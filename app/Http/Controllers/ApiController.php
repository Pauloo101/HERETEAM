<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Setting;
use App\Student_Session;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function totalstudent(Request $request)
    {
        $setting = Setting::select()->where('Is_active', 1)->first();
        $classroom = Classroom::with('sections')->get();
        $classrooms = [];
        foreach ($classroom as $key => $value) {
            foreach ($value->sections as $k => $v) {
                $Students = Student_Session::
            where('classroom_id',$value->id)
            ->where('session_id',$setting->session_id)
            ->where('term_id',$setting->term_id)
            ->where('section_id',$v->id)
            ->get();
           
                    $info = [];
                    $info['total'] = count($Students);
                    $info['section'] = $v->name;
                    $info['name'] = $value->name;
                    array_push($classrooms, $info);



            }

        }
        return $classrooms;
    }
}
