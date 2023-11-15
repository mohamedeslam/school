<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;

class emailVerificationController extends Controller
{

    public function verified()
    {
        return view(
            'schoolAdmin.verification.verified',
            [
                'titelPage' => 'تحقق من البريد الإلكتروني',
                // 'try'       =>
            ]
        );
    }
    public function verifiedSuccss()
    {
        return view(
            'schoolAdmin.verification.verifiedSuccss',
            [
                'titelPage' => 'تحقق من البريد الإلكتروني'
            ]
        );
    }

    public function VerifyAccount(Request $code, $userID)
    {
        $code->validate(
            [
                'first'   => 'required',
                'second'   => 'required',
                'third'   => 'required',
                'fourth'   => 'required',
                'fifth'   => 'required',
                'sixth'   => 'required'
            ]
        );
        $first = $code->input('first');
        $second = $code->input('second');
        $third = $code->input('third');
        $fourth = $code->input('fourth');
        $fifth = $code->input('fifth');
        $sixth = $code->input('sixth');
        $arr = array($first, $second, $third, $fourth, $fifth, $sixth);
        $code = implode($arr);
        $user = User::find($userID);
        // dd('code ' . $code . '    ' . 'DB code ' . $user->code_verified_at);
        if (Auth::check()) {
            if (!is_null($user->email_verified_at) && is_null($user->code_verified_at)) {
                return back()->with('erorr', 'الحساب يعمل , لقد تم التحقق من هذا الحساب مسبقاً');
            } elseif (is_null($user->email_verified_at) && !is_null($user->code_verified_at)) {
                if ($user->code_verified_at == $code) {
                    $user->email_verified_at = date('Y-m-d');
                    $user->code_verified_at = null;
                    $user->save();
                    return redirect()->route('verifiedSuccss');
                } else {
                    return back()->with('erorr', 'الرمز خاطأ الرجاء التأكد منه و المحاولة مرة أخرى');
                }
            } else {
                return back()->with('erorr', 'URL غير صحيح الرجاء المحاولة مرة أخرى');
            }
        }
    }

    public function resendEmailVerification($userID)
    {

        // session::put('try',0);
        // dd(session::get('qwe'));
        // session::get('try')+1;
        // return back();
        // session::increment('try');
        $user = User::find($userID);
        if (!is_null($user->email_verified_at)) {
            return back()->with('erorr1', 'الحساب يعمل , لقد تم التحقق من هذا الحساب مسبقاً');
        } else {
            if (session('try') < 3) {
                $user->code_verified_at = Str::random(6);
                Mail::to($user->email)->send(new EmailVerificationMail($user));
                $user->save();
                Session::increment('try');
                return back()->with('success1', 'تم إرسال الرمز');
            } elseif (session('try') >= 3 && !is_null($user->code_verified_at)) {
                session::forget('try');
                return back()->with('erorr1', 'تم إرسال الرمز بالفعل , إذا لم تتلقى الرمز الرجاء التأكد من البريد الإلكتروني');
            }
        }
    }
}
