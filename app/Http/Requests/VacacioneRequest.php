<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacioneRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'duracion' => 'required',
            'estado' => 'required',
            'observacion' => 'nullable',
            'empleado_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha fin',
            'empleado_id' => 'empleado'
        ];
    }
}
