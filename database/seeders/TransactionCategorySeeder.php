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
        TransactionCategory::create(['name' => 'Salario', 'transaction_type_id' => 1, 'icon_id' => 4]);
        TransactionCategory::create(['name' => 'Freelance', 'transaction_type_id' => 1, 'icon_id' => 5]);
        TransactionCategory::create(['name' => 'Ventas', 'transaction_type_id' => 1, 'icon_id' => 6]);
        TransactionCategory::create(['name' => 'Inversiones', 'transaction_type_id' => 1, 'icon_id' => 7]);
        TransactionCategory::create(['name' => 'Alquiler', 'transaction_type_id' => 1, 'icon_id' => 8]);
        TransactionCategory::create(['name' => 'Bonificaciones', 'transaction_type_id' => 1, 'icon_id' => 9]);
        TransactionCategory::create(['name' => 'Regalos', 'transaction_type_id' => 1, 'icon_id' => 10]);
        TransactionCategory::create(['name' => 'Reembolsos', 'transaction_type_id' => 1, 'icon_id' => 11]);
        TransactionCategory::create(['name' => 'Comisiones', 'transaction_type_id' => 1, 'icon_id' => 12]);
        TransactionCategory::create(['name' => 'Otros Ingresos', 'transaction_type_id' => 1, 'icon_id' => 13]);

        // CATEGORÍAS DE GASTOS (transaction_type_id = 2)
        TransactionCategory::create(['name' => 'Comida', 'transaction_type_id' => 2, 'icon_id' => 14]);
        TransactionCategory::create(['name' => 'Transporte', 'transaction_type_id' => 2, 'icon_id' => 15]);
        TransactionCategory::create(['name' => 'Vivienda', 'transaction_type_id' => 2, 'icon_id' => 16]);
        TransactionCategory::create(['name' => 'Servicios', 'transaction_type_id' => 2, 'icon_id' => 17]);
        TransactionCategory::create(['name' => 'Entretenimiento', 'transaction_type_id' => 2, 'icon_id' => 18]);
        TransactionCategory::create(['name' => 'Salud', 'transaction_type_id' => 2, 'icon_id' => 19]);
        TransactionCategory::create(['name' => 'Educación', 'transaction_type_id' => 2, 'icon_id' => 20]);
        TransactionCategory::create(['name' => 'Ropa', 'transaction_type_id' => 2, 'icon_id' => 21]);
        TransactionCategory::create(['name' => 'Tecnología', 'transaction_type_id' => 2, 'icon_id' => 22]);
        TransactionCategory::create(['name' => 'Otros Gastos', 'transaction_type_id' => 2, 'icon_id' => 23]);
    }
}
