<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoResidenteRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'nombre' => 'required',
            'motivo_salida' => 'nullable|max:100',
            'fecha_salida' => 'required_if:nombre,0',
            'fecha_regreso' => 'nullable|date',
            'residente_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'estado',
            'motivo_salida' => 'motivo salida',
            'fecha_salida' => 'fecha salida',
            'fecha_regreso' => 'fecha regreso',
            'residente_id' => 'residente'
        ];
    }
}
