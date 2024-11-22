<?php

namespace App\Http\Requests\Admin\Fleet;

use Illuminate\Foundation\Http\FormRequest;

class FleetStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'custom_make' => 'required',
            'custom_model' => 'required',
            'license_number' => 'required',
            'type' => 'required',
            
        ];
    }
}
