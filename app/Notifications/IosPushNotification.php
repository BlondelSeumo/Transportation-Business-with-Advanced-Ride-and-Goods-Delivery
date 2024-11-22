<?php

namespace App\Notifications;

use Pushok\Client;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Pushok\AuthProvider\Token;
use NotificationChannels\Apn\ApnChannel;
use NotificationChannels\Apn\ApnMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IosPushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $body, $expiresAt=null, $sound=null, $user_type)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ApnChannel::class];
    }

    public function toApn($notifiable)
    {
        // $options = Arr::except($app['config']['broadcasting.connections.apn'], 'environment');
        $options = Arr::except(data_get(config('broadcasting'), 'connections.apn'), 'environment');

        $production = data_get(config('broadcasting'), 'connections.apn.environment')=== ApnChannel::PRODUCTION;

        $token = Token::create($options);
        $customClient = new Client($token, $production);

        $expiresAt = Carbon::now()->addMinute(2);

        return ApnMessage::create()
            ->badge(1)
            ->title('Account User approved')
            ->body("Your service account was approved!")
            ->expiresAt($expiresAt)
            ->sound('default')
            ->via($customClient);
    }
}
