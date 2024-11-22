<?php

namespace App\Http\Requests\Admin\User;


use App\Http\Requests\BaseRequest;

class AddUserMoneyToWalletRequest extends BaseRequest
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
