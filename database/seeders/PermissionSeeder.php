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
            //tabla permisos
            'ver-permisos',
            'crear-permisos',
            'editar-permisos',
            'borrar-permisos',
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //tabla residentes
            'ver-residente',
            'crear-residente',
            'editar-residente',
            'borrar-residente',

            //tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario'
        ];


        //AÑADIMOS LOS PERMISOS A LA TABLA
        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }

        //CREAR ROLES Y ASIGNARLES LOS PERMISOS CORRESPONDIENTES

        //ROL 1 -- ENFERMERO -- LE DA SOLO ESTOS PERMISOS
        $role1 = Role::create(['name' => 'enfermero']);
        $role1->givePermissionTo('ver-permisos');
        $role1->givePermissionTo('ver-rol');
        $role1->givePermissionTo('ver-residente');
        $role1->givePermissionTo('ver-usuario');

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
