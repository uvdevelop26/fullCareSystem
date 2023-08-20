<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'estado',
                'tipo' => 'ingresos',
                'descripcion' => 'subsidios municipales, gobernaciones, etc.'
            ],
            [
                'nombre' => 'donaciones',
                'tipo' => 'ingresos',
                'descripcion' => 'donaciones privadas no gubernamentales'
            ],
            [
                'nombre' => 'pensiones',
                'tipo' => 'ingresos',
                'descripcion' => 'pensiones particulares de residentes'
            ],
            [
                'nombre' => 'otros',
                'tipo' => 'ingresos',
                'descripcion' => 'otros tipos de ingresos'
            ],
            [
                'nombre' => 'salarios',
                'tipo' => 'egresos',
                'descripcion' => 'pago de salario a funcionarios'
            ],
            [
                'nombre' => 'salud',
                'tipo' => 'egresos',
                'descripcion' => 'compra de suministros médicos'
            ],
            [
                'nombre' => 'alimentación',
                'tipo' => 'egresos',
                'descripcion' => 'gastos de cocina'
            ],
            [
                'nombre' => 'servicios',
                'tipo' => 'egresos',
                'descripcion' => 'agua, luz, telefono, etc'
            ],
            [
                'nombre' => 'otros',
                'tipo' => 'egresos',
                'descripcion' => 'otros tipos de egresos'
            ]
        ]);
    }
}
