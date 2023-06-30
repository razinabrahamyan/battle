<?php


namespace App\Traits;


use App\Notifications\UserNotification;
use App\User;
use Illuminate\Support\Facades\Notification;

trait NotificationsTrait
{
    public function storeNotification($data,$user_id){
        $notification = new UserNotification($data);
        Notification::send(User::find($user_id),$notification);
        return;
    }

    public function sendUserNotification($data,$user_id){
        event(new \App\Events\UserNotification($data,$user_id));
        return;
    }
}
