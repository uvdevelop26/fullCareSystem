<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresentacioneSeeder extends Seeder
{

    public function run()
    {
        DB::table('presentaciones')->insert([
            [
                'nombre' => 'comprimidos',
                'descripcion' => 'los comprimidos son una forma sólida de medicamento que se toma por vía oral. Generalmente, se fabrican presionando el medicamento en una forma compacta.'
            ],
            [
                'nombre' => 'capsulas',
                'descripcion' => 'las cápsulas son envases de gelatina o de plástico que contienen el medicamento en forma de polvo, líquido o gránulos. Se tragan enteras.'
            ],
            [
                'nombre' => 'jarabe',
                'descripcion' => 'el jarabe es una forma líquida de medicamento que generalmente contiene agua, azúcar y el principio activo. Se administra en dosis medidas con una cuchara dosificadora.'
            ],
            [
                'nombre' => 'inyección',
                'descripcion' => 'las inyecciones son medicamentos líquidos que se administran directamente en el cuerpo mediante una aguja y una jeringa. pueden ser intramusculares o intravenosas'
            ],
            [
                'nombre' => 'crema',
                'descripcion' => 'las cremas son medicamentos en forma de una sustancia semisólida que se aplica tópicamente sobre la piel. Se utilizan para tratar afecciones cutáneas.'
            ],
            [
                'nombre' => 'gotas',
                'descripcion' => 'las gotas son una forma líquida de medicamento que se administra en dosis pequeñas. a menudo se utilizan para afecciones oculares.'
            ]
        ]);
    }
}
