<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Iconos generales
        Icon::create(['name' => 'Ingresos', 'icon' => 'ri-arrow-up-circle-line']); // flecha arriba
        Icon::create(['name' => 'Gastos', 'icon' => 'ri-arrow-down-circle-line']); // flecha abajo
        Icon::create(['name' => 'Metas', 'icon' => 'ri-flag-line']);
        
        // Iconos para categorías de ingresos
        Icon::create(['name' => 'Salario', 'icon' => 'ri-wallet-line']);
        Icon::create(['name' => 'Freelance', 'icon' => 'ri-briefcase-line']);
        Icon::create(['name' => 'Ventas', 'icon' => 'ri-store-line']);
        Icon::create(['name' => 'Inversiones', 'icon' => 'ri-line-chart-line']);
        Icon::create(['name' => 'Alquiler', 'icon' => 'ri-home-line']);
        Icon::create(['name' => 'Bonificaciones', 'icon' => 'ri-gift-line']);
        Icon::create(['name' => 'Regalos', 'icon' => 'ri-gift-2-line']);
        Icon::create(['name' => 'Reembolsos', 'icon' => 'ri-refund-line']);
        Icon::create(['name' => 'Comisiones', 'icon' => 'ri-percent-line']);
        Icon::create(['name' => 'Otros Ingresos', 'icon' => 'ri-database-line']);

        // Iconos para categorías de gastos
        Icon::create(['name' => 'Comida', 'icon' => 'ri-restaurant-line']);
        Icon::create(['name' => 'Transporte', 'icon' => 'ri-car-line']);
        Icon::create(['name' => 'Vivienda', 'icon' => 'ri-home-3-line']);
        Icon::create(['name' => 'Servicios', 'icon' => 'ri-tools-line']);
        Icon::create(['name' => 'Entretenimiento', 'icon' => 'ri-movie-line']);
        Icon::create(['name' => 'Salud', 'icon' => 'ri-heart-pulse-line']);
        Icon::create(['name' => 'Educación', 'icon' => 'ri-book-line']);
        Icon::create(['name' => 'Ropa', 'icon' => 'ri-shirt-line']);
        Icon::create(['name' => 'Tecnología', 'icon' => 'ri-computer-line']);
        Icon::create(['name' => 'Otros Gastos', 'icon' => 'ri-database-line']);
        Icon::create(['name' => 'Balance', 'icon' => 'ri-stack-line']);
    }
}
