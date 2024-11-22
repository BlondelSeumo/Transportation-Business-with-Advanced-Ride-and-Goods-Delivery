<?php

namespace App\Http\Requests\Admin\Owner;


use App\Http\Requests\BaseRequest;

class AddOwnerMoneyToWalletRequest extends BaseRequest
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