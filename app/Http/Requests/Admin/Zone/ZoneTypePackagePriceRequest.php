<?php

namespace App\Http\Requests\Admin\Zone;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class ZoneTypePackagePriceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = Route::currentRouteName();
        return [
            'type_id' => 'required',
            'base_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
          
            // 'bill_status' => 'required|in:0,1',
            'distance_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'time_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'free_distance'=>'required|regex:/^\d*(\.\d{1,2})?$/',
            'free_minute' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'cancellation_fee' => 'required',
           
        ];
    }
}
