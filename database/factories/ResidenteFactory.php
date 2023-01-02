<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;


class ResidenteFactory extends Factory
{
   
    public function definition()
    {
        
        
        return [
            'foto' => $this->faker->imageUrl(150, 150),
            'fecha_ingreso' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'persona_id' =>Persona::all()->random()->id,
        ];
    }
}
