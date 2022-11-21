<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PaiseFactory extends Factory
{
    
    public function definition()
    {
        return [
            'nombre_pais' => $this->faker->country(20),
        ];
    }
}
