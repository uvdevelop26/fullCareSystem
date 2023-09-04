<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlergiaSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('alergias')->insert([
            [
                'nombre' => 'polen',
                'descripcion' => 'en reacción al polen de plantas y árboles en el aire.'
            ],
            [
                'nombre' => 'polvo',
                'descripcion' => 'debido a los ácaros del polvo presentes en el entorno doméstico.'
            ],
            [
                'nombre' => 'mascotas',
                'descripcion' => 'los alérgenos presentes en animales como perros y gatos pueden causar las reacciones.'
            ],
            [
                'nombre' => 'insectos',
                'descripcion' => 'picaduras de insectos como abejas, avispas, mosquitos y pulgas.'
            ],
            [
                'nombre' => 'latex',
                'descripcion' => 'presente en guantes, globos y productos médicos puede causar alergias.'
            ]
        ]);

    }
}
