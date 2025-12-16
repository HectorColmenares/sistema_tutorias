<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\Periodo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoFactory extends Factory
{
    protected $model = Documento::class;

    public function definition(): array
    {
        $tutorId = User::query()->where('rol','tutor')->inRandomOrder()->value('id')
            ?? User::factory()->tutor()->create()->id;

        $alumnoId = User::query()->where('rol','alumno')->inRandomOrder()->value('id')
            ?? User::factory()->alumno()->create()->id;

        return [
            'periodo_id' => Periodo::query()->inRandomOrder()->value('id') ?? Periodo::factory()->create()->id,
            'tipo' => fake()->randomElement(['REAC','RESA','PAT','INFORME','CONSTANCIA']),
            'nombre_original' => fake()->word().'.pdf',
            'ruta_archivo' => 'documentos/'.fake()->uuid().'.pdf',
            'subido_por_user_id' => $tutorId, // quien sube (tutor en tu caso)
            'tutor_user_id' => $tutorId,
            'alumno_user_id' => $alumnoId,
        ];
    }
}
