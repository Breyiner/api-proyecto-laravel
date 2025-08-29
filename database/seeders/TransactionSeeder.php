<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INGRESOS para Usuario 1
        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 1, // Salario
            'name' => 'Recibiste dinero por Salario',
            'amount' => 2500000,
            'description' => 'Salario correspondiente a agosto',
            'created_at' => Carbon::create(2025, 8, 25),
        ]);

        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 2, // Freelance
            'name' => 'Recibiste dinero por Freelance',
            'amount' => 800000,
            'description' => 'Desarrollo de aplicación para cliente externo',
            'created_at' => Carbon::create(2025, 8, 10),
        ]);

        // GASTOS para Usuario 1
        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 11, // Comida
            'name' => 'Gastaste dinero en Comida',
            'amount' => 350000,
            'description' => 'Compra mensual de mercado',
            'created_at' => Carbon::create(2025, 8, 15),
        ]);

        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 12, // Transporte
            'name' => 'Gastaste dinero en Transporte',
            'amount' => 200000,
            'description' => 'Tanqueo para el carro en agosto',
            'created_at' => Carbon::create(2025, 9, 20),
        ]);

        // INGRESOS para Usuario 2
        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 4, // Inversiones
            'name' => 'Recibiste dinero por inversiones',
            'amount' => 600000,
            'description' => 'Ganancia mensual de CDT',
            'created_at' => Carbon::create(2025, 7, 30),
        ]);

        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 7, // Regalos
            'name' => 'Recibiste dinero por Regalos',
            'amount' => 150000,
            'description' => 'Dinero recibido como regalo de cumpleaños',
            'created_at' => Carbon::create(2025, 8, 5),
        ]);

        // GASTOS para Usuario 2
        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 14, // Vivienda
            'name' => 'Gastaste dinero en Vivienda',
            'amount' => 1200000,
            'description' => 'Pago mensual de arriendo',
            'created_at' => Carbon::create(2025, 8, 1),
        ]);

        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 16, // Salud
            'name' => 'Gastaste dinero en Salud',
            'amount' => 90000,
            'description' => 'Chequeo general en clínica',
            'created_at' => Carbon::create(2025, 8, 18),
        ]);
    }
}
