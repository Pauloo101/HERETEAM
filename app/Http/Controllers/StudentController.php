<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Parents;
use App\Guardian;
use App\Setting;
use App\Student_Session;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public $parent;
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
        // $student = Student::all();
        // return Student::with('classroom')->latest()->get();
        return view('Student.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classroom = Classroom::all();
        return view('Student.create')->with('classroom', $classroom);
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
            'matric_no' => ['required','unique:students'],
            'surname' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'classroom_id' => 'required',
            'section_id'=>'required',
            'dob'=>'required',
            'father_name'=>'required',
            'email'=>'required',
            'father_occupation'=>'required',
            'father_phone'=>'required',
            'mother_name'=>'required',
            'other_name'=>'required',
            'mother_occupation'=>'required',
            'mother_phone'=>'required',
            'guardian_name'=>'required',
            'guardian_email'=>'required',
            'guardian_occupation'=>'required',
            'guardian_phone'=>'required',
            'relationship'=>'required',
            'guardian_address'=>'required'
        ]);
        $password = Hash::make($request->surname);
        $settings = Setting::select()->where('Is_Active', 1)->first();
        // dd($settings->session_id);
        // dd($request);
        $checkparent = Parents::where('father_phone',$request->father_phone)->orwhere('mother_phone',$request->mother_phone)->pluck('id');
        // dd($checkparent);
        if(count($checkparent) == 0){
        $this->parent = new Parents;
        $this->parent->name = $request->surname;
        $this->parent->father_name = $request->father_name;
        $this->parent->email = $request->email;
        $this->parent->father_occupation = $request->father_occupation;
        $this->parent->father_phone = $request->father_phone;
        $this->parent->mother_name = $request->mother_name;
        $this->parent->password = $password;
        // $this->parent->mother_email = $request->mother_email;
        $this->parent->mother_occupation = $request->mother_occupation;
        $this->parent->mother_phone = $request->mother_phone;
        $this->parent->is_guardian = $request->relationship;
        $this->parent->save();
        $this->parent = $this->parent->id;
        // dd($parent);
        $guardian = new Guardian;
        $guardian->name = $request->guardian_name;
        $guardian->phone = $request->guardian_phone;
        $guardian->email = $request->guardian_email;
        $guardian->occupation = $request->guardian_occupation;
        $guardian->address = $request->guardian_address;
        $guardian->relationship = $request->relationship;
        $guardian->guardian_is = $request->relationship;
        $guardian->save();
        echo('if');
        }
        else {
            $this->parent = $checkparent[0];
            echo('else');
        }
        // dd($this->parent[0]);
        $student = new Student;
        $student->parent_id = $this->parent;
        $student->matric_no = $request->matric_no;
        $student->first_name = $request->first_name;
        $student->other_name = $request->other_name;
        $student->surname = $request->surname;
        $student->gender = $request->gender;
        $student->DOB = $request->dob;
        $student->save();
        $student_session = new Student_Session;
        $student_session->session_id = $settings->session_id;
        $student_session->term_id = $settings->term_id;
        $student_session->student_id = $student->id;
        $student_session->classroom_id = $request->classroom_id;
        $student_session->section_id = $request->section_id;
        $student_session->student_name = $request->surname.' '.$request->first_name ;
        $student_session->save();

        // if ($request->hasFile('photo')) {
        //     $photo = $request->file('photo');
        //     $filename = time() . '.' . $photo->getClientOriginalExtension();
        //     Image::make($photo)->resize(50, 50)->save(public_path('/img/' . $filename));
        //     $student->photo = $filename;
        // } else {
        //     $student->photo = $request->null;
        // }
        // $student->save();
        return redirect()->route('student.index');
    }


    public function fetchstudent(Request $request){

        $settings = Setting::select()->where('Is_Active', 1)->first();
        if(($request->classroom != null)&&($request->section != null)){
          $students = DB::table('student_session')
            ->join('classrooms', 'student_session.classroom_id', '=', 'classrooms.id')
            ->join('sections', 'student_session.section_id', '=', 'sections.id')
            ->join('students', function ($join){
                $join->on( 'student_session.student_id', '=', 'students.id')
                ->where('students.Is_Active','=', 1);
            })
            ->select('student_session.*', 'classrooms.name AS classroom', 'students.gender',
            'students.first_name','students.dob', 'students.surname','students.matric_no', 'sections.name')
            ->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->where('classroom_id', $request->classroom)
            ->where('section_id', $request->section)
            // ->where('Is_Active', 1)
            ->get();
            return $students;
        }
        elseif($request->classroom != null){
            $students = DB::table('student_session')
            ->join('classrooms','student_session.classroom_id', '=','classrooms.id')
            ->join('sections', 'student_session.section_id', '=', 'sections.id')
            ->join('students', function($join){
                $join->on('student_session.student_id', '=' , 'students.id')
                ->where('students.Is_Active', '=' , 1);
            })
                ->select(
                    'student_session.*',
                    'classrooms.name AS classroom',
                    'students.gender',
                    'students.first_name',
                    'students.surname',
                    'students.matric_no',
                    'students.dob',
                    'sections.name'
                )
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $request->classroom)
                ->get();

                return $students;
        }
        //fetch a single student
        elseif($request->student ){
            $data = $request->student;
            $student = Student_Session::join('classrooms','student_session.classroom_id','=','classrooms.id')
            ->join('sections','student_session.section_id','=','sections.id')
            ->join('students',function($join){
                $join->on('student_session.student_id','=','students.id')
                ->where('students.Is_Active','=',1);
            })->select(
                'student_session.*',
                'classrooms.name AS classroom',
                'students.gender',
                'students.first_name',
                'students.surname',
                'students.matric_no',
                'students.dob',
                'sections.name')
                ->where('student_name','like', '%' . $data.'%')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->get()->toArray();
                //  $Arr = array($student);
                // $students = $student->toArray();
                return $student;
        }
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show')->with('student', $student);

    }
    public function studentupdate(Request $request){

        $this->validate($request, [
            'matric_no' => 'required',
            'surname' => 'required',
            'first_name' => 'required',
            'classroom' => 'required',
            'section' => 'required',
        ]);

        $student = Student::find($request->id);
        $student->matric_no = $request->matric_no;
        $student->surname = $request->surname;
        $student->first_name = $request->first_name;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->save();
        $settings = Setting::select()->where('Is_Active', 1)->first();

        // ssid -> student_ud -> if there is any changes cascade delete ****
        $ss = Student_Session::find($request->ssid);
        if ($ss->classroom_id == $request->classroom)
        {
            $ss->classroom_id = $request->classroom;
            $ss->section_id  = $request->section;
            $ss->student_name = $request->surname . ' ' . $request->first_name;
            $ss->save();
            return 'student record updated';
        }
        else
        {
            $records = student_subject::
            where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('student_id',$request->id)
            ->delete();
            $ss->classroom_id = $request->classroom;
            $ss->section_id  = $request->section;
            $ss->student_name = $request->surname . ' ' . $request->first_name;
            $ss->save();
            return 'deleted';
        }


        return 'What Are you trying to do';
    }


    public function update(Request $request)
    {

    }
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('student.index');
    }
    //custom funtions for config student vue file
    public function getparent(Request $request){
        $student = $request->student_id;
        $parent_id = Student::find($student);
        $parent = Parents::find($parent_id->parent_id);
        return $parent;
    }
    public function getrecords(Request $request){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $student = $request->student_id;
        $student_subject = DB::table('student_subject')
            ->join('subjects', 'student_subject.subject_id','=','subjects.id')
            ->select('student_subject.*', 'subjects.name AS subject')
            ->where('student_id',$student)
            ->where('session_id', $settings->session_id)
            ->where('term_id', $settings->term_id)
            ->get();
        return $student_subject;


    }
    public function searchstudent(Request $request){
        $data = $request->search;
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $students = Student::join('student_session',function($join) use($settings){
                        $join->on('students.id','=','student_session.student_id')
            ->where('student_session.session_id','=',$settings->session_id)
            ->where('student_session.term_id','=',$settings->term_id);
        })
        ->join('classrooms','student_session.classroom_id','=','classrooms.id')
        ->join('sections','student_session.section_id','=','sections.id')
        ->select('students.first_name','students.surname', 'students.Is_Active',
                 'students.gender','students.matric_no', 'students.id',
                 'classrooms.id AS classroomid','classrooms.name AS classroom',
                 'sections.id AS sectionid','sections.name As section')
                 ->where('first_name','like', '%' . $data.'%')
                ->orwhere('surname','like','%'. $data . '%')
                ->orwhere('matric_no' , 'like' , '%' . $data . '%')->take(10)->get();
        // dd($request->search);
        return $students;
    }
    //promote student to new session
    public function promotestudent(Request $request){
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $this->validate($request,[
            'session'=>'required',
            'term'=>'required',
            'classroom'=>'required',
            'targetclass'=>'required'
        ]);
        $target_classroom = Classroom::find($request->targetclass)->sections()->get();
        $student = DB::table('student_session')
                    ->where('session_id',$settings->session_id)
                    ->where('term_id',$settings->term_id)
                    ->where('classroom_id',$request->classroom)->pluck('student_id')->toArray();
                    // return $request->student;
        if(!empty($request->student)){
            $value = array_diff($student,$request->student);
            foreach ($value as $student_id) {
                //manual check
                $check = Student_Session::where('session_id',$request->session)->where('term_id',$request->term)->where('student_id',$student_id)->get();
                if(count($check) == 0){
                    $current_student = Student_Session::where('session_id', $settings->session_id)
                    ->where('term_id', $settings->term_id)->where('student_id', $student_id)->get();
                $student_session = new Student_Session;
                $student_session->session_id = $request->session;
                $student_session->term_id = $request->term;
                $student_session->student_id = $student_id;
                $student_session->classroom_id = $request->targetclass;
                $student_session->section_id = $target_classroom[0]->id;
                $student_session->student_name = $current_student[0]->student_name;
                $student_session->save();
                }

            }
            //repeat student
            foreach ($request->student as $r) {
                $check = Student_Session::where('session_id', $request->session)->where('term_id', $request->term)->where('student_id', $r)->get();
                if(count($check) == 0){
                     $current_student = Student_Session::where('session_id', $settings->session_id)
                    ->where('term_id', $settings->term_id)->where('student_id', $r)->get();

                $student_session = new Student_Session;
                $student_session->session_id = $request->session;
                $student_session->term_id = $request->term;
                $student_session->student_id = $r;
                $student_session->classroom_id = $current_student[0]->classroom_id;
                $student_session->section_id = $current_student[0]->section_id;
                $student_session->student_name = $current_student[0]->student_name;
                    $student_session->save();
                }


            }
        //    $value = array_diff($student,$request->student);
           return 'Student Promoted';
        }else{
            foreach ($student as $value) {
                $check = Student_Session::where('session_id', $request->session)->where('term_id', $request->term)->where('student_id', $value)->get();
                //compare
                if(count($check) == 0){
                     $current_student = Student_Session::where('session_id',$settings->session_id)
                ->where('term_id',$settings->term_id)->where('student_id',$value)->get();
                $student_session = new Student_Session;
                $student_session->session_id = $request->session;
                $student_session->term_id = $request->term;
                $student_session->student_id = $value;
                $student_session->classroom_id = $request->targetclass;
                // section
                $student_session->section_id = $target_classroom[0]->id;
                $student_session->student_name = $current_student[0]->student_name;
                    $student_session->save();
                }


                // $target_classroom[0]->id;
            }
            return 'All Student promoted ';
            //todo promote snr class
        }
        return 'Student Promoted';
    }

    public function test(){
        $courses = [];
        $c_s = [1,2,3,4];
        $carry = [2,5,6];
        array_push($courses ,'here', $c_s);
    }

    public function removestudent(Request $request)
    {
        $student = Student::find($request->id);
        // $parent = Parents::find($student->parent_id);
        $student->delete();
        // $parent->delete();
        return 'Student deleted';
    }

}
