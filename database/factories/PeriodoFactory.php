<?php

namespace Database\Factories;

use App\Models\Periodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodoFactory extends Factory
{
    protected $model = Periodo::class;

    public function definition(): array
    {
        $inicio = fake()->dateTimeBetween('-1 year', 'now');
        $fin = (clone $inicio)->modify('+4 months');

        return [
            'nombre' => fake()->unique()->numerify('202#-#'),
            'fecha_inicio' => $inicio->format('Y-m-d'),
            'fecha_fin' => $fin->format('Y-m-d'),
            'activo' => 0,
        ];
    }

    public function activo(): static
    {
        return $this->state(fn() => ['activo' => 1]);
    }
}
