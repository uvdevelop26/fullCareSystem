<?php

namespace Database\Factories;

use App\Models\Historiale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidencia>
 */
class IncidenciaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'cirugias' => $this->faker->word(),
            'alergias' => $this->faker->word(),
            'recomendaciones' => $this->faker->sentence(),
        ];
    }
}
