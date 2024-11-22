<?php

namespace App\Http\Requests\Master\Roles;

use App\Http\Requests\BaseRequest;

class CreateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'slug'=>'required|max:50',
            'description'=>'required|min:10',
            'locked'=>'boolean'

        ];
    }
}
