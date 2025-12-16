<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documento;
use App\Models\Periodo;
use App\Models\User;

class DocumentosSeeder extends Seeder
{
    public function run(): void
    {
        $periodo = Periodo::first();
        $tutorUser = User::where('email', 'tutor@demo.com')->first();
        $alumnoUser = User::where('email', 'alumno@demo.com')->first();

        if (!$periodo || !$tutorUser || !$alumnoUser) {
            return;
        }

        Documento::create([
            'periodo_id' => $periodo->id,
            'tipo' => 'constancia',
            'nombre_original' => 'constancia_demo.pdf',
            'ruta_archivo' => 'documentos/constancia_demo.pdf',
            'subido_por_user_id' => $tutorUser->id,
            'tutor_user_id' => $tutorUser->id,
            'alumno_user_id' => $alumnoUser->id,
        ]);
    }
}
