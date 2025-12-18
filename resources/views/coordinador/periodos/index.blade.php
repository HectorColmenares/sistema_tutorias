@extends('layouts.coordinador')

@section('title', 'Periodos')

@section('content')
    <div class="container-fluid">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
            <h2 style="margin:0;">Periodos</h2>

            <a href="{{ route('coordinador.periodos.create') }}"
                style="padding:10px 14px; background:#1f2937; color:#fff; border-radius:8px; text-decoration:none;">
                Nuevo periodo
            </a>
        </div>

        {{-- Mensajes --}}
        @if (session('status'))
            <div class="alert alert-success" style="margin-top:12px;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:12px;">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Buscador + Periodo activo --}}
        <div style="margin-top:16px; padding:16px; background:#fff; border-radius:10px;">
            <form method="GET" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <input type="text" name="q" value="{{ $q }}" placeholder="Buscar por nombre…"
                    style="padding:10px; border:1px solid #ddd; border-radius:8px; min-width:260px;">

                <button type="submit" style="padding:10px 14px; border-radius:8px; border:1px solid #ddd; cursor:pointer;">
                    Buscar
                </button>
            </form>

            <div
                style="margin-top:12px; display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
                @if ($periodoActivo)
                    <div>
                        <b>Periodo activo:</b>
                        {{ $periodoActivo->nombre }}
                        ({{ optional($periodoActivo->fecha_inicio)->format('Y-m-d') }} a
                        {{ optional($periodoActivo->fecha_fin)->format('Y-m-d') }})
                    </div>

                    <form method="POST" action="{{ route('coordinador.periodos.desactivar', $periodoActivo) }}"
                        onsubmit="return confirm('¿Desactivar el periodo activo? Esto puede impedir calendarización y grupos hasta que actives otro.');">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            style="padding:10px 14px; background:#d97706; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                            Desactivar periodo activo
                        </button>
                    </form>
                @else
                    <div><b>Periodo activo:</b> No hay periodo activo.</div>
                @endif
            </div>
        </div>

        {{-- Tabla --}}
        <div style="margin-top:16px; background:#fff; border-radius:10px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Nombre</th>
                        <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Inicio</th>
                        <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Fin</th>
                        <th style="text-align:left; padding:12px; border-bottom:1px solid #e5e7eb;">Estado</th>
                        <th style="text-align:right; padding:12px; border-bottom:1px solid #e5e7eb;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($periodos as $periodo)
                        <tr>
                            <td style="padding:12px; border-bottom:1px solid #f1f5f9;">
                                <b>{{ $periodo->nombre }}</b>
                            </td>
                            <td style="padding:12px; border-bottom:1px solid #f1f5f9;">
                                {{ optional($periodo->fecha_inicio)->format('Y-m-d') }}
                            </td>
                            <td style="padding:12px; border-bottom:1px solid #f1f5f9;">
                                {{ optional($periodo->fecha_fin)->format('Y-m-d') }}
                            </td>
                            <td style="padding:12px; border-bottom:1px solid #f1f5f9;">
                                @if ($periodo->activo)
                                    <span
                                        style="background:#dcfce7; color:#166534; padding:4px 8px; border-radius:999px; font-weight:600;">
                                        ACTIVO
                                    </span>
                                @else
                                    <span
                                        style="background:#f3f4f6; color:#374151; padding:4px 8px; border-radius:999px; font-weight:600;">
                                        INACTIVO
                                    </span>
                                @endif
                            </td>
                            <td style="padding:12px; border-bottom:1px solid #f1f5f9; text-align:right;">
                                <div style="display:inline-flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
                                    <a href="{{ route('coordinador.periodos.edit', $periodo) }}"
                                        style="padding:8px 10px; border-radius:8px; background:#f3f4f6; text-decoration:none; color:#111827;">
                                        Editar
                                    </a>

                                    @if (!$periodo->activo)
                                        <form method="POST" action="{{ route('coordinador.periodos.activar', $periodo) }}"
                                            onsubmit="return confirm('¿Activar este periodo? El periodo activo actual se desactivará.');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                style="padding:8px 10px; border-radius:8px; background:#2563eb; color:#fff; border:none; cursor:pointer;">
                                                Activar
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('coordinador.periodos.destroy', $periodo) }}"
                                            onsubmit="return confirm('¿Eliminar este periodo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="padding:8px 10px; border-radius:8px; background:#dc2626; color:#fff; border:none; cursor:pointer;">
                                                Eliminar
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                            action="{{ route('coordinador.periodos.desactivar', $periodo) }}"
                                            onsubmit="return confirm('¿Desactivar este periodo?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                style="padding:8px 10px; border-radius:8px; background:#d97706; color:#fff; border:none; cursor:pointer;">
                                                Desactivar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:18px; text-align:center; color:#6b7280;">
                                Sin periodos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:16px;">
            {{ $periodos->links() }}
        </div>

    </div>
@endsection
