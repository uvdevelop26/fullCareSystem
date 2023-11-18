<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ControlRutinaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'fecha' => 'required',
            'hora' => 'required',
            'realizado' => 'required',
            'horario_rutina_id' => [
                'required',
                Rule::unique('control_rutina')->where(function ($query) {
                    return $query->where('fecha', $this->fecha)
                        ->where('horario_rutina_id', $this->horario_rutina_id);
                })
            ]
        ];
    }

    public function attributes(){
        return [
            'horario_rutina_id' => 'horario',
        ];
    }
}
