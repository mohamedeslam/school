<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
// use App\Models\Teatcher;

class CheckSchoolMddleware
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
        $findID = school::where('user_id', $userID)->get();
        $schoolID = $findID->value('id');

        // $teatcher = $request -> route('teatcher');
        // $findTeatcherID = Teatcher::where('id', $teatcher)->get();
        // $schoolForTeatcherID = $findTeatcherID->value('school_id');

        $school = $request->route('schoolID');
        if ($school != $schoolID) {
            abort(403);
        }
        return $next($request);
    }
}
