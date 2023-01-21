<?php

namespace Database\Factories;

use App\Models\Caracteristica;
use App\Models\Enfermedade;
use App\Models\Incidencia;
use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class HistorialeFactory extends Factory
{
   
    public function definition()
    {
        return [
            'fecha_historial' => $this->faker->date(),
            'observaciones' => $this->faker->sentence(),
            'residente_id' => Residente::all()->random()->id,
            'caracteristica_id' => Caracteristica::all()->random()->id,
            'enfermedade_id' => Enfermedade::all()->random()->id,
            'incidencia_id' => Incidencia::all()->random()->id,
        ];
    }
}
