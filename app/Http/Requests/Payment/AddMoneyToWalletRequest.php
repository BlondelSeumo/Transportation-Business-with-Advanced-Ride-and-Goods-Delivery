<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseRequest;

class AddMoneyToWalletRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'=>'required|double',
            'payment_nonce'=>'required',
        ];
    }
}
