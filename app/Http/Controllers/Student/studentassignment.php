<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class studentassignment extends Controller
{
    public function getbasic(Request $request){
        $student = $request->student;
        $assignment = DB::table('assignment_student')
        ->join('assignments','assignment_student.assignment_id','=','assignments.id')
        ->join('subjects','assignments.subject_id','=','subjects.id')
        ->select('assignment_student.status AS assignment_status','assignment_student.score AS assignment_score','assignments.question','assignments.instruction','assignments.subject_id','assignments.due','subjects.name AS subject')->where('student_id',$student)->get();
        return response()->json($assignment);

    }
    public function getcbt(Request $request){
        $student = $request->student;
        $assignment = DB::table('assignment_cbt')
        ->join('assignment_question','assignment_cbt.assignment_code','=','assignment_question.assignment_code')
        ->join('subjects','assignment_cbt.subject_id','=','subjects.id')
        ->select('assignment_cbt.assignment_code','assignment_cbt.status AS assignment_status','assignment_cbt.score AS assignment_score','assignment_cbt.due', 'assignment_question.question', 'assignment_question.A', 'assignment_question.B', 'assignment_question.C', 'assignment_question.D', 'assignment_question.answer',
        'subjects.name')
        ->where('student_id',$student)->get();
        return response()->json($assignment);
    }
    public function submitcbt(Request $request){
        $code = $request->code;
        $student = $request->student;
        $answers  = serialize($request->answers);
        DB::table('assignment_cbt')->where('student_id',$student)->where('assignment_code',$code)->update([
            'status'=> 1,
            'score'=>$request->score,
            'answer'=>$answers
        ]);
        return 'done';
    }
    public function cbtsubject(Request $request){
        $student = $request->student;
        $subjects = DB::table('assignment_cbt')
        ->join('subjects','assignment_cbt.subject_id', '=','subjects.id')
        ->select('assignment_cbt.assignment_code','subjects.name')
        ->where('student_id',$student)
        ->where('status',0)
        ->get();
        $subject = $subjects->unique();
        return response()->json($subject);
    }
    //get cbt through assignment_code
    public function getcbtquestions(Request $request){
        $code = $request->code;
        // return $request;
        $assignment = DB::table('assignment_question')->where('assignment_code',$code)->get();
        return response()->json($assignment);
    }

}
