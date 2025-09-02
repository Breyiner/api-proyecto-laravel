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
        
        $superAdmin = User::create([
            'email' => 'superadmin@example.com',
            'password' => Hash::make('Breyner.051207'),
        ]);
        $superAdmin->assignRole('Super Administrador');

        Profile::create([
            'user_id' => $superAdmin->id,
            'first_name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'city_id' => 1,
            'gender_id' => 1,
        ]);
        
        $admin = User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('Breyner.051207'),
        ]);
        $admin->assignRole('Administrador');

        Profile::create([
            'user_id' => $admin->id,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'city_id' => 2,
            'gender_id' => 2,
        ]);

    }
}
