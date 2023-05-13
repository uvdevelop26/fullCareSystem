<?php

namespace Database\Factories;

use App\Models\Persona;
use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;


class FamiliareFactory extends Factory
{

    public function definition()
    {   
        $parentezcos = ['hijo/a', 'hermano/a', 'sobrino/a', 'otro'];

        return [
            'parentezco' => $this->faker->randomElement($parentezcos),
            'email' => $this->faker->email(),
            'residente_id' => Residente::all()->random()->id,
            'persona_id' => Persona::all()->random()->id
        ];
    }
}
