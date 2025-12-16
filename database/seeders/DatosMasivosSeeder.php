<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User,Alumno,Tutor,Periodo,Tutoria,Documento,Asistencia};

class DatosMasivosSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Periodo activo (si no hay)
        $periodo = Periodo::first() ?? Periodo::create([
            'nombre' => '2025-2-demo',
            'fecha_inicio' => now()->subMonths(4)->toDateString(),
            'fecha_fin' => now()->toDateString(),
            'activo' => 1,
        ]);

        // 2) Usuarios base por rol
        User::factory()->coordinador()->count(2)->create();
        $tutoresUsers = User::factory()->tutor()->count(10)->create();
        $alumnosUsers = User::factory()->alumno()->count(80)->create();

        // 3) Perfiles Tutor y Alumno (1 a 1 por user_id)
        foreach ($tutoresUsers as $u) {
            Tutor::factory()->create(['user_id' => $u->id]);
        }

        foreach ($alumnosUsers as $u) {
            Alumno::factory()->create(['user_id' => $u->id]);
        }

        // 4) Tutorías (ligadas a periodo)
        $tutorias = Tutoria::factory()->count(50)->create([
            'periodo_id' => $periodo->id,
        ]);

        // 5) ✅ Asistencias SIN duplicar (tutoria_id, alumno_user_id)
        $alumnosIds = $alumnosUsers->pluck('id');

        foreach ($tutorias as $tutoria) {
            // elige N alumnos únicos para ESTA tutoría
            $idsElegidos = $alumnosIds->shuffle()->take(rand(5, 20));

            foreach ($idsElegidos as $alumnoId) {
                Asistencia::updateOrCreate(
                    [
                        'tutoria_id' => $tutoria->id,
                        'alumno_user_id' => $alumnoId,
                    ],
                    [
                        'estado' => 'pendiente',
                        'confirmado_por_user_id' => null,
                        'confirmado_en' => null,
                    ]
                );
            }
        }

        // 6) Documentos (ligados a periodo)
        Documento::factory()->count(120)->create([
            'periodo_id' => $periodo->id,
        ]);
    }
}
