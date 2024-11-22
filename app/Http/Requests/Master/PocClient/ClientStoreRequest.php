<?php

namespace App\Http\Requests\Master\PocClient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;



class ClientStoreRequest extends FormRequest
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
    public function rules(Request $request)
    {  
        $check = $request;

        if($check->exisiting_client == 'on'){
            
            return [$request];  
            
        }else{

            return [
            'first_name' => 'required|max:50',
            'mobile'=>'required|mobile_number|unique:users,mobile',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:32|confirmed'

        ];
             
        }
        
    }
}
