<?php

namespace Database\Seeders;

use App\Models\Ciudade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadeSeeder extends Seeder
{
    
    public function run()
    {
        $ciudad = new Ciudade();
        $ciudad->nombre_ciudad = 'Natalicio Talavera';
        $ciudad->save();

        $ciudad2 = new Ciudade();
        $ciudad2->nombre_ciudad = 'Mauricio Jose Troche';
        $ciudad2->save();

        $ciudad3 = new Ciudade();
        $ciudad3->nombre_ciudad = 'Doctor Bottrel';
        $ciudad3->save();

        $ciudad4 = new Ciudade();
        $ciudad4->nombre_ciudad = 'Independencia';
        $ciudad4->save();
    }
}
