<?php

namespace Database\Seeders;

use App\Models\Seccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SeccionSeeder extends Seeder
{

    public function run()
    {
        DB::table('seccions')->insert([
            [
                'nombre_seccion' => 'administracion',
                'descripcion' => 'trámites administrativos'
            ],
            [
                'nombre_seccion' => 'enfermeria',
                'descripcion' => 'cuidados profesionales'
            ],
            [
                'nombre_seccion' => 'staff',
                'descripcion' => 'encargados de alimentación y limpieza del hogar'
            ]

        ]);
      
    }
}
