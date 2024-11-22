<?php

namespace App\Http\Requests\Master\Roles;

use App\Http\Requests\BaseRequest;

class UpdateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:roles,name,' . $this->role->id,
            'slug' => 'required|max:50|unique:roles,slug,' . $this->role->id,
            'description'=>'required|min:10',
            'locked'=>'boolean'

        ];
    }
}
