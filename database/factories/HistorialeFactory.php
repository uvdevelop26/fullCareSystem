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
        $fechaRegistro = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');

        return [
            'fecha_registro' => $fechaRegistro,
            'diagnostico' => $this->faker->sentence(),
            'tratamiento' => $this->faker->sentence(),
            'observaciones' => $this->faker->sentence(),
            'residente_id' => Residente::all()->random()->id,
            'caracteristica_id' => Caracteristica::all()->random()->id,
        ];
    }
}
