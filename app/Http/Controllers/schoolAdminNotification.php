<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\notification;

use App\Models\user;
use App\Models\school;
use App\Models\teatcher;
use Illuminate\Notifications\Notifiable;

class schoolAdminNotification extends Controller
{
    public function index()
    {

        return view(
            'schoolAdmin\notifications',
            [
                'titelPage' =>  'الإشعارات',
            ]
        );
    }
    public function showNotification($notificatonID)
    {
        $notification = notification::findOrFail($notificatonID);
        auth()->user()->notifications->where('id', $notificatonID)->markAsRead();
        return view('schoolAdmin/notification', [
            'titelPage'     =>  'إشعار',
            'notification'   =>  $notification,
        ]);
    }
    public function deleteNotification()
    {
        $user = auth::user();
        $user->notifications()->delete();
        return back();
    }
    public function markAsReadNotification(){
        auth()->user()->notifications->markAsRead();
        return back();

    }
}
