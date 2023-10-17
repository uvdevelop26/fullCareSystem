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
        $fechaInicio = $this->faker->dateTimeBetween('2009-01-01', '2023-12-31');
        
        return [
            'fecha_inicio' => $fechaInicio,
            'email' => $this->faker->email(),
            'seccion_id' => Seccion::all()->random()->id,
            'persona_id' => Persona::all()->random()->id,
        ];
    }
}
