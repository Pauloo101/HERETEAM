<?php

namespace App\Http\Controllers\AuthTeacher;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index(){
        return view('Teacher-view.home');
    }
    public function getsubject(){
        $teacher = auth()->user();
        $subject = $teacher->subjects()->get();
        // return response()->json($subject)
        return $subject;
        dd($subject);
    }

}
