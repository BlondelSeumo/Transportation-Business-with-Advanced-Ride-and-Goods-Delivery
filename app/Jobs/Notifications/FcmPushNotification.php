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
use App\Jobs\Notifications\BaseNotification;

class FcmPushNotification extends BaseNotification implements ShouldQueue
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
    * The device_token.
    *
    * @var device_token
    */
    protected $device_token;

    /**
     * Create a new job instance.
     *
     * @param $title,$body,$image,$device_token
     */
    public function __construct($title, $body, $device_token=null)
    {
        $this->title = $title;
        $this->body = $body['result'];
        $this->device_token = $device_token;
    }

    
    public function handle()
    {

       try{

            $API_ACCESS_KEY = env('FCM_SERVER_KEY');


           if(is_array($this->device_token))
           {
               $registrationIds = $this->device_token;
           }
           else
           {
               $registrationIds = array($this->device_token);
           }


           // prep the bundle
           $msg = array
           (
               'message'    => json_encode((object)$this->body),
               'title'      => $this->title,
               'vibrate'    => 1,
               'sound'      => 1,
               'largeIcon'  => 'large_icon',
               'smallIcon'  => 'small_icon'
           );
           $fields = array
           (
               'registration_ids'   => $registrationIds,
               'data'           => $msg
           );

           $headers = array
           (
               'Authorization: key=' . $API_ACCESS_KEY,
               'Content-Type: application/json'
           );

           $ch = curl_init();

           curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

           curl_setopt( $ch,CURLOPT_POST, true );
           curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
           curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
           curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
           curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
           $result = curl_exec($ch );
           curl_close( $ch );


           return $result;

            }catch (Exception $e){

        }

    }
}
