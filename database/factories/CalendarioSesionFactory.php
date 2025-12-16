<?php

namespace Database\Factories;

use App\Models\CalendarioSesion;
use App\Models\Periodo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarioSesionFactory extends Factory
{
    protected $model = CalendarioSesion::class;

    public function definition(): array
    {
        $fecha = fake()->dateTimeBetween('-2 months', '+2 months')->format('Y-m-d');

        return [
            'periodo_id' => Periodo::query()->inRandomOrder()->value('id') ?? Periodo::factory()->create()->id,
            'numero_sesion' => fake()->numberBetween(1, 16),
            'fecha_programada' => $fecha,
            'fecha_reprogramada' => null,
            'motivo_reprogramacion' => null,
            'reprogramada_por_user_id' => null,
        ];
    }
}
