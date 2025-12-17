<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Models\Resa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ResaController extends Controller
{
    public function index()
    {
        $documentos = Resa::orderByDesc('id')->paginate(15);

        // Ajusta la vista a tu estructura real:
        return view('documentos.resa.index', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.resa.create');
    }

    public function store(Request $request)
    {
        // ✅ AJUSTA reglas a tus campos reales
        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        $doc = DB::transaction(function () use ($data) {
            return Resa::create($data);
        });

        return redirect()->route('resa.edit', $doc->id)
            ->with('status', 'RESА creada correctamente.');
    }

    public function show(string $id)
    {
        $documento = Resa::findOrFail($id);
        return view('documentos.resa.show', compact('documento'));
    }

    public function edit(string $id)
    {
        $documento = Resa::findOrFail($id);
        return view('documentos.resa.edit', compact('documento'));
    }

    public function update(Request $request, string $id)
    {
        $documento = Resa::findOrFail($id);

        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($documento, $data) {
            $documento->update($data);
        });

        return back()->with('status', 'RESА actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $documento = Resa::findOrFail($id);

        DB::transaction(function () use ($documento) {
            // opcional: borrar archivo PDF si existe
            if (!empty($documento->pdf_path)) {
                Storage::disk('public')->delete($documento->pdf_path);
            }
            $documento->delete();
        });

        return redirect()->route('resa.index')->with('status', 'RESА eliminada.');
    }

    // ========= PDF =========

    // Descarga el PDF (sin guardar) o usando el guardado previo si existe
    public function pdf(string $id)
    {
        $documento = Resa::findOrFail($id);

        // Vista PDF: crea resources/views/pdf/resa.blade.php
        $pdf = Pdf::loadView('pdf.resa', compact('documento'));

        return $pdf->download('RESA_' . $documento->id . '.pdf');
    }

    // Genera PDF y lo guarda en storage + (opcional) guarda la ruta en BD
    public function generarPdf(string $id)
    {
        $documento = Resa::findOrFail($id);

        $pdf = Pdf::loadView('pdf.resa', compact('documento'));

        $filename = 'RESA_' . $documento->id . '_' . now()->format('Ymd_His') . '.pdf';
        $path = 'documentos/resa/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        // ✅ Solo si tienes columna pdf_path en tu tabla
        $documento->pdf_path = $path;
        $documento->save();

        return back()->with('status', 'PDF generado y guardado correctamente.');
    }
}
