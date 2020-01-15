<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 11/3/2019
 * Time: 2:35 PM
 */

namespace App\Notification;


class Expoclass
{
    public $tokens = [];
    public $sound = 'default';
    public $title = '';
    public $body = '';

    Public function sendnotification(){
        $curl = curl_init();
        foreach ($this->tokens as $token){
            $payload = [
                'to' => $token,
                'sound' => $this->sound,
                'body'=> $this->body,
                'title'=> $this->title
            ];


        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://exp.host/--/api/v2/push/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Accept-Encoding: gzip, deflate",
                "Content-Type: application/json",
                "cache-control: no-cache",
                "host: exp.host"
            ),
        ));
        }
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
        $curl = curl_init();

    }
}