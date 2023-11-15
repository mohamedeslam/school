<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\models\User;

class sendMassegeToSchoolAdmin extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $request->validate(
            [
                'title'     => 'required|max:255',
                'massege'   => 'required|max:955'
            ],
            [
                'title.required'    => '*',
                'massege.required'  => '*',
                'title.max'         => 'عنوان الرسالة طويل جداً',
                'massege.max'       => 'محتوى الرسالة طويل جداً'
            ]
        );
        $user=user::find($id);
        $usersend       = Auth::User()->id;
        $title      = $request->input('title');
        $massege    = $request->input('massege');
        $notification = array('id' => $usersend, 'title' => $title, 'massege' => $massege);
        notification::send($user, new \App\Notifications\sendMassegeToSchoolAdmin($notification));
        return back()->with('success', 'تم الإرسال');

    }
}