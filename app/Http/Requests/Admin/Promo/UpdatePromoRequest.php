<?php

namespace App\Http\Requests\Admin\Promo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_location_id' => 'required|exists:service_locations,id',
            'code' => 'required|unique:promo,code,'.$this->promo->id,
            'minimum_trip_amount' => 'required|integer',
            'maximum_discount_amount' => 'required|integer',
            'discount_percent' => 'required|integer|max:100',
            // 'total_uses' => 'required|integer',
            // 'uses_per_user' => 'required|integer',
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after:from',
        ];
    }

    public function messages()
    {
        return [
            'service_location_id.required' => 'Area name is required'
        ];
    }
}
