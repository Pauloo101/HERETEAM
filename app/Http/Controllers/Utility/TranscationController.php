<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TranscationController extends Controller
{
    public function record(Request $request)
    {
        //todo the id here might be access code
        if($request->has('reference')){
            //status 1 or 0
            // $transaction = DB::table('transactions')->where('code',$request->reference)->update(['status'=>1]);
            $info = DB::table('transactions')->where('code',$request->reference)->get();
            $here = new PaymentController();
            $here->makepayment($info);
            return 'done';
        }else{
            $students = serialize($request->students);
            $payments = serialize($request->payments);
             $transaction = DB::table('transactions')->insert([
            'code'=>$request->code,
            'type'=>$request->type,
            'students'=>$students,
            'payments'=>$payments,
            'parent_id'=>$request->parent_id,
            'amount'=>$request->amount
        ]);
             return 'done';
        }
    }

    public function checkpayment(){
        //check through paystack api for payment comfirmation
    }
    public function gettransactions(Request $request){
        //todo join to parent and probably orders too
        $transactions = Transaction::all();
        return $transactions;
    }
}
