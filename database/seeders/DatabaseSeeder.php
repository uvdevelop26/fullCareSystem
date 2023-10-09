<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Caracteristica;
use App\Models\Egreso;
use App\Models\Empleado;
use App\Models\Enfermedade;
use App\Models\EstadoResidente;
use App\Models\EstadoVacacione;
use App\Models\EstadoVariacione;
use App\Models\Familiare;
use App\Models\Historiale;
use App\Models\Horario;
use App\Models\Incidencia;
use App\Models\Ingreso;
use App\Models\Medicamento;
use App\Models\Permiso;
use App\Models\Persona;
use App\Models\Residente;
use App\Models\Rutina;
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
        Persona::factory(10)->create();
        $this->call(EstadoResidenteSeeder::class);
        Residente::factory(12)->create();
        Familiare::factory(18)->create();
        $this->call(SeccionSeeder::class);
        Empleado::factory(18)->create();
        Sueldo::factory(18)->create();
        $this->call(DiaSeeder::class);
        $this->call(TurnoSeeder::class);
        $this->call(EstadoVariacioneSeeder::class);
        Permiso::factory(10)->create(); 
        Vacacione::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(CategoriaSeeder::class);
        Ingreso::factory(10)->create();
        Egreso::factory(10)->create();
        Caracteristica::factory(20)->create();
        $this->call(EnfermedadeSeeder::class);
        $this->call(AlergiaSeeder::class);
        Historiale::factory(10)->create();
        $this->call(PresentacioneSeeder::class);
        Medicamento::factory(8)->create();
        Rutina::factory(8)->create();
        //Horario::factory(10)->create();
    }
}
