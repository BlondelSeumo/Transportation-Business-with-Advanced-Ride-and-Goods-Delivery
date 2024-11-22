<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
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
            'email' => 'required|email|max:150',
            // 'mobile' => 'required|mobile_number|unique:users,mobile,' . $this->user()->id,
            'profile_picture' => $this->userProfilePictureRule(),
        ];
    }
}
