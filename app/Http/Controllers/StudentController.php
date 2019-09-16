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

class StudentController extends Controller
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
        $student = Student::all();
        // return Student::with('classroom')->latest()->get();
        return view('student.Index', compact('student'));
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
            'father_email'=>'required',
            'father_occupation'=>'required',
            'father_phone'=>'required',
            'mother_name'=>'required',
            'mother_email'=>'required',
            'mother_occupation'=>'required',
            'mother_phone'=>'required',
            'guardian_name'=>'required',
            'guardian_email'=>'required',
            'guardian_occupation'=>'required',
            'guardian_phone'=>'required',
            'relationship'=>'required',
            'guardian_address'=>'required'
        ]);

        $settings = Setting::select()->where('Is_Active', 1)->first();
        // dd($settings->session_id);
        // dd($request);
        $parent = new Parents;
        $parent->father_name = $request->father_name;
        $parent->father_email = $request->father_email;
        $parent->father_occupation = $request->father_occupation;
        $parent->father_phone = $request->father_phone;
        $parent->mother_name = $request->mother_name;
        $parent->mother_email = $request->mother_email;
        $parent->mother_occupation = $request->mother_occupation;
        $parent->mother_phone = $request->mother_phone;
        $parent->is_guardian = $request->relationship;
        $parent->save();
        // // dd($parent);
        $guardian = new Guardian;
        $guardian->name = $request->guardian_name;
        $guardian->phone = $request->guardian_phone;
        $guardian->email = $request->guardian_email;
        $guardian->occupation = $request->guardian_occupation;
        $guardian->address = $request->guardian_address;
        $guardian->relationship = $request->relationship;
        $guardian->guardian_is = $request->relationship;
        $guardian->save();
        $student = new Student;
        $student->parent_id = $parent->id;
        $student->matric_no = $request->matric_no;
        $student->first_name = $request->first_name;
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
        elseif(empty($request->section)){
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
        return 'here';




    //     $settings = Setting::select()->where('Is_Active', 1)->first();
    // /** student from Student_Session */
    //         $student = student_session::select()
    //         ->where('session_id', $settings->session_id)
    //         ->where('term_id', $settings->term_id)
    //         ->where('classroom_id', $request->classroom)
    //         ->where('section_id', $request->section)
    //         ->pluck('student_id');
    //         dd($student);

    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show')->with('student', $student);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function studentupdate(Request $request){

        $this->validate($request, [
            'matric_no' => 'required',
            'surname' => 'required',
            'first_name' => 'required',
            'classroom' => 'required',
            'section' => 'required',
        ]);
//        dd($request);
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
        if ($ss->classroom == $request->classroom)
        {
            $ss->classroom_id = $request->classroom;
            $ss->section_id  = $request->section;
            $ss->student_name = $request->surname . ' ' . $request->first_name;
            $ss->save();
            return saved;
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
//        dd($request);
//        $student = Student::find($id);
//        $student->matric_no = $request->matric_no;
//        $student->first_name = $request->first_name;
//        $student->last_name = $request->last_name;
//        $student->gender = $request->gender;
//        $student->DOB = $request->DOB;
//        $student->save();
//        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
//        $student = Student::find($request->student_id);
//        $records = $student->subjects()
//            ->wherePivot('student_id','=', $request->student_id)
//            ->wherePivot('session_id', '=', $settings->session_id)
//            ->wherePivot('term_id', '=', $settings->term_id)
//            ->get();
//        dd($records);


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

}
