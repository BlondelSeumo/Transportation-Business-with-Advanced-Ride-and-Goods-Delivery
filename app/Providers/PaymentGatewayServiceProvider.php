<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Config;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('settings')) {

//stripe key update from settings table 

            $stripeKeys = DB::table('settings')
                ->whereIn('name', ['stripe_test_publishable_key', 'stripe_test_secret_key', 'stripe_live_publishable_key', 'stripe_live_secret_key'])
                ->get()
                ->keyBy('name');

            $stripeMode = DB::table('settings')
                ->where('name', 'stripe-environment')
                ->value('value');
        if($stripeMode){
             if ($stripeMode == "test") {
                $stripePublishableKey = $stripeKeys['stripe_test_publishable_key']->value;
                $stripeSecretKey = $stripeKeys['stripe_test_secret_key']->value;
            } else {
                $stripePublishableKey = $stripeKeys['stripe_live_publishable_key']->value;
                $stripeSecretKey = $stripeKeys['stripe_live_secret_key']->value;
            }         
        }


//paypal key update 
              $paypalKeys = DB::table('settings')
                ->whereIn('name', ['paypal_sandbox_client_id',
                    'paypal_sandbox_client_secrect',
                    'paypal_sandbox_app_id',
                    'paypal_live_client_id',
                    'paypal_live_client_secrect',
                    'paypal_live_app_id',
                    'paypal_notify_url'])
                ->get()
                ->keyBy('name');     

             $paypalMode = DB::table('settings')
                ->where('name', 'paypal_mode')
                ->value('value');
        if($paypalMode){
            if ($paypalMode == "sandbox") 
            {
                $paypal_client_id = $paypalKeys['paypal_sandbox_client_id']->value;
                $paypal_client_secrect = $paypalKeys['paypal_sandbox_client_secrect']->value;
                $paypal_app_id = $paypalKeys['paypal_sandbox_app_id']->value;
                $paypal_url = $paypalKeys['paypal_notify_url']->value;

            } else {

                $paypal_client_id = $paypalKeys['paypal_live_client_id']->value;
                $paypal_client_secrect = $paypalKeys['paypal_live_client_secrect']->value;
                $paypal_app_id = $paypalKeys['paypal_live_app_id']->value;
                $paypal_url = $paypalKeys['paypal_notify_url']->value;

            }
// dd($paypalKeys); 
        }
            
            // Set the configuration values directly
            Config::set('stripe.pk', $stripePublishableKey ?? null);
            Config::set('stripe.sk', $stripeSecretKey ?? null);
         
            //paypal 
            Config::set("paypal.mode", $paypalMode ??null);
            Config::set("paypal.{$paypalMode}.client_id", $paypal_client_id ?? null);
            Config::set("paypal.{$paypalMode}.client_secret", $paypal_client_secrect ?? null);
            Config::set("paypal.{$paypalMode}.app_id", $paypal_app_id ?? null);
            Config::set("paypal.notify_url", $paypal_url ?? null);

        }
    }

}