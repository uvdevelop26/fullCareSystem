<?php

namespace Database\Factories;

use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class RutinaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'residente_id' => Residente::all()->random()->id,
        ];
    }
}
