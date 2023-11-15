<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Teatcher;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class ChechTeatcherShowMiddleware
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
        $school = school::where('user_id', $userID)->get();
        $schoolID = $school->value('id');

        $teatcherID = $request->route('teatcher');
        $teatcher = Teatcher::where('id', $teatcherID)->get();
        $schoolIDFromTeatcher = $teatcher->value('school_id');

        if ($schoolID == $schoolIDFromTeatcher) {

            return $next($request);
        }
        abort(403);
    }
}