<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\MOdels\Subject;

class ChechSubjectShowMiddleware
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
        $schoolID = $school->value('id');

        $subjectID = $request->route('subject');
        $subject = Subject::where('id', $subjectID)->get();
        $schoolIDFromSubject = $subject->value('school_id');
        if ($schoolID == $schoolIDFromSubject) {
            return $next($request);
        }
        abort(403);
    }
}
