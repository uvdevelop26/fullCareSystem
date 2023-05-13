<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seccion>
 */
class SeccionFactory extends Factory
{

    public function definition()
    {
        $seccions = ['cocina', 'enfermeria', 'ayudante', 'administrativo', 'otro'];

        return [
            'nombre_seccion' => $this->faker->randomElement($seccions),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
