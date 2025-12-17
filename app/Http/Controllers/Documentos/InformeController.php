<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class InformeController extends Controller
{
    public function index()
    {
        $documentos = Informe::orderByDesc('id')->paginate(15);
        return view('documentos.informe.index', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.informe.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        $doc = DB::transaction(fn () => Informe::create($data));

        return redirect()->route('informe.edit', $doc->id)
            ->with('status', 'Informe creado correctamente.');
    }

    public function show(string $id)
    {
        $documento = Informe::findOrFail($id);
        return view('documentos.informe.show', compact('documento'));
    }

    public function edit(string $id)
    {
        $documento = Informe::findOrFail($id);
        return view('documentos.informe.edit', compact('documento'));
    }

    public function update(Request $request, string $id)
    {
        $documento = Informe::findOrFail($id);

        $data = $request->validate([
            'titulo' => ['nullable', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
        ]);

        DB::transaction(fn () => $documento->update($data));

        return back()->with('status', 'Informe actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $documento = Informe::findOrFail($id);

        DB::transaction(function () use ($documento) {
            if (!empty($documento->pdf_path)) {
                Storage::disk('public')->delete($documento->pdf_path);
            }
            $documento->delete();
        });

        return redirect()->route('informe.index')->with('status', 'Informe eliminado.');
    }

    public function pdf(string $id)
    {
        $documento = Informe::findOrFail($id);
        $pdf = Pdf::loadView('pdf.informe', compact('documento'));
        return $pdf->download('INFORME_' . $documento->id . '.pdf');
    }

    public function generarPdf(string $id)
    {
        $documento = Informe::findOrFail($id);

        $pdf = Pdf::loadView('pdf.informe', compact('documento'));

        $filename = 'INFORME_' . $documento->id . '_' . now()->format('Ymd_His') . '.pdf';
        $path = 'documentos/informe/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        $documento->pdf_path = $path; // requiere columna
        $documento->save();

        return back()->with('status', 'PDF generado y guardado correctamente.');
    }
}
