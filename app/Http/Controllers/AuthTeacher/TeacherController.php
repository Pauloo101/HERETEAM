<?php

namespace App\Http\Controllers\AuthTeacher;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\session;
use App\Setting;
use App\Student_Session;
use App\student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index()
    {
        return view('Teacher-view.home');
    }
    public function getsubject()
    {
        $teacher = auth()->user()->id;
        // return $teacher;
        $data =[];
        $subject = DB::table('subject_teacher')
            // ->join('classrooms', 'subject_teacher.classroom_id', '=', 'classrooms.id')
            // ->join('sections', 'subject_teacher.section_id', '=', 'sections.id')
            ->join('subjects', 'subject_teacher.subject_id', '=', 'subjects.id')
            ->select(
                'subject_teacher.subject_id',
                // 'classrooms.id AS class_id',
                // 'classrooms.name AS classroom',
                // 'sections.id AS sect_id',
                // 'sections.name AS section',
                'subjects.id AS sub_id',
                'subjects.name AS subject'
            )
            ->where('teacher_id', $teacher)->get();
            $subjects = $subject->unique();
            foreach ($subjects as $key => $value) {
                $CS = DB::table('subject_teacher')
                ->join('classrooms', 'subject_teacher.classroom_id', '=', 'classrooms.id')
                ->join('sections', 'subject_teacher.section_id', '=', 'sections.id')
                ->select('subject_teacher.subject_id',
                        'classrooms.id AS class_id',
                        'classrooms.name AS classroom',
                        'sections.id AS sect_id',
                        'sections.name AS section'
                        )
                ->where('teacher_id',$teacher)
                ->where('subject_id',$value->subject_id)
                ->get();
                // $encode = encode;
                array_push($data, ['subject'=>$value, 'classroom'=>$CS]);
            }
        return response()->json($data);
    }
    public function saverecord(Request $request)
    {
        $record =  student_subject::find($request->id);
        $testone = $request->testone;
        $testtwo = $request->testtwo;
        $testthree = $request->testthree;
        $exam = $request->exam;
        $record->testone = empty($testone) ? $record->testone : $testone;
        $record->testtwo = empty($testtwo) ? $record->testtwo : $testtwo;
        $record->testthree = empty($testthree) ? $record->testthree : $testthree;
        $record->exam = empty($exam) ? $record->exam : $exam;
        $record->save();
        return 'Records Saved';
    }

    public function subjectlist()
    {
        $teacher = auth()->user()->id;

        // $subject = Teacher::find($teacher)->with('subjects')->pluck('subject','subject_id');

        $subject = DB::table('subject_teacher')
            ->join('subjects', 'subject_teacher.subject_id', '=', 'subjects.id')
            ->select(
                'subject_teacher.subject_id',
                'subjects.id AS sub_id',
                'subjects.name AS subject'
            )
            ->where('teacher_id', $teacher)->get('subject_id', 'subject');
        $hh = $subject->unique();
        return $hh;
    }
    //class takin the subject by the teacher
    public function getclassroom(Request $request)
    {
        $teacher = auth()->user()->id;
        $classroom = DB::table('subject_teacher')
            ->join('classrooms', 'subject_teacher.classroom_id', '=', 'classrooms.id')
            ->select('subject_teacher.classroom_id', 'classrooms.id AS class_id', 'classrooms.name AS classroom')
            ->where('teacher_id', $teacher)->where('subject_id', $request->subject)->get('classroom_id', 'classroom');
        $hh = $classroom->unique();
        return response()->json($hh);
    }
    public function getsection(Request $request)
    {
        $teacher = auth()->user()->id;
        $section = DB::table('subject_teacher')
            ->join('sections', 'subject_teacher.section_id', '=', 'sections.id')
            ->select('subject_teacher.*', 'sections.name AS name', 'sections.id AS sect_id')
            ->where('teacher_id', $teacher)->where('subject_id', $request->subject)
            ->where('classroom_id', $request->classroom)->get();
        return response()->json($section);
    }

    public function storecbt(Request $request)
    {
        $teacher = auth()->user()->id;
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $this->validate($request, [
            'code' => ['required', 'unique:assignment_question,assignment_code'],
            'classroom' => 'required',
            'section' => 'required',
            'questions' => 'required',
            'subject' => 'required',
            // 'purpose' => 'assign',
            'duedate' => 'required_if:purpose,"assign"'
        ]);
        // if($request->purpose == 'assign'){
        //      return $request->purpose;
        // }else{
        //     return 'here';
        // }

        //save questions
        $questions = $request->questions;
        $section = serialize($request->section);
        // return unserialize($ser);
        foreach ($questions as $key => $value) {
            DB::table('assignment_question')->insert([
                'question' => $value["question"],
                'A' => $value["A"],
                'B' => $value["B"],
                'C' => $value["C"],
                'D' => $value["D"],
                'answer' => $value["answer"],
                'assignment_code' => $request->code,
                'subject_id' => $request->subject,
                'classroom_id' => $request->classroom,
                'section_id' => $section,
                'teacher_id' => $teacher
            ]);
        }

        if ($request->purpose == 'assign') {
            $student = Student_Session::where('classroom_id', $request->classroom)
                ->wherein('section_id', $request->section)->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)->pluck('student_id');

            foreach ($student as $key => $value) {
                DB::table('assignment_cbt')->insert([
                    'student_id' => $value,
                    'assignment_code' => $request->code,
                    'subject_id' => $request->subject,
                    'due' => $request->duedate
                ]);
            }
            return 'Assignment created and given to your students';
        }

        return 'Assignment created';
    }
    public function storebasic(Request $request)
    {
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $teacher = auth()->user()->id;
        $this->validate($request, [
            'question' => 'required|min:10',
            'instruction' => 'required|min:18',
            'classroom' => 'required',
            'section' => 'required',
            'duedate' => 'required',
            'subject' => 'required'
        ]);
        $section = serialize($request->section);
        $assignment = new Assignments;
        $assignment->question = $request->question;
        $assignment->instruction = $request->instruction;
        $assignment->classroom_id = $request->classroom;
        $assignment->section_id = $section;
        $assignment->subject_id = $request->subject;
        $assignment->due = $request->duedate;
        $assignment->teacher_id = $teacher;
        $assignment->save();

        $student = Student_Session::where('classroom_id', $request->classroom)
            ->wherein('section_id', $request->section)->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)->pluck('student_id');

        foreach ($student as $key => $value) {
            DB::table('assignment_student')->insert([
                'student_id' => $value,
                'assignment_id' => $assignment->id,
            ]);
        }
        return 'Assignment created and given to your students';
    }
    //assignment
    public function createassignment()
    {
        return view('Teacher-view.assignment.assignment');
    }
    public function manageassignment()
    {
        return view('Teacher-view.assignment.manage');
    }
    public function gettopics(Request $request){
        // return $request;
        $teacher = auth()->user()->id;
        $subject = $request->subject;
        $topics = DB::table('assignment_question')->where('teacher_id',$teacher)->where('subject_id',$subject)->pluck('assignment_code');
        $topic = $topics->unique();
        return $topic;
    }
    public function getquestions(Request $request){
        $topic = $request->topic;
        $questions = DB::table('assignment_question')->where('assignment_code',$topic)->get();
        return $questions;
    }
    //knowing the number of student that has access to the assignment
    public function assignmentstats(Request $request){
        $topic = $request->topic;
        $student = DB::table('assignment_cbt')->where('assignment_code',$topic)->pluck('due');
        $count = count($student);
        if($count > 0){
            $due = $student->unique();
            return response(['message'=>'Students which have access to the assignment are ', 'count'=>$count, 'due'=>$due]);
        }else{
            return response(['message'=>'No student have access to the assignment', 'count' => '']);
        }
    }
}
