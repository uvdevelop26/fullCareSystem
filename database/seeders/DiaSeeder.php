<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    

    public function run()
    {
        $dia = new Dia();
        $dia->nombre_dias = 'lunes';
        $dia->save();

        $dia1 = new Dia();
        $dia1->nombre_dias = 'martes';
        $dia1->save();

        $dia2 = new Dia();
        $dia2->nombre_dias = 'miercoles';
        $dia2->save();

        $dia3 = new Dia();
        $dia3->nombre_dias = 'jueves';
        $dia3->save();

        $dia4 = new Dia();
        $dia4->nombre_dias = 'viernes';
        $dia4->save();

        $dia5 = new Dia();
        $dia5->nombre_dias = 'sabado';
        $dia5->save();

        $dia6 = new Dia();
        $dia6->nombre_dias = 'domingo';
        $dia6->save();
    }
}
