<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Documentos - Sistema de Tutorías</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --header-height: 70px;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
            --primary-blue: #1B396A;
            --primary-orange: #FF771B;
            --transition-speed: 0.3s;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: var(--header-height);
            background-color: #f5f5f5;
        }

        /* HEADER - NUEVO COLOR NARANJA */
        .header-top {
            background-color: var(--primary-orange);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            z-index: 1000;
        }

        .header-left,
        .header-right {
            display: flex;
            align-items: center;
        }

        .header-center {
            flex: 1;
            text-align: center;
        }

        .header-center h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .logo-tecnm,
        .logo-oaxaca {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .bell {
            font-size: 1.5rem;
            margin-right: 20px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .bell:hover {
            transform: scale(1.1);
        }

        /* BOTÓN TOGGLE EN HEADER */
        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-right: 15px;
        }

        .toggle-sidebar-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* CONTENEDOR PRINCIPAL */
        .container-main {
            display: flex;
            min-height: calc(100vh - var(--header-height));
            transition: margin-left var(--transition-speed) ease;
        }

        /* SIDEBAR - NUEVO COLOR AZUL */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-blue) 0%, #15294f 100%);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 20px 15px;
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            z-index: 900;
            transition: width var(--transition-speed) ease;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            align-items: center;
        }

        /* Texto en menú - se oculta cuando está contraído */
        .sidebar.collapsed .menu-text {
            display: none;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        /* Íconos centrados cuando está contraído */
        .sidebar.collapsed .menu a {
            justify-content: center;
            padding: 15px 0;
            width: 100%;
        }

        .sidebar.collapsed .menu i {
            margin-right: 0;
        }

        .logo-sidebar {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 30px;
            margin-left: 5px;
        }

        .sidebar.collapsed .logo-sidebar {
            margin-left: 0;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .menu li {
            margin: 5px 0;
        }

        .menu-item {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            color: #bdc3c7;
            font-size: 1rem;
            margin: 8px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            padding: 0 15px;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .menu-item.active {
            background-color: var(--primary-orange);
            color: white;
        }

        .sidebar.collapsed .menu-item:hover {
            transform: translateY(-2px);
        }

        .menu i {
            margin-right: 15px;
            font-size: 1.2rem;
            min-width: 24px;
            text-align: center;
        }

        /* CONTENIDO PRINCIPAL */
        .content {
            flex: 1;
            padding: 30px;
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - var(--header-height));
            position: relative;
            background-color: white;
            border-radius: 15px 0 0 0;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: margin-left var(--transition-speed) ease;
        }

        .sidebar.collapsed~.content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 40px;
            text-align: center;
            padding-top: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* PANEL DE DOCUMENTOS */
        .docs-panel {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
            border: 2px solid #e0e0e0;
        }

        .docs-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .category-btn {
            background: linear-gradient(135deg, var(--primary-blue), #2a4a8a);
            color: white;
            border: none;
            padding: 30px 20px;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(27, 57, 106, 0.2);
            text-decoration: none;
        }

        .category-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(27, 57, 106, 0.3);
            background: linear-gradient(135deg, #2a4a8a, var(--primary-blue));
            color: white;
        }

        /* LOGO DE FONDO */
        .watermark {
            position: fixed;
            bottom: 30px;
            right: 30px;
            opacity: 0.05;
            z-index: 1;
            pointer-events: none;
        }

        .watermark img {
            width: 400px;
            max-width: 100%;
            height: auto;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .header-center h2 {
                font-size: 1.3rem;
            }

            .docs-categories {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 80px;
                --sidebar-collapsed-width: 80px;
            }

            .header-top {
                padding: 10px 15px;
            }

            .header-center h2 {
                font-size: 1rem;
            }

            .logo-tecnm,
            .logo-oaxaca {
                height: 40px;
            }

            .sidebar {
                width: var(--sidebar-width);
                align-items: center;
            }

            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }

            .content {
                margin-left: var(--sidebar-width);
                padding: 20px;
            }

            .sidebar.collapsed~.content {
                margin-left: var(--sidebar-width);
            }

            .logo-sidebar {
                width: 40px;
                height: 40px;
                margin-bottom: 20px;
                margin-left: 0;
            }

            .menu-item {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                justify-content: center;
                padding: 15px 0;
            }

            .page-title {
                font-size: 2rem;
            }

            .docs-panel {
                padding: 25px;
            }

            .docs-categories {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .category-btn {
                padding: 25px 15px;
                font-size: 1.1rem;
                min-height: 100px;
            }

            .watermark {
                display: none;
            }

            .menu-text {
                display: none;
            }

            .menu i {
                margin-right: 0;
            }
        }

        @media (max-width: 576px) {
            .header-top {
                flex-direction: column;
                height: auto;
                padding: 10px;
            }

            .header-left,
            .header-center,
            .header-right {
                width: 100%;
                justify-content: center;
                margin: 5px 0;
            }

            .header-center h2 {
                font-size: 0.9rem;
            }

            body {
                padding-top: 120px;
            }

            .sidebar {
                width: 100%;
                height: 60px;
                top: auto;
                bottom: 0;
                flex-direction: row;
                justify-content: space-around;
                padding: 10px 0;
            }

            .content {
                margin-left: 0;
                margin-bottom: 60px;
                border-radius: 0;
            }

            .logo-sidebar {
                display: none;
            }

            .page-title {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }
        }

        /* ANIMACIONES */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body class="fade-in">

    <!-- ENCABEZADO NARANJA -->
    <header class="header-top">
        <div class="header-left">
            <button class="toggle-sidebar-btn" id="toggleSidebar" title="Contraer/Expandir menú">
                <i class="bi bi-list"></i>
            </button>
            <img src="{{ asset('imagenes/tecnm.png') }}" alt="TecNM" class="logo-tecnm">
        </div>
        <div class="header-center">
            <h2>Instituto Tecnológico Superior de Teposcolula</h2>
        </div>
        <div class="header-right">
            <i class="bi bi-bell-fill bell" id="bellIcon" title="Notificaciones"></i>
            <img src="{{ asset('imagenes/oaxaca.jpg') }}" alt="Oaxaca" class="logo-oaxaca">
        </div>
    </header>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="container-main">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <img src="{{ asset('imagenes/tepos.jpg') }}" alt="Logo" class="logo-sidebar">

            <ul class="menu">
                <li>
                    <a href="{{ route('tutor.dashboard') }}" class="menu-item" title="Principal">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="menu-text">Principal</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('tutorados') }}" class="menu-item" title="Tutorados">
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-text">Tutorados</span>
                    </a>
                </li>

                <li>
                    <div class="menu-item active" title="Documentos">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span class="menu-text">Documentos</span>
                    </div>
                </li>

                <li>
                    <a href="{{ route('tutorias') }}" class="menu-item" title="Tutorías">
                        <i class="bi bi-journal-text-fill"></i>
                        <span class="menu-text">Tutorías</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('entrevista') }}" class="menu-item" title="Entrevista">
                        <i class="bi bi-chat-left-text-fill"></i>
                        <span class="menu-text">Entrevista</span>
                    </a>
                </li>

                <li>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" class="menu-item" title="Cerrar sesión"
                            style="background: none; border: none; cursor: pointer; width: 100%; text-align: left;">
                            <i class="bi bi-box-arrow-left"></i>
                            <span class="menu-text">Cerrar sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="content">
            <!-- TITULO DOCUMENTOS -->
            <div class="page-title">
                <i class="bi bi-folder-fill me-3"></i>DOCUMENTOS
            </div>

            <!-- PANEL DE DOCUMENTOS -->
            <div class="docs-panel fade-in">
                <p class="text-center text-muted mb-4">Seleccione el tipo de documento que desea gestionar:</p>

                <div class="docs-categories">
                    <a href="{{ route('documentos.reac') }}" class="category-btn">
                        <i class="bi bi-file-earmark-text me-2"></i>REAC
                    </a>
                    <a href="{{ route('documentos.resa') }}" class="category-btn">
                        <i class="bi bi-file-earmark-check me-2"></i>RESA
                    </a>
                    <a href="{{ route('documentos.pat') }}" class="category-btn">
                        <i class="bi bi-file-earmark-medical me-2"></i>PAT
                    </a>
                    <a href="{{ route('documentos.informe') }}" class="category-btn">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>INFORME
                    </a>
                </div>

                <div class="mt-5 text-center">
                    <p class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        Si no encuentra el documento que busca, contacte al coordinador de tutorías.
                    </p>
                </div>
            </div>

            <!-- LOGO DE FONDO -->
            <div class="watermark">
                <img src="{{ asset('imagenes/tepos.jpg') }}" alt="ITST">
            </div>
        </main>
    </div>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const toggleIcon = toggleBtn.querySelector('i');
            const bellIcon = document.getElementById('bellIcon');
            const menuItems = document.querySelectorAll('.menu-item:not(.logout-btn)');

            // Verificar si hay un estado guardado en localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            // Aplicar estado inicial
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                toggleIcon.className = 'bi bi-arrow-right-square-fill';
            }

            // Evento para el botón toggle
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');

                // Cambiar ícono según estado
                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.className = 'bi bi-arrow-right-square-fill';
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    toggleIcon.className = 'bi bi-list';
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });

            // Ajustar en redimensionamiento de pantalla
            window.addEventListener('resize', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('collapsed');
                    toggleIcon.className = 'bi bi-arrow-right-square-fill';
                    localStorage.setItem('sidebarCollapsed', 'true');
                }
            });

            // Inicial para móviles
            if (window.innerWidth < 768 && !isCollapsed) {
                sidebar.classList.add('collapsed');
                toggleIcon.className = 'bi bi-arrow-right-square-fill';
                localStorage.setItem('sidebarCollapsed', 'true');
            }

            // Remover clase active de todos los items del menú
            function removeActiveClass() {
                menuItems.forEach(item => {
                    item.classList.remove('active');
                });
            }

            // Agregar clase active al item actual (Documentos)
            menuItems.forEach(item => {
                if (item.querySelector('.bi-file-earmark-text-fill')) {
                    item.classList.add('active');
                }

                if (item.tagName === 'A' || item.tagName === 'BUTTON') {
                    item.addEventListener('click', function(e) {
                        if (this.tagName === 'A') {
                            removeActiveClass();
                            this.classList.add('active');
                        }
                    });
                }
            });

            // Manejar notificaciones
            if (bellIcon) {
                bellIcon.addEventListener('click', function() {
                    // Aquí podrías cargar notificaciones reales
                    const notifications = [{
                            id: 1,
                            text: "Nuevo documento REAC disponible",
                            time: "Hace 2 horas",
                            read: false
                        },
                        {
                            id: 2,
                            text: "Recordatorio: Entrega de informe mensual",
                            time: "Hace 1 día",
                            read: true
                        },
                        {
                            id: 3,
                            text: "Tutoría programada para mañana",
                            time: "Hace 2 días",
                            read: false
                        }
                    ];

                    const unreadCount = notifications.filter(n => !n.read).length;

                    let notificationHTML = `<div class="p-3">
                        <h6><i class="bi bi-bell-fill me-2"></i>Notificaciones (${unreadCount} sin leer)</h6>
                        <hr>`;

                    notifications.forEach(notif => {
                        notificationHTML += `
                            <div class="mb-2 p-2 ${notif.read ? 'bg-light' : 'bg-warning bg-opacity-10'} rounded">
                                <small class="d-block">${notif.text}</small>
                                <small class="text-muted">${notif.time}</small>
                            </div>`;
                    });

                    notificationHTML += `</div>`;

                    // Usar SweetAlert o modal de Bootstrap para mostrar notificaciones
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Notificaciones',
                            html: notificationHTML,
                            showCloseButton: true,
                            showConfirmButton: false,
                            width: '500px'
                        });
                    } else {
                        // Modal simple con Bootstrap
                        const modal = new bootstrap.Modal(document.getElementById('notificationsModal') ||
                            createNotificationModal());
                        modal.show();
                    }
                });
            }

            // Crear modal de notificaciones si no existe
            function createNotificationModal() {
                const modalDiv = document.createElement('div');
                modalDiv.id = 'notificationsModal';
                modalDiv.className = 'modal fade';
                modalDiv.innerHTML = `
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-bell-fill me-2"></i>Notificaciones</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="notificationsContent">
                                Cargando notificaciones...
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modalDiv);
                return modalDiv;
            }

            // Mostrar información del usuario si está autenticado
            @auth
            console.log('Usuario autenticado:', {
                nombre: '{{ Auth::user()->name }}',
                email: '{{ Auth::user()->email }}',
                rol: '{{ Auth::user()->role }}'
            });
        @endauth
        });
    </script>

</body>

</html>
