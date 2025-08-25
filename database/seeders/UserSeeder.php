<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('Administrador');

        Profile::create([
            'user_id' => $admin->id,
            'name' => 'Admin',
            'last_name' => 'Admin',
        ]);

        $superAdmin = User::create([
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('Super Administrador');

        Profile::create([
            'user_id' => $superAdmin->id,
            'name' => 'Super Admin',
            'last_name' => 'Super Admin',
        ]);
    }
}
