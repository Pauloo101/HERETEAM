<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function getUsers(Request $request){
        $columns = array(
            0=>'id',
            1=>'matric_no',
            2=>'first_name',
            3=>'last_name',
            4=>'gender',
            5=>'DOB'
        );

        $totalData = Student::count();
        $limit = $request->input('lenght');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $student = Student::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = Student::count();
        }else{
            $search = $request->input('search.value');
            $student =Student::Where('matric_no',"%{$search}%")
                ->orWhere('first_name','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Student::where('matric_no','like',"%{$search}%")
                ->orWhere('first_name','like',"%{$search}%")
                ->count();
        }
        $data = array();
        if($student){
            foreach ($student as $students){
                $nestedData['id'] = $students->id;
                $nestedData['matric_no'] = $students->matric_no;
                $nestedData['first_name'] = $students->first_name;
                $nestedData['last_name'] = $students->last_name;
                $nestedData['gender'] = $students->gender;
                $nestedData['DOB'] = $students->DOB;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);


    }
}
