<?php

namespace Database\Factories;

use App\Models\Ciudade;
use App\Models\Paise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName(50),
            'apellidos' => $this->faker->lastName(50),
            'ci_numero' => $this->faker->randomDigit(20),
            'fecha_nacimiento' => $this->faker->date(),
            'telefono' => $this->faker->phoneNumber(20),
            'edad' => $this->faker->numberBetween(1, 100),
            'sexo' => $this->faker->randomElement(['femenino', 'masculino']),
            'direccion' => $this->faker->sentence(),
            'ciudade_id' => Ciudade::all()->random()->id
        ];
    }
}
