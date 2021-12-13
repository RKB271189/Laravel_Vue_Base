<?php

namespace App\Notifications;

use App\Channel\FirebaseChannel;
use App\Usables_Extensions\WriteRead;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable, WriteRead;

    public $tries = 3;

    public $timeout = 15;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Pass some default value and fill the private variable as required

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }
    public function toNotification($notifiable)
    {
        try {
            $istestwithimage = false;
            if ($istestwithimage) {
                return (new FirebaseChannel)
                    ->subject("Header/Title of the notification")  //For Example : Reminder
                    ->greeting("Long message/body shown in the mobile notification") // For Example : You have not order since many days
                    ->level("Any flag") // For Eaxmple : 1/0 (we used for playing differnet notification sound)
                    ->salutation("Image path from the url saved in the project"); // For Eaxmple : https://domainname.com/Images/image.png
            } else {
                return (new FirebaseChannel)
                    ->subject("Header/Title of the notification")  //For Example : Reminder
                    ->greeting("Long message/body shown in the mobile notification") // For Example : You have not order since many days
                    ->level("Any flag"); // For Eaxmple : 1/0 (we used for playing differnet notification sound)                    
            }
        } catch (Exception $ex) {
            return false;
        }
    }
}
