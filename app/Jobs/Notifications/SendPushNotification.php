<?php

namespace App\Jobs\Notifications;

use Illuminate\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Notifications\AndroidPushNotification;

class SendPushNotification implements ShouldQueue
{
    use Dispatchable,Queueable,InteractsWithQueue,SerializesModels;

    /**
     * The User.
     *
     * @var user
     */
    protected $user;
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
    public function __construct($user,$title, $body, $data=null, $image=null)
    {
        $this->user = $user;
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
        $this->image = $image;
    }

      /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
         
        $this->user->notify(new AndroidPushNotification($this->title, $this->body, $this->data,$this->image));

    }
}
