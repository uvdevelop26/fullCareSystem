<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnfermedadeSeeder extends Seeder
{

    public function run()
    {
        DB::table('enfermedades')->insert([
            [
                'nombre' => 'hipertención',
            ],
            [
                'nombre' => 'diabetes tipo 2',
            ],
            [
                'nombre' => 'Artritis',
            ],
            [
                'nombre' => 'osteoporosis',
            ],
            [
                'nombre' => 'cancer',
            ],
            [
                'nombre' => 'Depresión y ansiedad',
            ],
            [
                'nombre' => 'demencia',
            ]
        ]);
    }
}
