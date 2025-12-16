@extends('layouts.coordinador')

@section('title', 'Dashboard Coordinador')

@section('content')
    <div class="welcome" style="width:100%; max-width: 1100px;">
        <h1>Sistema de Tutorías - Coordinador</h1>
        <p class="mb-3">Resumen del periodo activo</p>

        {{-- Periodo activo --}}
        <div class="user-info" style="max-width: 900px;">
            @if ($periodoActivo)
                <p>
                    <strong>Periodo:</strong>
                    {{ $periodoActivo->nombre }}
                    ({{ optional($periodoActivo->fecha_inicio)->format('Y-m-d') }} a
                    {{ optional($periodoActivo->fecha_fin)->format('Y-m-d') }})
                </p>

                <p>
                    <strong>Acción:</strong>
                    <a href="{{ route('coordinador.periodos.index') }}"
                        style="color:#FF771B; font-weight:700; text-decoration:none;">
                        Administrar periodos
                    </a>
                </p>
            @else
                <p><strong>Periodo:</strong> No hay periodo activo.</p>
                <p>
                    <strong>Acción:</strong>
                    <a href="{{ route('coordinador.periodos.index') }}"
                        style="color:#FF771B; font-weight:700; text-decoration:none;">
                        Activar un periodo
                    </a>
                </p>
            @endif
        </div>

        {{-- KPIs (reutilizando estilos existentes, sin Bootstrap) --}}
        <div
            style="width:100%; max-width: 900px; margin: 20px auto 0; display:grid; grid-template-columns: repeat(3, 1fr); gap: 14px;">
            <div class="user-info" style="margin:0;">
                <p><strong>Tutorías:</strong> {{ $totalTutorias }}</p>
            </div>
            <div class="user-info" style="margin:0;">
                <p><strong>Asistencias:</strong> {{ $totalAsistencias }}</p>
            </div>
            <div class="user-info" style="margin:0;">
                <p><strong>Documentos:</strong> {{ $totalDocumentos }}</p>
            </div>
        </div>

        {{-- Tablas --}}
        <div
            style="width:100%; max-width: 900px; margin: 22px auto 0; display:grid; grid-template-columns: 1fr 1fr; gap: 14px;">
            <div class="user-info" style="margin:0;">
                <p><strong>Asistencias por estado</strong></p>
                <div style="overflow:auto;">
                    <table style="width:100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Estado
                                </th>
                                <th style="text-align:right; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistenciasPorEstado as $estado => $total)
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid rgba(0,0,0,0.06);">{{ $estado }}
                                    </td>
                                    <td
                                        style="padding:8px; text-align:right; border-bottom:1px solid rgba(0,0,0,0.06); font-weight:600;">
                                        {{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="user-info" style="margin:0;">
                <p><strong>Documentos por tipo</strong></p>
                <div style="overflow:auto;">
                    <table style="width:100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Tipo
                                </th>
                                <th style="text-align:right; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentosPorTipo as $tipo => $total)
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid rgba(0,0,0,0.06);">{{ $tipo }}
                                    </td>
                                    <td
                                        style="padding:8px; text-align:right; border-bottom:1px solid rgba(0,0,0,0.06); font-weight:600;">
                                        {{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Top tutores --}}
        <div class="user-info" style="max-width: 900px; margin-top: 18px;">
            <p><strong>Top tutores por cantidad de tutorías</strong></p>
            <div style="overflow:auto;">
                <table style="width:100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align:left; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Tutor</th>
                            <th style="text-align:left; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Email</th>
                            <th style="text-align:right; padding:8px; border-bottom:1px solid rgba(0,0,0,0.08);">Tutorías
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topTutores as $t)
                            <tr>
                                <td style="padding:8px; border-bottom:1px solid rgba(0,0,0,0.06); font-weight:600;">
                                    {{ $t->name }}</td>
                                <td style="padding:8px; border-bottom:1px solid rgba(0,0,0,0.06);">{{ $t->email }}</td>
                                <td
                                    style="padding:8px; text-align:right; border-bottom:1px solid rgba(0,0,0,0.06); font-weight:700;">
                                    {{ $t->total_tutorias }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="padding:12px; text-align:center; color:#666;">
                                    Sin datos (¿hay tutorías en el periodo activo?).
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @auth
            <div class="user-info" style="max-width: 900px;">
                <p><strong>Usuario:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
        @endauth
    </div>
@endsection
