<?php

namespace Database\Factories;

use App\Models\Residente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamento>
 */
class MedicamentoFactory extends Factory
{
    
    public function definition()
    {
        return [
            'nombre_medicamento' => $this->faker->word(),
            'via_suministro' => $this->faker->randomElement(['via oral', 'via subcutanea', 'sanguinea', 'otros']),
            'fecha_vencimiento' => $this->faker->date(),
            'dosis_cantidad' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(1, 100),
            'residente_id' => Residente::all()->random()->id
        ];
    }
}
