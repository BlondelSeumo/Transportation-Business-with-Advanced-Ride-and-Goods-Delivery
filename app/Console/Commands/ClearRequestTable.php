<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Request\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\Notifications\SendPushNotification;
use App\Base\Constants\Masters\UserType;
use App\Jobs\NoDriverFoundNotifyJob;
use Kreait\Firebase\Contract\Database;


class ClearRequestTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Request Table Data Before 30 Days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(30);

        $request = Request::where( 'created_at', '<', $date)->delete();

/*new */
        $currentDateTimeUTC = Carbon::now('UTC');

        // Calculate the timestamp for 15 minutes ago in UTC
        $fifteenMinutesAgoUTC = $currentDateTimeUTC->subMinutes(3);
        // Query to get records within the last 15 minutes in UTC
        $out_Requests = Request::where('is_out_station', 1)
            ->where('is_completed', 0)
            ->where('is_cancelled', 0)
            ->where('is_driver_started', 0)
            ->where('created_at', '<=', $fifteenMinutesAgoUTC)
            ->get();

        if ($out_Requests->count()==0) {
            return $this->info('no-out-rides-found');
        }
        // dd(DB::getQueryLog());
        foreach ($out_Requests as $key => $out_request) {
               $out_request->update([
                'is_cancelled'=>true,
                'cancel_method'=>0,
                'cancelled_at'=>Carbon::now()->toDateString(),
            ]);

         $this->database->getReference('requests/'.$out_request->id)->update(['no_driver'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);


          $this->database->getReference('request-meta/'.$out_request->id)->remove();

          $this->database->getReference('bid-meta/'.$out_request->id)->remove();


          dispatch(new NoDriverFoundNotifyJob($out_request->id,$this->database));
       


        }

       $this->info('Bid Meta cleard');

    }
}
