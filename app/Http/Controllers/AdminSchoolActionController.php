<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teatcher;
use App\Models\User;
use App\Models\school;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSchoolActionController extends Controller
{
    public function HowIslog()
    {
        $userID = Auth::id();
        $findID = school::where('user_id', $userID)->get();
        return $findID->value('id');
    }

    public function index()
    {
        return view('schoolAdmin.index', [
            'schoolID'  => $this->HowIslog(),
            'titelPage' => 'الصفحة الرئيسية'
        ]);
    }

    public function schoolAdminSettings()
    {
        $userID = Auth::id();
        $user = user::findOrFail($userID);
        $school = School::findOrFail($this->HowIslog());
        return view('schoolAdmin.settings', [
            'titelPage' => 'الاعدادات العامة',
            'user'      => $user,
            'school'    => $school
        ]);
    }

    public function updateSchoolInformation(request $request, $id)
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
            ],
            [
                // Message for logo
                // 'logo.mimes' => 'امتدادات الصور المسموح بها jpeg,png,jpg فقط',
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
                'city.required'         => '*',
                'town.required'         => '*',
                'street.required'       => '*',
            ]
        );

        $school = School::findOrFail($id);
        $user   = User::findOrFail($school->user_id);


        if ($request->hasFile("logo")) {
            $image_pathOne = 'storage/' . $user->schoolLogo;
            $image_pathToo = 'storage/' . $school->schoolLogo;
            if (file_exists($image_pathOne)) {
                @unlink($image_pathOne);
            }
            if (file_exists($image_pathToo)) {
                @unlink($image_pathToo);
            }
            $logo = $request->file("logo");
            $schoolLogoName = $user->name . '_' . $user->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $realSchoollogoName = $logo->storeAs('schools/' . $school->supDirSchool . "/imageProfile", $schoolLogoName);
            $school->schoolLogo = $realSchoollogoName;
            $user->schoolLogo = $realSchoollogoName;
        }



        $school->school_name = $request->input('school_name');
        $school->phone = $request->input('phone');
        $school->email = $request->input('email');
        $school->city_address = $request->input('city');
        $school->town_address = $request->input('town');
        $school->about_school = $request->input('about');
        $school->street_address = $request->input('town');
        if ($school->save() &&  $user->save()) {
            return back()->with('success', 'تم تحديث البيانات ');
        }
    }

    public function updateUserName(request $request, $id)
    {
        $request->validate(
            [
                'userName' => 'required|regex:/^[a-zA-Z0-9]+$/|not_regex:/^[0-9]+$/|min:5|max:50|unique:users,name'
            ],
            [
                'userName.required'    => '*',
                'userName.regex'       => 'اسم المستخدم غير صالح',
                'userName.not_regex'   => 'اسم المستخدم غير صالح',
                'userName.min'         => 'اسم المستخدم قصير جداً',
                'userName.max'         => 'اسم المستخدم طويل جداً',
                'userName.unique'      => 'اسم المستخدم موجود الرجاء اختيار اسم مستخدم اخر'
            ]
        );

        $user = user::findOrFail($id);
        $user->name = $request->input('userName');
        if ($user->save()) {
            return back()->with('success', 'تم تحديث اسم المستخدم');
        }
    }

    public function updatePassword(request $request, $id)
    {

        $request->validate(
            [
                'oldPassword'               => 'required',
                'newPassword'              => 'required|min:8|max:30|confirmed',
                'newPassword_confirmation' => 'required|min:8|max:30'
            ],
            [
                'oldPassword.required'     => '*',
                'newPassword.required'     => '*',
                'newPassword.min'          => '(8 خانات) كلمة المرور قصير جداً',
                'newPassword.max'          => 'كلمة المرور طويلة جداً',
                'newPassword.confirmed'    => 'كلمة المرور غير متطابقة',
                'newPassword_confirmation.required'  => '*',
                'newPassword_confirmation.min'       => '(خانات 8) كلمة المرور قصير جداً',
                'newPassword_confirmation.max'       => 'كلمة المرور طويلة جداً'
            ]
        );
        $getPassword = user::findOrFail($id);
        $oldPassowrd = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        if (Hash::check($oldPassowrd, $getPassword->password)) {
            if (Hash::check($newPassword, $getPassword->password)) {
                return back()->with('passowdDontAdd', 'لكلمة المرور مضافة مسبقاً , الرجاء اختيار كلمة مرور جديدة');
            } else {
                $getPassword->password = Hash::make($request->input('newPassword'));
                if ($getPassword->save()) {
                    return back()->with('successx', 'تم تحدث كلمة المرور');
                }
            }
        } else {
            return back()->with('passowdDontAdd', 'كلمة المرور التي ادخلتها خطأ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImage($id)
    {
        $delImage = Teatcher::findOrFail($id);
        $delImage->teatcherProfile = null;
        $delImage->save();
        return back();
    }

    /**
     * teatcherAncetSetting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teatcherSettings($id)
    {
        $getTeatcher    = Teatcher::findOrFail($id);
        $getUser        = User::findOrFail($getTeatcher->user_id);
        return view('schoolAdmin.teatcher.advansetSettings', [
            'titelPage'     => 'الإعدادات المتقدمة',
            'getUser'       => $getUser,
            'getTeatcher'   => $getTeatcher,
            'color'         => $this->color()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTeatchetUserName(Request $request, $id)
    {
        $request->validate(
            [
                'userName'     => 'required|regex:/^[a-zA-Z0-9]+$/|not_regex:/^[0-9]+$/|min:5|max:50|unique:users,name'
            ],
            [
                'userName.required'    => '*',
                'userName.not_regex'   => 'اسم المستخدم غير صالح',
                'userName.regex'       => 'اسم المستخدم غير صالح',
                'userName.min'         => 'اسم المستخدم قصير جداً',
                'userName.max'         => 'اسم المستخدم طويل جداً',
                'unique'                => 'اسم المستخدم موجود الرجاء اختيار اسم مستخدم اخر',
            ]
        );
        $getUser = User::findOrFail($id);
        $getUser->name = $request->input('userName');

        if ($getUser->save()) {
            return back()->with('success', 'تم تحديث اسم المستخدم');
        } else {
            return back()->with('danger', 'توجد مشكلة لم يتم تحديث البيانات');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTeatchetPassword(Request $request, $id)
    {

        $request->validate(
            [
                'oldPassword'               => 'required',
                'newPassword'              => 'required|min:8|max:30|confirmed',
                'newPassword_confirmation' => 'required|min:8|max:30'
            ],
            [
                'oldPassword.required'     => '*',
                'newPassword.required'     => '*',
                'newPassword.min'          => '(8 خانات) كلمة المرور قصير جداً',
                'newPassword.max'          => 'كلمة المرور طويلة جداً',
                'newPassword.confirmed'    => 'كلمة المرور غير متطابقة',
                'newPassword_confirmation.required'  => '*',
                'newPassword_confirmation.min'       => '(خانات 8) كلمة المرور قصير جداً',
                'newPassword_confirmation.max'       => 'كلمة المرور طويلة جداً'
            ]
        );
        $getPassword = user::findOrFail($id);
        $oldPassowrd = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        if (Hash::check($oldPassowrd, $getPassword->password)) {
            if (Hash::check($newPassword, $getPassword->password)) {
                return back()->with('danger', 'لكلمة المرور مضافة مسبقاً , الرجاء اختيار كلمة مرور جديدة');
            } else {
                $getPassword->password = Hash::make($request->input('newPassword'));
                if ($getPassword->save()) {
                    return back()->with('success', 'تم تحدث كلمة المرور');
                }
            }
        } else {
            return back()->with('danger', 'كلمة المرور التي ادخلتها خطأ');
        }
    }

    public function color()
    {
        $num = rand(0, 2);
        if ($num == 0)
            return "secondary";
        elseif ($num == 1)
            return "info";
        else
            return "dark";
    }
}
