<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Subject;
use App\Models\teatcher;
use App\Http\Controllers\AdminSchoolActionController;

class AdminSchoolSubjectController extends Controller
{
    public function HowIslog()
    {
        $userID = Auth::id();
        $findID = school::where('user_id', $userID)->get();
        return $findID->value('id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSubject     =   subject::where('school_id', $this->HowIslog())->get();
        $getSchool      =   School::findOrfail($this->HowIslog());
        if($getSchool->type_of == 'ثانوي'){
            $typeOfSchool = 3; // ثانوي 
        }elseif($getSchool -> type_of == 'اساس'){
            $typeOfSchool = 8;
        }
        return view('schoolAdmin.subject.index', [
            'titelPage'         => 'الصفحة الرئيسية | المواد الدراسية',
            'getSubject'        => $getSubject,
            'typeOfSchool'      =>  $typeOfSchool,
            'color'             => $this->color()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schoolAdmin.subject.create', [
            'titelPage' => 'إنشاء مادة دراسية جديدة',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'subjectName'   => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',
                'level'         => 'required|numeric'
            ],
            [
                'subjectName.required'  =>  '*',
                'subjectName.min'       =>  'إسم المدرسة قصير جداً',
                'subjectName.regex'     =>  'إسم المدرسة غير صالح',
                'level.required'        =>  '*',
                'numeric'               =>  'الرجاء تحديد المستوى التعليمي'
            ]
        );
        $obSubject = new Subject();
        $getSubject = Subject::where('school_id', $this->HowIslog())->get();
        foreach ($getSubject as $subject) {
            if ($subject->name == $request->input('subjectName') && $request->input('level') == $subject->level) {
                return back()->with('danger', 'عذراَ تم اضافة هذة المادة في هذا المستوى التعليمي من قبل "قم بإختيار اسم اخر للمادة" أو "قم بتغير المستوى التعليمي"');
            }
        }
        $obSubject->school_id = $this->HowIslog();
        $obSubject->name      = $request->input('subjectName');
        $obSubject->level     = $request->input('level');
        if ($obSubject->save()) {
            return back()->with('success', 'تم إنشاء المادة');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getSubject = Subject::findOrFail($id);
        $getTeacher = Teatcher::find($getSubject->teatcher_id);

        $getRandomTeatcher = Teatcher::where('school_id', '=', $getSubject->school_id)->limit(7)->get();
        $getAllTeatcher = Teatcher::where('school_id', $getSubject->school_id)->get();
        return view('schoolAdmin.subject.show', [
            'titelPage'         => 'المادة الدراسية' . ' | ' . $getSubject->name,
            'getSubject'        => $getSubject,
            'getUser'        => $getRandomTeatcher,
            'getTeatcher'       => $getTeacher,
            'getAllTeatcher'    => $getAllTeatcher,
            'color'             => $this->color(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getSubject = Subject::findOrFail($id);
        return view('schoolAdmin.subject.edit', [
            'titelPage'     => 'تعديل المادة الدراسية' . ' | ' . $getSubject->name,
            'getSubject'    => $getSubject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'subjectName'   => 'required|regex:/^[\p{Arabic}a-zA-Z\s]+$/u|min:2',
                'level'         => 'required'
            ],
            [
                'subjectName.required'  => '*',
                'subjectName.min'       => 'إسم المدرسة قصير جداً',
                'subjectName.regex'     => 'إسم المدرسة غير صالح',
                'level.required'        => '*'
            ]
        );

        $getSubject = Subject::findOrFail($id);

        $findSubject = Subject::where('school_id', $this->HowIslog())->get();
        foreach ($findSubject as $subject) {

            if ($subject->name == $request->input('subjectName') && $request->input('level') == $subject->level) {
                return back()->with('danger', 'عذراَ تم اضافة هذة المادة في هذا المستوى التعليمي من قبل "قم بإختيار اسم اخر للمادة" أو "قم بتغير المستوى التعليمي"');
            }
        }
        $getSubject->name      = $request->input('subjectName');
        $getSubject->level     = $request->input('level');
        if ($getSubject->save()) {

            return back()->with('success', 'تم تعديل المادة');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $getSubject = subject::findOrFail($id);
        $getSubject->delete();
        return redirect()->route('subject.index');
    }

    public function color()
    {
        $num = rand(0, 2);
        if ($num == 0)
            return "secondary";
        elseif ($num == 1)
            return "info";
        else
            return "dark";
    }
}
