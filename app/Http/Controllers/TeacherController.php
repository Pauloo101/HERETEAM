<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Setting;
use App\student_subject;
use App\subject_teacher;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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

        return view('Teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => ['required','unique:teachers'],
            'email' =>['required', 'unique:teachers'],
            'password'=>'required',
            'gender'=> 'required',
        ]);
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $teacher = new Teacher;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->user_name = $request->user_name;
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;
        $password = Hash::make($request->password);
        $teacher->password = $password;

        $teacher->save();
        /**
         * if ($request->hasFile('photo'))
         *     $photo = $request->file('photo');
         * $filename = time() . '.' . $photo->getClientOriginalExtension();
         * Image::make($photo)->resize(50, 50)->save(public_path('/img/' . $filename));
         * $teacher->photo = $filename;
         */
        /**
         * class teacher and subject teacher
         */
        $teacher->classrooms()->attach($request->class_teacher,
            ['section_id' => $request->section_teacher, 'session_id' => $settings->session_id, 'term_id' => $settings->term_id]);

        if($request->section_id == 0){
            $classroom = Classroom::find($request->classroom)->sections()->get();

            //for sync stuff
            foreach ($classroom as $key => $value) {
                $section =  $value->id;
                $teacher->subjects()->attach($request->subject, ['section_id' => $section, 'classroom_id' => $request->classroom, 'session_id' => $settings->session_id, 'term_id' => $settings->term_id]);
            }
            return 'done';
        }
        else {
            $teacher->subjects()->attach($request->subject , ['section_id' => $request->section_id, 'classroom_id' => $request->classroom, 'session_id' => $settings->session_id, 'term_id' => $settings->term_id]);
        }



        return 'teacher.stored';

    }
    public function subjectteacher(Request $request){
        // return $request;
        $this->validate( $request , [
            'subject'=> 'required',
            'classroom'=> 'required',
            'teacher_id' => 'required',
            'section' => 'required'
        ]
        );
        $settings = Setting::select()->where('Is_Active', 1)->first();
        $teacher = Teacher::find($request->teacher_id);
        if (($request->section == null)||($request->section == 0)) {
            $classroom = Classroom::find($request->classroom)->sections()->get();
            foreach ($classroom as $key => $value) {
                $section =  $value->id;
                $teacher->subjects()->attach($request->subject, ['section_id' => $section, 'classroom_id' => $request->classroom, 'session_id' => $settings->session_id, 'term_id' => $settings->term_id]);
            }
            return 'done';
        } else {
            $teacher->subjects()->attach($request->subject, ['section_id' => $request->section, 'classroom_id' => $request->classroom, 'session_id' => $settings->session_id, 'term_id' => $settings->term_id]);
        }
        //validation for duplicate value

        return ' subjetct teacher';
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view('Teacher.profile')->with('teacher', $teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('Teacher.profile', compact('teacher', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->email = $request->email;
        $teacher->role = $request->role;
        $teacher->class_id = $request->class_id;
        // if ($request->hasFile('photo'))
        //     $photo = $request->file('photo');
        // $filename = time() . '.' . $photo->getClientOriginalExtension();
        // Image::make($photo)->resize(50, 50)->save(public_path('/img/' . $filename));

        // $teacher->photo = $filename;
        $teacher->save();
        return redirect()->route('teacher.index');
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
        //fountain
        $record->testave = ($record->testone + $record->testtwo + $record->testthree) / 3 ;
        $record->cumulatve = ($record->testave + $record->exam) / 2;
        $record->save();

        return 'Records Saved';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('teacher.index');
    }
    public function here(Request $request){
        dd($request);
    }
}
