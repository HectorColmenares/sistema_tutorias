<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;

class TutoresImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected int $successCount = 0;

    // ✅ Mapea nombre -> name (y otras columnas si hiciera falta)
    public function prepareForValidation($data, $index)
    {
        if (!isset($data['name']) && isset($data['nombre'])) {
            $data['name'] = $data['nombre'];
        }

        return $data;
    }

    public function model(array $row)
    {
        // ✅ Usa name como estándar
        $name = $row['name'] ?? $row['nombre'] ?? null;

        $user = User::create([
            'name' => $name,
            'email' => $row['email'] ?? null,
            'password' => Hash::make($row['password'] ?? 'password123'),
            'rol' => 'tutor',
        ]);

        Tutor::create([
            'user_id' => $user->id,
            'departamento' => $row['departamento'] ?? null,
            'cedula' => $row['cedula'] ?? null,
            'telefono' => $row['telefono'] ?? null,
        ]);

        $this->successCount++;
        return null;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }
}
