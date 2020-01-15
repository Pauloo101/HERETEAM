<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Setting;
use App\Student_Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('settings.index');
    }
    public function getactivesetting(){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        return $settings;
    }
    public function store(Request $request)
    {
         $this->validate($request,[
            'session' => "required" ,
            'term' => "required",
       ]
    );

        $validate = Setting::where('term_id',$request->term["id"])->where('session_id',$request->session["id"])->first();
        if($validate != null){
            return response("Settings Already Exist", 300);
            // return back()->withErrors('Settings Already Exist');

        }
        else {
          $setting = new Setting;
        $setting->session_id = $request->session["id"];
        $setting->session_name = $request->session["session"];
        $setting->term_name = $request->term["name"];
        $setting->term_id = $request->term["id"];
        if($request->state == 1){
             $check = Setting::where('Is_Active',1)->first();
            if (!empty($check)) {
                $check->Is_Active = 0;
                $check->save();
            }
             $setting->Is_Active = $request->state;
        }
        $setting->save();
        return 'done';
        }

    }
    public function update(Request $request, $id)
    {
        $check = Setting::where('Is_Active', 1)->first();
        if(!empty($check)){
            $check->Is_Active = 0;
            $check->save();
        }
        $settings = Setting::find($id);
        $settings->Is_Active = 1;
        $settings->save();
        return 'Settings Changed';
    }
    public function destroy($id)
    {
        //
    }
    // migrate students to new term or settings
    public function migratetoterm(Request $request){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $this->validate($request,[
            'term'=>'required',
            'classroom'=>'required'
        ]);
        $students = Student_Session::where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->where('classroom_id', $request->classroom)->get();

        foreach ($students as $key => $value) {
            // manaul check
            // return $value->student_id;
            $check = Student_Session::where('session_id', $settings->session_id)
                ->where('term_id', $request->term)
                ->where('student_id', $value->student_id)->get();
                // return $check;
            if(count($check)  == 0){
                // echo('here');
            $student_session = new Student_Session;
            $student_session->session_id = $settings->session_id;
            $student_session->term_id = $request->term;
            $student_session->student_id = $value->student_id;
            $student_session->classroom_id = $request->classroom;
            $student_session->section_id = $value->section_id;
            $student_session->student_name = $value->student_name;
            $student_session->save();
            // return $student_session;
            }
            // echo('checkedture');
        }
        return 'Promoted to term';

        // $classid = Classroom::all()->pluck('id');
        // $students = Student_Session::where('session_id', $settings->session_id)->where('term_id', $settings->term_id)->get();
        // foreach ($students as $key => $student) {
        //      $student_session = new Student_Session;
        //      $student_session->session_id = $request->session;
        //      $student_session->term_id = $request->term;
        //      $student_session->student_id = $students[$key]->student_id;
        //      $student_session->classroom_id =
        // }
        //check the new settings
        //migrate
    }
}
