<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Request\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Jobs\NoDriverFoundNotifyJob;
use App\Jobs\SendRequestToNextDriversJob;
use Kreait\Firebase\Contract\Database;

class ChangeDriversToTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:totrip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the request to other drivers when the driver doesn\'t respond';

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
        // Log::info("succccccccessss");
        $driver_timeout = 60;

        $request_meta = RequestMeta::whereRaw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'", updated_at)) > '.$driver_timeout." AND active=1")->get();
        // $request_meta = RequestMeta::whereActive(true)->get();

        if (count($request_meta)==0) {
            return $this->info('no-meta-drivers-found');
        }
        DB::beginTransaction();
        try {
            $meta_ids = $request_meta->pluck('id');
            $request_ids = $request_meta->pluck('request_id');

            foreach ($meta_ids as $key => $meta_id) {
                $request_meta_detable = RequestMeta::where('id', $meta_id)->first();
                $driver = $request_meta_detable->driver;
                $driver->available = true;
                $driver->save();
                // Delete Meta Driver From Firebase
                 $this->database->getReference('request-meta/'.$request_meta_detable->request_id)->set(['driver_id'=>'','request_id'=>$request_meta_detable->request_id,'user_id'=>$request_meta_detable->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

                // Delete Driver data from Mysql Request Meta
                $request_meta_detable->delete();
            }
            // RequestMeta::whereIn('id', $meta_ids)->delete();

            $data = RequestMeta::whereIn('request_id', $request_ids)->groupBy('request_id')->selectRaw('Min(id) as request_meta_id, request_id')->get();

            $next_driver_request_meta_id = $data->pluck('request_meta_id');

            $updated_request_id = $data->pluck('request_id');

            $request_meta =  RequestMeta::whereIn('id', $next_driver_request_meta_id)->update(['active'=>true]);

            $array_updated_request_ids = $updated_request_id->toArray();
            $array_request_ids = $request_ids->toArray();

            $no_driver_request_ids = array_diff($array_request_ids, $array_updated_request_ids);
            // Send Request to other drivers
            dispatch(new SendRequestToNextDriversJob($next_driver_request_meta_id,$this->database));

            $this->info('success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            Log::error('Error while changing requests to other drivers');
            return $this->info('unknown error occured');
        }
        DB::commit();
    }
}
