<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    
    public function run()
    {
        Direction::create([
            'pais' => 'Arg',
            'ciudad' => 'Natalicio',
            'barrio' => 'Virgen del Rosario'
        ]);

        Direction::factory(50)->create();
    }
}
