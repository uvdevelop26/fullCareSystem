<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direction>
 */
class DirectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          /*   'pais' => $this->faker->unique()->word(10),
            'ciudad' => $this->faker->word(15),
            'barrio' => $this->faker->word(25), */
        ];
    }
}
