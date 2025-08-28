<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goal::create([
            'user_id' => 1,
            'name' => 'Comprar apartamento',
            'target_amount' => 150000000,
            'description' => 'Ahorrar para la cuota inicial de un apartamento de 2 habitaciones en el norte de la ciudad',
            'due_date' => '2025-12-31',
        ]);

        Goal::create([
            'user_id' => 1,
            'name' => 'Vacaciones en Europa',
            'target_amount' => 8000000,
            'description' => 'Viaje familiar a España, Francia e Italia por 15 días durante las vacaciones de mitad de año',
            'due_date' => '2025-06-15',
            'completed' => true,
        ]);

        Goal::create([
            'user_id' => 2,
            'name' => 'Fondo de emergencia',
            'target_amount' => 12000000,
            'description' => 'Crear un fondo de emergencia que cubra 6 meses de gastos familiares',
            'due_date' => '2025-08-30',
        ]);

        Goal::create([
            'user_id' => 2,
            'name' => 'Carro nuevo',
            'target_amount' => 45000000,
            'description' => 'Ahorrar para comprar un vehículo familiar, preferiblemente SUV o crossover',
            'due_date' => '2026-03-15',
        ]);

        Goal::create([
            'user_id' => 2,
            'name' => 'Curso de inglés',
            'target_amount' => 2500000,
            'description' => 'Pagar curso intensivo de inglés de 6 meses en instituto reconocido',
            'due_date' => '2025-02-28',
            'status_id' => 2,
        ]);

        Goal::create([
            'user_id' => 1,
            'name' => 'Renovar cocina',
            'target_amount' => 18000000,
            'description' => 'Remodelar completamente la cocina con nuevos electrodomésticos y muebles',
            'due_date' => '2025-10-15',
        ]);

        Goal::create([
            'user_id' => 2,
            'name' => 'Inversión en CDT',
            'target_amount' => 25000000,
            'description' => 'Ahorrar para invertir en certificados de depósito a término de alto rendimiento',
            'due_date' => '2025-09-30',
        ]);
    }
}
