<?php

namespace Database\Seeders;

use App\Models\Ciudade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadeSeeder extends Seeder
{

    public function run()
    {
        DB::table('ciudades')->insert([
            [
                'nombre_ciudad' => 'natalicio talavera'
            ],
            [
                'nombre_ciudad' => 'mauricio jose troche'
            ],
            [
                'nombre_ciudad' => 'doctor bottrel'
            ],
            [
                'nombre_ciudad' => 'independencia'
            ],
        ]);
    }
}
