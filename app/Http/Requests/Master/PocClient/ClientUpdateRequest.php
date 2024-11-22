<?php

namespace App\Http\Requests\Master\PocClient;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'mobile'=>'required|mobile_number|unique:users,mobile,'.$this->user->id,
            'email'=>'required|email|unique:users,email,'.$this->user->id,

        ];
    }
}
