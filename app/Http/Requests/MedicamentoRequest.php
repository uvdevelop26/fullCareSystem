<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:200',
            'dosis' => 'required',
            'indicaciones' => 'nullable|max:200',
            'efectos_secundarios' => 'nullable|max:100',
            'residente_id' => 'required',
            'presentacione_id' => 'required',
            'horarios' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'efectos_secundarios' => 'efectos secundarios',
            'residente_id' => 'residente',
            'presentacione_id' => 'presentaciones'
        ];
    }
}
