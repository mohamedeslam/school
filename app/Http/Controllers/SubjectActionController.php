<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teatcher;
use App\Models\Subject;
use App\Models\User;

class SubjectActionController extends Controller
{
    /**
     * Add Teatcher For subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addTeacherForSubject(Request $request, $id)
    {
        $getSubject = Subject::findOrFail($id);
        $teatcherID = $request->input('teatcherSelected');
        $getSubject->teatcher_id = $teatcherID;
        $getSubject->selection   = 1;
        $getTeatcher = Teatcher::findOrFail($teatcherID);
        $teatcherFirstName  = $getTeatcher->firstName;
        $teatcherLastName   = $getTeatcher->lastName;
        if($getSubject->save()){
            return back()->with('success','تم تعين المعلم '.$teatcherFirstName.' '.$teatcherLastName.' لهاذة المادة الدراسية');
        }
    }

    /**
     * Add Teatcher For subject.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeTeacherForSubject($id)
    {
        $getSubject = Subject::findOrFail($id);
        $getSubject->teatcher_id = NULL;
        $getSubject->selection   = 0;
        if($getSubject->save()){
            return back();
        }
    }
}
