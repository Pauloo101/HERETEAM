<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student_subject;

class RecordController extends Controller
{
    public function save(Request $request){
        $id = $request->id;
        $marks = student_subject::find($id);
        $marks->testone = $request->testone;
        $marks->testtwo = $request->testtwo;
        $marks->testthree = $request->testthree;
        $marks->exam = $request->exam;
        $marks->save();
        dd($request);
    }
}
