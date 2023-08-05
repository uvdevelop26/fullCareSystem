<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiaSeeder extends Seeder
{


    public function run()
    {
        DB::table('dias')->insert([
            [
                'nombre_dias' => 'lunes'
            ],
            [
                'nombre_dias' => 'martes'
            ],
            [
                'nombre_dias' => 'miercoles'
            ],
            [
                'nombre_dias' => 'jueves'
            ],
            [
                'nombre_dias' => 'viernes'
            ],
            [
                'nombre_dias' => 'sabado'
            ],
            [
                'nombre_dias' => 'domingo'
            ]
        ]);
    }
}
