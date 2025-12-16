<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Models\SesionTutoria;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarizacionController extends Controller
{
    public function index()
    {
        $periodos = Periodo::orderByDesc('id')->get();

        // ✅ si no viene periodo_id, toma el primero
        $periodoId = request('periodo_id') ?? $periodos->first()?->id;

        $sesiones = collect();
        if ($periodoId) {
            $sesiones = SesionTutoria::where('periodo_id', $periodoId)
                ->orderBy('numero')
                ->get();
        }

        return view('coordinador.calendarizacion.index', compact('periodos', 'periodoId', 'sesiones'));
    }

    public function generar16(Request $request)
    {
        $data = $request->validate([
            'periodo_id' => ['required', 'exists:periodos,id'],
        ]);

        DB::transaction(function () use ($data) {
            for ($i = 1; $i <= 16; $i++) {
                SesionTutoria::firstOrCreate(
                    ['periodo_id' => $data['periodo_id'], 'numero' => $i],
                    [
                        'titulo' => "Sesión $i",
                        'descripcion' => null,
                        'fecha' => null,
                        'hora_inicio' => null,
                        'hora_fin' => null,
                    ]
                );
            }
        });

        return back()->with('status', 'Se generaron (o ya existían) las 16 sesiones para el periodo seleccionado.');
    }

    // ✅ Guardar cambios masivos por periodo
    public function updatePeriodo(Request $request, Periodo $periodo)
    {
        $data = $request->validate([
            'sesiones' => ['required', 'array'],
            'sesiones.*.id' => ['required', 'integer', 'exists:sesiones_tutorias,id'],
            'sesiones.*.fecha' => ['nullable', 'date'],
            'sesiones.*.hora_inicio' => ['nullable', 'date_format:H:i'],
            'sesiones.*.hora_fin' => ['nullable', 'date_format:H:i'],
            'sesiones.*.titulo' => ['nullable', 'string', 'max:255'],
            'sesiones.*.descripcion' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data, $periodo) {
            foreach ($data['sesiones'] as $row) {

                // ✅ asegura que la sesión pertenezca al periodo seleccionado
                $sesion = SesionTutoria::where('periodo_id', $periodo->id)
                    ->where('id', $row['id'])
                    ->firstOrFail();

                $sesion->update([
                    'fecha' => $row['fecha'] ?? null,
                    'hora_inicio' => $row['hora_inicio'] ?? null,
                    'hora_fin' => $row['hora_fin'] ?? null,
                    'titulo' => $row['titulo'] ?? null,
                    'descripcion' => $row['descripcion'] ?? null,
                ]);
            }
        });

        return back()->with('status', 'Calendarización guardada correctamente.');
    }

    // ✅ eliminar una sesión (y reordenar si quieres)
    public function destroy(SesionTutoria $sesion)
    {
        $periodoId = $sesion->periodo_id;

        $sesion->delete();

        // (opcional) reenumerar para que queden 1..n sin huecos:
        $restantes = SesionTutoria::where('periodo_id', $periodoId)->orderBy('numero')->get();
        $n = 1;
        foreach ($restantes as $s) {
            if ($s->numero != $n) {
                $s->update(['numero' => $n]);
            }
            $n++;
        }

        return back()->with('status', 'Sesión eliminada correctamente.');
    }
}
