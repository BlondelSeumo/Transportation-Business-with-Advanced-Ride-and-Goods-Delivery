<?php

namespace App\Console\Commands;

use App\Models\Admin\Driver;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\Notifications\SendPushNotification;

class OfflineUnAvailableDrivers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offline:drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offline Un Available Drivers';

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
        $current_timestamp = Carbon::now()->timestamp;
        $conditional_timestamp = Carbon::now()->subMinutes(15);

        $one_hr_conditional_time = Carbon::now()->subMinutes(30);

        $drivers = $this->database->getReference('drivers')->orderByChild('is_active')->equalTo(1)->getValue();

        foreach ($drivers as $key => $driver) {
            $driver_updated_at = Carbon::createFromTimestamp($driver['updated_at'] / 1000);
            
                $mysql_driver = Driver::where('id', $driver['id'])->first();
                // Check if the driver is on trip
                if($mysql_driver && $mysql_driver->requestDetail()->where('is_completed',false)->where('is_cancelled',false)->exists()){
                    goto end;
                }

            if($one_hr_conditional_time > $driver_updated_at){
                goto make_offline;
            }

            
            
            if ($conditional_timestamp > $driver_updated_at) {
                
                $this->info("some-drivers-are-there");

                if ($mysql_driver){
                    $notifable_driver = $mysql_driver->user;
                    $title = trans('push_notifications.reminder_push_title',[],$notifable_driver->lang);
                    $body = trans('push_notifications.reminder_push_body',['name'=> app_name()],$notifable_driver->lang);

                    dispatch(new SendPushNotification($notifable_driver,$title,$body));

                }
                
                
                make_offline:

                // Get last online record
                if ($mysql_driver && $mysql_driver->driverAvailabilities()) {

                    $updatable_offline_date_time = Carbon::createFromTimestamp($driver['updated_at']/1000);

                    $availability = $mysql_driver->driverAvailabilities()->where('is_online', true)->orderBy('online_at', 'desc')->first();
                    $created_params['duration'] = 0;
                    if ($availability) {
                        $last_online_date_time = Carbon::parse($availability->online_at);
                        $last_offline_date = Carbon::parse($updatable_offline_date_time);
                        $duration = $last_offline_date->diffInMinutes($last_online_date_time);
                        $created_params['duration'] = $availability->duration+$duration;
                        $availability->update(['is_online'=>false,'offline_at'=>$updatable_offline_date_time,'duration'=>$availability->duration+$duration]);

                    }else{
                        $created_params['duration'] = 0;  
                        $created_params['is_online'] = false;
                        $created_params['online_at'] = $updatable_offline_date_time;
                        $created_params['offline_at'] = $updatable_offline_date_time;
                        $mysql_driver->driverAvailabilities()->create($created_params);

                    }
                    
                    $mysql_driver->active = 0;
                    $mysql_driver->save();

                    $this->database->getReference('drivers/'.'driver_'.$driver['id'])->update(['is_active'=>0,'updated_at'=> Database::SERVER_TIMESTAMP]);

                }


                end:
                
                
            }

        $this->info("no-drivers-found");

        }

        $this->info("success");
    }
}
