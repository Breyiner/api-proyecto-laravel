<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            RolePermissionSeeder::class,
            StatusSeeder::class,
            CitySeeder::class,
            GenderSeeder::class,
            UserSeeder::class,
            TransactionTypeSeeder::class,
            TransactionCategorySeeder::class,
        ]);
    }
}
