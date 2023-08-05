<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnoSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('turnos')->insert([
            [
                'nombre_turnos' => 'mañana',
                'hora_entrada' =>  '06:00:00',
                'hora_salida' => '12:00:00'       
            ],
            [
                'nombre_turnos' => 'tarde',
                'hora_entrada' =>  '12:00:00',
                'hora_salida' => '18:00:00' 
            ],
            [
                'nombre_turnos' => 'noche',
                'hora_entrada' =>  '18:00:00',
                'hora_salida' => '00:00:00'
            ],
            [
                'nombre_turnos' => 'madrugada',
                'hora_entrada' =>  '00:00:00',
                'hora_salida' => '06:00:00'
            ]
        ]);
    }
}
