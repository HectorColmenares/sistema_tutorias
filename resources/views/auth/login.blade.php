<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Sistema de Tutorías</title>

    {{-- CSS público (no cambia funcionalidad) --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Vite (Tailwind/Breeze) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- ====== ENCABEZADO ====== -->
    <header class="login-header">
        <h1>Inicio de Sesión</h1>

    </header>

    <!-- ====== CONTENEDOR PRINCIPAL ====== -->
    <main class="login-container">
        <!-- COLUMNA IZQUIERDA -->
        <div class="login-left">
            <img src="{{ asset('imagenes/tepos.jpg') }}" alt="Logo ITST" class="logo-itst">
            <img src="{{ asset('imagenes/tecnm.png') }}" alt="Logo TecNM" class="logo-tecnm">
        </div>

        <!-- COLUMNA DERECHA -->
        <div class="login-right">
            <h2>TUTORÍAS</h2>
            <p class="login-subtitle">Sistema de Gestión de Tutorías Académicas ITSTE</p>

            {{-- Status (ej. “Se envió el correo…”) --}}
            @if (session('status'))
                <div class="success-message">
                    <i class="bi bi-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="error-message">
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- ✅ Mantenemos la funcionalidad original de Breeze --}}
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <div class="input-group">
                    <i class="bi bi-person-circle"></i>
                    <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}"
                        required autofocus autocomplete="username">
                </div>

                <div class="input-group">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="password" placeholder="Contraseña" required
                        autocomplete="current-password">
                </div>

                {{-- ⚠️ Roles: SOLO DISEÑO (sin name, sin required) para no cambiar lógica --}}
                {{-- Si luego quieres login por rol, lo implementamos aparte. --}}


                <div class="login-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Recordarme
                    </label>



                    <label class="role-option">

                        ¿Olvidaste tu contraseña?, contacta al Coordinador.
                    </label>
                </div>

                <button type="submit" class="btn-acceder">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Acceder
                </button>
            </form>
        </div>
    </main>
</body>

</html>
