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
            'fecha' => $this->faker->date(),
            'monto' => $this->faker->randomFloat(2, 50000, 200000),
            'empleado_id' => Empleado::all()->random()->id,
        ];
    }
}
