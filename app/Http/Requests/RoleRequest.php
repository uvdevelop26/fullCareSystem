<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:80',
            'permissions' => 'required'
        ];
    }

    public function attributes(){
        return [
            'name' => 'nombre del rol',
            'permissions' => 'permisos'
        ];
    }
}
