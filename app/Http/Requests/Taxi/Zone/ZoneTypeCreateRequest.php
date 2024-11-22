<?php

namespace App\Http\Requests\Taxi\Zone;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ZoneTypeCreateRequest extends FormRequest
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
            'type' => $route == 'updateZoneType' ? '' :'required|exists:vehicle_types,id',
            'payment_type' => 'required',
            'bill_status' => 'required|in:0,1',
        ];
    }
}
