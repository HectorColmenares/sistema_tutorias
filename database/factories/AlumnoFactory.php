<?php

namespace Database\Factories;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    protected $model = Alumno::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->alumno(),
            'carrera' => fake()->randomElement(['ISC','II','ITIC','IGE','IM']),
            'grupo' => strtoupper(fake()->randomLetter()) . fake()->numberBetween(1,9),
            'numero_control' => fake()->unique()->numerify('20######'),
        ];
    }
}
