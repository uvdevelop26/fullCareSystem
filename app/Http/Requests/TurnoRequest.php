<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'nombre_turnos' => 'required',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'empleado_id' => 'required',
            'nombre_dias' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nombre_turnos' => 'turno',
            'hora_entrada' => 'hora entrada',
            'hora_salida' =>'hora salida',
            'empleado_id' => 'empleado',
            'nombre_dias' => 'dias'
        ];
    }
}
