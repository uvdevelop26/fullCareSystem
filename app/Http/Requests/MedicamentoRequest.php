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
            'horarios' => [
                'array',
                'nullable'
            ],
            'horarios.*.valor' => [
                'nullable',
                'date_format:H:i',
            ],
            'horarios.*.hora' => [
                'nullable',
                'date_format:H:i'
              
            ],
        ];
    }

    public function attributes()
    {
        return [
            'efectos_secundarios' => 'efectos secundarios',
            'residente_id' => 'residente',
            'presentacione_id' => 'presentaciones',
        ];
    }

    public function messages()
    {
        return [
            //'horarios.*.valor.required' => 'El campo :attribute en horarios es obligatorio.',
            'horarios.*.valor.date_format' => 'El formato del campo valor en horarios debe ser H:M.',
            'horarios.*.hora.date_format' => 'El formato del campo valor en horarios debe ser H:M.',
        ];
    }
}
