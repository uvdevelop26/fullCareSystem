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
            'peso' => 'required',
            'altura' => 'required',
            'temperatura' => 'required',
            'presion_arterial' => 'required',

            'enfermedades' => 'required_if:nombre_enfermedad, | nullable',
            'nombre_enfermedad' => 'required_without:enfermedades',
            'descripcion_enfermedad' => 'required_with:nombre_enfermedad',

            'alergias' => 'required_if:nombre_alergia, | nullable',
            'nombre_alergia' => 'required_without:alergias',
            'descripcion_alergia' => 'required_with:nombre_alergia'
        ];
    }

    public function attributes(){
        return [
            'fecha_registro' => 'fecha',
            'residente_id' => 'residente',
            'presion_arterial' => 'presion arterial',
            'nombre_enfermedad' => 'otro',
            'nombre_alergia' => 'otro',
          
        ];
    }
}
