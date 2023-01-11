<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sueldo>
 */
class SueldoFactory extends Factory
{
    
    public function definition()
    {
        return [
            'categoria' => $this->faker->word(),
            'monto' => $this->faker->randomDigit(),
            'observacion' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id,

        ];
    }
}
