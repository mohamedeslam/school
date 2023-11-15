<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SchoolController;


use App\Models\school;


class CheckSubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userID = Auth::id();
        $school = School::where('user_id', $userID)->get();
        $subscriptionValue = $school->value('subscription');

        $subscription = SchoolController::subscriptionstatus($subscriptionValue);
        if($subscription == 0){
            return redirect()->Route('redirectSubPage');
            // abort(403); //Readirect to Page  
        }
        return $next($request);
    }
}
