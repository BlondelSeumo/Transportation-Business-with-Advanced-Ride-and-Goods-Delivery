<?php

namespace App\Http\Requests\Taxi\Promo;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_code' => 'required|unique:promo,coupon_code,null,id,deleted_at,NULL',
            'overall_amount' => 'required',
            'amount' => 'required',
            // 'zone' => 'required',
            'type' => 'required|in:fixed,percentage',
            'total_uses' => 'required|numeric',
            'uses_per_user' => 'required|numeric|lt:'.$this->total_uses,
            'start_date' => 'required|date|after:yesterday',
            'expiry_date' => 'required|date|after:'.$this->start_date
        ];
    }
}
