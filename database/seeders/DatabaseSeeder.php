<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            IconSeeder::class,
            StatusSeeder::class,
            CitySeeder::class,
            GenderSeeder::class,
            ColorSeeder::class,
            UserSeeder::class,
            TransactionTypeSeeder::class,
            TransactionCategorySeeder::class,
            TransactionSeeder::class,
            GoalStatusSeeder::class,
            GoalSeeder::class,
            GoalTransactionTypeSeeder::class,
            GoalTransactionSeeder::class,
        ]);
    }
}
