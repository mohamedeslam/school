<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Models\school;
use App\Models\Teatcher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Http\Controllers\sendMessagewelcomeNewUserController;
// use Mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Database\DBAL\TimestampType;

class SchoolController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.school.schools', [
            'titelPage' => 'الصفحة الرئيسية | للمدارس ',
            'getSchool' => school::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.school.create', [
            'titelPage' => 'اضافة مدرسة جديدة'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'logo'          => 'mimes:jpeg,png,jpg|max:5120',
                'school_name'   => 'required|regex:/[a-zA-Zء-ي]/|min:2|max:50',
                'phone'         => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
                'email'         => 'required|regex:/^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/|unique:users,email',
                'city'          => 'required',
                'town'          => 'required',
                'street'        => 'required',
                'subscription'  => 'required|numeric',
                'about'         => 'max:255',
                'user_name'     => 'required|regex:/^[a-zA-Z0-9]+$/|not_regex:/^[0-9]+$/|min:5|max:50|unique:users,name',
                'password'      => 'required|min:8|max:30|confirmed',
                'password_confirmation' => 'required|min:8|max:30',
            ],
            [
                // Message for logo
                'logo.mimes' => 'امتدادات الصور المسموح بها jpeg,png,jpg فقط',
                'logo.max' => 'حجم الصورة كبير',

                // Message for school name
                'school_name.required'  => '*',
                'school_name.regex'     => 'عذراً اسم المدرسة غير صالح',
                'school_name.min'       => 'اسم المدرسة قصير جداً',
                'school_name.max'       => 'اسم المدرسة طويل جداً',

                // Message for phone
                'phone.required'    => '*',
                'phone.regex'     => 'عذراً رقم الهاتف غير صالح',

                // message for email
                'email.required'    => '*',
                'email.regex'       => 'عذراً البريد الإلكتروني غير صالح',
                'email.unique'                => 'البريد الإلكتروني موجود الرجاء اختيار البريد الإلكتروني أخر',
                
                // message for address
                'city.required'     => '*',
                'town.required'     => '*',
                'street.required'   => '*',

                // message for numper of school
                'num_school.required_if'   => '*',

                // message for subscription
                'subscription.required' => '*',
                'subscription.numericx' => '*',

                // message for about
                'about.max' => '255 حرف ك حد أقصى',

                // message for user name
                'user_name.required'    => '*',
                'user_name.not_regex'   => 'اسم المستخدم غير صالح',

                'user_name.regex'       => 'اسم المستخدم غير صالح',
                'user_name.min'         => 'اسم المستخدم قصير جداً',
                'user_name.max'         => 'اسم المستخدم طويل جداً',
                'user_name.unique'                => 'اسم المستخدم موجود الرجاء اختيار اسم مستخدم اخر',
                'password.required'     => '*',
                'password.min'          => '(خانات 8) كلمة المرور قصير جداً',
                'password.max'          => 'كلمة المرور طويلة جداً',
                'password.confirmed'    => 'كلمة المرور غير متطابقة',
                'password_confirmation.required'    => '*',
                'password_confirmation.min'         => '(خانات 8) كلمة المرور قصير جداً',
                'password_confirmation.max'         => 'كلمة المرور طويلة جداً',
            ]
        );

        $ob_user = new user();
        $ob_school = new school();
        $u_ = $request->input('user_name');
        $p_ = Hash::make($request->input('password'));
        $ob_user->name = $request->input('user_name');
        $ob_user->email = $request->input("email");
        $ob_user->code_verified_at = Str::random(6);
        Mail::to($request->input('email'))->send(new EmailVerificationMail($ob_user));
        $ob_user->password  = $p_;
        $userRole = $ob_user->role = 1;
        $folderSchoolName = $u_ . '_' . time() . rand();
        mkdir('storage/schools/' . $folderSchoolName, 0777, true);
        mkdir('storage/schools/' . $folderSchoolName . '/imageProfile', 0777, true);


        if ($request->hasFile("logo")) {

            $logo = $request->file("logo");
            $schoolLogoName = $u_ . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $realSchoollogoName = $logo->storeAs('schools/' . $folderSchoolName . "/imageProfile", $schoolLogoName);
            $ob_user->schoolLogo = $realSchoollogoName;
        }
        if ($ob_user->save()) {
            $user_id_query = user::where('name', $u_)->where('password', $p_)->get();
            $user_id_value = $user_id_query->value('id');
            $ob_school->user_id = $user_id_value;

            $ob_school->school_name = $request->input("school_name");
            $ob_school->num_of_teacher = $request->input("num_teachers");
            $ob_school->num_of_students = $request->input("num_students");
            $ob_school->type_of = $request->input("type_of");
            $interval = $request->input("subscription");
            // [ calcSupsc() ] calculation subscraption
            $intervalDate = $this->calcSupsc($interval);
            $ob_school->subscription = $intervalDate;
            $ob_school->phone = $request->input("phone");
            $ob_school->email = $request->input("email");
            $ob_school->city_address = $request->input("city");
            $ob_school->town_address = $request->input("town");
            $ob_school->street_address = $request->input("street");
            $ob_school->about_school = $request->input("about");
            if ($request->hasFile("logo")) {
                $ob_school->schoolLogo = $realSchoollogoName;
            }
            $ob_school->supDirSchool = $folderSchoolName;
            if ($ob_school->save()) {

                $opNoty = new sendMessagewelcomeNewUserController();
                $opNoty->__invoke($user_id_value, $userRole); // Send Notification To New User
                return redirect()->route('school.index')->with('success', 'تم إضافة المدرسة بنجاح');
            } else {
                return back()->with('danger', 'توجد مشكلة لم يتم اضافة المدرسة');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($school_id)
    {
        $getSchool      = school::findOrFail($school_id);
        $getTeatcher    = Teatcher::where('school_id', $getSchool->id)->get();
        $getUser        = user::findOrFail($getSchool->user_id);
        $status         = $this->statusOfSupsc($getSchool->subscription);
        $supStatus      = $this->subscriptionstatus($getSchool->subscription);

        return view('admin.school.show', [
            'titelPage'         =>  'المدرسة',
            'getSchool'         =>  $getSchool,
            'getUser'           =>  $getUser,
            'getTeatcher'       =>  $getTeatcher,
            'subscriptionstatus' => $supStatus,
            'status'            => $status,
            'statusSup'         => $status,
        ]);
    }

    static function subscriptionstatus($subscription)
    {
        $yearSup = mb_substr($subscription, 0, 4);
        $monthSup = mb_substr($subscription, 5, 2);
        $daySup = mb_substr($subscription, 8, 2);


        $year   = date('Y');
        $month  = date('m');
        $day    = date('d');
        // dd($year.' '.$month.' '.$day);

        $testYear = $yearSup - $year;
        if ($testYear > 0) {
            if ($daySup <= $day) {
                $monthOfYear = $testYear * 12;
                $allMonthOfYear = $monthOfYear + $monthSup;
                $totallOfMonth = ($allMonthOfYear - $month) - 1;
                $calcDay    = 30 - $day;
                $totallDay   = $calcDay + $daySup;
                return 'الاشهر المتبقية ' . $totallOfMonth . ' الايام المتبقية ' . $totallDay;
            } elseif ($daySup > $day) {
                $monthOfYear = $testYear * 12;
                $allMonthOfYear = $monthOfYear + $monthSup;
                $totallOfMonth = ($allMonthOfYear - $month) - 1;
                $calcDaySup = 30 - $daySup;
                $calcDay    = 30 - $day;
                $totallDay = $calcDay - $calcDaySup;
                return 'الاشهر المتبقية ' . $totallOfMonth . ' الايام المتبقية ' . $totallDay;
            }
        } elseif ($testYear == 0) {
            if ($monthSup > $month) {
                if ($daySup <= $day) {
                    $totallMonth = ($monthSup - $month) - 1;
                    $calcDay    = 30 - $day;
                    $totallDay  = $calcDay + $daySup;
                    return 'الاشهر المتبقية ' . $totallMonth . ' الايام المتبقية ' . $totallDay;
                } elseif ($daySup > $day) {
                    $totallMonth = ($monthSup - $month);
                    $calcDaySup = 30 - $daySup;
                    $calcDay    = 30 - $day;
                    $totallDay = $calcDay - $calcDaySup;
                    return 'الاشهر المتبقية ' . $totallMonth . ' الايام المتبقية ' . $totallDay;
                }
            } elseif ($monthSup == $month) {
                if ($daySup > $day) {
                    $totallMonth = $monthSup - $month;
                    $calcDaySup = 30 - $daySup;
                    $calcDay    = 30 - $day;
                    $totallDay = $calcDay - $calcDaySup;
                    return 'الاشهر المتبقية ' . $totallMonth . ' الايام المتبقية ' . $totallDay;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } elseif ($testYear < 0) {
            return 0;
        } else {
            return 0;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getIdSchool = school::findOrFail($id);
        $getUser = user::findOrFail($getIdSchool->user_id);
        return view('admin.school.edit', [
            'titelPage' => 'تعديل بيانات المدرسة',
            'school'    => $getIdSchool,
            'user'      => $getUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'logo'          => 'mimes:jpeg,png,jpg|max:5120',
                'school_name'   => 'required|regex:/[a-zA-Zء-ي]/|min:2|max:50',
                'phone'         => 'required|numeric',
                'email'         => 'required|regex:/^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/',
                'city'          => 'required',
                'town'          => 'required',
                'street'        => 'required',
                'about'         => 'max:255'
            ],
            [
                // Message for logo
                'logo.mimes' => 'امتدادات الصور المسموح بها jpeg,png,jpg فقط',
                'logo.max' => 'حجم الصورة كبير',

                // Message for school name
                'school_name.required'  => '*',
                'school_name.regex'     => 'عذراً اسم المدرسة غير صالح',
                'school_name.min'       => 'اسم المدرسة قصير جداً',
                'school_name.max'       => 'اسم المدرسة طويل جداً',

                // Message for phone
                'phone.required'    => '*',
                'phone.numeric'     => 'عذراً رقم الهاتف غير صالح',

                // message for email
                'email.required'    => '*',
                'email.regex'       => 'عذراً البريد الإلكتروني غير صالح',

                // message for address
                'city.required'     => '*',
                'town.required'     => '*',
                'street.required'   => '*',

                // message for about 
                'about.max' => '255 حرف ك حد أقصى',
            ]
        );
        $getIdSchool = school::findOrFail($id);
        $getUserID = user::find($getIdSchool->user_id);

        /* Delete FIle Image After Delete And Edit
        [#] If Has Request Logo
        [A] Check Old Image Exist In File System
            [i] If file Image Exist
                - Delete FIle Image From File System
            [B] Save Image Name In Database
            [C] Storage Image In File System
        */

        if ($request->hasFile("logo")) {
            $image_pathOne = 'storage/' . $getUserID->schoolLogo;
            $image_pathToo = 'storage/' . $getIdSchool->schoolLogo;
            if (file_exists($image_pathOne)) {
                @unlink($image_pathOne);
            }
            if (file_exists($image_pathToo)) {
                @unlink($image_pathToo);
            }
            $logo = $request->file("logo");
            $schoolLogoName = $getUserID->name . '_' . $getUserID->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $realSchoollogoName = $logo->storeAs('schools/' . $getIdSchool->supDirSchool . "/imageProfile", $schoolLogoName);
            $getIdSchool->schoolLogo = $realSchoollogoName;
            $getUserID->schoolLogo = $realSchoollogoName;
            $getIdSchool->save();
            $getUserID->save(); //edite this 
        }
        $getIdSchool->school_name = $request->input('school_name');
        $getIdSchool->num_of_teacher = $request->input('num_teachers');
        $getIdSchool->num_of_students = $request->input('num_students');
        $getIdSchool->phone = $request->input('phone');
        $getIdSchool->email = $request->input('email');
        $getIdSchool->city_address = $request->input('city');
        $getIdSchool->town_address = $request->input('town');
        $getIdSchool->street_address = $request->input('street');
        $getIdSchool->type_of = $request->input('type_of');
        $getIdSchool->about_school = $request->input("about");
        $getIdSchool->save();
        return redirect()->route('school.show', $getIdSchool->id)->with('success', 'تم تحديث الملف الشخصي');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delUser = user::findOrFail($id);
        $getSchool = school::where('user_id', $delUser->id)->get();
        $supDirSchool = $getSchool->value('supDirSchool');
        $folderPath = 'storage/schools/' . $supDirSchool;
        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        }
        $delUser->delete();
        return redirect()->route('school.index');
    }

    static function calcSupsc($interval)
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $date = date_create($year . $month . $day);
        date_add($date, date_interval_create_from_date_string($interval . 'month'));
        return date_format($date, 'Y-m-d');
    }

    static function statusOfSupsc($date)
    {
        $toDay = date('Y-m-d');
        if ($toDay >= $date) {
            return "block";
        } else {
            return "unblock";
        }
    }
}
