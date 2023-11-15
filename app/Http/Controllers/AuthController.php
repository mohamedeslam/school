<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\school;
use App\models\Teatcher;
use App\models\User;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login.sing-in');
    }
    public function resetMyPassword()
    {
        return view('login.resetMypassword');
    }
    public function forgetMyPassword()
    {
        return view('login.forgetMyPassword');
    }
    public function login(Request $request)
    {
        $input = $request->all();

        // $this->validate([],[]);

        if (auth()->attempt(['name' => $input['userName'], 'password' => $input['password']])) {
            if (auth()->user()->role == 'admin') {
                return redirect()->Route('admin.home');
            } else if (auth()->user()->role == 'schoolAdmin') {
                return redirect()->Route('school.admin');
            }
        } else {
            return redirect()
                ->route('login')
                ->with('singInError', 'اسم المستخدم أو كلمة المرور خطاء');
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function verifyEmail($verificationCode)
    {

        $user = User::where('email_verified_at', $verificationCode)->first();
        if (!$user) {
            redirect()->route('login')->with('danger', 'invalid URL');
        } else {
            if ($user->email_verified_at) {
                redirect()->route('login')->with('success', 'you\'r Acount Already verified');
            } else {
                $user->update([
                    'email_verified_at' => \carbon\carbon::now()
                ]);
                redirect()->route('login')->with('success', 'you\'r Acount Successfully verified');
            }
        }
    }
}
