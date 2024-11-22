<?php

namespace App\Http\Requests\Admin\AdminDetail;

use Illuminate\Foundation\Http\FormRequest;

class ValidateJsonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'file' => 'required|mimes:json|max:2048',
            
        ];
    }
}
