<?php

namespace App\ORM_Model\Fld_Event;

use App\Notifications\UserNotification;
use App\User;
use Exception;

class EventRepository implements EventInterface
{
    public final function notification(string $message, $userprimarykey)
    {
        try {
            $send = User::find($userprimarykey);
            //$send->notify((new UserNotification())->delay(now()->addSeconds(5)));
            $send->notify(new UserNotification());
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        }
    }
}
