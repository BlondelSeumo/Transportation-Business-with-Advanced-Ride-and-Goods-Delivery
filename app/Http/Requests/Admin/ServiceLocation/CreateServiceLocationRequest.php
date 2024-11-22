<?php

namespace App\Http\Requests\Admin\ServiceLocation;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceLocationRequest extends FormRequest
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
            'name' => 'required|max:50|unique:service_locations,name,NULL,id,deleted_at,NULL',
            // 'currency_code' => 'required',
            // 'currency_symbol' => 'required',
            'timezone' => 'required',
            'country' => 'required',
        ];
    }
}
