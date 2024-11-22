<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Base\Constants\Setting\Settings as SettingSlug;
use App\Base\Constants\Setting\SettingCategory;
use App\Base\Constants\Setting\SettingSubGroup;
use App\Base\Constants\Setting\SettingValueType;

class SettingsSeeder extends Seeder
{
    /**
     * List of all the settings_from_seeder to be created along with their details.
     *
     * @var array
     */

    protected $app_for;

    protected $settings_from_seeder;

    public function __construct()
    {
        $this->app_for = config('app.app_for');

        $this->settings_from_seeder = [

        SettingSlug::TRIP_DISPTACH_TYPE => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 1,
            'field' => SettingValueType::SELECT,
            'option_value' => '{"one-by-one":1,"to-all-drivers":0}',
            'group_name' => null,
        ],

        SettingSlug::ROUND_THE_BILL_VALUE => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::MINIMUM_WALLET_AMOUNT_FOR_TRANSFER => [
            'category'=>SettingCategory::WALLET,
            'value' => 500,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],

         SettingSlug::DRIVER_SEARCH_RADIUS => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 3,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::USER_CAN_MAKE_A_RIDE_AFTER_X_MINIUTES => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 30,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::MINIMUM_TIME_FOR_SEARCH_DRIVERS_FOR_SCHEDULE_RIDE => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 30,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::MAXIMUM_TIME_FOR_FIND_DRIVERS_FOR_REGULAR_RIDE => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 5,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::TRIP_ACCEPT_REJECT_DURATION_FOR_DRIVER => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 30,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::HOW_MANY_TIMES_A_DRIVER_TIMES_A_DRIVER_CAN_ENABLE_THE_MY_ROUTE_BOOKING_PER_DAY => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 1,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::ENABLE_MY_ROUTE_BOOKING_FEATURE => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::LOGO => [
            'category'=>SettingCategory::GENERAL,
            'value' => null,
            'field' => SettingValueType::FILE,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::FAVICON => [
            'category'=>SettingCategory::GENERAL,
            'value' => null,
            'field' => SettingValueType::FILE,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::LOGINBG => [
            'category'=>SettingCategory::GENERAL,
            'value' => null,
            'field' => SettingValueType::FILE,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::NAV_COLOR => [
            'category'=>SettingCategory::GENERAL,
            'value' => '#0B4DD8',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::SIDEBAR_COLOR => [
            'category'=>SettingCategory::GENERAL,
            'value' => '#2a3042',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::SIDEBARTXT_COLOR => [
            'category'=>SettingCategory::GENERAL,
            'value' => '#a2a5af',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::APP_NAME => [
            'category'=>SettingCategory::GENERAL,
            'value' => 'Tagxi',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::CURRENCY => [
            'category'=>SettingCategory::GENERAL,
            'value' => 'INR',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::CURRENCY_SYMBOL => [
            'category'=>SettingCategory::GENERAL,
            'value' => '₹',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::DEFAULT_COUNTRY_CODE_FOR_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
            'value' => 'IN',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],

        SettingSlug::CONTACT_US_MOBILE1 => [
            'category'=>SettingCategory::GENERAL,
            'value' => '0000000000',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::CONTACT_US_MOBILE2 => [
            'category'=>SettingCategory::GENERAL,
            'value' => '0000000000',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::CONTACT_US_LINK => [
            'category'=>SettingCategory::GENERAL,
            'value' => 'https://tagxi-landing.ondemandappz.com/',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::DEFAULT_LAT => [
            'category'=>SettingCategory::GENERAL,
            'value' => 11.21215,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::DEFAULT_LONG => [
            'category'=>SettingCategory::GENERAL,
            'value' => 76.54545,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::ENABLE_COUNTRY_RESTRICT_ON_MAP => [
            'category'=>SettingCategory::GENERAL,
            'value' => '0',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
        SettingSlug::SHOW_WALLET_FEATURE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_WALLET_FEATURE_ON_MOBILE_APP_DRIVER => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_INSTATNT_RIDE_FEATURE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_OWNER_MODULE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_WALLET_MONEY_TRANSFER_FEAUTRE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_WALLET_MONEY_TRANSFER_FEAUTRE_ON_MOBILE_APP_FOR_DRIVER => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::SHOW_EMAIL_OTP_FEAUTRE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
//map location icond drag and drop feature
        SettingSlug::ENABLE_MAP_LOCATION_ICON_DRAG_AND_DROP_FATURE => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        // otp Features
        SettingSlug::ENABLE_OTP_FOR_LOGIN_IN_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        SettingSlug::ENABLE_OTP_FOR_SIGNUP_IN_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
             'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],
        //Otp Features 
        SettingSlug::SHOW_BANK_INFO_FEATURE_ON_MOBILE_APP => [
            'category'=>SettingCategory::GENERAL,
            'value' => 1,
             'field' => SettingValueType::SELECT,
             'option_value' => '{"yes":1,"no":0}',
             'group_name' => null,
        ],

        SettingSlug::DRIVER_WALLET_MINIMUM_AMOUNT_TO_GET_ORDER => [
            'category'=>SettingCategory::WALLET,
            'value' => -10000,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::OWNER_WALLET_MINIMUM_AMOUNT_TO_GET_ORDER => [
            'category'=>SettingCategory::WALLET,
            'value' => -10000,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],

        SettingSlug::ENABLE_PAYSTACK => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],
        SettingSlug::PAYSTACK_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'option_value' => '{"test":"test","production":"production"}',
            'value' => 'test',
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],
        SettingSlug::PAYSTACK_TEST_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'pk_test_527da4a4be4324509fbd32906d03d826eefdb395',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],
        SettingSlug::PAYSTACK_PRODUCTION_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],

        SettingSlug::PAYSTACK_TEST_PUBLISHABLE_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'pk_test_527da4a4be4324509fbd32906d03d826eefdb395',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],
        SettingSlug::PAYSTACK_PRODUCTION_PUBLISHABLE_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYSTACK_SETTINGS,
        ],
        SettingSlug::ENABLE_FLUTTER_WAVE => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::FLUTTERWAVE_SETTINGS,
        ],
         SettingSlug::FLUTTER_WAVE_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::FLUTTERWAVE_SETTINGS,
        ],
        SettingSlug::FLUTTER_WAVE_TEST_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::FLUTTERWAVE_SETTINGS,
        ],
        SettingSlug::FLUTTER_WAVE_PRODUCTION_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::FLUTTERWAVE_SETTINGS,
        ],

// cashfree
        SettingSlug::ENABLE_CASH_FREE => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],        
        SettingSlug::CASH_FREE_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'value' => 'test',
             'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],            
        SettingSlug::CASH_FREE_TEST_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'TEST15950842a648ba99cac7d66b63805951',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],
        SettingSlug::CASH_FREE_PRODUCTION_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],        
        SettingSlug::CASH_FREE_TEST_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'cfsk_ma_test_b368fc392899944a5006a8ab755e1d50_02d7733f',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],
        SettingSlug::CASH_FREE_PRODUCTION_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::CASH_FREE_SETTINGS,
        ],
//Razor_pay
        SettingSlug::ENABLE_RAZOR_PAY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],

         SettingSlug::RAZOR_PAY_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'test',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],

        SettingSlug::RAZOR_PAY_TEST_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'rzp_test_b444CSYRGAtdnV',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],
        SettingSlug::RAZOR_PAY_LIVE_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],
        SettingSlug::RAZOR_PAY_LIVE_SECRECT_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => ' ',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],
        SettingSlug::RAZOR_PAY_TEST_SECRECT_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'Q8ABpY18WPsyJ8LGvqGZR70l',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::RAZOR_PAY_SETTINGS,
        ],
/*khalti*/
        SettingSlug::ENABLE_KHALTI_PAY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::KHALTI_PAY_SETTINGS,
        ],
        SettingSlug::KHALTI_PAY_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::KHALTI_PAY_SETTINGS,
        ],
        SettingSlug::KHALTI_PAY_TEST_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'test_public_key_5066528dae744acb967edfae71959934',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::KHALTI_PAY_SETTINGS,
        ],
        SettingSlug::KHALTI_PAY_LIVE_API_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'test_public_key_5066528dae744acb967edfae71959934',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::KHALTI_PAY_SETTINGS,
        ],
/*mercadopago*/
        SettingSlug::ENABLE_MERCADOPAGO => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],

         SettingSlug::MERCADOPAGO_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],

        SettingSlug::MERCADOPAGO_TEST_PUBLIC_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'TEST-921f2a24-d29d-4af3-9ec8-3a366275cec8',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],
        SettingSlug::MERCADOPAGO_LIVE_PUBLIC_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'TEST-921f2a24-d29d-4af3-9ec8-3a366275cec8',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],

        SettingSlug::MERCADOPAGO_TEST_ACCESS_TOKEN => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'TEST-8770681523175761-021622-3db3401292f6ae1a11daed3a22b8db62-762016080',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],
        SettingSlug::MERCADOPAGO_LIVE_ACCESS_TOKEN => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'TEST-8770681523175761-021622-3db3401292f6ae1a11daed3a22b8db62-762016080',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::MERCADOPAGO_SETTINGS,
        ],
/**/
 // stripe
        SettingSlug::ENABLE_STRIPE => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],

         SettingSlug::STRIPE_ENVIRONMENT => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'value' => 'test',
             'option_value' => '{"test":"test","production":"production"}',
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],

         SettingSlug::STRIPE_TEST_PUBLISHABLE_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],

        SettingSlug::STRIPE_LIVE_PUBLISHABLE_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],

        SettingSlug::STRIPE_TEST_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'pk_test_51IuYWUSBCHfacuRqacrdy8IOlL3uUPq1XI0BZaRlqDPPcNsmywe6rSqjpM9HhVmELhXWhx95CH1pvNyQ8pvQEil900eGE0jXN8',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],

        SettingSlug::STRIPE_LIVE_SECRET_KEY => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::STRIPE_SETTINGS,
        ],
 //paypal
        SettingSlug::ENABLE_PAYPAL => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

         SettingSlug::PAYPAL_MODE => [
            'category'=>SettingCategory::INSTALLATION,
            'field' => SettingValueType::SELECT,
            'value' => 'sandbox',
             'option_value' => '{"sandbox":"sandbox","live":"live"}',
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

         SettingSlug::PAYPAL_SANDBOX_CLIENT_ID => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'AfcLuPxX21U1JJVRgUO1qRAblJfzMheGzXJRgVZLbpVIpI8WfT8kwD1AIOn-6moi5XQJRY-w3SrmAFFk',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

        SettingSlug::PAYPAL_SANDBOX_CLIENT_SECRECT => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'ELF9g1BW4zWwkOPMqxSPA6zN8hvnCD9WgoOv3BPJUVT1tyC70TCZWKZS-5sdI8-ah3BvdiqDyuAvz2Yh',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

        SettingSlug::PAYPAL_SANDBOX_APP_ID => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'APP-80W284485P519543T',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],
         SettingSlug::PAYPAL_LIVE_CLIENT_ID => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

        SettingSlug::PAYPAL_LIVE_CLIENT_SECRECT => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],

        SettingSlug::PAYPAL_LIVE_APP_ID => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],
        SettingSlug::PAYPAL_NOTIFY_URL => [
            'category'=>SettingCategory::INSTALLATION,
            'value' => 'your-key',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => SettingSubGroup::PAYPAL_SETTINGS,
        ],
        SettingSlug::REFERRAL_COMMISION_FOR_USER => [
            'category'=>SettingCategory::REFERRAL,
            'value' => 30,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
          SettingSlug::REFERRAL_COMMISION_FOR_DRIVER => [
            'category'=>SettingCategory::REFERRAL,
            'value' => 30,
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
     // stripe

        SettingSlug::ENABLE_VASE_MAP => [
            'category'=>SettingCategory::MAP_SETTINGS,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
        SettingSlug::MAP_TYPE => [
            'category'=>SettingCategory::MAP_SETTINGS,
            'value' => 'google',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"google":"google","open_street":"open_street"}',
            'group_name' => null,
        ],

        SettingSlug::GOOGLE_MAP_KEY => [
            'category'=>SettingCategory::MAP_SETTINGS,
            'value' => 'your-key',
            'field' => SettingValueType::PASSWORD,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::GOOGLE_MAP_KEY_FOR_DISTANCE_MATRIX => [
            'category'=>SettingCategory::MAP_SETTINGS,
            'value' => 'your-key',
            'field' => SettingValueType::PASSWORD,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::GOOGLE_SHEET_ID => [
            'category'=>SettingCategory::MAP_SETTINGS,
            'value' => 'your-sheet-id',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::FIREBASE_DB_URL => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'https://your-db.firebaseio.com',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::FIREBASE_API_KEY => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-api-key',
            'field' => SettingValueType::PASSWORD,
            'option_value' => null,
            'group_name' => null,
        ],
           SettingSlug::FIREBASE_AUTH_DOMAIN => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-auth-domain',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::FIREBASE_PROJECT_ID => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-firebase-project-id',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::FIREBASE_STORAGE_BUCKET => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-firebase-storage-bucket',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::FIREBASE_MESSAGIN_SENDER_ID => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-firebase-messaging-sender-id',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::FIREBASE_APP_ID => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-app-id',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::FIREBASE_MEASUREMENT_ID => [
            'category'=>SettingCategory::FIREBASE_SETTINGS,
            'value' => 'your-firebase-measurement-id',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::CURRENCY => [
            'category'=>SettingCategory::GENERAL,
            'value' => 'INR',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
        SettingSlug::CURRENCY_SYMBOL => [
            'category'=>SettingCategory::GENERAL,
            'value' => '₹',
            'field' => SettingValueType::TEXT,
            'option_value' => null,
            'group_name' => null,
        ],
         SettingSlug::SHOW_RIDE_OTP_FEATURE => [
            'category'=>SettingCategory::GENERAL,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
         SettingSlug::SHOW_RIDE_LATER_FEATURE => [
            'category'=>SettingCategory::GENERAL,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
         SettingSlug::SHOW_RIDE_WITHOUT_DESTINATION => [
            'category'=>SettingCategory::GENERAL,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
      /*Mailer Name*/
        SettingSlug::MAIL_MAILER => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'smtp',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
        SettingSlug::MAIL_HOST => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'smtp.gmail.com',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
        SettingSlug::MAIL_PORT => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => '587',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
        SettingSlug::MAIL_USERNAME => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'yourgmail@gmail.com',
            'field' => SettingValueType::PASSWORD,
            'group_name' => null,
        ],
        SettingSlug::MAIL_PASSWORD => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'your-password',
            'field' => SettingValueType::PASSWORD,
            'group_name' => null,
        ],
        SettingSlug::MAIL_ENCRYPTION => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'tls',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
        SettingSlug::MAIL_FROM_ADDRESS => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'yourgmail@gmail.com',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
         SettingSlug::MAIL_FROM_NAME => [
            'category'=>SettingCategory::MAIL_CONFIGURATION,
            'value' => 'misoftwares',
            'field' => SettingValueType::TEXT,
            'group_name' => null,
        ],
        SettingSlug::ENABLE_PET_PREFERENCE_FOR_USER => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ], 
         SettingSlug::ENABLE_LUGGAGE_PREFERENCE_FOR_USER => [
            'category'=>SettingCategory::TRIP_SETTINGS,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
        SettingSlug::SHOW_RENTAL_RIDE_FEATURE => [
            'category'=>SettingCategory::GENERAL,
            'value' => '1',
            'field' => SettingValueType::SELECT,
            'option_value' => '{"yes":1,"no":0}',
            'group_name' => null,
        ],
    ];


        if ($this->app_for == 'bidding') {
            $this->settings_from_seeder = array_merge($this->settings_from_seeder, [
                SettingSlug::BIDDING_HIGH_PERCENTAGE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => 10,
                    'field' => SettingValueType::TEXT,
                    'option_value' => 0,
                    'group_name' => null,
                ],  
                SettingSlug::SHOW_OUTSTATION_RIDE_FEATURE => [
                    'category'=>SettingCategory::GENERAL,
                     'value' => 1,
                     'field' => SettingValueType::SELECT,
                     'option_value' => '{"yes":1,"no":0}',
                     'group_name' => null,
                ],                
                SettingSlug::BIDDING_LOW_PERCENTAGE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => 50,
                    'field' => SettingValueType::TEXT,
                    'option_value' => 0,
                    'group_name' => null,
                ],                  
                SettingSlug::MAXIMUM_TIME_FOR_FIND_DRIVERS_FOR_BIDDING_RIDE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => 5,
                    'field' => SettingValueType::TEXT,
                    'option_value' => null,
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_SHIPMENT_LOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_SHIPMENT_UNLOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_DIGITAL_SIGNATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],          
                SettingSlug::BIDDING_AMOUNT_INCREASE_OR_DECREASE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => 10,
                    'field' => SettingValueType::TEXT,
                    'option_value' => 0,
                    'group_name' => null,
                ],                
            ]);
        }

        if ($this->app_for == 'super' || $this->app_for == 'bidding') {
            $this->settings_from_seeder = array_merge($this->settings_from_seeder, [
                SettingSlug::ENABLE_MODULES_FOR_APPLICATIONS => [
                    'category'=>SettingCategory::GENERAL,
                    'value' => "both",
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"taxi":"taxi","delivery":"delivery","both":"both"}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_SHIPMENT_LOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_SHIPMENT_UNLOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_DIGITAL_SIGNATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
            ]);
        }

        if ($this->app_for == 'delivery') {
            $this->settings_from_seeder = array_merge($this->settings_from_seeder, [
                SettingSlug::ENABLE_SHIPMENT_LOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_SHIPMENT_UNLOAD_FEATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
                SettingSlug::ENABLE_DIGITAL_SIGNATURE => [
                    'category'=>SettingCategory::TRIP_SETTINGS,
                    'value' => '1',
                    'field' => SettingValueType::SELECT,
                    'option_value' => '{"yes":1,"no":0}',
                    'group_name' => null,
                ],
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingDB = Setting::all();

        foreach ($this->settings_from_seeder as $setting_slug=>$setting) {
            $categoryFound = $settingDB->first(function ($one) use ($setting_slug) {
                return $one->name === $setting_slug;
            });

            $created_params = [
                        'name' => $setting_slug
                    ];

            $to_create_setting_data = array_merge($created_params, $setting);

            if (!$categoryFound) {
                Setting::create($to_create_setting_data);
            }
        }
        $setingsToDelete = [
            SettingSlug::SERVICE_TAX,
            SettingSlug::ADMIN_COMMISSION_TYPE,
            SettingSlug::ADMIN_COMMISSION,
            SettingSlug::ADMIN_COMMISSION_TYPE_FOR_DRIVER,
            SettingSlug::ADMIN_COMMISSION_FOR_DRIVER,
            SettingSlug::ADMIN_COMMISSION_TYPE_FOR_OWNER,
            SettingSlug::ADMIN_COMMISSION_FOR_OWNER,
        ];
        foreach ($setingsToDelete as $key => $setting_slug) {
            Setting::where('name',$setting_slug)->delete();
        }
    }
}