<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::all();
        return view('Teacher.index')->with('teacher', $teacher);
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
        $teacher = new Teacher;
        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->email = $request->email;
        $teacher->role = $request->role;
        $teacher->class_id = $request->class_id;
        if ($request->hasFile('photo'))
            $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(50, 50)->save(public_path('/img/' . $filename));

        $teacher->photo = $filename;
        $teacher->save();
        return redirect()->route('teacher.index');

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
        if ($request->hasFile('photo'))
            $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(50, 50)->save(public_path('/img/' . $filename));

        $teacher->photo = $filename;
        $teacher->save();
        return redirect()->route('teacher.index');
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
}
