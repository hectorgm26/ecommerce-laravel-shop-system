<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Asignar roles a los usuarios existentes
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $clienteRole = Role::firstOrCreate(['name' => 'cliente']);

        // Crear permisos (se guardaran en la bd, con el nombre del modelo-guion el verbo del permiso)
        $adminPermissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-activate',
            'rol-list',
            'rol-create',
            'rol-edit',
            'rol-delete',
            'producto-list',
            'producto-create',
            'producto-edit',
            'producto-delete',
            'pedido-list',
            'pedido-anulate'
        ];

        $clientePermissions = [
            'pedido-view',
            'pedido-cancel',
            'perfil'
        ];

        // Asignar esos permisos a los roles especificos
        foreach ($adminPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $adminRole->givePermissionTo($permission); // se asignan los permisos al rol admin
        }

        foreach ($clientePermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]);
            $clienteRole->givePermissionTo($permission);
        }

        // Crear usuarios de prueba
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@prueba.com'],
            ['name' => 'Admin', 'password' => bcrypt('admin123456')]
        );

        $adminUser->assignRole($adminRole); // Asignar el rol admin al usuario admin

        $clienteUser = User::firstOrCreate(
            ['email' => 'cliente@prueba.com'],
            ['name' => 'Cliente', 'password' => bcrypt('cliente123456')]
        );

        $clienteUser->assignRole($clienteRole); // Asignar el rol cliente al usuario cliente
    }
}
