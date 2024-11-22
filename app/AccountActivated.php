<?php

namespace App;

use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class AccountActivated extends Notification
{
    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        $fcm_message =  FcmMessage::create()
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('Hi Lavanya')
                ->setBody('Lavanya how are you?')
                ->setImage('http://54.193.155.147/taxi/public/storage/uploads/types/images/Sz7U1YxKlW13yAX9XYv06v1XkwjIyi8H0KoFYnIq.jpg'));

        return $fcm_message;
    }
}
