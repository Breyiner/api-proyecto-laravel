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
        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.store']);
        Permission::create(['name' => 'usuarios.update']);
        Permission::create(['name' => 'usuarios.destroy']);
    }
}
