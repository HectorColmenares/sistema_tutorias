<?php

namespace App\Imports;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumnosImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected int $successCount = 0;

    public function model(array $row)
    {
        // Evita errores por espacios
        $name = isset($row['name']) ? trim((string)$row['name']) : null;
        $email = isset($row['email']) ? trim((string)$row['email']) : null;

        DB::transaction(function () use ($row, $name, $email) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make((string)($row['password'] ?? 'password123')),
                'rol' => 'alumno',
            ]);

            Alumno::create([
                'user_id' => $user->id,
                'numero_control' => trim((string)$row['numero_control']),
                'carrera' => trim((string)$row['carrera']),
                'grupo' => isset($row['grupo']) ? trim((string)$row['grupo']) : null,
                'telefono' => isset($row['telefono']) ? trim((string)$row['telefono']) : null,
            ]);
        });

        $this->successCount++;
        return null;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'numero_control' => 'required|unique:alumnos,numero_control',
            'carrera' => 'required|string',
        ];
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }
}
