<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $periodoActivo = Periodo::where('activo', 1)->first();

        // Enums EXACTOS del sistema (según tu prompt)
        $asistenciaEstados = ['pendiente', 'asistio', 'falto', 'permiso_aprobado', 'permiso_rechazado'];
        $documentoTipos = ['REAC', 'RESA', 'PAT', 'INFORME', 'CONSTANCIA'];

        // Defaults cuando NO hay periodo activo
        $totalTutorias = 0;
        $totalAsistencias = 0;
        $totalDocumentos = 0;

        $asistenciasPorEstado = array_fill_keys($asistenciaEstados, 0);
        $documentosPorTipo = array_fill_keys($documentoTipos, 0);

        $topTutores = collect();

        if ($periodoActivo) {
            $pid = $periodoActivo->id;

            // Total tutorías del periodo
            $totalTutorias = DB::table('tutorias')
                ->where('periodo_id', $pid)
                ->count();

            // Asistencias del periodo (asistencias se filtran por tutorias.periodo_id)
            $totalAsistencias = DB::table('asistencias')
                ->join('tutorias', 'asistencias.tutoria_id', '=', 'tutorias.id')
                ->where('tutorias.periodo_id', $pid)
                ->count();

            // Asistencias por estado
            $rawAsist = DB::table('asistencias')
                ->join('tutorias', 'asistencias.tutoria_id', '=', 'tutorias.id')
                ->where('tutorias.periodo_id', $pid)
                ->select('asistencias.estado', DB::raw('COUNT(*) as total'))
                ->groupBy('asistencias.estado')
                ->pluck('total', 'estado')
                ->toArray();

            foreach ($rawAsist as $estado => $total) {
                if (array_key_exists($estado, $asistenciasPorEstado)) {
                    $asistenciasPorEstado[$estado] = (int)$total;
                }
            }

            // Total documentos del periodo
            $totalDocumentos = DB::table('documentos')
                ->where('periodo_id', $pid)
                ->count();

            // Documentos por tipo
            $rawDocs = DB::table('documentos')
                ->where('periodo_id', $pid)
                ->select('tipo', DB::raw('COUNT(*) as total'))
                ->groupBy('tipo')
                ->pluck('total', 'tipo')
                ->toArray();

            foreach ($rawDocs as $tipo => $total) {
                if (array_key_exists($tipo, $documentosPorTipo)) {
                    $documentosPorTipo[$tipo] = (int)$total;
                }
            }

            // Top tutores por # de tutorías (del periodo activo)
            $topTutores = DB::table('tutorias')
                ->join('users', 'tutorias.tutor_user_id', '=', 'users.id')
                ->where('tutorias.periodo_id', $pid)
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    DB::raw('COUNT(*) as total_tutorias')
                )
                ->groupBy('users.id', 'users.name', 'users.email')
                ->orderByDesc('total_tutorias')
                ->limit(5)
                ->get();
        }

        return view('coordinador.dashboard', [
            'periodoActivo' => $periodoActivo,
            'totalTutorias' => $totalTutorias,
            'totalAsistencias' => $totalAsistencias,
            'totalDocumentos' => $totalDocumentos,
            'asistenciasPorEstado' => $asistenciasPorEstado,
            'documentosPorTipo' => $documentosPorTipo,
            'topTutores' => $topTutores,
        ]);
    }
}
