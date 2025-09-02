<?php

namespace Database\Seeders;

use App\Models\GoalTransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoalTransactionType::create(['name' => 'Ingresos', 'color_id' => 2, 'icon_id'=> 3]);
        GoalTransactionType::create(['name' => 'Egresos', 'color_id' => 1, 'icon_id'=> 3]);
    }
}
