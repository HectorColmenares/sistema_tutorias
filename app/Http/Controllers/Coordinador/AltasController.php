<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AltasController extends Controller
{
    public function index()
    {
        return view('coordinador.altas.index');
    }

    // ====== TUTOR ======
    public function createTutor()
    {
        return view('coordinador.altas.create_tutor');
    }

    public function storeTutor(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'password' => ['required','string','min:8','confirmed'],

            // campos de tutores (ajusta si tu tabla tiene otros)
            'departamento' => ['nullable','string','max:255'],
            'cedula' => ['nullable','string','max:255'],
            'telefono' => ['nullable','string','max:50'],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol' => 'tutor',
            ]);

            Tutor::create([
                'user_id' => $user->id,
                'departamento' => $data['departamento'] ?? null,
                'cedula' => $data['cedula'] ?? null,
                'telefono' => $data['telefono'] ?? null,
            ]);
        });

        return redirect()->route('coordinador.altas.index')->with('status', 'Tutor creado correctamente.');
    }

    // ====== ALUMNO ======
    public function createAlumno()
    {
        return view('coordinador.altas.create_alumno');
    }

    public function storeAlumno(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'password' => ['required','string','min:8','confirmed'],

            // campos de alumnos (ajusta si tu tabla tiene otros)
            'numero_control' => ['required','string','max:50', Rule::unique('alumnos','numero_control')],
            'carrera' => ['required','string','max:255'],
            'grupo' => ['nullable','string','max:10'],
            'telefono' => ['nullable','string','max:50'],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol' => 'alumno',
            ]);

            Alumno::create([
                'user_id' => $user->id,
                'numero_control' => $data['numero_control'],
                'carrera' => $data['carrera'],
                'grupo' => $data['grupo'] ?? null,
                'telefono' => $data['telefono'] ?? null,
            ]);
        });

        return redirect()->route('coordinador.altas.index')->with('status', 'Alumno creado correctamente.');
    }

    // ====== PASSWORD ======
    public function editPassword()
    {
        return view('coordinador.altas.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email', 'exists:users,email'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        User::where('email', $data['email'])->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('coordinador.altas.index')->with('status', 'Contraseña actualizada correctamente.');
    }
}
