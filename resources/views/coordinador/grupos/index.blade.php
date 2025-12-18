@extends('layouts.coordinador')

@section('title', 'Asignación de Grupos')

@section('content')
    <div class="container-fluid">

        <h2 style="margin-bottom: 10px;">Grupos → Tutor (Periodo activo)</h2>

        @if (session('success'))
            <div class="alert alert-success" style="margin: 10px 0;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning" style="margin: 10px 0;">
                {{ session('warning') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="margin: 10px 0;">
                <ul style="margin:0;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!$periodoActivo)
            <p>No hay periodo activo. Activa uno desde <b>Periodos</b>.</p>
        @else
            <div class="card" style="padding: 15px; margin-bottom: 20px;">
                <div style="margin-bottom: 10px;">
                    <b>Periodo:</b> {{ $periodoActivo->nombre }}
                </div>

                <form method="POST" action="{{ route('coordinador.grupos.store') }}">
                    @csrf

                    <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
                        <div style="min-width: 260px;">
                            <label for="tutor_user_id"><b>Tutor</b></label><br>
                            <select name="tutor_user_id" id="tutor_user_id" required style="width:100%; padding:8px;">
                                <option value="">-- Selecciona un tutor --</option>
                                @foreach ($tutores as $t)
                                    <option value="{{ $t->id }}" @selected(old('tutor_user_id') == $t->id)>
                                        {{ $t->name }} ({{ $t->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="min-width: 200px;">
                            <label for="grupo"><b>Grupo</b></label><br>
                            <select name="grupo" id="grupo" required style="width:100%; padding:8px;">
                                <option value="">-- Selecciona un grupo --</option>
                                @foreach ($grupos as $g)
                                    <option value="{{ $g }}" @selected(old('grupo') == $g)>
                                        {{ $g }} ({{ $alumnosPorGrupo[$g] ?? 0 }} alumnos)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" style="padding:10px 16px; cursor:pointer;">
                                Generar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <h3>Asignaciones actuales</h3>

            <div class="card" style="padding: 15px;">
                @if ($asignaciones->isEmpty())
                    <p>No hay asignaciones todavía.</p>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Grupo</th>
                                <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Tutor</th>
                                <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Alumnos</th>
                                <th style="border-bottom:1px solid #ddd; padding:8px; text-align:right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $a)
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #eee;">{{ $a->grupo }}</td>
                                    <td style="padding:8px; border-bottom:1px solid #eee;">
                                        {{ $a->tutor?->name }} ({{ $a->tutor?->email }})
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #eee;">
                                        {{ $alumnosPorGrupo[$a->grupo] ?? 0 }}
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #eee; text-align:right;">
                                        <div style="display:inline-flex; gap:8px; align-items:center;">
                                            <a href="{{ route('coordinador.grupos.show', $a->id) }}"
                                                style="padding:6px 10px; cursor:pointer; text-decoration:none; border:1px solid #ddd; border-radius:6px;">
                                                Ver
                                            </a>

                                            <form method="POST" action="{{ route('coordinador.grupos.destroy', $a->id) }}"
                                                onsubmit="return confirm('¿Eliminar esta asignación?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="padding:6px 10px; cursor:pointer;">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif
    </div>
@endsection
