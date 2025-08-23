<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findByName('Administrador');
        $userRole = Role::findByName('Usuario');

        $adminRole->givePermissionTo(Permission::all()); // Dar todos los permisos administrador
        $userRole->givePermissionTo('usuarios.index');   // Dar permiso de listar al usuario

    }
}
