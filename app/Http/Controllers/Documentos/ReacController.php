<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Models\Reac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ReacController extends Controller
{
    public function index()
    {
        $documentos = Reac::orderByDesc('id')->paginate(15);
        return view('documentos.reac.index', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.reac.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        $doc = DB::transaction(fn () => Reac::create($data));

        return redirect()->route('reac.edit', $doc->id)
            ->with('status', 'REAC creada correctamente.');
    }

    public function show(string $id)
    {
        $documento = Reac::findOrFail($id);
        return view('documentos.reac.show', compact('documento'));
    }

    public function edit(string $id)
    {
        $documento = Reac::findOrFail($id);
        return view('documentos.reac.edit', compact('documento'));
    }

    public function update(Request $request, string $id)
    {
        $documento = Reac::findOrFail($id);

        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        DB::transaction(fn () => $documento->update($data));

        return back()->with('status', 'REAC actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $documento = Reac::findOrFail($id);

        DB::transaction(function () use ($documento) {
            if (!empty($documento->pdf_path)) {
                Storage::disk('public')->delete($documento->pdf_path);
            }
            $documento->delete();
        });

        return redirect()->route('reac.index')->with('status', 'REAC eliminada.');
    }

    public function pdf(string $id)
    {
        $documento = Reac::findOrFail($id);
        $pdf = Pdf::loadView('pdf.reac', compact('documento'));
        return $pdf->download('REAC_' . $documento->id . '.pdf');
    }

    public function generarPdf(string $id)
    {
        $documento = Reac::findOrFail($id);

        $pdf = Pdf::loadView('pdf.reac', compact('documento'));

        $filename = 'REAC_' . $documento->id . '_' . now()->format('Ymd_His') . '.pdf';
        $path = 'documentos/reac/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        $documento->pdf_path = $path; // requiere columna
        $documento->save();

        return back()->with('status', 'PDF generado y guardado correctamente.');
    }
}
