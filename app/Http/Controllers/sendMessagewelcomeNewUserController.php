<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class sendMessagewelcomeNewUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($userID, $userRole)
    {
        if ($userRole == 1) {
            $user = user::find($userID);
            $usersend       = Auth::User()->id;
            $title          = 'رسالة ترحبية';
            $title2          = 'التحقق من الحساب';
            $message        = 'أهلاً بك ،لقد تم إنشاء حساب المدرسة بنجاج يمكن الأن للمدرسة التمتع بمزايا المنصة الى حن إنتهاء الإشتراك في date و للتعرف على خصائص و مزايا المنصة يمكنك زيارة قائمة المساعة .';
            $message2        = 'تم إرسال رمز التحقق إلى بريدك الإلكتروني , الرجاء التحقق من البريد الإلكتروني';
            $notification   = array('id' => $usersend, 'title' => $title, 'massege' => $message);
            $notification2   = array('id' => $usersend, 'title' => $title2, 'massege' => $message2);
            notification::send($user, new \App\Notifications\sendMassegeToSchoolAdmin($notification));
            notification::send($user, new \App\Notifications\sendMassegeToSchoolAdmin($notification2));
        }
    }
}
