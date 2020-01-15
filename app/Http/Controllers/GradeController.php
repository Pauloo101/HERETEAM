<?php

namespace App\Http\Controllers;

use App\Setting;
use App\student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('GradeSystem.index');
    }
    //approve subject result or all
    public function approve(Request $request){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $students = $request->students;
        $classroom = $request->classroom;
        $unapprove = $request->unapprove;
        foreach ($students as $key => $value) {
            $approve = DB::table('student_subject')
        ->where('session_id', $settings->session_id)
        ->where('term_id', $settings->term_id)
        ->where('classroom_id', $classroom)
        ->where('student_id',$value)
        ->update(['approve'=>1]);
        // aprove in student_session
        $session = DB::table('student_session')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $classroom)
                ->where('student_id', $value)
                ->update(['approve' => 1]);

        }
        foreach ($unapprove as $key => $value) {
            $approve = DB::table('student_subject')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $classroom)
                ->where('student_id', $value)
                ->update(['approve' => 0]);
            // aprove in student_session
            $session = DB::table('student_session')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $classroom)
                ->where('student_id', $value)
                ->update(['approve' => 0]);
        }

        return 'Operation successful';
        // $approve = student_subject::find($request->id);
        // if($approve->approve == 0){
        //     $approve->approve = 1;
        //     return 'Result approved';
        // }else{
        //     $approve->approve = 0;
        //     return 'Result unapproved';
        // }

    }
    // before it was approve per subject now it approve by class
    public function subjectresult(Request $request){
        // subject
        // classroom
        // section
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $students = DB::table('student_session')
        ->join('students','student_session.student_id','=','students.id')
        ->select('student_session.*','students.matric_no','students.first_name','students.surname')
        ->where('session_id',$settings->session_id)
        ->where('term_id',$settings->term_id)
        ->where('classroom_id',$request->classroom)->get();
        // ->where('section_id',$request->section)
        // ->where('subject_id',$request->subject)
        return $students;
    }

}
