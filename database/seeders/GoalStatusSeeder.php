<?php

namespace Database\Seeders;

use App\Models\GoalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoalStatus::create(['name' => 'Activa']);
        GoalStatus::create(['name' => 'Inactiva']);
    }
}
