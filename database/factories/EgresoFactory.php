<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Egreso>
 */
class EgresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tipo' => $this->faker->word(),
            'subtipo' => $this->faker->word(),
            'detalle' => $this->faker->sentence(),
            'egreso_fecha' => $this->faker->date(),
            'monto' => $this->faker->numberBetween(1000, 5000)
        ];
    }
}
