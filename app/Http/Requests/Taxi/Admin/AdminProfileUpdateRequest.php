<?php

namespace App\Http\Requests\Taxi\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
			'email' => 'required|email|max:150|unique:users,email,' . $this->user()->id,
			'mobile' => 'sometimes|mobile_number|unique:users,mobile,' . $this->user()->id,
			'profile_picture' => $this->userProfilePictureRule(),
        ];
    }
}
