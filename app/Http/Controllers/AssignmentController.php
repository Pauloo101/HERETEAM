<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Student_Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use function Opis\Closure\unserialize;

class AssignmentController extends Controller
{
    public $students = [];
    public function index()
    {
        return view('assignment.assignment');
    }
    public function storebasic()
    { }
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
                'teacher_id'=> $teacher
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
    public function giveassignment(Request $request)
    { //needs unit test
        $settings = Setting::select()->where('Is_Active', 1)->first();

        $this->validate($request, [
            'code' => 'required',
            'due'=>'required'
        ]);
        $data = DB::table('assingments_question')->where('assignment_code',$request->code)
            ->pluck('classroom_id','section_id','subject_id');
            $section = unserialize($data->section_id);
        $student = Student_Session::where('classroom_id', $data->classroom_id)
            ->wherein('section_id', $section)->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)->pluck('student_id');

        foreach ($student as $key => $value) {
            DB::table('assignment_cbt')->insert([
                'student_id' => $value,
                'assignment_code' => $request->code,
                'subject_id' => $data->subject_id,
                'due' => $request->due
            ]);
        }
        return 'Assignment assigned to your students';
    }

    public function manage_assignment(){
        return view('Teacher-view.assignment.manage');
    }
    public function manage(){
        return view('assignment.manage');
    }
}
