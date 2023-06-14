<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Caracteristica;
use App\Models\Egreso;
use App\Models\Empleado;
use App\Models\Enfermedade;
use App\Models\Familiare;
use App\Models\Historiale;
use App\Models\Horario;
use App\Models\Incidencia;
use App\Models\Ingreso;
use App\Models\Medicamento;
use App\Models\Permiso;
use App\Models\Persona;
use App\Models\Residente;
use App\Models\Seccion;
use App\Models\Sueldo;
use App\Models\Turno;
use App\Models\Vacacione;
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
        Empleado::factory(20)->create();
        $this->call(DiaSeeder::class);
        Permiso::factory(20)->create();
        Sueldo::factory(20)->create();
        Vacacione::factory(10)->create();
        Ingreso::factory(20)->create();
        Egreso::factory(20)->create();
        Enfermedade::factory(20)->create();
        Incidencia::factory(20)->create();
        Caracteristica::factory(20)->create();
        Historiale::factory(20)->create();
        Medicamento::factory(15)->create();
        Horario::factory(10)->create();
    }
}
