<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\student_subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Student_Session;
use App\Setting;
use App\Models\sections;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Student::find(1)->with('classrooms');

        // $classroom = Classroom::with('subjects')->get();
        // $subjects = Subject::all();
        // return view('Subject.index', compact('subjects', 'classroom', 'diff'));
        return view('Subject.index');
    }

    //assign a class to a subject
    public function assignclass(Request $request)
    {
        $subject = Subject::find($request->input('subject_id'));
        $subject->classrooms()->sync($request->classroom_id, false);
        dd($request);
        return redirect()->route('subject.show', ['subject' => $subject]);
    }
// reg student using select2 in frontend
    public function Regstudent(Request $request)
    {
        $subjects = $request->subject;
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $student = Student_Session::select()
            ->where('student_id', $request->student) //change to student
            ->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->get();
        $id = $student[0]["section_id"];
        $classroom = $student[0]["classroom_id"];
        $student_name = $student[0]["student_name"];
        $classroom_name = Classroom::find($classroom);
        $section_name = sections::find($id);
        foreach ($subjects as $subject ){
            $student_subject = new student_subject;
            $student_subject->session_id = $settings->session_id;
            $student_subject->term_id = $settings->term_id;
            $student_subject->student_id = $request->student;
            $student_subject->classroom_id = $classroom;
            $student_subject->classroom_name = $classroom_name->name;
            $student_subject->section_id = $id;
            $student_subject->section_name = $section_name->name;
            $student_subject->subject_id = $subject;
            $student_subject->student_name = $student_name;
            $student_subject->save();
        }
        return 'Assiged a single Student';
    }

    public function RegClass(Request $request)
    {
        $settings = Setting::select()->where('Is_Active', 1)->first();
        // $this->validate($request, [
        //     'name' => ['required', 'unique:subjects']
        // ]);
        $classroom = $request->classroom;
        $subject = $request->subject;
        $section = $request->section;
        $classroom_name = Classroom::find($classroom);
        if($section == 'all'){
        $students = Student_Session::where('classroom_id', $classroom)
            ->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->get();
        foreach ($students as $student){
            $student_subject = new student_subject;
            $student_subject->session_id = $settings->session_id;
            $student_subject->term_id = $settings->term_id;
            $student_subject->student_id = $student->student_id;
            $student_subject->classroom_id = $student->classroom_id;
            $student_subject->classroom_name = $classroom_name->name;
            $student_subject->section_id = $student->section_id;
                $section_name = sections::find( $student->section_id);
            $student_subject->section_name = $section_name->name;
            $student_subject->subject_id = $subject;
            $student_subject->student_name = $student->student_name;
            $student_subject->save();
        }

        }
        else{
            $students = Student_Session::select()
                ->where('classroom_id', $classroom)
                ->where('section_id', $section)
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->get();
            $id = $request->section;
            $section_name = sections::find($id);
            foreach ($students as $student){
                $student_subject = new student_subject;
                $student_subject->session_id = $settings->session_id;
                $student_subject->term_id = $settings->term_id;
                $student_subject->student_id = $student->student_id;
                $student_subject->classroom_id = $student->classroom_id;
                $student_subject->classroom_name = $classroom_name->name;
                $student_subject->section_id = $student->section_id;
                $student_subject->section_name = $section_name->name;
                $student_subject->subject_id = $subject;
                $student_subject->student_name = $student->student_name;
                $student_subject->save();
            }
//
        }
        return 'done';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:subjects']
        ]);
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->save();
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id)->classrooms;
        $subname = Subject::find($id);
        $classroom = Classroom::all();
        $students = Student::all();
        $studentsubject = student_subject::select()->where('subject_id', $id)->get();
        // $sspivot = student_subject::select()->where('subject_id', $id)->get();
        $studentsub = Subject::find($id)->students;
        return view('Subject.show', compact(
            'subject', 'subname', 'students', 'studentsubject', 'studentsub', 'classroom'));
        // dd($studentsub);
        //here okay
        //return $subject;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function fetchsubject(Request $request)
    {
//        dd($request);
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $classroom =  Student_Session::select()->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->where('student_id', $request->student)->pluck("classroom_id");
        $subjects = Classroom::with('subjects')->find($classroom)->pluck('subjects');
//        dd($subjects);
//       $subject = DB::table('classroom_subject')->select('subject_id')
//           ->where('classroom_id', $request->classroom)->get();
       return $subjects;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getsubject(){
        $subject = Subject::with('classrooms')->get();
        return $subject;
    }
}
