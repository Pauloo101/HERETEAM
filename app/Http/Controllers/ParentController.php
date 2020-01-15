<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Parents;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function searchparent(Request $request)
    {
        $data = $request->search;
        $parent = Parents::where('name', 'like', '%' . $data . '%')
            ->orwhere('father_phone', 'like', '%' . $data . '%')
            ->orwhere('mother_phone', 'like', '%' . $data . '%')->take(10)->get();
        return $parent;
    }
    //api functions
    public function savetoken(Request $request){
        $parent = Parents::find($request->parent);
        $parent->token = $request->token;
        $parent->save();
        return 'Token saved';
    }
    public function fetchstudent(Request $request){
        $setting = Setting::select()->where('Is_Active', 1)->first();
        $student_id = Student::where('parent_id', $request->parent)->pluck('id');
        $student =  Student::where('parent_id', $request->parent)
                    ->join('student_session', 'students.id', '=', 'student_session.student_id')
                    ->join('session','student_session.session_id', '=' , 'session.id')
                    ->join('terms','student_session.term_id','=','terms.id')
                    ->join('classrooms','student_session.classroom_id', '=' , 'classrooms.id') //name
                    ->join('sections', 'student_session.section_id', '=', 'sections.id')
            ->get(['students.*', 'classrooms.name AS Classroom', 'terms.name AS term_name', 'session.session AS session_name', 'sections.name AS section']);
        $payment = DB::table('payments')
            ->join('payment_student', 'payments.id', '=', 'payment_student.payment_id')
            ->select('payments.*', 'payments.name', 'payments.description', 'payments.amount', 'payment_student.*')
            ->where('session_id', $setting->session_id)
            ->where('term_id', $setting->term_id)
            ->where('student_id', $student_id)
            ->get();
        return response(['student' => $student, 'payment' => $payment]);
    }
    public function getsettingpayment(Request $request){
        $setting = Setting::select()->where('Is_Active', 1)->first();
        $student = Student::find($request->student);
        $payment = DB::table('payments')
            ->join('payment_student', function ($join) use ($request) {
                $join->on('payments.id', '=', 'payment_student.payment_id')
                    ->where('payment_student.student_id', $request->student);
            })
            ->select(
                'payments.*',
                'payment_student.student_id',
                'payment_student.payment_method',
                'payment_student.payment_description',
                'payment_student.payment_reference',
                'payment_student.total',
                'payment_student.pending',
                'payment_student.status'
            )
            ->where('session_id', $setting->session_id)
            ->where('term_id', $setting->term_id)
            ->get();

        return response()->json($payment);
    }
    public function fetchhistory(Request $request)
    {
        $history = DB::table('payments_history')
            ->where('student_id', $request->student)
            ->where('payment_id', $request->payment)
            ->get();
        return response()->json($history);
    }
    public function getrecords(Request $request)
    {
        $student = $request->student;
        $session = $request->session;
        $term = $request->term;
        // echo($session);
        // echo($term);
        //added the approved from mr ty
        //if request->session and term is null
        if (($request->session == null) || ($request->term == null)) {
            $settings = Setting::select()->where('Is_Active', 1)->first();
            $student_subject = DB::table('student_subject')
                ->join('subjects', 'student_subject.subject_id', '=', 'subjects.id')
                ->select('student_subject.*', 'subjects.name AS subject')
                ->where('student_id', $student)
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('approve',1)
                ->get();
            return $student_subject;
        } else {
            $student_subject = DB::table('student_subject')
                ->join('subjects', 'student_subject.subject_id', '=', 'subjects.id')
                ->select('student_subject.*', 'subjects.name AS subject')
                ->where('student_id', $student)
                ->where('session_id', $request->session)
                ->where('term_id', $request->term)
                ->where('approve',1)
                ->get();
            return $student_subject;
        }
    }

    public function getsessions(Request $request)
    {
        $student = $request->student;
        $session = DB::table('student_session')
            ->distinct()
            ->where('student_id', $student)
            ->join('session', 'student_session.session_id', '=', 'session.id')
            ->select('student_session.session_id', 'session.session AS name')
            ->get(['session_id']);
        return $session;
    }
    public function getterms(Request $request)
    {
        $student = $request->student;
        $session = $request->session;
        $term = DB::table('student_session')
            ->join('terms', 'student_session.term_id', '=', 'terms.id')
            ->select('student_session.*', 'terms.name AS name')
            ->where('student_id', $student)
            ->where('session_id', $session)
            // ->join('terms', 'student_session.term_id', '=', 'terms.id')
            ->get();
        return $term;
    }
    public function matchparent(Request $request)
    { //todo fix surname matching
        foreach ($request->student as $key => $value) {
            $student = Student::find($value['id']);
            $student->parent_id = $request->parent;
            $student->save();
            return "Done";
        }
    }
    public function updateparent(Request $request){
        // return $request;
        $parent = Parents::find($request->id);
        // return $parent;
        $parent->email = empty($request->father['email']) ? $parent->email : $request->father['email'];
        $parent->father_phone = empty($request->father['father_phone']) ?  $parent->father_phone : $request->father['father_phone']  ;
        $parent->mother_phone = empty($request->mother['mother_phone']) ?  $parent->mother_phone : $request->mother['mother_phone'];
        $parent->mother_name = empty($request->mother['mother_name']) ?   $parent->mother_name : $request->mother['mother_name'];
        $parent->father_name = empty($request->father['father_name']) ? $parent->father_name : $request->father['father_name'];
        // return $parent->email;
        $parent->save();
        return "parent Updated";
    }

}
