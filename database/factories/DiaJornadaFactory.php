<?php

namespace Database\Factories;

use App\Models\Dia;
use App\Models\Jornada;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiaJornadaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'jornada_id' => Jornada::all()->random()->id,
            'dia_id' => Dia::all()->random()->id
        ];
    }
}
