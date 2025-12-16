<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Models\Periodo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $periodos = Periodo::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('nombre', 'like', "%{$q}%");
            })
            ->orderByDesc('activo')
            ->orderByDesc('fecha_inicio')
            ->paginate(10)
            ->withQueryString();

        $periodoActivo = Periodo::where('activo', 1)->first();

        return view('coordinador.periodos.index', [
            'periodos' => $periodos,
            'periodoActivo' => $periodoActivo,
            'q' => $q,
        ]);
    }

    public function create()
    {
        return view('coordinador.periodos.create');
    }

    public function store(StorePeriodoRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Si viene activo = 1, desactivamos el resto
        if (!empty($data['activo'])) {
            Periodo::where('activo', 1)->update(['activo' => 0]);
        }

        Periodo::create([
            'nombre' => $data['nombre'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'activo' => (bool)($data['activo'] ?? false),
        ]);

        return redirect()
            ->route('coordinador.periodos.index')
            ->with('status', 'Periodo creado correctamente.');
    }

    public function edit(Periodo $periodo)
    {
        return view('coordinador.periodos.edit', [
            'periodo' => $periodo,
        ]);
    }

    public function update(UpdatePeriodoRequest $request, Periodo $periodo): RedirectResponse
    {
        $data = $request->validated();

        // Si se marca activo = 1, desactivamos el resto
        if (!empty($data['activo'])) {
            Periodo::where('activo', 1)
                ->where('id', '!=', $periodo->id)
                ->update(['activo' => 0]);
        }

        $periodo->update([
            'nombre' => $data['nombre'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'activo' => (bool)($data['activo'] ?? $periodo->activo),
        ]);

        return redirect()
            ->route('coordinador.periodos.index')
            ->with('status', 'Periodo actualizado.');
    }

    public function destroy(Periodo $periodo): RedirectResponse
    {
        // Regla simple: permitir borrar si NO está activo
        if ($periodo->activo) {
            return back()->withErrors(['periodo' => 'No puedes eliminar el periodo activo.']);
        }

        $periodo->delete();

        return redirect()
            ->route('coordinador.periodos.index')
            ->with('status', 'Periodo eliminado.');
    }

    public function activar(Periodo $periodo): RedirectResponse
    {
        // Desactiva todos y activa este (operación “único activo”)
        Periodo::where('activo', 1)->update(['activo' => 0]);
        $periodo->update(['activo' => 1]);

        return redirect()
            ->route('coordinador.periodos.index')
            ->with('status', "Periodo '{$periodo->nombre}' activado.");
    }
}
