<?php

namespace Database\Factories;

use App\Models\Persona;
use App\Models\Seccion;
use App\Models\Sueldo;
use Illuminate\Database\Eloquent\Factories\Factory;


class EmpleadoFactory extends Factory
{
    
    public function definition()
    {
        
        return [
            'fecha_ingreso' => $this->faker->date(),
            'email' => $this->faker->email(),
            'profesion' => $this->faker->jobTitle(),
            'seccion_id' => Seccion::all()->random()->id,
            'persona_id' => Persona::all()->random()->id,
        ];
    }
}
