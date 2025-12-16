@extends('layouts.coordinador')

@section('title', 'Altas')

@section('content')
    <div style="width:100%; max-width: 950px; margin: 0 auto;">
        <div class="welcome">
            <h1 style="color: #1B396A; margin-bottom: 8px;">Altas</h1>
            <p style="color: #666; font-size: 16px; margin-bottom: 30px;">
                Alta manual de Tutor/Alumno, cambio de contraseña e importación por Excel
            </p>

            {{-- Mensajes de estado --}}
            @if (session('status'))
                <div class="user-info"
                    style="border-left: 6px solid #22c55e; background: #f0fdf4; padding: 16px; margin-bottom: 24px; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: #22c55e;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p style="color: #166534; font-weight: 500; margin: 0;">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            {{-- Errores generales --}}
            @if ($errors->any())
                <div class="user-info"
                    style="border-left: 6px solid #ef4444; background: #fef2f2; padding: 16px; margin-bottom: 24px; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: #ef4444;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p style="color: #991b1b; font-weight: 500; margin: 0;">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            {{-- ✅ Errores de importación por fila --}}
            @if (session('import_failures'))
                <div class="user-info"
                    style="border-left: 6px solid #f59e0b; background: #fffbeb; padding: 20px; margin-bottom: 24px; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                        <svg style="width: 20px; height: 20px; color: #f59e0b;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.342 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <p style="color: #92400e; font-weight: 600; margin: 0; font-size: 17px;">Errores en importación</p>
                    </div>

                    <div style="background: white; border-radius: 6px; padding: 16px; border: 1px solid #fde68a;">
                        @foreach (session('import_failures') as $failure)
                            <div
                                style="padding: 12px 0; border-bottom: 1px solid #fef3c7; {{ !$loop->last ? 'border-bottom: 1px solid #fef3c7;' : '' }}">
                                <div style="display: flex; align-items: flex-start; gap: 10px;">
                                    <span
                                        style="background: #f59e0b; color: white; min-width: 70px; padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: 600; text-align: center;">
                                        Fila {{ $failure->row() }}
                                    </span>
                                    <div style="flex: 1;">
                                        <p style="color: #92400e; font-weight: 500; margin: 0 0 5px 0; font-size: 14px;">
                                            {{ implode(', ', $failure->errors()) }}
                                        </p>
                                        <div
                                            style="background: #fef3c7; padding: 8px 12px; border-radius: 4px; margin-top: 6px;">
                                            <p style="color: #92400e; font-size: 12px; margin: 0; font-family: monospace;">
                                                <strong>Valores:</strong>
                                                {{ json_encode($failure->values(), JSON_UNESCAPED_UNICODE) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ====== Tarjeta de Acciones ====== --}}
            <div class="user-info"
                style="max-width: 950px; background: white; border-radius: 12px; padding: 24px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div
                        style="background: #1B396A; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 22px; height: 22px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 style="color: #1B396A; font-size: 20px; font-weight: 700; margin: 0;">Acciones principales</h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    {{-- Alta Tutor --}}
                    <a href="{{ route('coordinador.altas.tutor.create') }}"
                        style="background: linear-gradient(135deg, #FF771B 0%, #ff944d 100%); color: white; padding: 18px 20px; border-radius: 12px; text-decoration: none; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border: 2px solid transparent;"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 16px rgba(255, 119, 27, 0.2)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div>
                            <div style="font-weight: 700; font-size: 17px; margin-bottom: 4px;">Alta Tutor</div>
                            <div style="font-size: 13px; opacity: 0.9;">Registro manual de tutor</div>
                        </div>
                        <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    {{-- Alta Alumno --}}
                    <a href="{{ route('coordinador.altas.alumno.create') }}"
                        style="background: linear-gradient(135deg, #1B396A 0%, #2a4b8a 100%); color: white; padding: 18px 20px; border-radius: 12px; text-decoration: none; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border: 2px solid transparent;"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 16px rgba(27, 57, 106, 0.2)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div>
                            <div style="font-weight: 700; font-size: 17px; margin-bottom: 4px;">Alta Alumno</div>
                            <div style="font-size: 13px; opacity: 0.9;">Registro manual de alumno</div>
                        </div>
                        <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    {{-- Cambiar contraseña --}}
                    <a href="{{ route('coordinador.altas.password.edit') }}"
                        style="background: linear-gradient(135deg, #111827 0%, #374151 100%); color: white; padding: 18px 20px; border-radius: 12px; text-decoration: none; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border: 2px solid transparent;"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 16px rgba(17, 24, 39, 0.2)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div>
                            <div style="font-weight: 700; font-size: 17px; margin-bottom: 4px;">Cambiar contraseña</div>
                            <div style="font-size: 13px; opacity: 0.9;">Actualizar credenciales</div>
                        </div>
                        <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ====== Tarjeta de Importación por Excel ====== --}}
            <div class="user-info"
                style="max-width: 950px; background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div
                        style="background: #10b981; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 22px; height: 22px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 style="color: #1B396A; font-size: 20px; font-weight: 700; margin: 0;">Importación masiva por Excel
                    </h2>
                </div>

                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 25px;">
                    {{-- Importar alumnos --}}
                    <div style="background: #f8fafc; border-radius: 10px; padding: 20px; border: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                            <div
                                style="background: #1B396A; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </div>
                            <h3 style="color: #1B396A; font-size: 17px; font-weight: 600; margin: 0;">Importar Alumnos</h3>
                        </div>

                        <form method="POST" action="{{ route('coordinador.altas.alumnos.import') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <div style="position: relative;">
                                    <input type="file" name="archivo" accept=".xlsx,.xls,.csv" required
                                        style="width: 100%; padding: 12px; border: 2px dashed #cbd5e1; border-radius: 8px; background: white; cursor: pointer; font-size: 14px;"
                                        onchange="this.style.borderColor='#1B396A';">
                                    <div
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                        <svg style="width: 20px; height: 20px; color: #64748b;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit"
                                    style="background: #1B396A; color: white; padding: 12px 16px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px;"
                                    onmouseover="this.style.background='#2a4b8a';"
                                    onmouseout="this.style.background='#1B396A';">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Subir y procesar
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Importar tutores --}}
                    <div style="background: #f8fafc; border-radius: 10px; padding: 20px; border: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                            <div
                                style="background: #FF771B; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 style="color: #FF771B; font-size: 17px; font-weight: 600; margin: 0;">Importar Tutores</h3>
                        </div>

                        <form method="POST" action="{{ route('coordinador.altas.tutores.import') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <div style="position: relative;">
                                    <input type="file" name="archivo" accept=".xlsx,.xls,.csv" required
                                        style="width: 100%; padding: 12px; border: 2px dashed #cbd5e1; border-radius: 8px; background: white; cursor: pointer; font-size: 14px;"
                                        onchange="this.style.borderColor='#FF771B';">
                                    <div
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                        <svg style="width: 20px; height: 20px; color: #64748b;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit"
                                    style="background: #FF771B; color: white; padding: 12px 16px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px;"
                                    onmouseover="this.style.background='#ff944d';"
                                    onmouseout="this.style.background='#FF771B';">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Subir y procesar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Información de formato --}}
                <div style="background: #f0f9ff; border-radius: 8px; padding: 18px; border-left: 4px solid #0ea5e9;">
                    <div style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px;">
                        <svg style="width: 18px; height: 18px; color: #0ea5e9; flex-shrink: 0; margin-top: 2px;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p style="color: #0369a1; font-size: 14px; font-weight: 500; margin: 0;">
                            Instrucciones para importación
                        </p>
                    </div>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 12px;">
                        <div style="background: white; border-radius: 6px; padding: 12px; border: 1px solid #e0f2fe;">
                            <p style="color: #1B396A; font-size: 13px; font-weight: 600; margin: 0 0 6px 0;">📄 Requisitos
                                del archivo</p>
                            <ul style="color: #475569; font-size: 13px; margin: 0; padding-left: 18px;">
                                <li>Primera fila debe contener encabezados</li>
                                <li>Formatos aceptados: .xlsx, .xls, .csv</li>
                                <li>Máximo 1000 registros por archivo</li>
                            </ul>
                        </div>

                        <div style="background: white; border-radius: 6px; padding: 12px; border: 1px solid #e0f2fe;">
                            <p style="color: #FF771B; font-size: 13px; font-weight: 600; margin: 0 0 6px 0;">👨‍🏫 Formato
                                para Tutores</p>
                            <div
                                style="color: #475569; font-size: 12px; font-family: 'Courier New', monospace; background: #f8fafc; padding: 8px; border-radius: 4px;">
                                name, email, password, departamento, cedula, telefono
                            </div>
                        </div>

                        <div style="background: white; border-radius: 6px; padding: 12px; border: 1px solid #e0f2fe;">
                            <p style="color: #1B396A; font-size: 13px; font-weight: 600; margin: 0 0 6px 0;">👨‍🎓 Formato
                                para Alumnos</p>
                            <div
                                style="color: #475569; font-size: 12px; font-family: 'Courier New', monospace; background: #f8fafc; padding: 8px; border-radius: 4px;">
                                name, email, password, numero_control, carrera, grupo, telefono
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .user-info {
                padding: 16px !important;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr !important;
            }

            h1 {
                font-size: 24px !important;
            }

            h2 {
                font-size: 18px !important;
            }
        }

        input[type="file"]::-webkit-file-upload-button {
            visibility: hidden;
        }

        input[type="file"]::before {
            content: 'Seleccionar archivo';
            display: none;
        }

        input[type="file"]:hover {
            border-color: #94a3b8 !important;
        }
    </style>
@endsection
