<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'username' => 'required|max:50',
            'password' => 'required|confirmed|min:7',
            'empleado_id' => 'required',
            'role_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'nombre de usuario',
            'password' => 'contraseña',
            'empleado_id' => 'empleado',
            'role_id' => 'roles'
        ];
    }
}
