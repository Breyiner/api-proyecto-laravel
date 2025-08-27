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
            'name' => 'Pago mensual empresa',
            'amount' => 2500000,
            'description' => 'Salario correspondiente a agosto',
            'created_at' => Carbon::create(2025, 8, 25),
        ]);

        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 2, // Freelance
            'name' => 'Proyecto freelance web',
            'amount' => 800000,
            'description' => 'Desarrollo de aplicación para cliente externo',
            'created_at' => Carbon::create(2025, 8, 10),
        ]);

        // GASTOS para Usuario 1
        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 11, // Comida
            'name' => 'Supermercado',
            'amount' => 350000,
            'description' => 'Compra mensual de mercado',
            'created_at' => Carbon::create(2025, 8, 15),
        ]);

        Transaction::create([
            'user_id' => 1,
            'transaction_category_id' => 12, // Transporte
            'name' => 'Gasolina',
            'amount' => 200000,
            'description' => 'Tanqueo para el carro en agosto',
            'created_at' => Carbon::create(2025, 9, 20),
        ]);

        // INGRESOS para Usuario 2
        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 4, // Inversiones
            'name' => 'Rendimiento CDT',
            'amount' => 600000,
            'description' => 'Ganancia mensual de CDT',
            'created_at' => Carbon::create(2025, 7, 30),
        ]);

        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 7, // Regalos
            'name' => 'Cumpleaños',
            'amount' => 150000,
            'description' => 'Dinero recibido como regalo de cumpleaños',
            'created_at' => Carbon::create(2025, 8, 5),
        ]);

        // GASTOS para Usuario 2
        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 14, // Vivienda
            'name' => 'Arriendo apartamento',
            'amount' => 1200000,
            'description' => 'Pago mensual de arriendo',
            'created_at' => Carbon::create(2025, 8, 1),
        ]);

        Transaction::create([
            'user_id' => 2,
            'transaction_category_id' => 16, // Salud
            'name' => 'Consulta médica',
            'amount' => 90000,
            'description' => 'Chequeo general en clínica',
            'created_at' => Carbon::create(2025, 8, 18),
        ]);
    }
}
