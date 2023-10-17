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
        $fecha = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');

        return [
            'fecha' => $fecha,
            'monto' => $this->faker->randomFloat(2, 50000, 200000),
            'empleado_id' => Empleado::all()->random()->id,
        ];
    }
}
