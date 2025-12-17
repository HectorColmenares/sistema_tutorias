<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Models\Pat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PatController extends Controller
{
    public function index()
    {
        $documentos = Pat::orderByDesc('id')->paginate(15);
        return view('documentos.pat.index', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.pat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        $doc = DB::transaction(fn () => Pat::create($data));

        return redirect()->route('pat.edit', $doc->id)
            ->with('status', 'PAT creada correctamente.');
    }

    public function show(string $id)
    {
        $documento = Pat::findOrFail($id);
        return view('documentos.pat.show', compact('documento'));
    }

    public function edit(string $id)
    {
        $documento = Pat::findOrFail($id);
        return view('documentos.pat.edit', compact('documento'));
    }

    public function update(Request $request, string $id)
    {
        $documento = Pat::findOrFail($id);

        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        DB::transaction(fn () => $documento->update($data));

        return back()->with('status', 'PAT actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $documento = Pat::findOrFail($id);

        DB::transaction(function () use ($documento) {
            if (!empty($documento->pdf_path)) {
                Storage::disk('public')->delete($documento->pdf_path);
            }
            $documento->delete();
        });

        return redirect()->route('pat.index')->with('status', 'PAT eliminada.');
    }

    public function pdf(string $id)
    {
        $documento = Pat::findOrFail($id);
        $pdf = Pdf::loadView('pdf.pat', compact('documento'));
        return $pdf->download('PAT_' . $documento->id . '.pdf');
    }

    public function generarPdf(string $id)
    {
        $documento = Pat::findOrFail($id);

        $pdf = Pdf::loadView('pdf.pat', compact('documento'));

        $filename = 'PAT_' . $documento->id . '_' . now()->format('Ymd_His') . '.pdf';
        $path = 'documentos/pat/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        $documento->pdf_path = $path; // requiere columna
        $documento->save();

        return back()->with('status', 'PDF generado y guardado correctamente.');
    }
}
