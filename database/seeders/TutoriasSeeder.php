<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tutoria;
use App\Models\Periodo;
use App\Models\User;
use Illuminate\Support\Str;

class TutoriasSeeder extends Seeder
{
    public function run(): void
    {
        $periodo = Periodo::first();
        $tutorUser = User::where('email', 'tutor@demo.com')->first();

        if (!$periodo || !$tutorUser) {
            return;
        }

        Tutoria::create([
            'periodo_id' => $periodo->id,
            'tutor_user_id' => $tutorUser->id,
            'calendario_sesion_id' => null, // o pon un id válido si ya lo siembras
            'fecha' => now()->toDateString(),
            'tema' => 'Primera tutoría de prueba',
            'qr_token' => Str::uuid()->toString(),
            'estado' => 'activa', // ajusta si tu sistema usa otros valores
        ]);
    }
}
