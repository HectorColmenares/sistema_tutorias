<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\GrupoTutor;
use App\Models\Periodo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GruposTutoresController extends Controller
{
    public function index()
    {
        $periodoActivo = Periodo::where('activo', 1)->first();

        // Si aún no hay periodo activo, evitamos errores
        if (!$periodoActivo) {
            return view('coordinador.grupos.index', [
                'periodoActivo' => null,
                'tutores' => collect(),
                'grupos' => collect(),
                'asignaciones' => collect(),
                'alumnosPorGrupo' => collect(),
            ])->with('warning', 'No hay un periodo activo. Activa uno para poder asignar grupos.');
        }

        $tutores = User::query()
            ->where('rol', 'tutor')
            ->where('activo', 1)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        // Lista de grupos existentes desde alumnos.grupo
        $grupos = Alumno::query()
            ->select('grupo')
            ->whereNotNull('grupo')
            ->distinct()
            ->orderBy('grupo')
            ->pluck('grupo');

        // Conteo de alumnos por grupo
        $alumnosPorGrupo = Alumno::query()
            ->selectRaw('grupo, COUNT(*) as total')
            ->groupBy('grupo')
            ->pluck('total', 'grupo');

        $asignaciones = GrupoTutor::query()
            ->with(['tutor:id,name,email'])
            ->where('periodo_id', $periodoActivo->id)
            ->orderBy('grupo')
            ->get();

        return view('coordinador.grupos.index', compact(
            'periodoActivo',
            'tutores',
            'grupos',
            'asignaciones',
            'alumnosPorGrupo'
        ));
    }

    public function store(Request $request)
    {
        $periodoActivo = Periodo::where('activo', 1)->firstOrFail();

        // Para validar que el grupo existe “de verdad” en alumnos
        $gruposValidos = Alumno::query()
            ->select('grupo')
            ->whereNotNull('grupo')
            ->distinct()
            ->pluck('grupo')
            ->toArray();

        $data = $request->validate([
            'tutor_user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where(fn ($q) => $q->where('rol', 'tutor')),
            ],
            'grupo' => [
                'required',
                'string',
                'max:5',
                Rule::in($gruposValidos),
            ],
        ], [
            'grupo.in' => 'El grupo seleccionado no existe en alumnos.',
        ]);

        // Regla: 1 grupo por periodo tiene 1 tutor. Si ya existía, lo “reasignamos”.
        GrupoTutor::updateOrCreate(
            [
                'periodo_id' => $periodoActivo->id,
                'grupo' => $data['grupo'],
            ],
            [
                'tutor_user_id' => $data['tutor_user_id'],
            ]
        );

        return redirect()
            ->route('coordinador.grupos.index')
            ->with('success', 'Asignación guardada: el tutor quedó a cargo del grupo ' . $data['grupo'] . '.');
    }

    public function destroy(GrupoTutor $grupoTutor)
    {
        $grupoTutor->delete();

        return redirect()
            ->route('coordinador.grupos.index')
            ->with('success', 'Asignación eliminada.');
    }

    public function show(GrupoTutor $grupoTutor)
    {
        // (Opcional) Si quieres validar periodo activo, puedes descomentar esto:
        // $periodoActivo = Periodo::where('activo', 1)->first();
        // if (!$periodoActivo || $grupoTutor->periodo_id !== $periodoActivo->id) {
        //     return redirect()->route('coordinador.grupos.index')
        //         ->with('warning', 'Esa asignación no pertenece al periodo activo.');
        // }

        // Cargar tutor y periodo para mostrar en la vista
        $grupoTutor->load(['tutor:id,name,email', 'periodo:id,nombre']);

        // ✅ CORRECTO: alumnos del grupo + su user, sin columnas inexistentes
        $alumnos = Alumno::query()
            ->with(['user:id,name,email'])
            ->where('grupo', $grupoTutor->grupo)
            ->get()
            // ✅ Ordenar por el nombre del usuario (PHP, no SQL)
            ->sortBy(fn ($al) => $al->user->name ?? '')
            ->values(); // reindexa 0..n

        return view('coordinador.grupos.show', [
            'grupoTutor' => $grupoTutor,
            'alumnos' => $alumnos,
        ]);
    }
}
