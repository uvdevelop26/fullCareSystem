<?php

namespace Database\Factories;

use App\Models\Historiale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnfermedadeFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre_enfermedades' => $this->faker->word(),
            'tratamientos' => $this->faker->sentence(),
            'alimentacion' => $this->faker->sentence(),
            'recomendaciones' => $this->faker->sentence(),
            
        ];
    }
}
