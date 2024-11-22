<?php

namespace App\Console\Commands;

use App\Models\Admin\Driver;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Models\User;

class ClearDemoDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Database';

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
        if(env('APP_FOR')=='demo'){

        $non_deleted_ids = [];

        $non_deleted_ids[] = $user = User::belongsToRole('super-admin')->pluck('id')->first();

        $non_deleted_ids[] = User::belongsToRole('dispatcher')->pluck('id')->first();

        $mobile_numbers = ['8883821932','8667241567'];

        $non_deleted_ids[] = User::whereIn('mobile',$mobile_numbers)->pluck('id')->first();

        User::whereNotIn('id',$non_deleted_ids)->delete();

        $this->database->getReference('drivers')->remove();

        $this->database->getReference('requests')->remove();

        $this->info("success");
    
        }
        

    }
}
