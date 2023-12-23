<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistorialeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'residente_id' => 'required',
            'fecha_registro' =>  'required|date',
            'peso' => 'required|numeric|max:200',
            'altura' => 'required|numeric',
            'temperatura' => 'required|numeric',
            'presion_arterial' => 'required|numeric',
            'diagnostico' => 'required|max:200',
            'tratamiento' => 'required|max:200',
            'observaciones' => 'required|max:200',
            
        ];
    }

    public function attributes()
    {
        return [
            'fecha_registro' => 'fecha',
            'residente_id' => 'residente',
            'presion_arterial' => 'presion arterial',
        ];
    }
}
