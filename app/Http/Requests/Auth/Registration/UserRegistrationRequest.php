<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class UserRegistrationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'last_name' => 'max:50',
            'email' => 'required|email|max:150',
            'password' => 'sometimes|required|min:8',
            // 'uuid' => 'required|uuid|exists:mobile_otp_verifications,id,verified,1',
            'mobile' => 'required',
            'terms_condition' => 'sometimes|required|boolean|in:1',
            'device_token'=>'sometimes|required',
            'login_by'=>'sometimes|required|in:android,ios',
            'oauth_token'=>'sometimes|required',
        ];
    }
}
