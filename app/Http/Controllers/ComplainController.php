<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Reply;
use App\Notification\Expoclass;
use App\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplainController extends Controller
{
    public function index(){
        return view('Complains.index');
    }
    public function complain(Request $request){
        request()->validate([
            'title'=>'required',
            'message'=>'required'
        ]);
        $parent = $request->parent;
        $complain = new Complain;
        $complain->title = $request->title;
        $complain->message = $request->message;
        $complain->parent_id = $parent;
        $complain->save();
        return 'complaint saved';
    }
    public function reply (Request $request)
    {
        request()->validate([
            'reply' => 'required',
        ]);
        $parent_id=Complain::find($request->complain)->pluck('parent_id');
        $token = Parents::where('id',$parent_id)->pluck('token');
        $parent = $request->parent;
        $reply = new Reply;
        $reply->complain_id = $request->complain;
        $reply->message =  $request->reply;

        if(empty($parent)){
            $reply->type = 0 ;
            $notify = new Expoclass();
            $notify->title = 'Complain Replied';
            $notify->body = $request->reply;
            $notify->tokens = $token;
            $notify->sendnotification();
        } else{
            $reply->type = 1;
        }
        $reply->save();
        return 'Repied';
    }
    public function getreply(Request $request){
        $replys = Reply::where('complain_id',$request->complain)->get();
        return $replys;
    }
    Public function getcomplain(Request $request){
        if($request->has('parent')){
        $complains = Complain::where('parent_id',$request->parent)->get();
        return $complains;
        }else{
            $complains = DB::table('complains')
            ->join('parent','complains.parent_id', '=' , 'parent.id')
            ->select('complains.*','parent.*')->get();

            return $complains;
        }

    }
}
