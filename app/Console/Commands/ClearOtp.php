<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\MailOtp;
use Illuminate\Console\Command;

class ClearOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   protected $signature = 'clear:otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '3 hours completed OTP Deleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $currentTime = Carbon::now();


        $otps = MailOtp::where('created_at', '<', $currentTime)->get();


      
        foreach ($otps as $otp) 
        {
            $created_time = strtotime($otp->created_at);

            $time =strtotime($currentTime);

            $difference = abs($time - $created_time)/3600;

                if ($difference >= 3)
                 {
                $otp->delete();
                }         
        }

       $this->info(' OTP Records cleard ');    }
}