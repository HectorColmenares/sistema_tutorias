@extends('layouts.coordinador')

@section('title', 'Cambiar contraseña')

@section('content')
    <div style="width:100%; max-width: 950px; margin: 0 auto;">
        <div class="welcome">
            <h1 style="color: #111827; margin-bottom: 8px;">Cambiar contraseña</h1>
            <p style="color: #666; font-size: 16px; margin-bottom: 30px;">
                Actualiza la contraseña de cualquier usuario del sistema
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

            {{-- Mensaje de éxito --}}
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

            {{-- Formulario --}}
            <div class="user-info"
                style="max-width: 950px; background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <form method="POST" action="{{ route('coordinador.altas.password.update') }}" id="passwordForm">
                    @csrf
                    @method('PATCH')

                    <div
                        style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid #111827;">
                        <div
                            style="background: #111827; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 22px; height: 22px; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                        </div>
                        <h2 style="color: #111827; font-size: 20px; font-weight: 700; margin: 0;">Actualizar credenciales
                        </h2>
                    </div>

                    {{-- Campo: Email del usuario --}}
                    <div style="margin-bottom: 28px;">
                        <label
                            style="display: block; color: #374151; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Correo electrónico del usuario <span style="color: #ef4444;">*</span>
                        </label>
                        <p style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">
                            Ingresa el correo del tutor o alumno cuya contraseña deseas cambiar
                        </p>
                        <div style="position: relative;">
                            <input type="email" name="email" value="{{ old('email') }}" required
                                placeholder="Ej: usuario@universidad.edu"
                                style="width: 100%; max-width: 500px; padding: 14px 16px 14px 48px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                onfocus="this.style.borderColor='#111827'; this.style.boxShadow='0 0 0 3px rgba(17, 24, 39, 0.1)';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                            <div style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%);">
                                <svg style="width: 20px; height: 20px; color: #9ca3af;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Campo: Nueva contraseña --}}
                    <div style="margin-bottom: 28px;">
                        <label
                            style="display: block; color: #374151; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Nueva contraseña <span style="color: #ef4444;">*</span>
                        </label>
                        <p style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">
                            Mínimo 8 caracteres, recomendado incluir mayúsculas, minúsculas y números
                        </p>
                        <div style="position: relative; max-width: 500px;">
                            <input type="password" name="password" required id="password"
                                placeholder="Ingresa la nueva contraseña"
                                style="width: 100%; padding: 14px 16px 14px 48px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                onfocus="this.style.borderColor='#111827'; this.style.boxShadow='0 0 0 3px rgba(17, 24, 39, 0.1)';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                            <div style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%);">
                                <svg style="width: 20px; height: 20px; color: #9ca3af;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                    </path>
                                </svg>
                            </div>
                            <button type="button" onclick="togglePassword('password')"
                                style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af; padding: 4px;">
                                <svg id="eye-password" style="width: 20px; height: 20px;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-wrap: wrap; gap: 12px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <div id="lengthCheck"
                                    style="width: 16px; height: 16px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 10px; height: 10px; color: white; display: none;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span style="color: #6b7280; font-size: 13px;">Mínimo 8 caracteres</span>
                            </div>
                        </div>
                    </div>

                    {{-- Campo: Confirmar contraseña --}}
                    <div style="margin-bottom: 32px;">
                        <label
                            style="display: block; color: #374151; font-weight: 600; margin-bottom: 10px; font-size: 15px;">
                            Confirmar nueva contraseña <span style="color: #ef4444;">*</span>
                        </label>
                        <p style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">
                            Vuelve a ingresar la nueva contraseña para confirmar
                        </p>
                        <div style="position: relative; max-width: 500px;">
                            <input type="password" name="password_confirmation" required id="password_confirmation"
                                placeholder="Repite la nueva contraseña"
                                style="width: 100%; padding: 14px 16px 14px 48px; border-radius: 10px; border: 2px solid #d1d5db; font-size: 15px; color: #1f2937; transition: all 0.2s;"
                                onfocus="this.style.borderColor='#111827'; this.style.boxShadow='0 0 0 3px rgba(17, 24, 39, 0.1)';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                            <div style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%);">
                                <svg style="width: 20px; height: 20px; color: #9ca3af;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af; padding: 4px;">
                                <svg id="eye-password_confirmation" style="width: 20px; height: 20px;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div id="matchCheck" style="margin-top: 10px; display: none; align-items: center; gap: 6px;">
                            <div
                                style="width: 16px; height: 16px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 10px; height: 10px; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span style="color: #22c55e; font-size: 13px; font-weight: 500;">Las contraseñas
                                coinciden</span>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div
                        style="display: flex; gap: 16px; margin-top: 40px; padding-top: 24px; border-top: 1px solid #e5e7eb; justify-content: center;">
                        <button type="submit"
                            style="background: linear-gradient(135deg, #111827 0%, #374151 100%); color: white; padding: 14px 32px; border-radius: 10px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(17, 24, 39, 0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Actualizar contraseña
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

            {{-- Información de seguridad --}}
            <div
                style="margin-top: 24px; background: #fef2f2; border-radius: 8px; padding: 20px; border-left: 4px solid #dc2626;">
                <div style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg style="width: 20px; height: 20px; color: #dc2626; flex-shrink: 0; margin-top: 2px;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    <div>
                        <h3 style="color: #991b1b; font-size: 16px; font-weight: 600; margin: 0 0 8px 0;">Consideraciones
                            de seguridad</h3>
                        <ul style="color: #991b1b; font-size: 14px; margin: 0; padding-left: 18px;">
                            <li>La contraseña se actualizará inmediatamente para el usuario</li>
                            <li>El usuario no será notificado automáticamente del cambio</li>
                            <li>Es responsabilidad del coordinador informar al usuario</li>
                            <li>Se recomienda usar contraseñas seguras y únicas</li>
                            <li>Esta acción no puede deshacerse</li>
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

        // Validación en tiempo real
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const lengthCheck = document.getElementById('lengthCheck');
        const matchCheck = document.getElementById('matchCheck');

        function validatePassword() {
            // Validar longitud
            if (passwordField.value.length >= 8) {
                lengthCheck.style.background = '#22c55e';
                lengthCheck.querySelector('svg').style.display = 'block';
            } else {
                lengthCheck.style.background = '#e5e7eb';
                lengthCheck.querySelector('svg').style.display = 'none';
            }

            // Validar coincidencia
            if (passwordField.value && confirmField.value) {
                if (passwordField.value === confirmField.value) {
                    confirmField.style.borderColor = '#22c55e';
                    matchCheck.style.display = 'flex';
                } else {
                    confirmField.style.borderColor = '#ef4444';
                    matchCheck.style.display = 'none';
                }
            } else {
                confirmField.style.borderColor = '#d1d5db';
                matchCheck.style.display = 'none';
            }
        }

        passwordField.addEventListener('input', validatePassword);
        confirmField.addEventListener('input', validatePassword);

        // Validación final al enviar
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            if (passwordField.value !== confirmField.value) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor verifica.');
                passwordField.style.borderColor = '#ef4444';
                confirmField.style.borderColor = '#ef4444';
                passwordField.focus();
            }

            if (passwordField.value.length < 8) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 8 caracteres.');
                passwordField.style.borderColor = '#ef4444';
                passwordField.focus();
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

            .flex-buttons {
                flex-direction: column !important;
                gap: 12px !important;
            }

            button,
            a {
                width: 100% !important;
                justify-content: center !important;
            }

            input {
                max-width: 100% !important;
            }
        }
    </style>
@endsection
