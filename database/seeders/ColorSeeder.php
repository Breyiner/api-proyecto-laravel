<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Color::create([
            'name' => 'Verde',
            'hex' => '#28a745',
        ]);

        Color::create([
            'name' => 'Rojo',
            'hex' => '#dc3545',
        ]);

        Color::create([
            'name' => 'Metas',
            'hex' => '#ffd500',
        ]);

        Color::create([
            'name' => 'Balance',
            'hex' => '#1e90ff',
        ]);
    }
}
