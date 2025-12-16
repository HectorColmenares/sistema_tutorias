@extends('layouts.coordinador')

@section('title', 'Altas')

@section('content')
    <div style="width:100%; max-width: 900px;">
        <div class="welcome">
            <h1>Altas</h1>
            <p>Alta manual de Tutor/Alumno, cambio de contraseña e importación por Excel</p>

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

            {{-- ✅ Mostrar errores de importación por fila --}}
            @if (session('import_failures'))
                <div class="user-info" style="border-left: 6px solid #ef4444; margin-top: 12px;">
                    <p><strong>Errores en importación:</strong></p>

                    <ul style="margin-top: 10px; padding-left: 18px;">
                        @foreach (session('import_failures') as $failure)
                            <li style="margin-bottom: 10px;">
                                <strong>Fila {{ $failure->row() }}:</strong>
                                {{ implode(', ', $failure->errors()) }}
                                <br>
                                <small style="color:#555;">
                                    Valores: {{ json_encode($failure->values(), JSON_UNESCAPED_UNICODE) }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ====== Acciones ====== --}}
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

            {{-- ====== Importación por Excel ====== --}}
            <div class="user-info" style="max-width: 900px; margin-top: 15px;">
                <p><strong>Importación por Excel</strong></p>

                <div style="display:flex; gap:18px; flex-wrap:wrap; margin-top:10px;">
                    {{-- Importar alumnos --}}
                    <form method="POST" action="{{ route('coordinador.altas.alumnos.import') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                            <input type="file" name="archivo" accept=".xlsx,.xls,.csv" required>
                            <button type="submit"
                                style="background:#1B396A;color:#fff;padding:8px 12px;border-radius:10px;border:none;font-weight:700;cursor:pointer;">
                                Importar Alumnos
                            </button>
                        </div>
                    </form>

                    {{-- Importar tutores --}}
                    <form method="POST" action="{{ route('coordinador.altas.tutores.import') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                            <input type="file" name="archivo" accept=".xlsx,.xls,.csv" required>
                            <button type="submit"
                                style="background:#FF771B;color:#fff;padding:8px 12px;border-radius:10px;border:none;font-weight:700;cursor:pointer;">
                                Importar Tutores
                            </button>
                        </div>
                    </form>
                </div>

                <p style="margin-top:12px; color:#666;">
                    La primera fila debe tener encabezados.
                    <br>
                    <strong>Alumnos:</strong> name, email, password, numero_control, carrera, grupo, telefono
                    <br>
                    <strong>Tutores:</strong> name, email, password, departamento, cedula, telefono
                </p>
            </div>
        </div>
    </div>
@endsection
