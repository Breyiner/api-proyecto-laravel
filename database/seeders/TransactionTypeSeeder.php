<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionType::create(['name' => 'Ingresos', 'color_id' => 1, 'icon_id'=> 1]);
        TransactionType::create(['name' => 'Gastos', 'color_id' => 2, 'icon_id'=> 2]);
    }
}
