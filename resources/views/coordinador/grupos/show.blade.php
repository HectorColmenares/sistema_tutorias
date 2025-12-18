@extends('layouts.coordinador')

@section('title', 'Detalle de Grupo')

@section('content')
    <div class="container-fluid">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
            <h2 style="margin:0;">Detalle del Grupo</h2>

            <a href="{{ route('coordinador.grupos.index') }}"
                style="padding:10px 14px; background:#f3f4f6; border-radius:8px; text-decoration:none; color:#111827;">
                Volver
            </a>
        </div>

        <div class="card" style="padding:15px; margin-top:15px;">
            <p style="margin:0 0 6px 0;"><b>Grupo:</b> {{ $grupoTutor->grupo }}</p>

            <p style="margin:0 0 6px 0;">
                <b>Tutor a cargo:</b>
                {{ $grupoTutor->tutor?->name ?? 'Sin tutor' }}
                @if ($grupoTutor->tutor?->email)
                    ({{ $grupoTutor->tutor->email }})
                @endif
            </p>

            @if ($grupoTutor->periodo)
                <p style="margin:0;"><b>Periodo:</b> {{ $grupoTutor->periodo->nombre }}</p>
            @endif
        </div>

        <h3 style="margin-top:18px;">Miembros del grupo</h3>

        <div class="card" style="padding:15px;">
            @if ($alumnos->isEmpty())
                <p>No hay alumnos registrados en este grupo.</p>
            @else
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">#</th>
                            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Alumno</th>
                            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">No. Control</th>
                            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $i => $al)
                            <tr>
                                <td style="padding:8px; border-bottom:1px solid #eee;">{{ $i + 1 }}</td>
                                <td style="padding:8px; border-bottom:1px solid #eee;">
                                    {{ $al->user?->name ?? 'Sin nombre' }}
                                    @if ($al->user?->email)
                                        <span style="color:#6b7280;">({{ $al->user->email }})</span>
                                    @endif
                                </td>
                                <td style="padding:8px; border-bottom:1px solid #eee;">
                                    {{ $al->numero_control ?? '—' }}
                                </td>
                                <td style="padding:8px; border-bottom:1px solid #eee;">
                                    {{ $al->carrera ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
@endsection
