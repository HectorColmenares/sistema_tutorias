<?php

namespace Database\Factories;

use App\Models\Asistencia;
use App\Models\Tutoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsistenciaFactory extends Factory
{
    protected $model = Asistencia::class;

    public function definition(): array
    {
        $estado = fake()->randomElement(['pendiente','asistio','falto','permiso_aprobado','permiso_rechazado']);

        return [
            'tutoria_id' => Tutoria::query()->inRandomOrder()->value('id') ?? Tutoria::factory()->create()->id,
            'alumno_user_id' => User::query()->where('rol','alumno')->inRandomOrder()->value('id')
                ?? User::factory()->alumno()->create()->id,
            'estado' => $estado,
            'confirmado_por_user_id' => in_array($estado, ['asistio','falto','permiso_aprobado','permiso_rechazado'])
                ? User::query()->whereIn('rol',['tutor','coordinador'])->inRandomOrder()->value('id')
                : null,
            'confirmado_en' => in_array($estado, ['asistio','falto','permiso_aprobado','permiso_rechazado'])
                ? now()
                : null,
        ];
    }
}
