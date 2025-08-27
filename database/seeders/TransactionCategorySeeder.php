<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CATEGORÍAS DE INGRESOS (transaction_type_id = 1)
        TransactionCategory::create(['name' => 'Salario', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Freelance', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Ventas', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Inversiones', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Alquiler', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Bonificaciones', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Regalos', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Reembolsos', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Comisiones', 'transaction_type_id' => 1]);
        TransactionCategory::create(['name' => 'Otros Ingresos', 'transaction_type_id' => 1]);

        // CATEGORÍAS DE GASTOS (transaction_type_id = 2)
        TransactionCategory::create(['name' => 'Comida', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Transporte', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Vivienda', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Servicios', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Entretenimiento', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Salud', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Educación', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Ropa', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Tecnología', 'transaction_type_id' => 2]);
        TransactionCategory::create(['name' => 'Otros Gastos', 'transaction_type_id' => 2]);
    }
}
