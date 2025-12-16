<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => null,
            'password' => bcrypt('password'),
            'rol' => fake()->randomElement(['coordinador','tutor','alumno']),
            'activo' => 1,
            'telefono' => fake()->optional()->numerify('##########'),
            'remember_token' => Str::random(10),
        ];
    }

    public function alumno(): static
    {
        return $this->state(fn() => ['rol' => 'alumno']);
    }

    public function tutor(): static
    {
        return $this->state(fn() => ['rol' => 'tutor']);
    }

    public function coordinador(): static
    {
        return $this->state(fn() => ['rol' => 'coordinador']);
    }
}
