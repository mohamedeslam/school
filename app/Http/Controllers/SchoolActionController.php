<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\school;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SchoolActionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdvansetSettings($id)
    {
        $getIdSchool = school::findOrFail($id);
        $getUser = user::findOrFail($getIdSchool->user_id);
        return view('admin.school.advansetSetting', [
            'titelPage'     => 'الإعدادات المتقدمة',
            'getSchool'     => $getIdSchool,
            'getUser'       => $getUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserName(Request $request, $id)
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

        $getUserName = user::findOrFail($id);
        $getUserName->name = $request->input('userName');
        if ($getUserName->save()) {
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
    public function updatePassword(Request $request, $id)
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
        $newPassword = $request->input('newPassword');
        $oldPassowrd = $request->input('oldPassword');
        if (Hash::check($oldPassowrd, $getPassword->password)) {
            if (Hash::check($newPassword, $getPassword->password)) {
                return back()->with('danger', 'كلمة المرور مضافة مسبقاً , الرجاء اختيار كلمة مرور جديدة');
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



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statusSchool(Request $request, $id)
    {
        $getSchool = school::findOrFail($id);
        $inputVlaue = $request->input('status');
        if ($inputVlaue == 'on' && $getSchool->status == 0) {
            $getSchool->status = 1;
            $getSchool->save();
            return back();
        } elseif ($inputVlaue == null && $getSchool->status == 1) {
            $getSchool->status = 0;
            $getSchool->save();
            return back()->with('success', 'تم حظر المدرسة');
        } else {
            return back()->with('danger', 'يوجد خطاء');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function chanselSubsc($id)
    {
        $getSchool = school::findOrFail($id);
        $date = date('Y-m-d');
        $getSchool->subscription = $date;
        if ($getSchool->save()) {

            return back()->with('success', 'تم إلغاء الإشتراك');
        }
    }

    // static function calcSupsc($interval, $oldDate)
    // {
    //     $date = date_create($oldDate);
    //     date_add($date, date_interval_create_from_date_string($interval . 'month'));
    //     return date_format($date, 'Y-m-d');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImage($id)
    {
        $getImageFromSchool = school::findOrFail($id);
        $getImageFromUser   = user::find($getImageFromSchool->user_id);
        $image_path = 'storage/' . $getImageFromSchool->schoolLogo;

        if (file_exists($image_path)) {

            @unlink($image_path);
        }
        $getImageFromSchool->schoolLogo = null;
        $getImageFromSchool->save();
        $getImageFromUser->save();
        return back();
    }
}
