<?php

namespace Database\Factories;

use App\Models\Caracteristica;
use App\Models\Enfermedade;
use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class HistorialeFactory extends Factory
{
   
    public function definition()
    {
        return [
            'fecha_registro' => $this->faker->date(),
            'diagnostico' => $this->faker->sentence(),
            'tratamiento' => $this->faker->sentence(),
            'observaciones' => $this->faker->sentence(),
            'residente_id' => Residente::all()->random()->id,
            'caracteristica_id' => Caracteristica::all()->random()->id,
        ];
    }
}
