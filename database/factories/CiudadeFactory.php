<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ciudade>
 */
class CiudadeFactory extends Factory
{
    
    public function definition()
    {
        return [
            'nombre_ciudad' => $this->faker->city(45),
        ];
    }
}
