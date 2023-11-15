<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teatcher;
use App\Models\User;
use App\Models\school;
use App\Models\subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminSchoolTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTeatcher = Teatcher::where('school_id', $this->HowIslog())->get();
        return view('schoolAdmin.teatcher.index', [
            'titelPage'     => 'الصفحة الرئيسية | المعلمين',
            'getTeatcher'   => $getTeatcher,
            'color'         => $this->color()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schoolAdmin.teatcher.create', [
            'titelPage' => 'انشاء معلم جديد',
            'schoolID'     => $this->HowIslog()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'teatcherProfile'   => 'mimes:jpeg,png,jpg|max:5120',
                'firstName'         => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',
                'lastName'          => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',
                'email'         => 'required|regex:/^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/',
                'phone'         => 'required|numeric',
                'userName'     => 'required|regex:/^[a-zA-Z0-9]+$/|not_regex:/^[0-9]+$/|min:5|max:50|unique:users,name',
                'password'      => 'required|min:8|max:30|confirmed',
                'password_confirmation' => 'required|min:8|max:30',
            ],
            [
                'teatcherProfile.mimes' => 'امتدادات الصور المسموح بها jpeg,png,jpg فقط',
                'teatcherProfile.max' => 'حجم الصورة كبير',

                'firstName.required'    => '*',
                'firstName.min'         => 'الاسم الاول قصير جداً',
                'firstName.regex'       => 'الاسم الاول غير صالح',

                'lastName.required'     => '*',
                'lastName.min'          => 'اسم الاب قصير جداً',
                'lastName.regex'        => 'اسم الاب غير صالح',

                'email.required'    => '*',
                'email.regex'       => 'عذراً البريد الإلكتروني غير صالح',

                'phone.required'    => '*',
                'phone.numeric'     => 'عذراً رقم الهاتف غير صالح',

                'userName.required'    => '*',
                'userName.not_regex'   => 'اسم المستخدم غير صالح',
                'userName.regex'       => 'اسم المستخدم غير صالح',
                'userName.min'         => 'اسم المستخدم قصير جداً',
                'userName.max'         => 'اسم المستخدم طويل جداً',
                'unique'                => 'اسم المستخدم موجود الرجاء اختيار اسم مستخدم اخر',
                'password.required'     => '*',
                'password.min'          => '(خانات 8) كلمة المرور قصير جداً',
                'password.max'          => 'كلمة المرور طويلة جداً',
                'password.confirmed'    => 'كلمة المرور غير متطابقة',
                'password_confirmation.required'    => '*',
                'password_confirmation.min'         => '(خانات 8) كلمة المرور قصير جداً',
                'password_confirmation.max'         => 'كلمة المرور طويلة جداً',
            ]
        );
        $obTeatcher = new Teatcher();
        $obUser = new user();
        $school = School::findOrFail($this->HowIslog());
        // dd($school->id);
        $valUserName = $request->input('userName');
        $valPassword = Hash::make($request->input('password'));
        $obUser->name  = $valUserName;
        $obUser->password = $valPassword;
        $obUser->role   = 2;

        if ($request->hasFile("teatcherProfile")) {

            $logo = $request->file("teatcherProfile");
            $schoolLogoName = $school->school_name . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $realSchoollogoName = $logo->storeAs('schools/' . $school->supDirSchool . "/imageProfile", $schoolLogoName);
            $obUser->schoolLogo = $realSchoollogoName;
        }

        if ($obUser->save()) {
            $getUserID = user::where('name', $valUserName)->where('password', $valPassword)->get();
            $valUserID = $getUserID->value('id');
            $obTeatcher->user_id = $valUserID;
            $obTeatcher->school_id = $school->id;
            $obTeatcher->firstName     = strip_tags($request->input('firstName'));
            $obTeatcher->lastName      = strip_tags($request->input('lastName'));
            $obTeatcher->address       = strip_tags($request->input('address'));
            $obTeatcher->email         = strip_tags($request->input('email'));
            $obTeatcher->phone         = strip_tags($request->input('phone'));
            if ($request->hasFile("teatcherProfile")) {
                $obTeatcher->teatcherProfile = $realSchoollogoName;
            }
            if ($obTeatcher->save()) {
                return redirect()->route('teatcher.index')->with('success', 'تم إنشاء المعلم بنجاح');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($teatcher)
    {
        $getTeatcher = Teatcher::findOrFail($teatcher);
        $getUser = User::findOrFail($getTeatcher->user_id);
        return view('schoolAdmin.teatcher.show', [
            'titelPage'     => 'العلم' . ' | ' . $getTeatcher->firstName . ' ' . $getTeatcher->lastName,
            'getTeatcher'   => $getTeatcher,
            'getUser'       => $getUser,
            'schoolID'      => $this->HowIslog(),
            'color'         => $this->color()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($teatcher)
    {
        $getTeatcher = Teatcher::findOrFail($teatcher);
        $getUser = User::findOrFail($getTeatcher->user_id);
        return view('schoolAdmin.teatcher.edit', [
            'titelPage'     => 'تعديل الملف الشخصي',
            'getTeatcher'   => $getTeatcher,
            'getUser'       => $getUser,
            'schoolID'      => $this->HowIslog(),
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
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'teatcherProfile'   => 'mimes:jpeg,png,jpg|max:5120',
                'firstName'         => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',
                'lastName'          => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',                'email'         => 'required|regex:/^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/',
                'phone'         => 'required|numeric',
            ],
            [
                'teatcherProfile.mimes' => 'امتدادات الصور المسموح بها jpeg,png,jpg فقط',
                'teatcherProfile.max' => 'حجم الصورة كبير',                'firstName.required'    => '*',
                'firstName.min'         => 'الاسم الاول قصير جداً',
                'firstName.regex'       => 'الاسم الاول غير صالح',

                'lastName.required'     => '*',
                'lastName.min'          => 'اسم الاب قصير جداً',
                'lastName.regex'        => 'اسم الاب غير صالح',

                'email.required'    => '*',
                'email.regex'       => 'عذراً البريد الإلكتروني غير صالح',

                'phone.required'    => '*',
                'phone.numeric'     => 'عذراً رقم الهاتف غير صالح',
            ]
        );
        $getTeatcher = Teatcher::findOrFail($id);
        $getSchool = School::findOrFail($getTeatcher->school_id);
        $getUser = user::findOrFail($getTeatcher->user_id);


        if ($request->hasFile("teatcherProfile")) {
            $image_pathOne = 'storage/' . $getUser->schoolLogo;
            $image_pathToo = 'storage/' . $getTeatcher->teatcherProfile;
            if (file_exists($image_pathOne)) {
                @unlink($image_pathOne);
            }
            if (file_exists($image_pathToo)) {
                @unlink($image_pathToo);
            }
            $logo = $request->file("teatcherProfile");
            $schoolLogoName = $getUser->name . '_' . $getUser->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $realSchoollogoName = $logo->storeAs('schools/' . $getSchool->supDirSchool . "/imageProfile", $schoolLogoName);
            $getTeatcher->teatcherProfile = $realSchoollogoName;
            $getUser->schoolLogo = $realSchoollogoName;
        }

        $logo = $request->hasFile("teatcherProfile");
        if ($logo) {
            $new_logo = $request->file("teatcherProfile");
            $logo_name = $new_logo->store("teatcherProfileImage");
            $getTeatcher->teatcherProfile = $logo_name;
        }

        $getTeatcher->firstName = strip_tags($request->input('firstName'));
        $getTeatcher->lastName  = strip_tags($request->input('lastName'));
        $getTeatcher->address   = strip_tags($request->input('address'));
        $getTeatcher->email     = strip_tags($request->input('email'));
        $getTeatcher->phone     = strip_tags($request->input('phone'));

        if ($getTeatcher->save() && $getUser->save()) {
            return redirect()->route('teatcher.index')->with('success', 'تم تحديث الملف الشخصي');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $teatcher = Teatcher::where('user_id', $user->id)->get();
        $teatcherProfile = $teatcher->value('teatcherProfile');
        // return 'storage/'.$teatcherProfile;
        if ($teatcherProfile != null) {
            Storage::delete($teatcherProfile);
        }
        $user->delete();

        return redirect()->route('teatcher.index')->with('success', 'تم حذف المعلم');
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

    // This Function Return SchoolID 
    public function HowIslog()
    {
        $userID = Auth::id();
        $school = school::where('user_id', $userID)->get();
        return $school->value('id');
    }
}
