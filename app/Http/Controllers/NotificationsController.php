<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Student;
use App\Notification\Expoclass;
use App\Parents;
use App\Setting;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public $ptoken = [];
    public $pid = [];

    public function sendpush(Request $request){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(30 * 10);
        $notificationBuilder = new PayloadNotificationBuilder($request->title);
        $notificationBuilder->setBody($request->message)->setSound('default');

        $dataBuilder = new PayloadDataBuilder();

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "fz13T4517hI:APA91bHtUaIzLplGL-MtdrNgfJaU7wKg3gE1vGkUn91ZeZimnDBxRJhyKLvinVIUKTDMGw8U3dmtU40QLXeO_P2i_Rz_lIP5GRngdjzcIqf6CdTYX7dxtHf-E8KX69Ht9itB3hSW_Ge3";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your d33atabase)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();
    }

    public function manypush(Request $request){
        $setting = Setting::select()->where('Is_Active',1)->first();
        if($request->recipient == 'all'){
            $token = Parents::pluck('token')->toArray();
            $id = Parents::pluck('id')->toArray();
            $this->pid = $id;
            $this->ptoken = $token;
        }
        elseif ($request->section == null) {
            $students = DB::table('student_session')
            ->where('classroom_id',$request->classroom)
            ->pluck('student_id');
            for($i = 0; $i< count($students); $i++){
                $student = Student::where('id', $students[$i])->pluck('parent_id');
                $parent = Parents::find($student)->pluck('token');
                array_push($this->ptoken, $parent);
                 $id = Parents::pluck('id')->toArray();
                $this->pid = $id;
            }
        }
        else{
            $students = DB::table('student_session')
            ->where('classroom_id',$request->classroom)
            ->where('section_id',$request->section)
            ->pluck('student_id');
            for($i = 0; $i < count($students); $i++ ){
                $student = Student::where('id',$students[$i])->pluck('parent_id');
                $parent = Parents::find($student)->pluck('token');
                array_push($this->ptoken, $parent);
                 $id = Parents::pluck('id')->toArray();
                $this->pid = $id;
            }
        }

        $notify = new Expoclass();
        $notify->title = $request->title;
        $notify->body = $request->body;
        $notify->tokens = $this->ptoken;
        $notify->sendnotification();
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->save();
        $notification->parents()->sync($this->pid,false);
        return 'done';

    }

    public function getnotifications(Request $request){
        if($request->has('parent')){
             $notification = Parents::find($request->parent)->notifications()->get();
        return $notification;
        }else {
            $notifications = Notification::all();
            return $notifications;
        }


    }
    //web

}
