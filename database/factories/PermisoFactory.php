<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;


class PermisoFactory extends Factory
{
   
    public function definition()
    {
        return [
            'fecha_permiso' => $this->faker->date(),
            'justificacion' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id,

        ];
    }
}
