<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Request\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use App\Jobs\NoDriverFoundNotifyJob;
use App\Base\Constants\Masters\PushEnums;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Transformers\Requests\CronTripRequestTransformer;
use App\Models\Request\DriverRejectedRequest;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Base\Constants\Setting\Settings;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Support\Facades\Log;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;


class AssignDriversForScheduledRides extends Command
{
    use FetchDriversFromFirebaseHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign_drivers:for_schedule_rides';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Drivers for schdeulesd rides';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       $ride_cancelation_time =Carbon::now()->subMinutes(10)->format('Y-m-d H:i:s');

       $uncompleted_requests = Request::where('trip_start_time', '<', $ride_cancelation_time)
           ->where('is_later', 1)
           ->where('is_completed', 0)
           ->where('is_cancelled', 0)
           ->where('is_driver_started', 0)
           ->get();

      if($uncompleted_requests) {  
       foreach ($uncompleted_requests as $uncompleted_request) 
       {
           $update_parms['is_cancelled'] = true;
           $update_parms['cancelled_at'] = date('Y-m-d H:i:s');
           $update_parms['cancel_method'] = 0;
           
           $uncompleted_request->update($update_parms);

           if($uncompleted_request->driver_id){
            Driver::where('id',$uncompleted_request->driver_id)->update(['available'=>true]);
        }
        
        
           $this->database->getReference('requests/'.$uncompleted_request->id)->update(['is_cancelled'=>true,'updated_at'=> Database::SERVER_TIMESTAMP]);
           $this->database->getReference('bid-meta/'.$uncompleted_request->id)->remove();
           $this->database->getReference('request-meta/'.$uncompleted_request->id)->remove();
           $this->database->getReference('requests/'.$uncompleted_request->id)->remove();
               // dd($uncompleted_request);
        }
     }

        $requests = Request::where('is_later', 1)
                    ->where('is_bid_ride',0)
                    ->where('is_completed', 0)->where('is_cancelled', 0)->where('is_driver_started', 0)->get();

        if ($requests->count()==0) {
            return $this->info('no-schedule-rides-found');
        }

        // dd(DB::getQueryLog());
        foreach ($requests as $key => $request) {
            $trip_start_time = $request->trip_start_time;

            if($request->prefered_arriving_time){
                $findable_duration = $request->prefered_arriving_time+2;
            }else{
                $findable_duration = get_settings('minimum_time_for_search_drivers_for_schedule_ride');
            }
            if(!$findable_duration){
                $findable_duration = 45;
            }
            $condition_time = [Carbon::parse($request->trip_start_time),Carbon::parse($request->trip_start_time)->subMinutes($findable_duration+5)];
            $current_time = Carbon::now();
            if ($current_time->between($condition_time[0],$condition_time[1])) {

            }else{
                continue;

            }
            if($current_time > $condition_time[0])
            {
                $this->cancelRequest($request);

            }else{

                $request->update(['on_search'=>true]);

                $this->fetchDriversFromFirebase($request);              

            }

        }

        $this->info('success');
    }

    public function cancelRequest($request)
    {

        $this->database->getReference('requests/'.$request->id)->update(['is_cancel' => 1]);

        $no_driver_request_ids = [];
        $no_driver_request_ids[0] = $request->id;
        dispatch(new NoDriverFoundNotifyJob($no_driver_request_ids,$this->database));


    }

}
