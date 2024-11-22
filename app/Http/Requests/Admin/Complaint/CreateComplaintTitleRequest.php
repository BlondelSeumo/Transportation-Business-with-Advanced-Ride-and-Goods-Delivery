<?php

namespace App\Http\Requests\Admin\Complaint;

use Illuminate\Foundation\Http\FormRequest;

class CreateComplaintTitleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_type' => 'required',
            'title' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title field is required'
        ];
    }
}
