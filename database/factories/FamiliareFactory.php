<?php

namespace Database\Factories;

use App\Models\Persona;
use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class FamiliareFactory extends Factory
{
    
    public function definition()
    {
        $residente = Residente::all();
        $persona = Persona::all();

        return [
            'parentezco' => $this->faker->randomElement(['Hijo/a', 'Hermano/a', 'sobrino/a', 'otro']),
            'email' => $this->faker->email(),
            'residente_id' => $this->faker->numberBetween(1, $residente->count()),
            'persona_id' => $this->faker->numberBetween(1, $persona->count())
        ];
    }
}
