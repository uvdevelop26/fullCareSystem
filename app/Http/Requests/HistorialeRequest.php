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
            'fecha_registro' =>  'required',
            'diagnostico' => 'required',
            'tratamiento' => 'required',
            'observaciones' => 'required',
            'residente_id' => 'required',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'temperatura' => 'required|numeric',
            'presion_arterial' => 'required|numeric',
        ];
    }

    public function attributes(){
        return [
            'fecha_registro' => 'fecha',
            'residente_id' => 'residente',
            'presion_arterial' => 'presion arterial',
        ];
    }
}
