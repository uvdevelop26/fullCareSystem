<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingreso>
 */
class IngresoFactory extends Factory
{
    
    public function definition()
    {
        return [
            'tipo' => $this->faker->word(),
            'subtipo' => $this->faker->word(),
            'detalle' => $this->faker->sentence(),
            'ingreso_fecha' => $this->faker->date(),
            'monto' => $this->faker->numberBetween(1000, 5000)
        ];
    }
}
