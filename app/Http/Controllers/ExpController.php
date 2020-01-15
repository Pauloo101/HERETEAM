<?php

namespace App\Http\Controllers;

use App\Notification\Expoclass;
use Illuminate\Http\Request;
use NotificationChannels\ExpoPushNotifications\ExpoChannel;
use NotificationChannels\ExpoPushNotifications\ExpoMessage;
use NotificationChannels\ExpoPushNotifications\Http\ExpoController;
use Illuminate\Notifications\Notification;

class ExpController extends Notification
{
     public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

//    public function toExpoPush($notifiable)
//    {
//    //     $token = 'ExponentPushToken[kLGYdHPpr2hJfQKgPrbRtt]';
//    //    return ExpoController::subscribe($token);
//
//        return ExpoMessage::create()
//            ->badge(1)
//            ->enableSound()
//            ->body("Your {$notifiable->service} account was approved!");
//    }
//    public function here(){
//        $key = "ExponentPushToken[kLGYdHPpr2hJfQKgPrbRtt]";
//        $userID = 1;
//        $notification = [
//            'title'=>'hello',
//            'body'=>'world'
//        ];
//        try {
//            $expo = Exponent
//        } catch (\Throwable $th) {
//            //throw $th;
//        }
//    }

    public function here()
    {
//        echo('here');
//         $payload = array(
//             'to' => 'ExponentPushToken[kLGYdHPpr2hJfQKgPrbRtt]',
//             'sound' => 'default',
//             'body' => 'hello',
//             'title'=>'world'
//         );
        $notify = new Expoclass();
        $notify->title = 'here message';
        $notify->body = 'work oo';
        $notify->tokens = ['ExponentPushToken[kLGYdHPpr2hJfQKgPrbRtt]'];
        $notify->sendnotification();
        echo('here');


    }



}

