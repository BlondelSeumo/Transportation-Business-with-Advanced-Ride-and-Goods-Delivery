<?php

namespace App\Jobs;

use App\Jobs\NotifyViaMqtt;
use Illuminate\Bus\Queueable;
use App\Models\Request\RequestMeta;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Base\Constants\Masters\PushEnums;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Transformers\Requests\CronTripRequestTransformer;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;

class SendRequestToNextDriversJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request_meta_ids;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_meta_ids,Database $database)
    {
        $this->request_meta_ids = $request_meta_ids;
        $this->database = $database;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->request_meta_ids as $key => $request_meta_id) {
            $request_meta_detail = RequestMeta::find($request_meta_id);

            // Add Meta Driver into Firebase Request Meta
            $this->database->getReference('request-meta/'.$request_meta_detail->request_id.'/'.$request_meta_detail->driver_id)->set(['driver_id'=>$request_meta_detail->driver_id,'request_id'=>$request_meta_detail->request_id,'user_id'=>$request_meta_detail->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

            $request_result =  fractal($request_meta_detail->request, new CronTripRequestTransformer)->parseIncludes('userDetail');

            $pus_request_detail = $request_result->toJson();
            $title = trans('push_notifications.new_request_title');
            $body = trans('push_notifications.new_request_body');
            $push_data = ['notification_enum'=>PushEnums::REQUEST_CREATED,'result'=>(string)$pus_request_detail];

            if ($request_meta_detail->driver->user()->exists()) {
                $driver = $request_meta_detail->driver;
                // Form a socket sturcture using users'id and message with event name
                $socket_data = new \stdClass();
                $socket_data->success = true;
                $socket_data->success_message  = PushEnums::REQUEST_CREATED;
                $socket_data->result = $request_result;
                // Form a socket sturcture using users'id and message with event name
                // $socket_message = structure_for_socket($driver->id, 'driver', $socket_data, 'create_request');
                
                // dispatch(new NotifyViaSocket('transfer_msg', $socket_message));

                // dispatch(new NotifyViaMqtt('create_request_'.$driver->id, json_encode($socket_data), $driver->id));

                $notifiable_driver = $request_meta_detail->driver->user;

                dispatch(new SendPushNotification($notifiable_driver,$title,$body));
            }
        }
    }
}
