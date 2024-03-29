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
use App\Models\Jornada;
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
        //Residentes
        $this->call(CiudadeSeeder::class);
        Persona::factory(100)->create();
        $this->call(HabitacioneSeeder::class);
        Residente::factory(15)->create();
        Familiare::factory(18)->create();

        //Empleados - Usuarios
        $this->call(SeccionSeeder::class);
        Empleado::factory(18)->create();
        Sueldo::factory(18)->create();
        $this->call(DiaSeeder::class);
        $this->call(TurnoSeeder::class);
        Jornada::factory(10)->create();
        
        $this->call(EstadoVariacioneSeeder::class);

        

        Permiso::factory(10)->create(); 
        Vacacione::factory(10)->create();
        $this->call(PermissionSeeder::class);

        //Finanzas
        $this->call(CategoriaSeeder::class);
        Ingreso::factory(10)->create();
        Egreso::factory(10)->create();
        
        //Salud
        Caracteristica::factory(20)->create();
        $this->call(EnfermedadeSeeder::class);
        Historiale::factory(10)->create();
        $this->call(PresentacioneSeeder::class);
        Medicamento::factory(15)->create();
        Rutina::factory(15)->create();
        //Horario::factory(10)->create();
    }
}
