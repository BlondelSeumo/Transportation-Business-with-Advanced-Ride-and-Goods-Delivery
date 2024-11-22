<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThirdPartySetting;

class ThirdPartySettingSeeder extends Seeder
{

    protected $payment_settings = [
//sms
        ['name' => 'enable_firebase_otp',
         'value' => '1',
         'module' => 'sms',
        ],  
    //twilio       
        ['name' => 'enable_twilio',
         'value' => '0',
         'module' => 'sms',
        ], 
        ['name' => 'twilio_sid',
         'value' => 'Your Twilio SID',
         'module' => 'sms',
        ], 
        ['name' => 'twilio_token',
         'value' => 'Your Twilio Token',
         'module' => 'sms',
        ], 
        ['name' => 'twilio_from_number',
         'value' => 'Your Twilio Phone Number',
         'module' => 'sms',
        ],         
   // sparrow               
        ['name' => 'enable_sparrow',
         'value' => '0',
         'module' => 'sms',
        ], 
        ['name' => 'sparrow_sender_id',
         'value' => 'Your Sparrow Sender Id',
         'module' => 'sms',
        ], 
        ['name' => 'sparrow_token',
         'value' => 'Your Sparrow Token',
         'module' => 'sms',
        ],  
//msg91
        ['name' => 'enable_msg91',
         'value' => '0',
         'module' => 'sms',
        ],  
        ['name' => 'msg91_sender_id',
         'value' => 'Your MSG91 Sender Token',
         'module' => 'sms',
        ],  
        ['name' => 'msg91_auth_key',
         'value' => 'Your MSG91 Auth Key',
         'module' => 'sms',
        ], 
//enable_sms_india_hub
        ['name' => 'enable_sms_india_hub',
         'value' => '0',
         'module' => 'sms',
        ],  
        ['name' => 'sms_india_hub_api_key',
         'value' => 'Your Sms India Hub Api Key',
         'module' => 'sms',
        ],  
        ['name' => 'sms_india_hub_sid',
         'value' => 'Your SMS India Hub SID',
         'module' => 'sms',
        ], 
    // smsala
        ['name' => 'enable_smsala',
         'value' => '0',
         'module' => 'sms',
        ],      
        ['name' => 'smsala_api_key',
         'value' => 'Your SMS ALA API ID',
         'module' => 'sms',
        ], 
        ['name' => 'smsala_api_password',
         'value' => 'Your SMS ALA SmsAla API Password',
         'module' => 'sms',
        ], 
        ['name' => 'smsala_sender_id',
         'value' => 'Your SMS ALA Sender ID',
         'module' => 'sms',
        ], 
// Modules
        ['name' => 'map_type',
         'value' => '1',
         'module' => 'app_modules',
        ],  
        ['name' => 'enable_shipment_load_feature',
         'value' => '1',
         'module' => 'app_modules',
        ],  
        ['name' => 'enable_shipment_unload_feature',
         'value' => '1',
         'module' => 'app_modules',
        ],  
        ['name' => 'enable_digital_signature',
         'value' => '1',
         'module' => 'app_modules',
        ],    
        ['name' => 'enable_country_restrict_on_map',
         'value' => '1',
         'module' => 'app_modules',
        ],        
        ['name' => 'enable_digital_signatur_at_the_end_of_ride',
         'value' => '1',
         'module' => 'app_modules',
        ], 
        ['name' => 'enable_delivery_start_and_end_of_ride',
         'value' => '1',
         'module' => 'app_modules',
        ], 
        ['name' => 'enable_otp_tripstart',
         'value' => '1',
         'module' => 'app_modules',
        ],   
        ['name' => 'enable_rental_ride',
         'value' => '1',
         'module' => 'app_modules',
        ],  
        ['name' => 'enable_my_route_booking_feature',
         'value' => '1',
         'module' => 'app_modules',
        ],    
        ['name' => 'how_many_times_a_driver_can_enable_the_my_route_booking_per_day',
         'value' => '1',
         'module' => 'app_modules',
        ],    
        ['name' => 'enable_modules_for_applications',
         'value' => '1',
         'module' => 'app_modules',
        ],       
        ['name' => 'enable_vase_map',
         'value' => '1',
         'module' => 'app_modules',
        ],   

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_params = $this->payment_settings;

        $value = ThirdPartySetting::first();
        if(is_null($value))
        {
          foreach ($created_params as $third_party_setting) 
          {
            ThirdPartySetting::create($third_party_setting);
          }
        }else {
             ThirdPartySetting::where('module', 'sms')->whereIn('name', ['smsala_from_number', 'smsala_token','smsala_api_key','smsala_secrect_key','smsala_from_number'])->delete();

          foreach ($created_params as $third_party_setting) 
          {
            $value->updateOrCreate($third_party_setting);
          }
        }
    }
}
