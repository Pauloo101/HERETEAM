<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    public function index()
    {
        // $classroom = Classroom::all();
        //
        // $classroom = DB::table('classroom_sections')
        //     ->rightjoin('classrooms', 'classroom_sections.classroom_id', '=', 'classrooms.id')
        //     ->leftjoin('sections', 'classroom_sections.sections_id', '=', 'sections.id')
        //     ->select('classroom_sections.*', 'classrooms.name', 'sections.name')
        //     ->get();
        // dd($classroom);
        $classroom = Classroom::with('sections')->get();
        return view('Class.Index')->with('classroom', $classroom);
             dd($classroom->sections);
    }

    public function here()
    {
       $classroom = Classroom::all();
       return response()->json($classroom);
    }
    public function create()
    {
        return view('Class.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|unique:classrooms',
            // 'section_id' => 'required'
        ]);
        $classroom = new Classroom;
        $classroom->name = $request->name;
        $classroom->save();
        if(count($request->section_id) > 0){
             $classroom->sections()->sync($request->section_id, false);
        }
        return redirect()->route('Class.index');
    }

    public function show($id)
    {
        $classroom = Classroom::find($id);
        return view('Class.show')->with('classroom',$classroom);
    }

    public function edit($id)
    {
        $classroom = Classroom::find($id);
        return view('Class.edit', compact('classroom','id'));
    }

    public function classupdate(Request $request){
//        dd($request);
        $this->validate($request,[
            'name' =>'required',
            'section_id' => 'required'
        ]);
        $classroom = Classroom::find($request->id);
        DB::table('classroom_sections')->where('classroom_id', $classroom->id)->delete();
        $classroom->name = $request->name;
        $classroom->sections()->sync($request->section_id, false);
        return'class update';
    }
    public function classdelete(Request $request){
        $classroom = Classroom::where('id',$request->id)->delete();
        DB::table('classroom_sections')->where('classroom_id', $request->id)->delete();
        return 'Class Deleted';
    }
    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        $classroom->name= $request->name;
        $classroom->save();
       return redirect()->route('Class.index');
    }

    public function destroy($id)
    {
        //
    }

    //section resource

    public function storesection(Request $request){
        $this->validate($request,[
            'name'=> 'required|unique:sections'
        ]);
        $section = new sections();
        $section->name = $request->name;
        $section->save();
        return null;
    }
    public function updatesection(Request $request){
//        dd($request["section"]["id"]);
        $id = $request["section"]["id"];
        $section = sections::find($id);
        $section->name = $request["cache"];
        $section->save();
        return 'Update Section';
    }
    public function indexsection(){
        $section = sections::all();
        // return response().json([$section]);
        return Response::json($section);
        //return $section;
    }
    // todo
    // class order

}
