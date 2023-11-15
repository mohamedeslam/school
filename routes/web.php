<?php

use App\Http\Controllers\AdminSchoolTeacherController;
use App\Http\Controllers\AdminSchoolActionController;
use App\Http\Controllers\AdminSchoolSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\emailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StaticAdminController;
use App\Http\Controllers\SchoolActionController;
use App\Http\Controllers\SubjectActionController;
use App\Http\Controllers\sendMassegeToSchoolAdmin;
use App\Http\Controllers\schoolAdminNotification;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Auth\Notifications\VerifyEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/resetMyPassword', [AuthController::class, 'resetMypassword'])->name('resetMypassword');
Route::get('/forgetMyPassword', [AuthController::class, 'forgetMyPassword'])->name('forgetMyPassword');
Route::post('login/checkLogin', [AuthController::class, 'login']);
Route::get('logoutUsers', [AuthController::class, 'logout'])->name('logoutUsers');
// School Admin Route Whithout Middelware
Route::GET('school/admin/endSub', function () {
    return view('schoolAdmin.subscriptionStatus', [
        'titelPage' => 'الإشتراك'
    ]);
})->name('redirectSubPage');
// [Admin] Group Routing
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::resource('admin/school', SchoolController::class);

    Route::get('/admin', [StaticAdminController::class, 'index'])->name('admin.home');
    Route::get('/admin/active', [StaticAdminController::class, 'ActiveSchool']);
    Route::get('/admin/settings', [StaticAdminController::class, 'settings']);
    Route::get('/admin/expirat', [StaticAdminController::class, 'expirat']);

    Route::get('/admin/school/schoolAction/editAdvansetSettings/{id}', [SchoolActionController::class, 'editAdvansetSettings']);
    Route::post('/admin/school/schoolAction/updateDate/{id}', [SubscriptionController::class, 'updateSubscription']);
    Route::post('/admin/school/schoolAction/updateUserName/{id}', [SchoolActionController::class, 'updateUserName']);
    Route::post('/admin/school/schoolAction/updatePassword/{id}/', [SchoolActionController::class, 'updatePassword']);
    Route::post('/admin/school/schoolAction/statusSchool/{id}', [SchoolActionController::class, 'statusSchool']);
    Route::get('/admin/school/schoolAction/chanselSubsc/{id}', [SchoolActionController::class, 'chanselSubsc']);
    Route::get('/admin/school/schoolAction/removeImage/{id}', [SchoolActionController::class, 'removeImage']);

    // Notification Route
    Route::POST('/admin/school/sendMassegeToSchoolAdmin/{id}', sendMassegeToSchoolAdmin::class);
    Route::POST('/admin/school/sendMassegeToSchoolAdmin/{id}', sendMassegeToSchoolAdmin::class);
});
// [School Admin] Group Routing
Route::middleware(['auth', 'user-role:schoolAdmin', 'checkSubscription', 'verificationMiddleware'])->group(function () {
    // Global Route And Index Route
    Route::get('school/admin', [AdminSchoolActionController::class, 'index'])->name('school.admin');
    Route::get('school/admin/settings', [AdminSchoolActionController::class, 'schoolAdminSettings']);
    Route::post('/school/admin/settings/updateSchoolInformation/{id}', [AdminSchoolActionController::class, 'updateSchoolInformation']);
    Route::POST('/school/admin/setting/updateUserName/{id}', [AdminSchoolActionController::class, 'updateUserName']);
    Route::POST('/school/admin/setting/updatePassword/{id}', [AdminSchoolActionController::class, 'updatePassword']);
    // Route Teatcher
    Route::resource('school/admin/teatcher', AdminSchoolTeacherController::class);
    Route::get('school/admin/teatcher/{teatcher}', [AdminSchoolTeacherController::class, 'show'])->middleware(['ChechTeatcherShowMiddleware']);
    Route::get('/school/admin/teatcher/settings/{id}', [AdminSchoolActionController::class, 'teatcherSettings']);
    Route::get('/adminSchool/teatcher/AdminSchoolActionController/removeImage/{id}', [AdminSchoolActionController::class, 'removeImage']);
    Route::post('/school/admin/updateTeatchetUserName/{id}', [AdminSchoolActionController::class, 'updateTeatchetUserName']);
    Route::post('/school/admin/updateTeatchetPassword/{id}', [AdminSchoolActionController::class, 'updateTeatchetPassword']);
    // Route subject 
    Route::resource('school/admin/subject', AdminSchoolSubjectController::class);
    Route::get('school/admin/subject/{subject}', [AdminSchoolSubjectController::class, 'show'])->middleware(['ChechSubjectShowMiddleware']);
    Route::post('/admin/school/SubjectActionController/addTeacherForSubject/{id}', [SubjectActionController::class, 'addTeacherForSubject']);
    Route::get('/admin/school/SubjectActionController/removeTeacherForSubject/{id}', [SubjectActionController::class, 'removeTeacherForSubject']);
    // Route::GET('/admin/school/getprofileImageForAllUsers',[publicControllerSchoolAdmin::class,'getprofileImageForAllUsers']);
});

// Route Notification
Route::GET('school/admin/notifications', [schoolAdminNotification::class, 'index']);
Route::GET('/school/admin/notification/{id}', [schoolAdminNotification::class, 'showNotification']);

Route::GET('/school/admin/notifications/delete', [schoolAdminNotification::class, 'deleteNotification']);
Route::GET('/school/admin/notifications/markAsRead', [schoolAdminNotification::class, 'markAsReadNotification']);
//Route Verification
Route::POST('/school/admin/verify-account/{userID}', [emailVerificationController::class, 'VerifyAccount'])->name('verifyEmail');
Route::GET('/school/admin/resendEmailVerification{userID}', [emailVerificationController::class, 'resendEmailVerification'])->name('resendEmailVerification');
Route::GET('school/admin/verified', [emailVerificationController::class, 'verified'])->name('verified');
Route::GET('school/admin/verifiedSuccss', [emailVerificationController::class, 'verifiedSuccss'])->name('verifiedSuccss');
