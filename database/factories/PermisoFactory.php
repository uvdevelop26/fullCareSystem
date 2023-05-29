<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;


class PermisoFactory extends Factory
{

    public function definition()
    {
        $justificacion = ['enfermedad', 'duelo', 'viaje', 'emergencia familiar', 'otros'];
        $estado = ['pendiente', 'aprobado'];

        return [
            'fecha_permiso' => $this->faker->date(),
            'justificacion' => $this->faker->randomElement($justificacion),
            'estado' => $this->faker->randomElement($estado),
            'observacion' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id,
        ];
    }
}
