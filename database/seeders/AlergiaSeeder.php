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
            ],
            [
                'nombre' => 'polvo',  
            ],
            [
                'nombre' => 'mascotas',
                
            ],
            [
                'nombre' => 'insectos',
                
            ],
            [
                'nombre' => 'latex',
            ]
        ]);

    }
}
