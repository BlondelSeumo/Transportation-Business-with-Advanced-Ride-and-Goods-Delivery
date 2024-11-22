<?php

namespace App\Http\Requests\Admin\Driver;


use App\Http\Requests\BaseRequest;

class AddDriverMoneyToWalletRequest extends BaseRequest
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
        ];
    }
}
