@extends('layouts.coordinador')

@section('title', 'Cambiar contraseña')

@section('content')
    <div style="width:100%; max-width: 900px;">
        <div class="welcome">
            <h1>Cambiar contraseña</h1>

            @if ($errors->any())
                <div class="user-info" style="border-left: 6px solid #ef4444;">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('coordinador.altas.password.update') }}" class="user-info"
                style="max-width:900px;">
                @csrf
                @method('PATCH')

                <p><strong>Email del usuario:</strong>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        style="flex:1;padding:8px;border-radius:8px;border:1px solid #ddd;">
                </p>

                <p><strong>Nueva contraseña:</strong>
                    <input type="password" name="password" required
                        style="flex:1;padding:8px;border-radius:8px;border:1px solid #ddd;">
                </p>

                <p><strong>Confirmar:</strong>
                    <input type="password" name="password_confirmation" required
                        style="flex:1;padding:8px;border-radius:8px;border:1px solid #ddd;">
                </p>

                <div style="display:flex; gap:12px; margin-top:14px; justify-content:center;">
                    <button type="submit"
                        style="background:#111827;color:#fff;padding:10px 14px;border-radius:10px;border:none;font-weight:800;cursor:pointer;">
                        Actualizar
                    </button>
                    <a href="{{ route('coordinador.altas.index') }}"
                        style="padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;border:1px solid #ccc;color:#111;">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
