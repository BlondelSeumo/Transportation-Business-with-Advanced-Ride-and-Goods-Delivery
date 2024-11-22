<?php

namespace App\Http\Requests\Taxi\Sos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'service_location_id' => 'required',
            'name' => 'required|max:50',
            'number'=>'required|numeric|unique:sos,number,'.$this->sos->id.',id,deleted_at,NULL'
        ];
    }
}
