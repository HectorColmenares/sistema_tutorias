<?php

namespace Database\Factories;

use App\Models\Tutoria;
use App\Models\Periodo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TutoriaFactory extends Factory
{
    protected $model = Tutoria::class;

    public function definition(): array
    {
        return [
            'periodo_id' => Periodo::query()->inRandomOrder()->value('id') ?? Periodo::factory()->create()->id,
            'tutor_user_id' => User::query()->where('rol','tutor')->inRandomOrder()->value('id')
                ?? User::factory()->tutor()->create()->id,
            'calendario_sesion_id' => null,
            'fecha' => fake()->date(),
            'tema' => fake()->sentence(4),
            'qr_token' => (string) Str::uuid(),
            'estado' => fake()->randomElement(['activa','cerrada']),
        ];
    }
}
