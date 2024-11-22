<?php

namespace App\Http\Requests\Auth\App;

use App\Http\Requests\BaseRequest;

class GenericAppLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'sometimes|required|email|exists:users,email',
            'password'      => 'sometimes|required',
            'username'      => 'sometimes|required|exists:users,username',
            // 'mobile'=>'sometimes|required|mobile_number',
            'login_by'=>'sometimes|required',
            'device_token'=>'sometimes|required'
        ];
    }
}
