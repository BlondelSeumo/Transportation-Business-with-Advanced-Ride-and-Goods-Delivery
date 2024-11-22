<?php

namespace App\Http\Requests\Taxi\Zone;

use Illuminate\Foundation\Http\FormRequest;

class ZoneSurgePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [    
            'peaktime_start' => 'required',
            'peaktime_end' => 'required',
            'peak_base_price_percentage' => 'required',
            'peak_distance_price_percentage' => 'required',
            'applied_days' => 'required'
        ];
    }
}
