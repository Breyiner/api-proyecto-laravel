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

        // Super Administrador: todos los permisos
        $superAdminRole->syncPermissions(Permission::all());

        // Administrador: todos menos los recursos de super-administrador (super-admin.* y super-admin.access)
        $adminRole->syncPermissions(
            Permission::whereNotIn('name', [
                'super-admin', 'super-admin.access',
                'permissions.access', 'roles.access',
                'cities.access', 'genders.access', 'colors.access', 'statuses.access', 
                'goal-statuses.access', 'transaction-types.access', 'goal-transaction-types.access', 
                'transaction-categories.access'
            ])->get()
        );

        // Usuario: todos los index de vistas, store de goals/transactions, access, own/show y permisos propios
        $userRole->syncPermissions([
            // Index de vistas
            'goals.index', 'transactions.index',
            'cities.index', 'transaction-categories.index', 'transaction-types.index', 'genders.index',

            // Store de goals y transactions
            'goals.store', 'transactions.store','goal-transactions.store',

            // access de vistas
            'home.access', 'profile.access', 'calendar.access', 'user',
            'goals.access',

            // Own y Show
            'goals.show-own', 'transactions.show-own', 'goals.show', 'transactions.show','goal-transactions.show-own',
            'goal-transactions.index-own','goals.index-own','balance.show-own','transactions.index-own','goal-transactions.show-own','transaction-categories.index-own','profiles.show-own',
            
            // Permisos propios del usuario
            'users.show-own', 'users.update-own-email', 'users.update-own-password', 'profiles.update-own'
        ]);

    }
}