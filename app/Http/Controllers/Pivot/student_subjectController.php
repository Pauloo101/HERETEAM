<?php

namespace App\Http\Controllers\Pivot;


use App\student_subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Arr;
use App\Setting;
class student_subjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchmarks(Request $request){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $subject = $request->subject;
        $classroom = $request->classroom;
        $section = $request->section;
        $marks = student_subject::select()
        ->where('session_id', $settings->session_id)
        ->where('term_id', $settings->term_id)
        ->where('subject_id', $subject)
        ->where('classroom_id',$classroom)
        ->where('section_id',$section)
        ->get();
        // $students = $marks[student_id];
        // dd($marks);
//         $all = count($marks);
//         for($i = 0 ; $i <= $all ; $i++ ){
////             $student_id = $marks[$i]['student_id'];
////             $student_name = Student::find($student_id)->pluck('first_name','surname');
//             // $here = $student_name.$marks[$i];
////             return Response::json(array('marks' => $marks, 'name' => $student_name));
//             $goal = [];
//              $marks = Arr::add($marks[$i] , 'edit' , 'hre');
//             $goal = Arr::prepend($goal, $marks);
//              return $goal;
//         };

        return $marks;
        // dd($marks);
    }

    public function record(Request $request)
    {
        //        $here = $request->all();
        //$input = filter_input_array(INPUT_POST);
        // $student = Input::all();
        $student = $request->all();
//        $id = $request->id;
        $recordstore = student_subject::find($request->input('id'));
        //$studentupdate = Student::find($request->input('id'));
        $recordstore->fill($student);
        $recordstore->save();
        return null;

        //        dd($request->all());
        //        \Log::info($request->all());
        //        \Log::info($request->all());
        //        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $studentsubject = student_subject::find($id);
        //dd($studentsubject);
        $studentsubject->testone = $request->testone;
        $studentsubject->testtwo = $request->testtwo;
        $studentsubject->testthree = $request->testthree;
        $studentsubject->exam = $request->exam;
        $studentsubject->save();
        return redirect()->route('subject.index');
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
