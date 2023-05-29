<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'fecha_permiso' => 'required',
            'justificacion' => 'required',
            'estado' => 'required',
            'observacion' => 'nullable',
            'empleado_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_permiso' => 'fecha de permiso',
            'empleado_id' => 'empleado',
        ];
    }
}
