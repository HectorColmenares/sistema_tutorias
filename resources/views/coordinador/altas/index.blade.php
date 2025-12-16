@extends('layouts.coordinador')

@section('title', 'Altas')

@section('content')
    <div style="width:100%; max-width: 900px;">
        <div class="welcome">
            <h1>Altas</h1>
            <p>Alta manual de Tutor/Alumno y cambio de contraseña</p>

            @if (session('status'))
                <div class="user-info" style="border-left: 6px solid #22c55e;">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="user-info" style="border-left: 6px solid #ef4444;">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="user-info" style="max-width: 900px;">
                <p><strong>Acciones</strong></p>

                <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top: 10px;">
                    <a href="{{ route('coordinador.altas.tutor.create') }}"
                        style="background:#FF771B;color:#fff;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;">
                        Alta Tutor
                    </a>

                    <a href="{{ route('coordinador.altas.alumno.create') }}"
                        style="background:#1B396A;color:#fff;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;">
                        Alta Alumno
                    </a>

                    <a href="{{ route('coordinador.altas.password.edit') }}"
                        style="background:#111827;color:#fff;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:700;">
                        Cambiar contraseña
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
