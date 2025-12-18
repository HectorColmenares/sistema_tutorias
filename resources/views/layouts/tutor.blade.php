<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Tutorías - Tutor')</title>

    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
<header class="navbar-top">
    <div class="navbar-content">
        <div class="left-section d-flex align-items-center">
            <button class="toggle-sidebar-btn" id="toggleSidebar" type="button">
                <i class="bi bi-list"></i>
            </button>
            <img src="{{ asset('imagenes/tecnm.png') }}" alt="TecNM" class="logo-tecnm">
        </div>

        <div class="title">Instituto Tecnológico Superior de Teposcolula</div>

        <div class="right-section">
            <i class="bi bi-bell-fill" id="bellIcon" title="Notificaciones"></i>
            <img src="{{ asset('imagenes/oaxaca.jpg') }}" alt="Oaxaca" class="logo-oaxaca">
        </div>
    </div>
</header>

<div class="main-container">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('imagenes/tepos.jpg') }}" alt="Logo" class="sidebar-logo">
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('tutor.dashboard') }}" class="{{ request()->routeIs('tutor.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i> <span class="menu-text">Inicio</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.documentos') }}" class="{{ request()->routeIs('tutor.documentos') ? 'active' : '' }}">
                    <i class="bi bi-folder-fill"></i> <span class="menu-text">Documentos</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.calendarizacion') }}" class="{{ request()->routeIs('tutor.calendarizacion') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event-fill"></i> <span class="menu-text">Calendarización</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.tutorias') }}" class="{{ request()->routeIs('tutor.tutorias') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> <span class="menu-text">Tutorías</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.entrevistas') }}" class="{{ request()->routeIs('tutor.entrevistas') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots-fill"></i> <span class="menu-text">Entrevistas</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.asistencias') }}" class="{{ request()->routeIs('tutor.asistencias') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check-fill"></i> <span class="menu-text">Asistencias</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.constancias') }}" class="{{ request()->routeIs('tutor.constancias') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf-fill"></i> <span class="menu-text">Constancias</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tutor.datos') }}" class="{{ request()->routeIs('tutor.datos') ? 'active' : '' }}">
                    <i class="bi bi-person-lines-fill"></i> <span class="menu-text">Datos personales</span>
                </a>
            </li>
        </ul>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-right"></i> <span class="menu-text">Cerrar sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="contenido">
        @yield('content')
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const toggleIcon = toggleBtn ? toggleBtn.querySelector('i') : null;

    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        if (toggleIcon) toggleIcon.className = 'bi bi-arrow-right-square-fill';
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const now = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', now ? 'true' : 'false');
            if (toggleIcon) toggleIcon.className = now ? 'bi bi-arrow-right-square-fill' : 'bi bi-list';
        });
    }
});
</script>
</body>
</html>
