<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permisos sobre usuarios
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.show-own']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.update-role']);
        Permission::create(['name' => 'users.update-own-email']);
        Permission::create(['name' => 'users.update-own-password']);
        Permission::create(['name' => 'users.destroy']);

        // Permisos sobre estados de usuarios
        Permission::create(['name' => 'statuses.index']);
        Permission::create(['name' => 'statuses.show']);
        Permission::create(['name' => 'statuses.store']);
        Permission::create(['name' => 'statuses.update']);
        Permission::create(['name' => 'statuses.destroy']);

        //Permisos sobre ciudades
        Permission::create(['name' => 'cities.index']);
        Permission::create(['name' => 'cities.show']);
        Permission::create(['name' => 'cities.store']);
        Permission::create(['name' => 'cities.update']);
        Permission::create(['name' => 'cities.destroy']);

        //Permisos sobre generos
        Permission::create(['name' => 'genders.index']);
        Permission::create(['name' => 'genders.show']);
        Permission::create(['name' => 'genders.store']);
        Permission::create(['name' => 'genders.update']);
        Permission::create(['name' => 'genders.destroy']);

        //Permisos sobre colores
        Permission::create(['name' => 'colors.index']);
        Permission::create(['name' => 'colors.show']);
        Permission::create(['name' => 'colors.store']);
        Permission::create(['name' => 'colors.update']);
        Permission::create(['name' => 'colors.destroy']);

        //Permisos sobre perfiles
        Permission::create(['name' => 'profiles.index']);
        Permission::create(['name' => 'profiles.show']);
        Permission::create(['name' => 'profiles.show-own']);
        Permission::create(['name' => 'profiles.show-user']);
        Permission::create(['name' => 'profiles.store']);
        Permission::create(['name' => 'profiles.update']);
        Permission::create(['name' => 'profiles.update-own']);

        //Permisos sobre tipos de movimientos
        Permission::create(['name' => 'transaction-types.index']);
        Permission::create(['name' => 'transaction-types.show']);
        Permission::create(['name' => 'transaction-types.store']);
        Permission::create(['name' => 'transaction-types.update']);
        Permission::create(['name' => 'transaction-types.destroy']);

        //Permisos sobre categorias de movimientos
        Permission::create(['name' => 'transaction-categories.index']);
        Permission::create(['name' => 'transaction-categories.index-own']);
        Permission::create(['name' => 'transaction-categories.show']);
        Permission::create(['name' => 'transaction-categories.store']);
        Permission::create(['name' => 'transaction-categories.update']);
        Permission::create(['name' => 'transaction-categories.destroy']);
        
        //Permisos sobre movimientos
        Permission::create(['name' => 'transactions.index']);
        Permission::create(['name' => 'transactions.index-own']);
        Permission::create(['name' => 'transactions.show']);
        Permission::create(['name' => 'transactions.show-own']);
        Permission::create(['name' => 'transactions.store']);
        Permission::create(['name' => 'transactions.update']);
        Permission::create(['name' => 'transactions.destroy']);

        // Permisos sobre estados de metas
        Permission::create(['name' => 'goal-statuses.index']);
        Permission::create(['name' => 'goal-statuses.show']);
        Permission::create(['name' => 'goal-statuses.store']);
        Permission::create(['name' => 'goal-statuses.update']);
        Permission::create(['name' => 'goal-statuses.destroy']);

        // Permisos sobre estados metas
        Permission::create(['name' => 'goals.index']);
        Permission::create(['name' => 'goals.index-own']);
        Permission::create(['name' => 'goals.show']);
        Permission::create(['name' => 'goals.show-own']);
        Permission::create(['name' => 'goals.store']);
        Permission::create(['name' => 'goals.update']);
        Permission::create(['name' => 'goals.destroy']);
        Permission::create(['name' => 'goals.destroy-safe']);

        //Permisos sobre tipos de movimientos de metas
        Permission::create(['name' => 'goal-transaction-types.index']);
        Permission::create(['name' => 'goal-transaction-types.show']);
        Permission::create(['name' => 'goal-transaction-types.store']);
        Permission::create(['name' => 'goal-transaction-types.update']);
        Permission::create(['name' => 'goal-transaction-types.destroy']);

        //Permisos sobre movimientos metas
        Permission::create(['name' => 'goal-transactions.index']);
        Permission::create(['name' => 'goal-transactions.index-own']);
        Permission::create(['name' => 'goal-transactions.show']);
        Permission::create(['name' => 'goal-transactions.show-own']);
        Permission::create(['name' => 'goal-transactions.store']);
        Permission::create(['name' => 'goal-transactions.update']);
        Permission::create(['name' => 'goal-transactions.destroy']);

        //Permisos balance
        Permission::create(['name' => 'balance.show']);
        Permission::create(['name' => 'balance.show-own']);

    }
}
