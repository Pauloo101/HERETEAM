<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utility\TranscationController;
use App\Models\Payment;
use App\Models\Student;
use App\Notification\Expoclass;
use App\Parents;
use App\Setting;
use App\Student_Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public $total;
    public $amount= 0;
    public $ratios = [];
    public $shares = [];
    public $totalpaid = 0;
    public function createpayment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required'
        ]);
        $setting  =  Setting::select()->where('Is_Active', 1)->first();
        $amount = $request->amount;
        if ($request->classroom == "") {
            $payment = new Payment;
            $payment->name = $request->name;
            $payment->description  = $request->description;
            $payment->amount = $request->amount;
            $payment->classroom_id = 0;
            $payment->section_id = 0;
            $payment->session_id = $setting->session_id;
            $payment->term_id = $setting->term_id;
            $payment->save();
        } else {
            $payment = new Payment;
            $payment->name = $request->name;
            $payment->description  = $request->description;
            $payment->amount = $request->amount;
            $payment->classroom_id = $request->classroom;
            $payment->section_id = $request->section;
            $payment->session_id = $setting->session_id;
            $payment->term_id = $setting->term_id;
            $payment->save();
            if (($request->classroom == 0) && ($request->section == 0)) {
                //assign all students in student_session to the payment
                $student = DB::table('student_session')->pluck('student_id');
                foreach ($student as  $id) {
                    $payment->students()->attach([$id => ['pending' => $amount]]);
                };
                // $payment->students()->sync($student => ['pending' => $amount]);
                return 'All the Students';
            } elseif (($request->classroom != 0) && ($request->section == 0)) {
                //assign all student in that class
                $student = DB::table('student_session')->where('classroom_id', $request->classroom)->pluck('student_id');
                foreach ($student as  $id) {
                    $payment->students()->attach([$id => ['pending' => $amount]]);
                };
                return 'All Students in a specific class';
            } else {
                //assign student in that class nd that section
                $student = DB::table('student_session')
                    ->where('classroom_id', $request->classroom)
                    ->where('section_id', $request->section)
                    ->pluck('student_id');
                foreach ($student as  $id) {
                    $payment->students()->attach([$id => ['pending' => $amount]]);
                };
                return 'All Students in a specific class and specific section';
            }
        }

        return 'done';
    }
    public function fetchpayment(Request $request)
    {
        $setting = Setting::select()->where('Is_Active', 1)->first();
        $student = Student::find($request->student);
        $payment = $student->payments()->get();
        return response()->json($payment);
    }
    public function getsettingpayment(Request $request)
    {
        $setting = Setting::select()->where('Is_active', 1)->first();
        $student = Student::find($request->student);
        $payment = DB::table('payments')
            ->join('payment_student', function ($join) use ($request) {
                $join->on('payments.id', '=', 'payment_student.payment_id')
                    ->where('payment_student.student_id', $request->student);
            })
            ->select(
                'payments.*',
                'payment_student.student_id',
                'payment_student.payment_method',
                'payment_student.payment_description',
                'payment_student.payment_reference',
                'payment_student.total',
                'payment_student.pending',
                'payment_student.status'
            )
            ->where('session_id', $setting->session_id)
            ->where('term_id', $setting->term_id)
            ->get();

        return response()->json($payment);
    }
    public function fetchhistory(Request $request)
    {
        $history = DB::table('payments_history')
            ->where('student_id', $request->student)
            ->where('payment_id', $request->payment)
            ->get();
        return response()->json($history);
    }
    public function savepayment(Request $request)
    {
        $amount = null;
        //create append convert to
        $student = Student::find($request->student);
        $sid = $request->student;
        $amounts = $request->amount;
        $i = 0;
        foreach ($amounts as $key => $value) {

            $vint = intval($value);
            $vjson = json_encode($vint);
            $previous = DB::table('payment_student')->where('payment_id', $key)->where('student_id', $sid)
                ->pluck('payments');

            // $v = json_encode($value);
            if ($previous[0] == null) {
                $amount = $vjson;
                $student->payments()->updateExistingPivot($key, array('payments' => $amount), false);
            } else {
                foreach ($previous as $key => $value) {
                    $vpint = intval($value);
                    $combine = array($vpint, $vint);

                    $amount = json_encode($value);
                    print_r($amount);

                    // $student->payments()->updateExistingPivot($key, array('payments' => $amount), false);
                    // echo($amount);
                }
                // return $amount;
            }
        }
        dd($request);
    }
    public function recordpayment(Request $request)
    {
        request()->validate(array(
            'amount' => 'required',
            'date_paid'=>'required',
            'reference_no' => 'required|unique:payments_history'
        ));
        // dd($request);
        //if status is == 1 return payment completed
        DB::table('payments_history')->insert([
            'payment_id' => $request->payment,
            'amount' => $request->amount,
            'student_id' => $request->student,
            'reference_no' => $request->reference_no,
            'description' => $request->description,
            'date_paid'=> $request->date_paid
        ]);
        $amounts = DB::table('payments_history')->where('payment_id', $request->payment)
            ->where('student_id', $request->student)->pluck('amount');

        for ($i = 0; $i < count($amounts); $i++) {
            $this->total = $amounts[$i] +  $this->total;
        }
        $payment = Payment::find($request->payment);
        $pending = $payment->amount - $this->total;
        $why = DB::table('payment_student')
            ->where('payment_id', $request->payment)
            ->where('student_id', $request->student)
            ->update(['total' => $this->total, 'pending' => $pending]);

        if ($this->total == $payment->amount) {
            DB::table('payment_student')
                ->where('payment_id', $request->payment)
                ->where('student_id', $request->student)
                ->update(['status' => 1]);
        }
        //notification
        $parent_id = Student::find($request->student)->pluck('parent_id');
        $token = Parents::where('id',$parent_id)->pluck('token');
        $notify = new Expoclass();
        $notify->title = 'Your payment has been processed';
        $notify->body = 'thank you';
        $notify->token = $token;
        $notify->sendnotification();
        return 'done';
    }
    //payment overview per classroom
    public function paymentoverview(Request $request){
        $classid = [];
        $classroom =$request->classroom;
        array_push($classid,$classroom,0);
        $setting = Setting::select()->where('Is_active', 1)->first();
        $info = DB::table('payments')
        ->join('payment_student', 'payments.id', '=', 'payment_student.payment_id')
        ->join('student_session',function($join) use($setting , $classroom){
            $join->on('payment_student.student_id', '=', 'student_session.student_id')
            ->where('student_session.session_id',$setting->session_id)
            ->where('student_session.term_id',$setting->term_id)
            ->where('student_session.classroom_id',$classroom);
        })
        ->join('students','student_session.student_id','=','students.id')
        // ->join('student_session' , function($join) use($setting , $classroom){
        //     $join->on('students.id','=','student_session.student_id')
            // ->where('session_id',$setting->session_id)
            // ->where('term_id',$setting->term_id)
            // ->where('student_session.classroom_id',$classroom);
        // })
        ->select('payments.*','payment_student.total','payment_student.pending','student_session.classroom_id AS classid','students.matric_no','students.first_name','students.surname','students.id AS student_id')
            ->where('payments.session_id',1)
            ->where('payments.term_id', 1)
            ->wherein('payments.classroom_id',$classid)
            ->get();

        return $info;

    }
    public function fetchbill(Request $request)
    {
        $settings = Setting::select()->where('Is_Active', 1)->first();
        // return $request;
        $zero  = 0;
        if ($request->classroom == 0) {
            // echo('ifonly');
            $bill = Payment::where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)->where('classroom_id', $request->classroom)->get();
            return $bill;
        } elseif ((!$request->classroom == 0) && ($request->section == 0)) {

            $first = DB::table('payments')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $zero);

            $bill = DB::table('payments')
                ->where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $request->classroom)
                ->union($first)->get();
            return $bill;
        } elseif ($request->section > 0) {
            // echo('>0');
            $bill = Payment::where('session_id', $settings->session_id)
                ->where('term_id', $settings->term_id)
                ->where('classroom_id', $request->classroom)
                ->where('section_id', $request->section)
                ->get();
            return $bill;
        }

    }
    public function fetchdebtors(Request $request)
    {
       $settings = Setting::select()->where('Is_active', 1)->first();
        $student = DB::table('payment_student')
            ->join('payments','payment_student.payment_id','=','payments.id')
            ->join('students', 'payment_student.student_id', '=', 'students.id')
            ->join('student_session',function ($join) use($request, $settings){
                $join->on('students.id','=','student_session.student_id')
                ->where('student_session.session_id',$settings->session_id)
                ->where('student_session.term_id',$settings->term_id)
                ->where('student_session.classroom_id',$request->classroom);
            })
            ->join('sections','student_session.section_id','=', 'sections.id')
            ->select('payment_student.total', 'payment_student.pending', 'payment_student.status', 'sections.name AS section',
            'payments.amount','payments.description','payments.name',
            'students.matric_no','students.first_name','students.surname')
            ->where('status',0)
            ->where('payment_id',$request->payment)->get();
            //ambigous id
    //    $student =DB::table('payments')
    //    ->join('payment_student',function ($join) {
    //        $join->on('payments.id', '=', 'payment_student.payment_id')
    //        ->where('payment_student.status',0);
    //    })
    //    ->join('students','payment_student.student_id','=','students.id')
    //    ->select('payments.amount','payments.description','payments.name',
    //             'students.matric_no','students.first_name','students.surname',
    //             'payment_student.total','payment_student.pending','payment_student.status'
    //    )->where('id', 1)->get();
       return response()->json($student);

    }
    public function payment(Request $request)
    {
        return $request;
    }
    public function getpayment(Request $request)
    {
        // class
    }
    public function assignpayment(Request $request)
    {
        $payment = Payment::find($request->payment);
        $amount = $payment->amount;
        $student = $request->student;
        $payment->students()->syncWithoutDetaching([$student => ['pending' => $amount]]);
        return 'done';
    }
    public function unassignpayment(Request $request)
    {
        $payment = Payment::find($request->payment);
        $payment->students()->detach($request->student);
        return 'done';
    }
    public function makepayment($request){
        //payment is the name not id
        // $here = '';
        $payment = unserialize($request[0]->payments);
        $amount = $request[0]->amount;
        $ref = $request[0]->code;
        $students = unserialize($request[0]->students);
        // echo($request);
        $paymentinfo = Payment::wherein('name',$payment)->pluck('id');
        // echo('here');
        // return 'dere';
        $info = DB::table('payment_student')->wherein('student_id',$students)->wherein('payment_id',$paymentinfo)->where('status', 0 )->get(['pending','student_id','id','payment_id']);
        // return $info;
        foreach ($info as  $value) {
          $this->amount = $value->pending + $this->amount;
        }
        $pending = $this->amount;
        // return $pending;
        //sharing the money
        $payments = DB::table('payment_student')->wherein('student_id', $students)->whereIn('payment_id', $paymentinfo)->where('status',0)->get();
        $counter = count($payments);
        $i = 0;
        // return $payments;
       foreach ($payments as  $value) {
           $i++;
        //    echo($i);
           $ratio = ($value->pending / $pending)*100;
           array_push($this->ratios,$ratio);
           if($i == $counter){
            //    echo('here');
            if(empty($this->shares)){
                array_push($this->shares,$amount);
            }else{
                 $share = 0;
               $second = 0;
               foreach ($this->shares as $main) {
                   $second++;
                 $share = $main + $share;
                  if($second == count($this->shares)){
                      $value = $amount - $share;
                     array_push($this->shares , $value);
                  }
               };
            }
           }elseif($i < $counter){
                $value = ($amount * $ratio)/100;
                $share = round($value / 100)*100;
                array_push($this->shares, $share);

           }
       }
        // return $this->shares;


       foreach ($info as $key => $value) {

           $famount = $this->shares[$key];
        //   return 'here';
           if($famount == 0){
                echo('insufficent funds');
           }else {
               DB::table('payments_history')->insert([
              'student_id'=>$value->student_id,
              'payment_id'=>$value->payment_id,
              'amount'=> $famount,
              'reference_no'=>$ref.'-'.$key,
              'description'=>'Paystack'
              ]);
           }
       }

    // for ($concat=0; $concat < count($info) ; $concat++) {

    //     $famount = $this->shares[$concat];
    //     if($famount == 0){
    //         echo('insufficent funds');
    //     }
    //     else{

    //         DB::table('payments_history')->insert([
    //           'student_id'=>$info[$concat]->student_id,
    //           'payment_id'=>$info[$concat]->payment_id,
    //           'amount'=> $famount,
    //           'reference_no'=>$ref.'-'.$concat,
    //           'description'=>'Paystack'
    //           ]);
    //     }
    // }

    foreach ($info as $value) {
        $this->totalpaid =  0;
        $h = 0;
        $paid = DB::table('payments_history')->where('student_id',$value->student_id)->where('payment_id',$value->payment_id)->pluck('amount');
        for ($kk=0; $kk <count($paid) ; $kk++) {
            $this->totalpaid = $paid[$kk] + $this->totalpaid;
        }
        $pays = Payment::find($value->payment_id);
        $payment_student_pending = $pays->amount - $this->totalpaid;
        // $payment_student_pending =  $this->totalpaid - $value->pending ;
        if($payment_student_pending == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        $payment_student = DB::table('payment_student')->where('student_id', $value->student_id)->where('payment_id', $value->payment_id)->update([
            'total'=> $this->totalpaid,
            'pending'=> $payment_student_pending,
            'status' => $status,
        ]);
    }
    //   for ($count=0; $count < count($info) ; $count++) {
    //     DB::table('payment_student')->where('')
    //   };
       return 'Saved !';
    }
    public function payverify(Request $request)
    {
        $reference = 'T544520520796269';
        $url = 'https://api.paystack.co/transaction/verify/'.$reference;
        //open connection
        $ch = curl_init();
        //set request parameters
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer sk_test_487ee6cf35e4d3b30983f29be9851818e74b482b']);

        //send request
        $request = curl_exec($ch);
        //close connection
        curl_close($ch);
        //declare an array that will contain the result
        $result = array();
        if ($request) {
            $result = json_decode($request, true);
        }

        return $result;

    }

    // the students with unassigned payment

    public function fetchunassigned(Request $request)
    {
        //the session_id and term_id used to fix a bug
        $setting = Setting::select()->where('Is_Active', 1)->first();
        $students = Payment::
        join('payment_student','payments.id','=','payment_student.payment_id')
        ->join('student_session', function($join) use($request,$setting){
            $join->on('payment_student.student_id','=','student_session.student_id')
            ->where('student_session.classroom_id', $request->classroom)
            ->where('student_session.session_id',$setting->session_id)
            ->where('student_session.term_id',$setting->term_id);
        })
        ->join('students','student_session.student_id','=','students.id')
        ->select('payments.*','student_session.classroom_id','students.id','students.matric_no','students.first_name','students.surname','students.other_name')
        ->where('payments.id',$request->bill)->get();
        $arraystd= [];
        foreach ($students as $key => $value) {
            array_push($arraystd, $value->id);
        }

        $compare = Student_Session::
        join('students','student_session.student_id','=','students.id')
        ->select('student_session.*','students.id', 'students.matric_no', 'students.first_name', 'students.surname', 'students.other_name')
        ->where('student_session.session_id',$setting->session_id)
        ->where('student_session.term_id',$setting->term_id)
        ->where('student_session.classroom_id',$request->classroom)
        ->whereNotIn('student_session.student_id',$arraystd)
        ->get();
        return $compare;
    }
    public function paymentname(Request $request)
    {

    }
    public function gethistory(Request $request)
    {
        $setting = Setting::select()->where('Is_active', 1)->first();
        if($request->name == 1){
            $payment = Payment::all();
            $name = [];
            foreach ($payment as $key => $value) {
                array_push($name, $value->name);
            };
            $singlename = array_unique($name);
            return response()->json(['names'=>$singlename]);
            // return $singlename;
        }
        // use payment to get history
       else{
           if($request->has('classroom')){
                $history = Payment::join('payments_history', 'payments.id', '=', 'payments_history.payment_id')
                    ->join('student_session', function ($join) use ($setting, $request) {
                        $join->on('payments_history.student_id', '=', 'student_session.student_id')
                            ->where('student_session.session_id', $setting->session_id)
                            ->where('student_session.term_id', $setting->term_id)
                            ->where('student_session.classroom_id',$request->classroom);
                    })
                    ->join('students', 'student_session.student_id', '=', 'students.id')
                    ->join('classrooms', 'student_session.classroom_id', '=', 'classrooms.id')
                    ->select(
                        'payments.*',
                        'payments_history.amount AS hamount',
                        'payments_history.reference_no AS hreference_no',
                        'payments_history.description AS hdescription',
                        'payments_history.date_paid AS hdate_paid',
                        'students.matric_no',
                        'students.first_name',
                        'students.surname',
                        'students.other_name',
                        'classrooms.name AS classroom'
                    )
                    ->where('payments.name', $request->payment_name)->get();
                return response()->json(['history' => $history]);
           }elseif ($request->has('section')) {

           }else{
               $history = Payment::join('payments_history', 'payments.id', '=', 'payments_history.payment_id')
                ->join('student_session', function ($join) use ($setting) {
                    $join->on('payments_history.student_id', '=', 'student_session.student_id')
                        ->where('student_session.session_id', $setting->session_id)
                        ->where('student_session.term_id', $setting->term_id);
                })
                ->join('students', 'student_session.student_id', '=', 'students.id')
                ->join('classrooms','student_session.classroom_id','=','classrooms.id')
                ->select('payments.*', 'payments_history.amount AS hamount', 'payments_history.reference_no AS hreference_no', 'payments_history.description AS hdescription', 'payments_history.date_paid AS hdate_paid','students.id AS student_id', 'students.matric_no', 'students.first_name', 'students.surname', 'students.other_name',
                'classrooms.name AS classroom')
                ->where('payments.name', $request->payment_name)
                ->where('payments.session_id',$setting->session_id)
                ->where('payments.term_id',$setting->term_id)
                ->get();
                return response()->json(['history'=>$history]);
           }
            // $history = Payment::join('payments_history', 'payments.id', '=', 'payments_history.payment_id')
            // ->select('payments.*','payments_history.student_id')
            // ->where('payments.name',$request->payment_name)->get();

                // return $history;
       }


    }
    public function apihistory(Request $request)
    {
        $setting = Setting::select()->where('Is_active', 1)->first();
        $history =  Payment::
        join('payments_history','payments.id','=','payments_history.payment_id')
            ->join('student_session', function ($join) use ($setting) {
                $join->on('payments_history.student_id', '=', 'student_session.student_id')
                    ->where('student_session.session_id', $setting->session_id)
                    ->where('student_session.term_id', $setting->term_id);
            })
            ->join('students', 'student_session.student_id', '=', 'students.id')
            ->join('sections','student_session.section_id','=','sections.id')
            ->join('classrooms', 'student_session.classroom_id', '=', 'classrooms.id')
            ->select('payments.*',
            'payments_history.amount AS hamount',
            'payments_history.reference_no AS hreference_no',
            'payments_history.description AS hdescription',
            'payments_history.date_paid AS hdate_paid',
            'students.matric_no',
            'students.first_name',
            'students.surname',
            'students.other_name',
            'classrooms.name AS classroom',
            'sections.name AS section')->get();
            return $history;
    }
}
