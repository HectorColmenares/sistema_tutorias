<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Tutorías - Coordinador')</title>

    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- ====== BARRA SUPERIOR ====== --}}
    <header class="navbar-top">
        <div class="navbar-content">

            <div class="left-section d-flex align-items-center">
                {{-- ✅ BOTÓN TOGGLE AQUÍ (NO en el <ul>) --}}
                <button class="toggle-sidebar-btn" id="toggleSidebar" title="Contraer/Expandir menú" type="button">
                    <i class="bi bi-list"></i>
                </button>

                <img src="{{ asset('imagenes/tecnm.png') }}" alt="TecNM" class="logo-tecnm">
            </div>

            <div class="title">
                Instituto Tecnológico Superior de Teposcolula
            </div>

            <div class="right-section">
                <i class="bi bi-bell-fill" id="bellIcon" title="Notificaciones"></i>
                <img src="{{ asset('imagenes/oaxaca.jpg') }}" alt="Oaxaca" class="logo-oaxaca">
            </div>

        </div>
    </header>

    <div class="main-container">
        {{-- ====== SIDEBAR ====== --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('imagenes/tepos.jpg') }}" alt="Logo" class="sidebar-logo">
            </div>

            <ul class="menu">
                <li>
                    <a href="#" class="{{ request()->is('coordinador/documentos*') ? 'active' : '' }}"
                        title="Documentos">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span class="menu-text">Documentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('coordinador.altas.index') }}"
                        class="{{ request()->routeIs('coordinador.altas.*') ? 'active' : '' }}" title="Altas">
                        <i class="bi bi-person-plus-fill"></i>
                        <span class="menu-text">Altas</span>
                    </a>
                </li>


                <li>
                    <a href="#" class="{{ request()->is('coordinador/calendarizacion*') ? 'active' : '' }}"
                        title="Calendarización">
                        <i class="bi bi-calendar-week-fill"></i>
                        <span class="menu-text">Calendarización</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="{{ request()->is('coordinador/tutorias*') ? 'active' : '' }}"
                        title="Tutorías">
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-text">Tutorías</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="{{ request()->is('coordinador/grupos*') ? 'active' : '' }}" title="Grupos">
                        <i class="bi bi-diagram-3-fill"></i>
                        <span class="menu-text">Grupos</span>
                    </a>
                </li>
            </ul>

            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Cerrar sesión">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="menu-text">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ====== CONTENIDO PRINCIPAL ====== --}}
        <main class="contenido">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notificaciones demo
            const bellIcon = document.getElementById('bellIcon');
            if (bellIcon) {
                bellIcon.addEventListener('click', function() {
                    const notifications = [{
                            text: "Bienvenido al sistema de tutorías (Coordinador)",
                            time: "Reciente"
                        },
                        {
                            text: "Revisa los periodos activos",
                            time: "Reciente"
                        },
                    ];

                    let msg = `Notificaciones:\n\n`;
                    notifications.forEach(n => {
                        msg += `- ${n.text} (${n.time})\n`;
                    });
                    alert(msg);
                });
            }

            // Toggle sidebar
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
                    if (toggleIcon) toggleIcon.className = now ? 'bi bi-arrow-right-square-fill' :
                        'bi bi-list';
                });
            }
        });
    </script>
</body>

</html>
