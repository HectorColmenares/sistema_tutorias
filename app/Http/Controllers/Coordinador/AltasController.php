<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Imports\AlumnosImport;
use App\Imports\TutoresImport;
use App\Models\Alumno;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'departamento' => ['nullable', 'string', 'max:255'],
            'cedula' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:50'],
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

        return redirect()
            ->route('coordinador.altas.index')
            ->with('status', 'Tutor creado correctamente.');
    }

    // ====== ALUMNO ======
    public function createAlumno()
    {
        return view('coordinador.altas.create_alumno');
    }

    public function storeAlumno(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'numero_control' => ['required', 'string', 'max:50', Rule::unique('alumnos', 'numero_control')],
            'carrera' => ['required', 'string', 'max:255'],
            'grupo' => ['nullable', 'string', 'max:10'],
            'telefono' => ['nullable', 'string', 'max:50'],
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

        return redirect()
            ->route('coordinador.altas.index')
            ->with('status', 'Alumno creado correctamente.');
    }

    // ====== PASSWORD ======
    public function editPassword()
    {
        return view('coordinador.altas.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::where('email', $data['email'])->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('coordinador.altas.index')
            ->with('status', 'Contraseña actualizada correctamente.');
    }

    // ====== IMPORT EXCEL ======
    public function importAlumnos(Request $request)
    {
        $request->validate([
            'archivo' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        $import = new AlumnosImport();
        Excel::import($import, $request->file('archivo'));

        $ok = $import->getSuccessCount();
        $failures = $import->failures();
        $fail = count($failures);

        return redirect()
            ->route('coordinador.altas.index')
            ->with('status', "Importación alumnos: $ok creados, $fail con error.")
            ->with('import_failures', $failures);
    }

    public function importTutores(Request $request)
    {
        $request->validate([
            'archivo' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        $import = new TutoresImport();
        Excel::import($import, $request->file('archivo'));

        $ok = $import->getSuccessCount();
        $failures = $import->failures();
        $fail = count($failures);

        return redirect()
            ->route('coordinador.altas.index')
            ->with('status', "Importación tutores: $ok creados, $fail con error.")
            ->with('import_failures', $failures);
    }
}
