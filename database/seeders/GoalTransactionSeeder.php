<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoalTransaction;

class GoalTransactionSeeder extends Seeder
{
    public function run()
    {
        // meta 1
        GoalTransaction::create([
            'goal_id' => 1,
            'name' => 'Ingresaste dinero a la meta',
            'amount' => 500000,
            'description' => 'Ingreso inicial de ahorro',
            'transaction_type_id' => 1, // Ingreso
        ]);

        GoalTransaction::create([
            'goal_id' => 1,
            'name' => 'Retiraste dinero de la meta',
            'amount' => 150000,
            'description' => 'Compra de materiales',
            'transaction_type_id' => 2, // Egreso
        ]);

        // meta 2
        GoalTransaction::create([
            'goal_id' => 2,
            'name' => 'Ingresaste dinero a la meta',
            'amount' => 200000,
            'description' => 'Abono quincenal',
            'transaction_type_id' => 1, // Ingreso
        ]);

        GoalTransaction::create([
            'goal_id' => 2,
            'name' => 'Retiraste dinero de la meta',
            'amount' => 50000,
            'description' => 'Gasto en transporte',
            'transaction_type_id' => 2, // Egreso
        ]);
    }
}