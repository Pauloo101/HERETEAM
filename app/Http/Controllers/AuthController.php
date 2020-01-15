<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Parents;
use App\Setting;
use App\Student_Session;
// use App\Http\Controller
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;


class AuthController extends Controller
{


    public $matric_no ;
    //  use AuthenticatesUsers;

    //     protected $redirectTo = '/teachers';

    //     protected function guard()
    //     {
    //         return Auth::guard('parent');
    //     }

    // public function login(Request $request)
    // {
    //     $http = new \GuzzleHttp\Client;

    //     try {
    //         $response = $http->post('http://127.0.0.1:8000/oauth/token', [
    //             'form_params' => [
    //                 'grant_type' => 'password',
    //                 'client_id' => 2,
    //                 'client_secret' => 'ZF0IkQ65toumkWJB8Kkm8YtElW7B452VdUx8aBzI',
    //                 'username' => $request->username,
    //                 'password' => $request->password,
    //                 'provider' => 'parent'
    //             ]
    //         ]);
    //         return $response->getBody();
    //     } catch (\GuzzleHttp\Exception\BadResponseException $e) {
    //         if ($e->getCode() == 400) {
    //             return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
    //         } else if ($e->getCode() == 401) {
    //             return response()->json('Your credentials are incorrect . Please try again', $e->getCode());
    //         }
    //         return response()->json('Something went wrong on the server.', $e->getCode());
    //     }
    // }

    public function register(Request $request){
       $data = $request->validate([
            'name' => 'required',
            'email'=> 'email|required',
            'password' => 'required|confirmed'
            //father_phone
        ]);
        $data['password'] = Hash::make($request->password);
        $user = Parents::create($data);
        $msg = 'Valid';
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=>$user, 'accesstoken'=> $accessToken, 'message'=>'VAlid']);
    }
    public function login(Request $request){

        $email = $request->email;
        $student = Student::where('matric_no',$email)->get();
        if(count($student) > 0){
            // return $student[0]['surname'];
            if($student[0]['surname'] == $request->password){
                $settings = Setting::select()->where('Is_Active', 1)->first();
                $info = DB::table('student_session')
                ->join('classrooms', 'student_session.classroom_id', '=', 'classrooms.id')
                ->join('sections', 'student_session.section_id', '=', 'sections.id')
                ->select('student_session.session_id','classrooms.name AS classroom', 'sections.name AS section')
                ->where('session_id',$settings->session_id)
                ->where('term_id',$settings->term_id)
                ->where('student_id',$student[0]['id'])->get();
                return response(['message' => 'valid', 'student'=>$student, 'info'=>$info,'role'=>'student','session'=>$settings->session_name, 'term'=>$settings->term_name]);
            }else{
                return response(['message' => 'Invalid']);
            }
        }
        $password = Hash::make($request->password);

        $parent = Parents::where('email',$email)
        ->orwhere('father_phone',$email)
        ->orwhere('mother_phone',$email)->first();

    if(!empty($parent)){
        if(Hash::check($request->password, $parent->password)){
            $parent->password = "";
            // $json = json_encode($parent);
            return response(['message' => 'valid','user'=>$parent,'role'=>'parent']);
        }
        else{
            return response(['message' => 'invalid']);
        }
    }else{
        return response(['message'=>'invalid']);
    }
        return response(['message' => 'invalid']);

    }
    // public function logout(){
    //     // auth()->user()->tokens->each(function ($token, $key){
    //     //     $token->delete();
    //     // });
    //     auth()->user()->tokens->each(function ($token, $key){
    //         $token->delete();
    //     });
    //     return response(['message' => 'logged out successfully']);
    // }



}
