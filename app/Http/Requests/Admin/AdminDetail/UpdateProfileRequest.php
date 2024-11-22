<?php

namespace App\Http\Requests\Admin\AdminDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        if ($this->action == 'password') {
            return [
                'password'=>'required|min:8|max:32|confirmed'
            ];
        } else {
            return [
                'first_name' => 'required|max:50',
                // 'last_name' => 'required|max:50',
                'mobile'=>'required',
                'email'=>'required',
                'address'=>'required|min:10',
            ];
        }
    }
}
