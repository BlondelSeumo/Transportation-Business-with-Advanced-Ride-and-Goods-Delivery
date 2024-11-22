<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Setting;
use App\Models\Admin\Zone;
use App\Models\Admin\Airport;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Admin\PromoUser;
use App\Models\Admin\ZoneBound;
use App\Models\Access\Permission;
use Illuminate\Cache\TaggableStore;
use App\Base\SMSTemplate\SMSTemplate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Services\Setting\SettingContract;
use App\Helpers\Notification\AdminInformation;
use App\Base\Services\Hash\HashGeneratorContract;
use App\Base\Libraries\QueryFilter\FilterContract;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Base\Services\OTP\Generator\OTPGeneratorContract;
use App\Models\Admin\Driver;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use App\Models\ThirdPartySetting;
use App\Models\Cms\FrontPage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\User;

// use Log;

/**
 * Custom helper functions.
 */
if (!function_exists('url_info')) {
    /**
     * Get the admin information.
     * Returns AdminInformation instance.
     *
     * @return AdminInformation
     */
    function url_info()
    {
        // return 'https://byocart.com/oddsol/Base1/storage/app/public/uploads/';
        return 'http://localhost/TaxiAppz/storage/app/public/uploads/';
    }
}


if (! function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        return Str::startsWith($haystack, $needles);
    }
}

if (! function_exists('array_except')) {
    /**
     * Get all of the given array except for a specified array of keys.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function array_except($array, $keys)
    {
        return Arr::except($array, $keys);
    }
}

if (!function_exists('uuid')) {
    /**
     * Generate Uuid string.
     *
     * @return string
     */
    function uuid()
    {
        return Uuid::uuid4()->toString();
    }
}

if (! function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_random($length = 16)
    {
        return Str::random($length);
    }
}

if (! function_exists('studly_case')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     * @return string
     */
    function studly_case($value)
    {
        return Str::studly($value);
    }
}

if (!function_exists('is_valid_uuid')) {
    /**
     * Check if the UUID is valid.
     *
     * @param string $uuid
     * @return bool
     */
    function is_valid_uuid($uuid)
    {
        return Uuid::isValid($uuid);
    }
}
if (!function_exists('convert_currency_to_usd')) {
    /**
     * Check if the currency is valid and convert the currency to USD.
     *
     * @param string $amount
     * @return bool
     */
    function convert_currency_to_usd($currency_code, $amount)
    {
        if ($currency_code=='USD') {
            return array(
            'converted_amount'=>$amount,
            'converted_type'=>'USD-USD',
        );
        }
        $usd_amount = Cache::get($currency_code)?:null;

        if ($usd_amount==null) {
            $get_usd_amount =  get_and_set_currency_value_using_curreny_layer();

            if (!$get_usd_amount) {
                return array(
            'converted_amount'=>0,
            'converted_type'=>$currency_code.'-USD',
            );
            }
        }

        $usd_amount = Cache::get($currency_code)?:null;

        $converted_amount = ($amount / $usd_amount);
        $converted_type = $currency_code."-USD";

        return array(
            'converted_amount'=>number_format((float)$converted_amount, 2, '.', ''),
            'converted_type'=>$converted_type,
        );
    }
}
if (!function_exists('get_firebase_settings')) {
    function get_firebase_settings($key)
    {
        // dd($key);
        return ThirdPartySetting::where('module', 'firebase')->whereName($key)->pluck('value')->first();

    }
}


if (!function_exists('get_and_set_currency_value_using_curreny_layer')) {

     /**
     * Check if the currency is valid and convert the currency to USD.
     *
     * @param string $amount
     * @return bool
     */
    function get_and_set_currency_value_using_curreny_layer()
    {
        $endpoint = 'live';
        $access_key = 'bf2ce041ad76f21bf70835b4840f6a67';

        $source = 'USD';

        // initialize CURL:
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&source='.$source.'&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $currency_lists = json_decode($json, true);
        $currency_array = $currency_lists['quotes'];

        foreach ($currency_array as $key => $value) {
            $key = str_replace("USD", "", $key);
            Cache::put($key, $value, 1440);
        }

        return true;
    }
}

if (!function_exists('panel_layout')) {
    /**
     * layout
     *
     * @return object
     */
    function panel_layout()
    {
        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $permissions = Permission::all();
        } else {

            // $permissions = auth()->user()->roles[0]->permissions; // temp
            $permissions = Permission::all();
        }

        $menu =[];
        $menu["sort"]=[];

        foreach ($permissions as $key => $permission) {
            if (array_key_exists($permission->main_menu, $menu)) {
                if (!array_key_exists($permission->sub_menu, $menu[$permission->main_menu])&&$permission->sub_menu!=null) {
                    set_menu($menu[$permission->main_menu][$permission->sub_menu]);

                    set_data($menu, $permission);

                    set_sort($menu, $permission->main_menu, $permission->sort);

                    $menu[$permission->main_menu]['sub_menu']=true;
                } elseif ($permission->sub_menu!=null && $menu[$permission->main_menu][$permission->sub_menu]['link'] == null) {
                    set_data($menu, $permission);

                    set_sort($menu, $permission->main_menu, $permission->sort);
                } elseif ($permission->sub_menu==null) {
                    set_data($menu, $permission);

                    set_sort($menu, $permission->main_menu, $permission->sort);
                }
            } else {
                $menu[$permission->main_menu]['sub_menu']=$permission->sub_link?true:false;
                $menu[$permission->main_menu]['icon']=null;
                $menu[$permission->main_menu]['link']=null;

                set_sort($menu, $permission->main_menu, $permission->sort);
                if ($permission->sub_menu !=null) {
                    set_menu($menu[$permission->main_menu][$permission->sub_menu]);
                }
                set_data($menu, $permission);
            }
        }

        $sortdata = asort($menu['sort']);

        return $menu;
    }
}


if (!function_exists('set_menu')) {
    /**
     * Set menu
     * @return string
     */
    function set_menu(&$menuArray)
    {
        $menuArray=["link" => null];
    }
}

if (!function_exists('set_data')) {
    /**
     * Set data
     * @return string
     */
    function set_data(&$linkPath, $data)
    {
        if ($linkPath[$data->main_menu]['link']==null) {
            $linkPath[$data->main_menu]['link'] = $data->main_link;
        }

        if ($data->sub_menu!=null&&$linkPath[$data->main_menu][$data->sub_menu]['link']==null) {
            $linkPath[$data->main_menu][$data->sub_menu]['link'] = $data->sub_link;
        }

        if ($linkPath[$data->main_menu]['icon']==null) {
            $linkPath[$data->main_menu]['icon'] = $data->icon;
        }
    }
}

if (!function_exists('set_sort')) {
    /**
     * Generate a random OTP.
     *
     * @param int|null $length Default value is 6 | Maximum value is 9
     * @return string
     */
    function set_sort(&$menuArray, $menu, $sort)
    {
        if ($sort != null) {
            $menuArray["sort"][$menu]= $sort;
        }
    }
}



/**
 * Custom helper functions.
 */
if (!function_exists('set_settings')) {
    function set_settings()
    {
        $array_config_value = Setting::get();

        Cache::put("setting_cache_set", "yes", 120);

        foreach ($array_config_value as $key => $value) {
            Cache::put($value['name'], $value['value'], 120);
            //$array[] = [$value['name']=> $value['value']];
        }
        return true;
    }
}

/**
 * Custom helper functions.
 */
if (!function_exists('get_settings')) {
    function get_settings($key)
    {
        // if (Cache::has('setting_cache_set')) {
        //     return Cache::get($key)?:null;
        // } else {
        //     $array = set_settings();

        //     return Cache::get($key)?:null;
        // }

        return Setting::whereName($key)->pluck('value')->first();

    }
}

if (!function_exists('get_sms_settings')) {
    function get_sms_settings($key)
    {

        return ThirdPartySetting::where('module', 'sms')->whereName($key)->pluck('value')->first();

    }
}
if (!function_exists('get_active_sms_settings')) {
    function get_active_sms_settings()
    {

        return ThirdPartySetting::where('module', 'sms')->where('value', "1")->pluck('name')->first();

    }
}


if (!function_exists('web_map_settings')) {
    function web_map_settings()
    {
        $setting = Setting::where('name', 'map_type')->first();
        if ($setting) {
            return $setting->value;
        }
        return null;
    }
}

/**
 * Custom helper functions.
 */

if (!function_exists('find_zone')) {
    function find_zone($lat, $lng)
    {
        $point = new Point($lat, $lng);

        $zone = Zone::contains('coordinates', $point)->where('active', 1)->first();

        return $zone;
    }
}

if (!function_exists('find_airport')) {
    function find_airport($lat, $lng)
    {
        $point = new Point($lat, $lng);

        $zone = Airport::companyKey()->contains('coordinates', $point)->where('active', 1)->first();

        return $zone;
    }
}

if (!function_exists('get_distance_matrix')) {
    function get_distance_matrix($pick_lat, $pick_lng, $drop_lat, $drop_lng, $traffic = false)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json';
        $args = [
          'units' => "imperial",
          'origins' => "$pick_lat,$pick_lng",
          'destinations' => "$drop_lat,$drop_lng",
          'key' => get_settings('google_map_key_for_distance_matrix')
        ];
        //AIzaSyDsgTHjo-lusijguNf8XO8aLNyYHe9mRE4



        if ($traffic) {
            $args['departure_time'] = 'now';
        }

        $query = http_build_query($args);

        $res = $client->request('GET', "$url?$query");

        if ($res->getStatusCode() == 200) {
            return \GuzzleHttp\json_decode($res->getBody()->getContents());
        }
    }
}

if (!function_exists('get_duration_text_from_distance_matrix')) {
    function get_duration_text_from_distance_matrix($distance_matrix)
    {
        $element = get_first_element_in_distance_matrix($distance_matrix);

        if (isset($element)) {
            if (isset($element->duration_in_traffic)) {
                return $element->duration_in_traffic->text;
            } elseif (isset($element->duration)) {
                return $element->duration->text;
            }
        }

        return null;
    }
}


if (!function_exists('get_distance_value_from_distance_matrix')) {
    function get_distance_value_from_distance_matrix($distance_matrix)
    {
        $element = get_first_element_in_distance_matrix($distance_matrix);

        if (isset($element) && isset($element->distance)) {
            return (float)$element->distance->value;
        }

        return null;
    }
}

if (!function_exists('get_duration_value_from_distance_matrix')) {
    function get_duration_value_from_distance_matrix($distance_matrix)
    {
        $element = get_first_element_in_distance_matrix($distance_matrix);

        if (isset($element)) {
            if (isset($element->duration_in_traffic)) {
                return (int)$element->duration_in_traffic->value;
            } elseif (isset($element->duration)) {
                return (int)$element->duration->value;
            }
        }
    }
}

if (!function_exists('kilometer_to_miles')) {
    function kilometer_to_miles($km)
    {
        return $km * 0.621371;
    }
}

if (!function_exists('miles_to_km')) {
    function miles_to_km($miles)
    {
        return $miles * 1.60934;
    }
}

if (!function_exists('get_distance_text_from_distance_matrix')) {
    function get_distance_text_from_distance_matrix($distance_matrix)
    {
        $element = get_first_element_in_distance_matrix($distance_matrix);

        if (isset($element) && isset($element->distance)) {
            return $element->distance->text;
        }

        return null;
    }
}

if (!function_exists('get_first_element_in_distance_matrix')) {
    function get_first_element_in_distance_matrix($distance_matrix)
    {
        if (!isset($distance_matrix) || $distance_matrix->status != 'OK') {
            return null;
        }

        if (!is_array($distance_matrix->rows) || empty($distance_matrix->rows)) {
            return null;
        }

        $row = $distance_matrix->rows[0];

        if (!is_array($row->elements) || empty($row->elements)) {
            return null;
        }

        return $row->elements[0];
    }
}

if (!function_exists('zone_full_details')) {
    function zone_full_details($latitude, $longitude)
    {
        $zone_id = 0;
        $points = $longitude . " " . $latitude;

        $zone_records = ZoneBound::get();

        foreach ($zone_records as $key => $zone_list) {
            $longitudeZoneArray = zoneLongitudeArrays($zone_list->bound);
            $latitudeZoneArray = zoneLatitudeArrays($zone_list->bound);

            $zoneCoordinates = array_map("zoneCoordinates", $longitudeZoneArray, $latitudeZoneArray);
            $pointLocation = new pointLocation();

            // The last point's coordinates must be the same as the first one's, to "close the loop"
            if ($pointLocation->pointInPolygon($points, $zoneCoordinates)) {
                $zone_id = $zone_list->id;
                return $zone_list;
            }
        }
        return $zone_records;
    }
}

if (!function_exists('find_given_points_in_single_zone_bound')) {
    function find_given_points_in_single_zone_bound($single_zone__bound, $points)
    {
        $longitudeZoneArray = zoneLongitudeArrays($single_zone__bound);
        $latitudeZoneArray = zoneLatitudeArrays($single_zone__bound);

        $zoneCoordinates = array_map("zoneCoordinates", $longitudeZoneArray, $latitudeZoneArray);
        $pointLocation = new pointLocation();

        if ($pointLocation->pointInPolygon($points, $zoneCoordinates)) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('distance_between_two_coordinates')) {
    function distance_between_two_coordinates($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "M") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }

    }
}


if (!function_exists('currency_get')) {
    function currency_get($currency_code)
    {
        if (Cache::has('currency_cache')) {
            return Cache::get($currency_code) ?: null;
        } else {
            $array = get_current_curreny_value($currency_code);

            return Cache::get($currency_code) ?: null;
        }
    }
}

if (!function_exists('get_current_curreny_value')) {
    function get_current_curreny_value()
    {
        $endpoint = 'live';
        $access_key = 'bf2ce041ad76f21bf70835b4840f6a67';

        $source = 'USD';
        $currencies = 'INR';
        $amount = 10;

        // initialize CURL:
        $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '&source=' . $source . '&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $currency_lists = json_decode($json, true);

        // echo "<pre>";print_r();die();
        $currency_array = $currency_lists['quotes'];

        Cache::put("currency_cache", "yes", 1440);

        foreach ($currency_array as $key => $value) {
            $key = str_replace("USD", "", $key);
            Cache::put($key, $value, 1440);
        }

        return $currency_array;
    }
}

if (!function_exists('generate_otp')) {
    /**
     * Generate a random OTP.
     *
     * @param int|null $length Default value is 6 | Maximum value is 9
     * @return string
     */
    function generate_otp($length = null)
    {
        return app(OTPGeneratorContract::class)->generate($length);
    }
}

if (!function_exists('is_valid_mobile_number')) {
    /**
     * Check if the mobile number is valid.
     *
     * @param string $mobile
     * @return bool
     */
    function is_valid_mobile_number($mobile)
    {
        return preg_match('/^[0-9]+$/', $mobile);
    }
}

if (!function_exists('is_valid_email')) {
    /**
     * Check if the email address is valid.
     *
     * @param string $email
     * @return bool
     */
    function is_valid_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('is_valid_city_id')) {
    /**
     * Check if the city id is valid.
     *
     * @param string $cityId
     * @return bool
     */
    function is_valid_city_id($cityId)
    {
        return Validator::make(
            ['city_id' => $cityId],
            ['city_id' => 'required|uuid|exists:cities,id']
        )->passes();
    }
}

if (!function_exists('is_valid_date')) {
    /**
     * Validate the date time string and return the Carbon instance if needed.
     *
     * @param string $date
     * @param bool $returnDate
     * @return bool|\Carbon\Carbon
     */
    function is_valid_date($date, $returnDate = true)
    {
        if (Validator::make(['date' => $date], ['date' => 'required|date'])->fails()) {
            return false;
        }

        return $returnDate ? Carbon::parse($date) : true;
    }
}

if (!function_exists('hash_check')) {
    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     */
    function hash_check($value, $hashedValue)
    {
        return app('hash')->check($value, $hashedValue);
    }
}

if (!function_exists('driver_uuid')) {
    /**
     * Generate Uuid string.
     *
     * @return string
     */
    function driver_uuid()
    {
        do {
            $uuid = str_random(10);
        } while (Driver::whereUuid($uuid)->exists());

        return $uuid;
    }
}


if (!function_exists('structure_for_socket')) {
    /**
     * Check the given plain value against a hash.
     *
     * @param  uuid  $id
     * @param  string  $user_type
     * @param  string $message
     * @param  string $event
     * @return bool
     */
    function structure_for_socket($id, $user_type, $message, $event)
    {
        $structure = array();
        $structure['id']= $id;
        $structure['user_type']= $user_type;
        $structure['message']= $message;
        $structure['event']= $event;
        return $structure;
    }
}


if (!function_exists('access')) {
    /**
     * Get the singleton Access instance.
     *
     * @param string|null $guard
     * @return \App\Base\Libraries\Access\Access
     */
    function access($guard = null)
    {
        $access = app('access');

        if (is_null($guard)) {
            return $access;
        }

        return $access->guard($guard);
    }
}

if (!function_exists('sms')) {
    /**
     * Get the SMS sender instance.
     *
     * @param string|array|null $numbers
     * @param string|null $message
     * @param int|null $type
     * @return \App\HappyLocate\Libraries\SMS\SMS
     */
    function sms($numbers = null, $message = null, $type = null)
    {
        return app('sms')->to($numbers)->message($message)->type($type);
    }
}

if (!function_exists('sms_template')) {
    /**
     * Get the message generated using the SMS template.
     *
     * @param string $name
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function sms_template($name, array $replace = [], $locale = null)
    {
        return (new SMSTemplate($name, $replace, $locale))->getMessage();
    }
}

if (!function_exists('filter')) {
    /**
     * Get the Query String Filter instance.
     *
     * @param \Illuminate\Database\Eloquent\Builder|null $builder
     * @param \League\Fractal\TransformerAbstract|callable|null $transformer
     * @param \App\HappyLocate\Libraries\QueryFilter\FilterContract|null $customFilter
     * @return \App\HappyLocate\Libraries\QueryFilter\QueryFilter
     */
    function filter(Builder $builder = null, $transformer = null, FilterContract $customFilter = null)
    {
        $queryFilter = app('query-filter');

        if (!is_null($builder)) {
            $queryFilter = $queryFilter->builder($builder);
        }

        if (!is_null($transformer)) {
            $queryFilter = $queryFilter->transformWith($transformer);
        }

        if (!is_null($customFilter)) {
            $queryFilter = $queryFilter->customFilter($customFilter);
        }

        return $queryFilter;
    }
}

if (!function_exists('db_setting')) {
    /**
     * Get the database setting value.
     *
     * @param string $name
     * @param mixed|null $default
     * @return SettingContract|\Illuminate\Foundation\Application|mixed|null
     */
    function db_setting($name = null, $default = null)
    {
        $setting = app(SettingContract::class);

        if (is_null($name)) {
            return $setting;
        }

        return $setting->get($name, $default);
    }
}

if (!function_exists('hash_generator')) {
    /**
     * Get the hash generator instance or the hash (with arguments).
     *
     * @param int|null $length
     * @param string|null $prefix
     * @param string|null $suffix
     * @param string|null $extension
     * @return HashGeneratorContract|\Illuminate\Foundation\Application|mixed|string
     */
    function hash_generator($length = null, $prefix = null, $suffix = null, $extension = null)
    {
        $hashGenerator = app(HashGeneratorContract::class);

        if (func_num_args() === 0) {
            return $hashGenerator;
        }

        return $hashGenerator->make($length, $prefix, $suffix, $extension);
    }
}

if (!function_exists('is_cache_taggable')) {
    /**
     * Check if the current cache store supports tagging.
     * Run the provided closure function if tagging is supported.
     *
     * @param Closure|null $closure
     * @return bool|mixed
     */
    function is_cache_taggable(Closure $closure = null)
    {
        if (Cache::getStore() instanceof TaggableStore) {
            return $closure ? $closure() : true;
        }

        return false;
    }
}

if (!function_exists('model_cache_tag')) {
    /**
     * Get the model's cache tag.
     * Manually add another tag to the tag list if provided.
     *
     * @param Model $model
     * @param string|mixed $additionalTag
     * @return array|string
     */
    function model_cache_tag(Model $model, $additionalTag = null)
    {
        $tag = 'model_' . $model->getTable();

        if ($additionalTag && is_string($additionalTag)) {
            return [$tag, $additionalTag];
        }

        return $tag;
    }
}

if (!function_exists('model_cache_key')) {
    /**
     * Generate a unique cache key for the model using the primary key.
     *
     * @param Model $model
     * @return string
     */
    function model_cache_key(Model $model)
    {
        return "model_{$model->getTable()}_{$model->getKey()}";
    }
}

if (!function_exists('flush_model_cache')) {
    /**
     * Flush the model's tagged cache.
     *
     * @param Model $model
     * @return bool|mixed
     */
    function flush_model_cache(Model $model)
    {
        return is_cache_taggable(function () use ($model) {
            Cache::tags(model_cache_tag($model))->flush();
        });
    }
}

if (!function_exists('app_environment')) {
    /**
     * Get or check the current application environment.
     *
     * @param mixed $args
     * @return bool|string
     */
    function app_environment(...$args)
    {
        return app()->environment(...$args);
    }
}

if (!function_exists('app_debug_enabled')) {
    /**
     * Check if the app debug is enabled.
     *
     * @return bool
     */
    function app_debug_enabled()
    {
        return config('app.debug', false);
    }
}

if (!function_exists('now')) {
    /**
     * Get a Carbon instance for the current date and time.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return \Carbon\Carbon
     */
    function now($tz = null)
    {
        return Carbon::now($tz);
    }
}

if (!function_exists('to_carbon')) {
    /**
     * Create a carbon instance from a string.
     *
     * @param string $time
     * @return \Carbon\Carbon
     */
    function to_carbon($time)
    {
        return Carbon::parse($time);
    }
}

if (!function_exists('ip')) {
    /**
     * Get the client IP address.
     *
     * @return string
     */
    function ip()
    {
        return request()->ip();
    }
}

if (!function_exists('array_has_all')) {
    /**
     * Check if an array contains all the searched array values.
     *
     * @param array $search The array values used to search
     * @param array $haystack The main array on which the search is performed
     * @return bool
     */
    function array_has_all(array $search, array $haystack)
    {
        if (empty($search)) {
            return false;
        }

        return !array_diff($search, $haystack);
    }
}

if (!function_exists('file_path')) {
    /**
     * Get the full file path given the folder path and file name.
     *
     * @param string $path
     * @param string $filename
     * @param string $folder The folder inside the path
     * @return string
     */
    function file_path($path, $filename, $folder = null)
    {
        return rtrim($path, '/') . ($folder ? "/{$folder}/" : '/') . $filename;
    }
}

if (!function_exists('folder_merge')) {
    /**
     * Get the full folder path after merging all the provided paths.
     *
     * @param array $folders The folders to merge
     * @return string
     */
    function folder_merge(...$folders)
    {
        return array_reduce($folders, function ($result, $folder) {
            return $result . trim($folder, '/') . '/';
        });
    }
}

if (!function_exists('role_middleware')) {
    /**
     * Generate the role middleware string.
     *
     * @param string|array $roles
     * @param bool $requireAll
     * @param string $middlewareName
     * @return string
     */
    function role_middleware($roles, $requireAll = false, $middlewareName = 'role')
    {
        $string = $middlewareName . ':' . implode('|', array_wrap($roles));

        return $requireAll ? $string . ',true' : $string;
    }
}

if (! function_exists('array_wrap')) {
    /**
     * If the given value is not an array, wrap it in one.
     *
     * @param  mixed  $value
     * @return array
     */
    function array_wrap($value)
    {
        return Arr::wrap($value);
    }
}

if (! function_exists('str_is')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param  string|array  $pattern
     * @param  string  $value
     * @return bool
     */
    function str_is($pattern, $value)
    {
        return Str::is($pattern, $value);
    }
}
if (! function_exists('array_only')) {
    /**
     * Get a subset of the items from the given array.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function array_only($array, $keys)
    {
        return Arr::only($array, $keys);
    }
}

if (!function_exists('perm_middleware')) {
    /**
     * Generate the permission middleware string.
     *
     * @param string|array $permissions
     * @param bool $requireAll
     * @param string $middlewareName
     * @return string
     */
    function perm_middleware($permissions, $requireAll = false, $middlewareName = 'permission')
    {
        $string = $middlewareName . ':' . implode('|', array_wrap($permissions));

        return $requireAll ? $string . ',true' : $string;
    }
}

if (!function_exists('admin_info')) {
    /**
     * Get the admin information.
     * Returns AdminInformation instance.
     *
     * @return AdminInformation
     */
    function admin_info()
    {
        return (new AdminInformation);
    }
}

if (!function_exists('limit_value')) {
    /**
     * Limit the given input value between the min and max value.
     *
     * @param mixed $value
     * @param mixed $min
     * @param mixed $max
     * @return mixed
     */
    function limit_value($value, $min, $max)
    {
        return min(max($value, $min), $max);
    }
}

if (!function_exists('array_to_object')) {
    /**
     * Convert an array to object.
     *
     * @param array $array
     * @param bool $recursive
     * @return object
     */
    function array_to_object(array $array, $recursive = true)
    {
        return json_decode(json_encode($array, $recursive ? JSON_FORCE_OBJECT : 0));
    }
}

if (!function_exists('object_to_array')) {
    /**
     * Convert an array to object.
     *
     * @param array $array
     * @param bool $recursive
     * @return object
     */
    function object_to_array($string)
    {
        if (get_magic_quotes_gpc()) {
            $string = stripslashes($string);
        }

        $contents = utf8_encode($string);
        $results = json_decode($contents);

        return $results;
    }
}

if (!function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param string $folder
     */
    function include_route_files($folder)
    {
        $path = base_path('routes' . DIRECTORY_SEPARATOR . $folder);
        $rdi = new recursiveDirectoryIterator($path);
        $it = new recursiveIteratorIterator($rdi);

        while ($it->valid()) {
            if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }

            $it->next();
        }
    }
}

if (!function_exists('driver_document_name')) {
    function driver_document_name($status)
    {
        switch ($status) {
            case 1:
                return 'UPLOADED AND APPROVED';
                break;
            case 2:
                return 'NOT UPLOADED';
                break;
            case 3:
                return 'UPLOADED AND WAITING FOR APPROVAL';
                break;
            case 4:
                return 'REUPLOADED AND WAITING FOR APPROVAL';
                break;
            case 5:
                return 'DECLINED';
                break;
            default:
                return 'EXPIRED';
                break;
        }
    }
}

if (!function_exists('app_logo')) {
    function app_logo()
    {
        $setting = Setting::whereName('logo')->first();

        return $setting->app_logo;
    }
}

if (!function_exists('app_name')) {
    function app_name()
    {
        $setting = Setting::whereName('app_name')->first();

        return $setting->value;
    }
}

if (!function_exists('fav_icon')) {
    function fav_icon()
    {
        $setting = Setting::whereName('favicon')->first();

        return $setting->fav_icon;
    }
}

if (!function_exists('login_bg')) {
    function login_bg()
    {
        $setting = Setting::whereName('loginbg')->first();

        return $setting->login_bg;
    }
}

if (!function_exists('default_country_code_for_mobile_app')) {
    function default_country_code_for_mobile_app()
    {
        $setting = Setting::whereName('default_country_code_for_mobile_app')->first();

        return $setting->default_country_code_for_mobile_app;
    }
}



if (!function_exists('web_booking_logo')) {
    function web_booking_logo()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_logo = FrontPage::first();
        if(!$web_booking_logo->web_booking_logo){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_logo->web_booking_logo));
        // dd($path_url);
        return $path_url;
    }
}

if (!function_exists('web_booking_taxi')) {
    function web_booking_taxi()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_taxi = FrontPage::first();
        if(!$web_booking_taxi->web_booking_taxi){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_taxi->web_booking_taxi));
        // dd($path_url);
        return $path_url;
    }
}
if (!function_exists('web_booking_track')) {
    function web_booking_track()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_track = FrontPage::first();
        if(!$web_booking_track->web_booking_track){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_track->web_booking_track));
        // dd($path_url);
        return $path_url;
    }
}



if (!function_exists('web_booking_rental')) {
    function web_booking_rental()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_rental = FrontPage::first();
        if(!$web_booking_rental->web_booking_rental){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_rental->web_booking_rental));
        // dd($path_url);
        return $path_url;
    }
}
if (!function_exists('web_booking_delivery')) {
    function web_booking_delivery()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_delivery = FrontPage::first();
        if(!$web_booking_delivery->web_booking_delivery){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_delivery->web_booking_delivery));
        // dd($path_url);
        return $path_url;
    }
}
if (!function_exists('web_booking_history')) {
    function web_booking_history()
    {
        $path = config('base.cms.upload.web-picture.path');
        $web_booking_history = FrontPage::first();
        if(!$web_booking_history->web_booking_history){
            return null;
        }
        $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $web_booking_history->web_booking_history));
        // dd($path_url);
        return $path_url;
    }
}



if (! function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string  $value
     * @param  int  $limit
     * @param  string  $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (! function_exists('get_line_string')) {
    /**
     * Get all of the given array except for a specified array of keys.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function get_line_string($pickup_lat, $pickup_lng, $drop_lat, $drop_lng)
    {
        $url = 'https://maps.googleapis.com/maps/api/directions/json?&origin='.$pickup_lat.','.$pickup_lng.'&destination='.$drop_lat.','.$drop_lng.'&sensor=false&key='.get_settings('google_map_key_for_distance_matrix');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        // Log::info($result);


        $encoded_result = json_decode($result);

        $points = [];


        $poly_line = \Polyline::decode($encoded_result->routes[0]->overview_polyline->points);

        $poly_points = \Polyline::pair($poly_line);

        foreach ($poly_points as $key => $point) {
            $points[] = new Point($point[0], $point[1]);
        }

        return $poly_line_string = new LineString($points);
    }
}




function getDistanceMatrixByOpenstreetMap($pick_lat,$pick_lng,$drop_lat,$drop_lng) {

    // Base URL for the OpenStreetMap Distance Matrix API
    $url = "https://routing.openstreetmap.de/routed-bike/route/v1/driving/".$pick_lng.','.$pick_lat.';'.$drop_lng.','.$drop_lat.'?overview=false&alternatives=true&steps=true';


    // Fetch data from the API
    $response = file_get_contents($url);

    // Decode JSON response
    $data = json_decode($response, true);


    $distance_in_km = (float)number_format(($data['routes'][0]['distance']/1000),1);
    $distance_in_meters = ($data['routes'][0]['distance']);

    $distance_in_miles = (float)number_format(($data['routes'][0]['distance']/1609.344),1);

    $duration_in_mins = (int)number_format(($data['routes'][0]['duration']/60));
    $duration_in_secs = (int)number_format(($data['routes'][0]['duration']));


    $distance_matrix = ['distance_in_meters'=>$distance_in_meters,'distance_in_km'=>$distance_in_km,'distance_in_miles'=>$distance_in_miles,'duration_in_mins'=>$duration_in_mins,'duration_in_secs'=>$duration_in_secs];


    return $distance_matrix;

}


if (! function_exists('get_directions')) {
    /**
     * Get all of the given array except for a specified array of keys.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function get_directions($pickup_lat, $pickup_lng, $drop_lat, $drop_lng)
    {
         $url = 'https://maps.googleapis.com/maps/api/directions/json?';

        // Parameters for the API request
        $params = [
            'origin' => $pickup_lat.','.$pickup_lng, // Origin coordinates (latitude,longitude)
            'destination' => $drop_lat.','.$drop_lng, // Destination coordinates (latitude,longitude)
            'key' => get_settings('google_map_key_for_distance_matrix'), // Your Google API key
        ];

        // Build the request URL
        $requestUrl = $url . http_build_query($params);

        // Send GET request to the Directions API
        $response = file_get_contents($requestUrl);

        // Decode JSON response
        $directionsData = json_decode($response, true);

        if($directionsData['status'] != "OK") {
            $error_message = $directionsData['error_message'];
            return response()->json(['success' => false, 'message' => $error_message . ' Cannot get Polyline from Google Map API']);
        } else {
            $points = $directionsData['routes'][0]['overview_polyline']['points'];
            return response()->json(['success' => true, 'message' => 'success', 'points' => $points]);
        }

    }

}

    if (!function_exists('invoice_logo')) {
        function invoice_logo()
        {
            $path = config('base.cms.upload.web-picture.path');
            $invoice_logo = FrontPage::first();
            if(!$invoice_logo->invoice_logo){
                return null;
            }
            $path_url = Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($path, $invoice_logo->invoice_logo));
            // dd($path_url);
            return $path_url;
        }
    }

if (!function_exists('get_or_check_if_exists_user')) {

function get_or_check_if_exists_user($mobile,$role,$check_exists=false)
{

        $mobile_with_zero = $mobile;
        $mobile_without_zero = $mobile;

        if (substr($mobile, 0, 1) === '0') {

        $mobile_with_zero = $mobile;

        $mobile_without_zero = ltrim($mobile, '0');

        } else {

        $mobile_with_zero = '0'.$mobile;

        $mobile_without_zero = $mobile;

        }

        if($check_exists){

            return  $user = User::where('mobile', $mobile_with_zero)
        ->orWhere('mobile', $mobile_without_zero)->belongsTorole($role)
        ->exists();
            
        }else{

            return $user = User::where('mobile', $mobile_with_zero)
        ->orWhere('mobile', $mobile_without_zero)->belongsTorole($role)
        ->first();

        }
       

    }

}
