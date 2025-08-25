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
        $superAdminRole = Role::findByName('Super Administrador');
        $adminRole = Role::findByName('Administrador');
        $userRole = Role::findByName('Usuario');

        $superAdminRole->givePermissionTo(Permission::all()); // Dar todos los permisos al super administrador
        $adminRole->givePermissionTo(Permission::whereNotIn('name', ['users.update-role', 'users.update'])->get());
        $userRole->givePermissionTo([
            'users.show-own', 'users.update-own-email', 'users.update-own-password'
        ]);

    }
}