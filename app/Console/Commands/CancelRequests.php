<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Contract\Database;
use Carbon\Carbon;
use App\Models\Request\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\Notifications\SendPushNotification;
use App\Base\Constants\Masters\UserType;
use App\Jobs\NoDriverFoundNotifyJob;

class CancelRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Request over 15 minutes not accepted  biding rides';

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
     * @return int
     */
    public function handle()
    {
        $currentDateTimeUTC = Carbon::now('UTC');

        // Calculate the timestamp for 15 minutes ago in UTC
        $fifteenMinutesAgoUTC = $currentDateTimeUTC->subMinutes(3);

        // Query to get records within the last 15 minutes in UTC
        $requests = Request::where('is_later', 0)
            ->where('is_bid_ride', 1)
            ->where('is_completed', 0)
            ->where('is_cancelled', 0)
            ->where('is_driver_started', 0)
            ->where('created_at', '<=', $fifteenMinutesAgoUTC)
            ->get();

        if ($requests->count()==0) {
            return $this->info('no-bidding-rides-found');
        }
        // dd(DB::getQueryLog());
        foreach ($requests as $key => $request) {
               $request->update([
                'is_cancelled'=>true,
                // 'custom_reason'=>"No Drivers Found",
                'cancel_method'=>UserType::AUTOMATIC,
                'cancelled_at'=>Carbon::now()->toDateString(),
            ]);

         $this->database->getReference('requests/'.$request->id)->update(['no_driver'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);


          $this->database->getReference('request-meta/'.$request->id)->remove();

          $this->database->getReference('bid-meta/'.$request->id)->remove();


          dispatch(new NoDriverFoundNotifyJob($request->id,$this->database));
       


        }


          $this->info('success');

    }
}
