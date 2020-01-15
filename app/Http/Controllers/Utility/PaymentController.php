<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        return view('finance');
    }
    // fetch payment
    public function fetchpayment(Request $request)
    {
        $payement = Payment::all()->pluck('name');
        return $payement;
    }
    public function getstats(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'classroom'=>'required',
            'payment'=>'required'
        ]);

        $info = Payment::where('name',$request->payment)->get();
        if ($info[0]->classroom_id == 0){
            $pay = Payment::where('name',$request->payment)->get();
            $count = DB::table('payment_student')->where('payment_id',$pay[0]->id)->get();
            $pending = 0;

// return $count;            // for ($i = 0; $i < count($count); $i++) {
            //     return $count[0];
            // }
            $data = count($count);
            $amount = $info[0]->amount;
            $total = $data * $amount;
            return response()->json(['count'=>$data , 'amount'=>$amount, 'total'=>$total, 'pending'=>$count]);
        } else {
            $payment = Payment::where('name', $request->payment)->where('classroom_id', $request->classroom)->get();
            $count = DB::table('payment_student')->where('payment_id', $payment[0]->id)->get()->toArray();
            // $pending = 0 ;
            // return $count;
            // for ($i=0; $i < count($count) ; $i++) {
            //     return $count[0];
            // }
            $data = count($count);
            $amount = $info[0]->amount;
            $total = $data * $amount;
            return response()->json(['count' => $data, 'amount' => $amount, 'total'=>$total, 'pending' => $count]);
            // return $data;
        }
    }
}
