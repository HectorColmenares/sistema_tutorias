<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Alumno;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        // COORDINADOR
        $coord = User::updateOrCreate(
            ['email' => 'coord@demo.com'],
            [
                'name' => 'Coordinador Demo',
                'password' => Hash::make('password'),
                'rol' => 'coordinador', // ajusta si tu campo se llama distinto
            ]
        );

        // TUTOR
        $tutorUser = User::updateOrCreate(
            ['email' => 'tutor@demo.com'],
            [
                'name' => 'Tutor Demo',
                'password' => Hash::make('password'),
                'rol' => 'tutor',
            ]
        );

        Tutor::updateOrCreate(
            ['user_id' => $tutorUser->id],
            [
                'departamento' => 'Sistemas',
                'cedula' => 'TUT-123',
            ]
        );

        // ALUMNO
        // ALUMNO
$alumnoUser = User::updateOrCreate(
    ['email' => 'alumno@demo.com'],
    [
        'name' => 'Alumno Demo',
        'password' => Hash::make('password'),
        'rol' => 'alumno',
    ]
);

Alumno::updateOrCreate(
    ['user_id' => $alumnoUser->id],
    [
        'numero_control' => '20123456', // ✔ nombre correcto
        'carrera' => 'ISC',
        'grupo' => '5A',               // ✔ sí existe
    ]
);
    }
}
