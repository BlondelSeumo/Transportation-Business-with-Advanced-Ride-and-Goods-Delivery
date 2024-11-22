<?php

namespace App\Http\Requests\Admin\SoS;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSosRequest extends FormRequest
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
            'service_location_id' => 'required',
            'name' => 'required|max:50',
            'number'=>'required|unique:sos,number,'.$this->sos->id.',id,deleted_at,NULL'
        ];
    }
}
