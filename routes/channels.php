<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notification.{userid}', function ($user, $userid) {
    return (int) $user->id === (int) $userid;
    //return true;//Should return true 
    //return false;// If it returns false then in browser console it wil give u forbidden error
});
