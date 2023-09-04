<?php

namespace Database\Factories;

use App\Models\Presentacione;
use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class MedicamentoFactory extends Factory
{

    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'dosis' => $this->faker->word(),
            'indicaciones' => $this->faker->sentence(),
            'efectos_secundarios' => $this->faker->sentence(),
            'residente_id' => Residente::all()->random()->id,
            'presentacione_id' => Presentacione::all()->random()->id,
        ];
    }
}
