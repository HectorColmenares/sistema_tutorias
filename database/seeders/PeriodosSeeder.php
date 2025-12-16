<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodosSeeder extends Seeder
{
    public function run(): void
    {
        Periodo::updateOrCreate(
            ['nombre' => '2025-2'], // ajusta si tu campo es otro
            [
                'fecha_inicio' => '2025-08-01',
                'fecha_fin' => '2025-12-15',
                'activo' => 1,
            ]
        );
    }
}
