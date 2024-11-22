<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Models\Setting;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\ThirdPartySetting;

/**
 * @resource Settings
 *
 * vechicle types Apis
 */
class SettingController extends BaseController
{
    /**
     * The Setting model instance.
     *
     * @var \App\Models\Setting
     */
    protected $settings;

    protected $imageUploader;

    /**
     * VehicleTypeController constructor.
     *
     * @param \App\Models\Setting $settings
     */
    public function __construct(Setting $settings, ImageUploaderContract $imageUploader)
    {
        $this->settings = $settings;
        $this->imageUploader = $imageUploader;
    }

    /**
    * Get all vehicle types
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $settings = Setting::select('*')->get()->groupBy('category');

        $page = trans('pages_names.system_settings');

        $main_menu = 'settings';
        $sub_menu = 'system_settings';

        return view('admin.master.settings', compact('settings', 'page', 'main_menu', 'sub_menu'));
    }

    /**
    * Store Settings
    *
    */
    public function store(Request $request)
    {
        // dd($request);
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('system/settings')->with('warning', $message);
        }
        DB::beginTransaction();

        $settings_to_redis = $request->except(['logo','_token']);

        try {
            $settingTable = Setting::get();
            $firebase_json_status = 0;
            foreach ($settingTable as $key => $value) {
                if(str_contains($value, '*')){
                    continue;
                }
                $key_name = $value->name;
                if (isset($request->$key_name)) {

                    $settingTable[$key]->value = $request->$key_name;
                    if ($request->hasFile($value->name)) {
                        //print_r($value->name);die();

                        if ($uploadedFile = $this->getValidatedUpload($value->name, $request)) {
                              if($value->name == "firebasejson") {
                                    $result = $this->imageUploader->file($uploadedFile)
                                              ->saveSystemFirebaseJson();


                           if($result['status'])
                           {

                            $settingTable[$key]->value = $result['file_name'];
                           }
                           else{
                            $firebase_json_status = 1;
                           }

                        }
                    else{
                         $settingTable[$key]->value = $this->imageUploader->file($uploadedFile)
                                ->saveSystemAdminLogo();
                    }

                        }
                    }

                    $settingTable[$key]->save();
                }
            }


            Cache::forget('setting_cache_set');
            // Redis::set('settings', json_encode($settings_to_redis));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e . 'Error while Create Admin. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
        DB::commit();

        $message = trans('succes_messages.system_settings_updated');


        if($firebase_json_status == 1)
        {
            return redirect('system/settings')->with('warning', $result['message']);
        }

        return redirect('system/settings')->with('success', $message);


    }

    public function mapIndex()
    {
        $item = Setting::where('category','map_settings')->where('name', 'map_type')->get();
        $page = trans('pages_names.map_settings');
        $main_menu = 'settings';
        $sub_menu = 'map_settings';



        return view('admin.master.maps', compact('item', 'page', 'main_menu', 'sub_menu'));
    }

    public function getById(Setting $setting)
    {
        $page = trans('pages_names.map_settings');

        $main_menu = 'settings';
        $sub_menu = 'map_settings';
        $item = $setting;

        return view('admin.master.maps', compact('item', 'page', 'main_menu', 'sub_menu'));
    }
    public function mapUpdate(Request $request)
    {
        if (env('APP_FOR') == 'demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('system/settings/map')->with('warning', $message);
        }

        $mapSetting = Setting::where('name', 'map_type')->first();

        if (!$mapSetting) {
            $message = trans('error_messages.setting_not_found');
            return redirect('system/settings/map')->with('error', $message);
        }

        $mapSetting->update([
            'value' => $request->map_type,
        ]);

        $message = trans('Map Type updated successfully.');
        return redirect('system/settings/map')->with('success', $message);
    }



    public function sms()
    {
       $sms_settings = ThirdPartySetting::where('module', 'sms')->get();

        $page = trans('pages_names.third_party_settings');

        $main_menu = 'settings';
        $sub_menu = 'third_party_settings';

        return view('admin.master.sms_module', compact( 'main_menu', 'sub_menu','sms_settings'));
    }
    public function smsStore(Request $request)
    {
       if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('system/settings/sms_gateway')->with('warning', $message);
        }

        // dd($request);
        ThirdPartySetting::where('module', 'sms')->delete(); // corrected delete command

        $payment_settings = $request->except('_token');

        foreach ($payment_settings as $key => $payment_setting)
        {
            ThirdPartySetting::create(['name' => $key, 'value' => $payment_setting, 'module' => 'sms']);
        }

        $message = trans('succes_messages.sms_settings_updated');

        return redirect('system/settings/sms_gateway')->with('success', $message);
    }
/*module settings*/
    public function moduleSetting()
    {
       $module_settings = Setting::get();

        $page = trans('pages_names.third_party_settings');

        $main_menu = 'settings';
        $sub_menu = 'third_party_settings';

        return view('admin.master.module', compact( 'main_menu', 'sub_menu','module_settings'));        
    }
    public function moduleStore(Request $request)
    {
        dd($request->all());
    }
}
