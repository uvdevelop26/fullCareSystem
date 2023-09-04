<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Database\Eloquent\Factories\Factory;


class JornadaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'empleado_id' => Empleado::all()->random()->id,
            'turno_id' => Turno::all()->random()->id
        ];
    }
}
