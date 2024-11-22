<?php

namespace App\Jobs;

use App\Jobs\NotifyViaMqtt;
use App\Jobs\NotifyViaSocket;
use Illuminate\Bus\Queueable;
use App\Models\Request\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Base\Constants\Masters\PushEnums;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Transformers\Requests\CronTripRequestTransformer;
use App\Jobs\Notifications\SendPushNotification;
use Kreait\Firebase\Contract\Database;

class NoDriverFoundNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestids;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestids, Database $database)
    {
        $this->requestids = $requestids;
        $this->database = $database;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $app_for = config('app.app_for');

        foreach ($this->requestids as $key => $request_id) {
            $request_detail = Request::find($request_id);
            $request_detail->update(['is_cancelled'=>true,'cancel_method'=>0,'cancelled_at'=>date('Y-m-d H:i:s')]);
            
        if($app_for == 'bidding')
        {
            $this->database->getReference('bid-meta/'.$request_detail->id)->remove();
        }
            $request_detail->fresh();
            $request_result =  fractal($request_detail, new CronTripRequestTransformer);
            $pus_request_detail = $request_result->toJson();
    
            $title = trans('push_notifications.no_driver_found_title',[],$request_detail->userDetail->lang);
            $body = trans('push_notifications.no_driver_found_body',[],$request_detail->userDetail->lang);


            $push_data = ['notification_enum'=>PushEnums::NO_DRIVER_FOUND];

            if ($request_detail->userDetail()->exists()) {

                if($request_result->userDetail->fcm_token){
                $user = $request_detail->userDetail;
                $socket_data = new \stdClass();
                $socket_data->success = true;
                $socket_data->success_message  = PushEnums::NO_DRIVER_FOUND;
                $socket_data->result = $request_result;
                dispatch(new SendPushNotification($user,$title,$body));
                }

            }
        }
    }
}
