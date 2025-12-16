@extends('layouts.coordinador')

@section('title', 'Alta Alumno')

@section('content')
    <div style="width:100%; max-width: 950px; margin: 0 auto;">
        <div class="welcome">
            <h1 style="color: #1B396A; margin-bottom: 8px;">Alta de Alumno</h1>
            <p style="color: #666; font-size: 16px; margin-bottom: 30px;">
                Registro manual de nuevo alumno en el sistema
            </p>

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

            {{-- Formulario --}}
            <div class="user-info"
                style="max-width: 950px; background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <form method="POST" action="{{ route('coordinador.altas.alumno.store') }}" id="alumnoForm">
                    @csrf

                    {{-- Sección: Datos de usuario --}}
                    <div style="margin-bottom: 32px;">
                        <div
                            style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #1B396A;">
                            <div
                                style="background: #1B396A; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 style="color: #1B396A; font-size: 18px; font-weight: 700; margin: 0;">Datos de usuario</h2>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                            {{-- Campo: Nombre --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Nombre completo <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        placeholder="Ej: Juan Pérez García"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Campo: Email --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Correo electrónico <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="Ej: alumno@universidad.edu"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                            {{-- Campo: Contraseña --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Contraseña <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="password" name="password" required id="password"
                                        placeholder="Mínimo 8 caracteres"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                            </path>
                                        </svg>
                                    </div>
                                    <button type="button" onclick="togglePassword('password')"
                                        style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af;">
                                        <svg id="eye-password" style="width: 18px; height: 18px;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Campo: Confirmar contraseña --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Confirmar contraseña <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="password" name="password_confirmation" required
                                        id="password_confirmation" placeholder="Repite la contraseña"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    </div>
                                    <button type="button" onclick="togglePassword('password_confirmation')"
                                        style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af;">
                                        <svg id="eye-password_confirmation" style="width: 18px; height: 18px;"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sección: Datos de alumno --}}
                    <div style="margin-bottom: 32px;">
                        <div
                            style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #10b981;">
                            <div
                                style="background: #10b981; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 20px; height: 20px; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                </svg>
                            </div>
                            <h2 style="color: #10b981; font-size: 18px; font-weight: 700; margin: 0;">Datos académicos</h2>
                        </div>

                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                            {{-- Campo: Número de control --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Número de control <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="text" name="numero_control" value="{{ old('numero_control') }}"
                                        required placeholder="Ej: 19201100"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Campo: Carrera --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Carrera <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="text" name="carrera" value="{{ old('carrera') }}" required
                                        placeholder="Ej: Ingeniería en Sistemas"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Campo: Grupo --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Grupo
                                </label>
                                <div style="position: relative;">
                                    <input type="text" name="grupo" value="{{ old('grupo') }}"
                                        placeholder="Ej: 5A, 3B"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Campo: Teléfono --}}
                            <div>
                                <label
                                    style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                    Teléfono
                                </label>
                                <div style="position: relative;">
                                    <input type="tel" name="telefono" value="{{ old('telefono') }}"
                                        placeholder="Ej: 555-123-4567"
                                        style="width: 100%; padding: 12px 16px 12px 42px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                    <div style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);">
                                        <svg style="width: 18px; height: 18px; color: #9ca3af;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div
                        style="display: flex; gap: 16px; margin-top: 40px; padding-top: 24px; border-top: 1px solid #e5e7eb; justify-content: center;">
                        <button type="submit"
                            style="background: linear-gradient(135deg, #1B396A 0%, #2a4b8a 100%); color: white; padding: 14px 32px; border-radius: 10px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(27, 57, 106, 0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Guardar alumno
                        </button>

                        <a href="{{ route('coordinador.altas.index') }}"
                            style="background: white; color: #374151; padding: 14px 32px; border-radius: 10px; border: 2px solid #d1d5db; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;"
                            onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#9ca3af';"
                            onmouseout="this.style.background='white'; this.style.borderColor='#d1d5db';">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver al listado
                        </a>
                    </div>
                </form>
            </div>

            {{-- Información adicional --}}
            <div
                style="margin-top: 24px; background: #f0f9ff; border-radius: 8px; padding: 16px; border-left: 4px solid #0ea5e9;">
                <div style="display: flex; align-items: flex-start; gap: 10px;">
                    <svg style="width: 18px; height: 18px; color: #0ea5e9; flex-shrink: 0; margin-top: 2px;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p style="color: #0369a1; font-size: 14px; font-weight: 500; margin: 0 0 8px 0;">
                            Información importante
                        </p>
                        <ul style="color: #475569; font-size: 13px; margin: 0; padding-left: 18px;">
                            <li>El número de control debe ser único por alumno</li>
                            <li>La contraseña debe tener al menos 8 caracteres</li>
                            <li>El alumno recibirá credenciales en su correo</li>
                            <li>Los campos marcados con <span style="color: #ef4444;">*</span> son obligatorios</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById('eye-' + fieldId);

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>`;
            } else {
                field.type = 'password';
                eyeIcon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        }

        // Validación de contraseñas
        document.getElementById('alumnoForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor verifica.');
                document.getElementById('password').style.borderColor = '#ef4444';
                document.getElementById('password_confirmation').style.borderColor = '#ef4444';
            }
        });
    </script>

    <style>
        @media (max-width: 768px) {
            .user-info {
                padding: 20px !important;
            }

            h1 {
                font-size: 24px !important;
            }

            .grid-template-cols-2 {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }

            .flex-buttons {
                flex-direction: column !important;
                gap: 12px !important;
            }

            button,
            a {
                width: 100% !important;
                justify-content: center !important;
            }
        }
    </style>
@endsection
