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
                'descripcion' => 'aumento de la presión arterial aumenta el riesgo de enfermedades cardíacas y accidentes cerebrovasculares.'
            ],
            [
                'nombre' => 'diabetes tipo 2',
                'descripcion' => 'trastorno metabólico que afecta la regulación del azúcar en sangre.'
            ],
            [
                'nombre' => 'Artritis',
                'descripcion' => 'inflamación de las articulaciones que puede causar dolor y limitación en la movilidad.'
            ],
            [
                'nombre' => 'osteoporosis',
                'descripcion' => 'pérdida de densidad ósea que aumenta el riesgo de fracturas.'
            ],
            [
                'nombre' => 'cancer',
                'descripcion' => 'varias formas de cáncer, como el de mama, próstata, pulmón y colon, se vuelven más comunes en adultos mayores.'
            ],
            [
                'nombre' => 'Depresión y ansiedad',
                'descripcion' => 'problemas de salud mental que pueden afectar el bienestar emocional y la calidad de vida.'
            ],
            [
                'nombre' => 'demencia',
                'descripcion' => 'síntomas relacionados con la pérdida de funciones cognitivas, como la memoria, la capacidad de razonar y el pensamiento abstracto'
            ]
        ]);
    }
}
