<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Empleado;
use App\Models\Familiare;
use App\Models\Permiso;
use App\Models\Persona;
use App\Models\Residente;
use App\Models\Seccion;
use App\Models\Sueldo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
       
       $this->call(CiudadeSeeder::class);
       Persona::factory(100)->create();
       Residente::factory(20)->create();
       Familiare::factory(20)->create();
       Seccion::factory(4)->create();
       Empleado::factory(15)->create();
       Permiso::factory(10)->create();
       Sueldo::factory(10)->create();
    }
}
