<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingreso>
 */
class IngresoFactory extends Factory
{
    
    public function definition()
    {
        //fecha
        $fecha = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');

        return [
            'fecha' => $fecha,
            'concepto' => $this->faker->word(),
            'detalle' => $this->faker->sentence(),
            'monto' => $this->faker->numberBetween(100000, 500000),
            'nro_comprobante' => $this->faker->numberBetween(10, 100),
            'user_id' => User::all()->random()->id,
            'categoria_id' => Categoria::all()->random()->id,
            
        ];
    }
}
