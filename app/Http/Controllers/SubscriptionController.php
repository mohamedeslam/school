<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;


class SubscriptionController extends Controller
{
    public function updateSubscription(Request $request, $id)
    {
        $getSubscription = school::findOrFail($id);

        // $createToDayDate = date('Y-m-d');
        $subscriptionFromDB = $getSubscription->subscription;
        // dd($subscriptionFromDB);
        $interval = $request->input('subscription');
        $dateInterval = $this->calcSupsc($interval, $subscriptionFromDB);
        // dd($dateInterval);
        $getSubscription->subscription = $dateInterval;
        
        if ($getSubscription->save()) {
            //Send Notification To School Tell Them The Subscription Is Updated 
            return back()->with('success', 'تم تمديد فترة الإشتراك بنجاح سوف ينتهي هذة الإشتراك في ' .$dateInterval);
        }
    }

    static function calcSupsc($interval, $oldDate)
    {
        $date = date_create($oldDate);
        date_add($date, date_interval_create_from_date_string($interval . 'month'));
        return date_format($date, 'Y-m-d');
    }
}
