<?php

namespace Database\Factories;

use App\Models\EstadoResidente;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;


class ResidenteFactory extends Factory
{

    public function definition()
    {
        $fechaIngreso = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');

        return [
            'foto' => $this->faker->imageUrl(150, 150),
            'fecha_ingreso' => $fechaIngreso,
            'persona_id' => Persona::all()->random()->id,
            'estado_residente_id' => EstadoResidente::all()->random()->id
        ];
    }
}
