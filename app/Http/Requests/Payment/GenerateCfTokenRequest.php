<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseRequest;

class GenerateCfTokenRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_amount'=>'required|double',
            'order_currency'=>'required',
        ];
    }
}
