<?php

namespace App\Jobs\Notifications;

use Illuminate\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use NotificationChannels\Fcm\Resources\AndroidConfig;

class AndroidPushNotification extends Notification implements ShouldQueue
{
    use Queueable,InteractsWithQueue,SerializesModels;

    /**
     * The title.
     *
     * @var title
     */
    protected $title;
    /**
    * The body.
    *
    * @var body
    */
    protected $body;
    /**
    * The image.
    *
    * @var image
    */
    protected $image;
    /**
    * The data.
    *
    * @var data
    */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param $title,$body,$image,$data
     */
    public function __construct($title, $body, $data=null, $image=null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
        $this->image = $image;
    }

    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable)
    { 
        if ($this->data) { 
           
            
            return FcmMessage::create()
            ->setData($this->data)
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->title)
                ->setBody($this->body));
        } else {
            return FcmMessage::create()
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->title)
                ->setBody($this->body)
                ->setImage($this->image));
        }
    }
}
