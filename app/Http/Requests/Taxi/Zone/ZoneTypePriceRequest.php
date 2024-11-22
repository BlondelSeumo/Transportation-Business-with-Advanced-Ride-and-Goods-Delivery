<?php

namespace App\Http\Requests\Taxi\Zone;

use Illuminate\Foundation\Http\FormRequest;

class ZoneTypePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ride_now_base_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_price_per_distance' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_waiting_charge'=>'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_cancellation_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',        
            // 'ride_now_drop_out_of_zone_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_base_distance' => 'required|numeric',
            'ride_now_price_per_time'=>'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_admin_service_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_now_admin_service_fee_type' => 'required|in:0,1',
            // 'ride_now_driver_saving_percentage'=>'required|numeric|min:0|max:100',
            'ride_now_free_waiting_time' => 'required|numeric|min:0',

            'ride_later_base_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_later_price_per_distance' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_later_waiting_charge'=>'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_later_cancellation_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            // 'ride_later_custom_select_driver_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            // 'ride_later_drop_out_of_zone_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_later_base_distance' => 'required',
            'ride_later_price_per_time'=>'required|regex:/^\d*(\.\d{1,2})?$/',
            'ride_later_admin_service_fee' => 'required',
            'ride_later_admin_service_fee_type' => 'required|in:0,1',
            // 'ride_later_driver_saving_percentage'=>'required|numeric|min:0|max:100',
            'ride_later_free_waiting_time' => 'required|numeric|min:0',
        ];
    }
}
