<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class PermissionSeeder extends Seeder
{

    public function run()
    {
        //Resetea roles y permisos almacenados en chache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //CREA EL ARRAY CON LOS PERMISOS
        $permissions = [
            //tabla residentes
            'ver-residente',
            'crear-residente',
            'editar-residente',
            'borrar-residente',

            //tabla familiares
            'ver-familiare',
            'crear-familiare',
            'editar-familiare',
            'borrar-familiare',

            //tabla Empleados
            'ver-empleado',
            'crear-empleado',
            'editar-empleado',
            'borrar-empleado',

            //tabla sueldos
            'ver-sueldo',
            'crear-sueldo',
            'editar-sueldo',
            'borrar-sueldo',

            //tabla Jornadas
            'ver-jornada',
            'crear-jornada',
            'editar-jornada',
            'borrar-jornada',

            //tabla permisos
            'ver-permisos',
            'crear-permisos',
            'editar-permisos',
            'borrar-permisos',

            //tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //tabla permissions
            'ver-permission',
            'crear-permission',
            'editar-permission',
            'borrar-permission',

            //tabla ingresos
            'ver-ingreso',
            'crear-ingreso',
            'editar-ingreso',
            'borrar-ingreso',

            //tabla egresos
            'ver-egreso',
            'crear-egreso',
            'editar-egreso',
            'borrar-egreso',

            //tabla-historial
            'ver-historial',
            'crear-historial',
            'editar-historial',
            'borrar-historial',

            //medicamentos
            'ver-medicamento',
            'crear-medicamento',
            'editar-medicamento',
            'borrar-medicamento'
        ];


        //AÑADIMOS LOS PERMISOS A LA TABLA
        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }

        //CREAR ROLES Y ASIGNARLES LOS PERMISOS CORRESPONDIENTES

        //ROL 1 -- ENFERMERO -- LE DA SOLO ESTOS PERMISOS
        $role1 = Role::create(['name' => 'enfermero']);
        $role1->givePermissionTo('ver-empleado');
        $role1->givePermissionTo('ver-sueldo');
        $role1->givePermissionTo('ver-jornada');
        $role1->givePermissionTo('ver-historial');
        $role1->givePermissionTo('ver-medicamento');


        //ROL 2 -- ADMIN -- LE DA TODOS LOS PERMISOS
        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        //ROL 3 -- LE DA TODOS LOS PERMISOS -- ESTO ESTA EN GATE -- AuthServiceProvider
        $role3 = Role::create(['name' => 'super-admin']);

        //CREAR USUARIOS DEMO PARA PRUEBAS

        //USUARIO 1 = ES SUPER ADMIN
        $user = \App\Models\User::factory()->create([
            'username' => 'Super Admin',
            'empleado_id' => 5,
            'password' => Hash::make(123456789),
        ]);

        $user->assignRole($role3);

        //----------------------------------
        //USUARIO 2 = ES USUARIO ADMIN

        $user = \App\Models\User::factory()->create([
            'username' => 'Admin User',
            'empleado_id' => 2,
            'password' => Hash::make(12345678910),
        ]);


        $user->assignRole($role2);

        //-----------------------------------------------
        //USUARIO 3 = ES ENFERMERO

        $user = \App\Models\User::factory()->create([
            'username' => 'EjemploUser',
            'empleado_id' => 3,
            'password' => Hash::make(12345678),
        ]);

        $user->assignRole($role1);
    }
}
