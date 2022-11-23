<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Familiar>
 */
class FamiliarFactory extends Factory
{
    
    public function definition()
    {
        return [
            /* 'parentezco' => $this->faker->randomElement(['padre', 'madre', 'hermano', 'otro']),
            'email' => $this->faker->email(),
            'persona_id' => Persona::random()->id */
        ];
    }
}
