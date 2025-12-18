@extends('layouts.coordinador')

@section('title', 'Nuevo periodo')

@section('content')
    <div class="container-fluid">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
            <h2 style="margin:0;">Nuevo periodo</h2>

            <a href="{{ route('coordinador.periodos.index') }}"
                style="padding:10px 14px; background:#f3f4f6; border-radius:8px; text-decoration:none; color:#111827;">
                Volver
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:12px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div style="margin-top:16px; background:#fff; border-radius:10px; padding:16px;">
            <form method="POST" action="{{ route('coordinador.periodos.store') }}">
                @csrf

                <div style="margin-bottom:14px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">Nombre</label>
                    <input name="nombre" value="{{ old('nombre') }}" required maxlength="50"
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:14px;">
                    <div style="flex:1; min-width:220px;">
                        <label style="display:block; font-weight:600; margin-bottom:6px;">Fecha inicio</label>
                        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                            style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                    </div>

                    <div style="flex:1; min-width:220px;">
                        <label style="display:block; font-weight:600; margin-bottom:6px;">Fecha fin</label>
                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                            style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                    <input type="checkbox" name="activo" value="1" {{ old('activo') ? 'checked' : '' }}>
                    <label>Marcar como activo</label>
                </div>

                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <button type="submit"
                        style="padding:10px 14px; background:#1f2937; color:#fff; border:none; border-radius:8px; cursor:pointer;">
                        Guardar
                    </button>

                    <a href="{{ route('coordinador.periodos.index') }}"
                        style="padding:10px 14px; background:#f3f4f6; border-radius:8px; text-decoration:none; color:#111827;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
