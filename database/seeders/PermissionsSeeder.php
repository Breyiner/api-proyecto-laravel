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

        // Permisos sobre estados
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

        //Permisos sobre perfiles
        Permission::create(['name' => 'profiles.index']);
        Permission::create(['name' => 'profiles.show']);
        Permission::create(['name' => 'profiles.show-own']);
        Permission::create(['name' => 'profiles.show-user']);
        Permission::create(['name' => 'profiles.store']);
        Permission::create(['name' => 'profiles.update']);
        Permission::create(['name' => 'profiles.update-own']);
    }
}
