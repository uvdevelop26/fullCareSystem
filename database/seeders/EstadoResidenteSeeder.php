<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoResidenteSeeder extends Seeder
{

    public function run()
    {
        DB::table('estado_residentes')->insert([
                [
                    'nombre_estado' => 'activo'
                ],
                [
                    'nombre_estado' => 'inactivo'
                ],
            ]);
    }
}
