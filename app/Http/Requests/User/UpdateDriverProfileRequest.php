<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateDriverProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|max:50',
            'email' => 'sometimes|required|email|max:150',
            // 'mobile' => 'sometimes|required|mobile_number|unique:users,mobile,' . $this->user()->id,
            'profile_picture' => $this->userProfilePictureRule(),
            'vehicle_type'=>'sometimes|required|exists:vehicle_types,id',
            // 'car_make'=>'sometimes|required|exists:car_makes,id',
            // 'car_model'=>'sometimes|required|exists:car_models,id',
            'car_color'=>'sometimes|required',
            'car_number'=>'sometimes|required',
        ];
    }
}
