<?php

namespace Database\Factories;
use App\Models\Historiale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CaracteristicaFactory extends Factory
{
    
    public function definition()
    {
        return [
            'peso' => $this->faker->randomDigit(),
            'altura' => $this->faker->randomDigit(),
            'temperatura' => $this->faker->randomDigit(),
            'presion_arterial' => $this->faker->randomDigit(),
        ];
    }
}
