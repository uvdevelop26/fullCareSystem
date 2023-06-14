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
            'username' => 'required',
            'password' => 'required',
            'empleado_id' => 'required',
            'role_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Nombre de Usuario',
            'password' => 'Contraseña',
            'empleado_id' => 'empleado',
            'role_id' => 'roles'
        ];
    }
}
