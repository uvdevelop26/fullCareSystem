<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\EstadoVariacione;
use Illuminate\Database\Eloquent\Factories\Factory;


class PermisoFactory extends Factory
{

    public function definition()
    {
        //fecha de inicio y fecha fin
        $fechaInicio = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');
        $fechaFin = $this->faker->dateTimeInInterval($fechaInicio, '+30 days');

    
        return [
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'duracion' => $this->faker->numberBetween(1, 15),
            'motivo' => $this->faker->sentence(),
            'empleado_id' => Empleado::all()->random()->id,
            'estado_variacione_id' => EstadoVariacione::all()->random()->id
        ];
    }
}
