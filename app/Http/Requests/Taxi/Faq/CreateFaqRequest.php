<?php

namespace App\Http\Requests\Taxi\Faq;

use Illuminate\Foundation\Http\FormRequest;

class CreateFaqRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_location_id' => 'required',
            'user_type' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'service_location_id.required' => 'Area name is required'
        ];
    }
}
