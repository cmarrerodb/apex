<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        // Permission::create(['name' => 'ver usuarios']);
        // Permission::create(['name' => 'crear usuario']);
        // Permission::create(['name' => 'editar usuario']);
        // Permission::create(['name' => 'eliminar usuario']);

        // Permission::create(['name' => 'ver reservas']);
        // Permission::create(['name' => 'crear reserva']);
        // Permission::create(['name' => 'editar reserva']);
        // Permission::create(['name' => 'eliminar reserva']);

        // Permission::create(['name' => 'asignar permiso']);
        // create roles and assign created permissions


        // this can be done as separate statements
        // $role = Role::create(['name' => 'supervisor']);
        // $role->givePermissionTo([
        //     'ver usuarios',
        //     'ver reservas',
        //     'crear reserva',
        //     'editar reserva',
        //     'eliminar reserva'
        // ]);

        // or may be done by chaining
        // $role = Role::create(['name' => 'usuario'])
        //     ->givePermissionTo(['ver reservas']);

        // $role = Role::create(['name' => 'administrador']);
        // $role->givePermissionTo(Permission::all());

        Permission::truncate();

        // Crear permisos
        $permissions = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',

            'ver permisos',
            'crear permisos',
            'asignar permisos',
            'editar permisos',
            'eliminar permisos',

            'ver roles',
            'crear roles',
            'editar roles',
            'eliminar roles',

            'ver reservas',
            'crear reservas',
            'editar reservas',
            'eliminar reservas',
            'rechazar reservas',
            'rollback reservas',
            'no-show reservas',
            'cancelar reservas',

            'ver giftcards',
            'crear giftcards',
            'editar giftcards',
            'anular giftcards',
            'sincronizar giftcards',

            'ver administrar',

            'ver extras',

            'ver bloqueos',
            'editar bloqueos',
            'crear bloqueos',

            'ver historial',
            'rollback historial',

            'ver configuraciones globales',
            'crear configuraciones globales',
            'editar configuraciones globales',

            'ver configuraciones automaticas',
            'crear configuraciones automaticas',
            'editar configuraciones automaticas',
            'eliminar configuraciones automaticas',

            'ver sucursales',
            'cear sucursales',
            'editar sucursales',
            'eliminar sucursales',

            'ver salones',
            'cear salones',
            'editar salones',
            'eliminar salones',

            'ver mesas',
            'crear mesas',
            'editar mesas',
            'eliminar mesas',

            'ver tipos de reservas',
            'cear tipos de reservas',
            'editar tipos de reservas',
            'eliminar tipos de reservas',

            'ver razones cancelacion',
            'cear razones cancelacion',
            'editar razones cancelacion',
            'eliminar razones cancelacion',

            'ver email enviados',

            'ver clientes',
            'cear clientes',
            'editar clientes',
            'eliminar clientes',

            'ver tipos de clientes',
            'cear tipos de clientes',
            'editar tipos de clientes',
            'eliminar tipos de clientes',

            'ver categoria de clientes',
            'cear categoria de clientes',
            'editar categoria de clientes',
            'eliminar categoria de clientes',

            'ver comensales',

            'ver calendario',


        ];

        foreach ($permissions as $permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Crear roles y asignar permisos
        $roles = [

            'SuperUsuario'=>[],   

            'Administrador Reservas'=>[
                'ver usuarios',
                'ver reservas',
                'crear reservas',
                'editar reservas',
                'eliminar reservas',
                'rollback reservas',
            ],

            'Tomador Reservas'=>[
                'ver usuarios',
                'ver reservas',
                'crear reservas',
                'editar reservas',
                'eliminar reservas',
                'rollback reservas',
            ],
            'Consulta'=>[
                'ver calendario'
            ],
           
        ];

        foreach ($roles as $role_name => $role_permissions) {
            $role = Role::where('name', $role_name)->first();
            if (!$role) {
                $role = Role::create(['name' => $role_name]);
            }
            foreach ($role_permissions as $permission_name) {
                $permission = Permission::where('name', $permission_name)->first();
                $role->givePermissionTo($permission);
            }
        }

        // Obtener el rol del administrador
        $adminRole = Role::where('name', 'SuperUsuario')->first();
        // Obtener todos los permisos
        $permissions = Permission::all();
        // Sincronizar todos los permisos con el rol del administrador
        $adminRole->syncPermissions($permissions);
    }
}
