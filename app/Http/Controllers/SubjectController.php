<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\student_subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $subject = Subject::all();
       //$class = Classroom::all();
        $classroom = Classroom::with('subjects')->get();
        $subjects = Subject::all();
        //with('classrooms')->get();
        //$sub=Subject::with('classrooms')->get()->diff($subjects);
        //$diff = $class->diff($classroom);
        //$here = $subjects->classrooms
        //dd($sub);
        return view('Subject.index',compact('subjects','classroom','diff'));
    }
    //assign a class to a subject
    public function assignclass(Request $request)
    {
        $subject = Subject::find($request->input('subject_id'));
        $subject->classrooms()->sync($request->classroom_id, false);
        //$classroom = Classroom::where('id',$request->input('classroom_id'))->first();
//        dd($subject,$classroom);
//        if($classroom){
//            $subject->classrooms()->attach($classroom->id);
//        }
       // $assigned = Student::find($subject)->classrooms;
        return redirect()->route('subject.show',['subject'=>$subject]);
    }

    public function Regstudent(Request $request)
    {
        $subject = Subject::find($request->input('subject_id'));
        $subject->students()->sync($request->student_id, false);
        return redirect()->route('subject.show',['subject'=>$subject]);

    }
    public function RegClass(Request $request){
        // all student in a class in subject.show
        $subject = Subject::find($request->input('subject_id'));
        $student  = Student::find($request->classroom_id)->pluck('id');
        //dd($student);
        $subject->students()->sync($student, false);
        return redirect()->route('subject.show',['subject'=>$subject]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required','unique:subjects']
        ]);
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->save();
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id)->classrooms;
        $subname = Subject::find($id);
        $classroom = Classroom::all();
        $students = Student::all();
        $sspivot = student_subject::select()->where('subject_id', $id)->get();
       $studentsub = Subject::find($id)->students;
       //dd($studentsubject);
        //here okay
        //return $subject;
          return view ('Subject.show', compact(
              'subject','subname','students','studentsub','sspivot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
