<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacacione>
 */
class VacacioneFactory extends Factory
{
  
    public function definition()
    {
        $estados = ['pendiente', 'aprobado', 'rechazado'];

        return [
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'duracion' => $this->faker->numberBetween(1, 15),
            'estado' => $this->faker->randomElement($estados),
            'observacion' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id
        ];
    }
}
