<?php

namespace App\Http\Requests\Admin\Onboarding;

use App\Http\Requests\BaseRequest;

class UpdateOnboardingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'name' => 'required|max:50',
            'icon'=>$this->OnboardingImageRule(),
            //'description'=>'required|max:25',
            //'short_description'=>'required|max:25',
           // 'supported_vehicles'=>'required',
           // 'icon_types_for'=>'required'
            // 'is_accept_share_ride'=>'required|boolean',
        ];
    }
}
