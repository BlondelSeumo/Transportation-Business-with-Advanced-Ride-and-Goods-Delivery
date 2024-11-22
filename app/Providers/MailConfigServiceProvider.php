<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('settings')) {
            $mail = DB::table('settings')->first();
            if ($mail) //checking if table is not empty
            {

        $mailSettings = DB::table('settings')->where('category', 'mail_configuration')->get();

            $config = array(
                    'driver'     => $mailSettings[0]->value ?? 0,
                    'host'       => $mailSettings[1]->value ?? 0,
                    'port'       => $mailSettings[2]->value ?? 0,
                    'from'       => array('address' => $mailSettings[6]->value ?? 0, 'name' => $mailSettings[7]->value ?? 0),
                    'encryption' => $mailSettings[5]->value ?? 0,
                    'username'   => $mailSettings[3]->value ?? 0,
                    'password'   => $mailSettings[4]->value ?? 0,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}