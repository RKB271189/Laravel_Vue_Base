<?php

namespace App\Channel;

use App\Usables_Extensions\ClientURL;
use Exception;
use Illuminate\Notifications\Messages\SimpleMessage;
use Illuminate\Notifications\Notification;

class FirebaseChannel extends SimpleMessage
{
    use ClientURL;
    public function send($notifiable, Notification $notification)
    {
        try {
            $data = $notification->toNotification($notifiable);
            $check = $data->toArray();
            if (array_key_exists('salutation', $check) && !empty($data->salutation)) { // If key image is sent with notification then salutation must exists
                $image = $data->salutation; //Full path of image url
                $fields = array(
                    'to' => $notifiable->notificationkey, //this is notificationkey column from user table database
                    'data' => array(
                        "body" => $data->greeting,
                        "title" => $data->subject,
                        "image" => $image
                    )
                );
            } else {
                // $fields = array(
                //     'to' => $notifiable->notificationkey,//this is notificationkey column from user table database
                //     'data' => array(
                //         "body" => $data->greeting,
                //         "title" => $data->subject,
                //         "flag" => (int)$data->level
                //     )
                // );
                $fields = array(
                    'to' => config('project.test_notification_key'), //For testing purpose key you firebase genrated notification key for android in .env file
                    'data' => array(
                        "body" => $data->greeting,
                        "title" => $data->subject,
                        "flag" => (int)$data->level
                    )
                );
            }

            $fields = json_encode($fields);
            $headers = array(
                'Authorization: key=' . config('project.firebase_key'),
                'Content-Type: application/json'
            );
            $url = config('project.firebase_url');
            $ispost = true;
            $this->RequestURL($url, $ispost, $headers, $fields);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
