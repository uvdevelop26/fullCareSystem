<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ControlMedicamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'horario_medicamento_id' => [
                'required',
                Rule::unique('control_medicamento')->where(function ($query) {
                    return $query->where('fecha', $this->fecha)
                        ->where('horario_medicamento_id', $this->horario_medicamento_id);
                })
            ]
        ];
    }

    public function attributes(){
        return [
            'horario_medicamento_id' => 'horario',
        ];
    }
}
