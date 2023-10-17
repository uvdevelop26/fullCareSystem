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
        $sexos = ['femenino', 'masculino'];

        //la dirección no exceda los 100 caracteres
        $direccion = $this->faker->sentence();
        $direccion = substr($direccion, 0, 100);

        //Regulamos fecha de nacimiento
        $fechaNacimiento = $this->faker->dateTimeBetween('-88 years', '-16 years');


        return [
            'nombres' => $this->faker->firstName(50),
            'apellidos' => $this->faker->lastName(50),
            'ci_numero' => $this->faker->numberBetween(700000, 6000000),
            'fecha_nacimiento' => $fechaNacimiento,
            'telefono' => $this->faker->phoneNumber(20),
            'edad' => $this->faker->numberBetween(1, 100),
            'sexo' => $this->faker->randomElement($sexos),
            'direccion' => $direccion,
            'ciudade_id' => Ciudade::all()->random()->id
        ];
    }
}
