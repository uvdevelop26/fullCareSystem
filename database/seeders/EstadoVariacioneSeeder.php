<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoVariacioneSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('estado_variaciones')->insert([
            [
                'nombre_estado' => 'pendiente'
            ],
            [
                'nombre_estado' => 'aprobado'
            ],
            [
                'nombre_estado' => 'rechazado'
            ],
        ]);
    }
}
