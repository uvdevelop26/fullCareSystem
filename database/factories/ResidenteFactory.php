<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;


class ResidenteFactory extends Factory
{
   
    public function definition()
    {
        $personas = Persona::all();
        return [
            'foto' => $this->faker->imageUrl(150, 150),
            'fecha_ingreso' => $this->faker->date(),
            'fecha_salida' => $this->faker->date(),
            'persona_id' => $this->faker->unique()->numberBetween(1, $personas->count()),
        ];
    }
}
