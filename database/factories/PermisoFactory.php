<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\EstadoVariacione;
use Illuminate\Database\Eloquent\Factories\Factory;


class PermisoFactory extends Factory
{

    public function definition()
    {
      
        return [
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'duracion' => $this->faker->numberBetween(1, 15),
            'motivo' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id,
            'estado_variacione_id' => EstadoVariacione::all()->random()->id
        ];
    }
}
