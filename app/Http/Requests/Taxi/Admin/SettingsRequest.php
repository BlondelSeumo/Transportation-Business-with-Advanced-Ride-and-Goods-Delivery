<?php

namespace App\Http\Requests\Taxi\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as Req;

class SettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Req $request)
    {
        $tabName = $request->tabName;

        if($tabName == 'trip'){
            return [
                'assign_method' => 'required|in:0,1',
                'driver_time_out' => 'required|numeric|min:1',
                'driver_search_radius' => 'required',
                'auto_transfer' => 'required|in:0,1',
                'auto_logout_driver_time' => 'required|numeric|min:1',
                'arrived_enabled_distance' => 'required|regex:/^\d*(\.\d{2})?$/',
                'driver_trip_limit' => 'required|numeric|min:1',
                'pick_up_location_change_distance_limit' => 'required|regex:/^\d*(\.\d{2})?$/',
                'top_20_drivers_minimum_rating_limit' => 'required|regex:/^\d*(\.\d{2})?$/',
                'reward_point_for_five_star_rating' => 'required|regex:/^\d*(\.\d{2})?$/',
                'waiting_grace_time_before_start_trip' => 'required|regex:/^\d*(\.\d{2})?$/',
                'trip_period' => 'required|numeric|min:1',
            ];
        }elseif($tabName == 'wallet'){
            return [
                'wallet_min_amount_for_trip' => 'required|numeric',
                'wallet_min_amount_for_trip_driver' => 'required|numeric',
                'wallet_min_amount_to_balance' => 'required|regex:/^\d*(\.\d{2})?$/',
                'wallet_min_amount_to_add' => 'required|regex:/^\d*(\.\d{2})?$/',
            ];
        }elseif($tabName == 'referral'){
            return [
                'referral_amount' => 'required|regex:/^\d*(\.\d{2})?$/',
                'reffered_amount' => 'required|regex:/^\d*(\.\d{2})?$/',
                'how_many_trips_should_completed_to_refer_someone' => 'required|numeric|min:1',
                'how_many_trips_should_complete_to_get_referral_amount' => 'required|numeric|min:1',
            ];
        }elseif($tabName == 'general'){
            return [
                'application_name' => 'required',
                'paginate' => 'required|numeric|min:1',
                'latitude' => 'required|latitude',
                'longitude' => 'required|latitude',
                'head_office_number' => 'required|contact_number',
                'customer_care_number' => 'required|contact_number',
                'help_email' => 'required|email',
                'time_zone' => 'required|time_zone',
            ];
        }elseif($tabName == 'notification'){
            return [
                'send_sms' => 'required|in:0,1',
                'send_email' => 'required|in:0,1',
            ];
        }else{
            return [
                // 'service_tax' => 'required|regex:/^\d*(\.\d{2})?$/',
                // 'minimum_cancellation_fee_to_pay' => 'required|regex:/^\d*(\.\d{2})?$/',
    
            ];
        }
    }
}
