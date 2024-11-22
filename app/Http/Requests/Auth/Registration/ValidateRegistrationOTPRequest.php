<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class ValidateRegistrationOTPRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid'  => 'required|uuid|exists:mobile_otp_verifications,id',
            'otp'   => 'required|otp',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $message = 'There was an error validating the otp.';

        return [
            'uuid.required' => $message,
            'uuid.uuid'     => $message,
            'uuid.exists'   => $message,
        ];
    }
}
