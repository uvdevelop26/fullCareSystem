<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitacioneSeeder extends Seeder
{

    public function run()
    {
        DB::table('habitaciones')->insert([
            [
                'numero' => 1,
                'descripcion' => 'habitacion con 5 camas 4x4'
            ],
            [
                'numero' => 2,
                'descripcion' => 'habitacion con 5 camas 4x4'
            ],
            [
                'numero' => 3,
                'descripcion' => 'pensiones particulares de residentes'
            ],
            [
                'numero' => 4,
                'descripcion' => 'otros tipos de ingresos prueba 4x4'
            ],
            [
                'numero' => 5,
                'descripcion' => 'otros tipos de ingresos prueba 4x4'
            ],
        ]);
    }
}
