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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'duracion' => 'required|numeric|max:10',
            'motivo' => 'nullable',
            'empleado_id' => 'required',
            'estado_variacione_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'fecha_inicio' => 'fecha inicio',
            'fecha_fin'  => 'fecha fin',
            'empleado_id' => 'empleado',
            'estado_variacione_id' => 'estado',
        ];
    }
}
