<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAT - Planeación de Actividades de Tutorías</title>

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
            transition: margin-left var(--transition-speed) ease;
        }

        .sidebar.collapsed~.content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 30px;
            text-align: center;
            padding-top: 20px;
        }

        /* ACCIÓN BOTONES */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .btn-primary,
        .btn-secondary {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), #2a4a8a);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27, 57, 106, 0.3);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        /* DOCUMENTO PAT */
        .pat {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Versión para exportar/impresión (sin sombra ni bordes extra) */
        .pat.export-pdf {
            box-shadow: none;
            border-radius: 0;
            border: none;
            padding: 0;
            max-width: 100%;
        }

        .official-header {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .official-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-oficial {
            height: 70px;
            width: auto;
        }

        .title-cell {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            color: var(--primary-blue);
        }

        .subtitle-cell {
            text-align: center;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .meta-cell {
            text-align: right;
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        /* TABLAS */
        .info-table,
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .info-table th,
        .info-table td,
        .main-table th,
        .main-table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }

        .info-table th {
            background-color: var(--primary-blue);
            color: white;
            font-weight: 600;
        }

        .main-table th {
            background-color: #2c3e50;
            color: white;
            font-weight: 600;
        }

        .info-table td,
        .main-table td {
            background-color: white;
        }

        .cell[contenteditable="true"]:empty::before {
            content: "Click para escribir...";
            color: #95a5a6;
            font-style: italic;
        }

        .input-date,
        .select-modalidad {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-small {
            padding: 6px 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-small:hover {
            background-color: #c0392b;
        }

        .section-title-pill {
            background: linear-gradient(135deg, var(--primary-blue), #2a4a8a);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: bold;
            text-align: center;
            margin: 25px 0;
            font-size: 1.2rem;
        }

        .watermark {
            position: fixed;
            bottom: 20px;
            right: 20px;
            opacity: 0.05;
            z-index: 1;
            pointer-events: none;
        }

        .watermark img {
            width: 300px;
            max-width: 100%;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 80px;
                --sidebar-collapsed-width: 80px;
            }

            .header-center h2 {
                font-size: 1rem;
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
                padding: 15px;
            }

            .sidebar.collapsed~.content {
                margin-left: var(--sidebar-width);
            }

            .page-title {
                font-size: 1.8rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .pat {
                padding: 15px;
                overflow-x: auto;
            }

            .info-table,
            .main-table {
                font-size: 0.9rem;
            }

            .menu-text {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 15px 0;
            }

            .menu i {
                margin-right: 0;
            }

            .logo-sidebar {
                margin-left: 0;
            }
        }

        /* IMPRESIÓN: solo el documento, sin menú ni encabezado */
        @media print {
            body {
                padding-top: 0;
                background: #ffffff !important;
            }

            .header-top,
            .sidebar,
            .action-buttons,
            .watermark {
                display: none !important;
            }

            .content {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }

            .pat {
                box-shadow: none;
                border-radius: 0;
                border: none;
                padding: 0;
                max-width: 100%;
            }

            /* Evitar cortes feos en tablas */
            table {
                page-break-inside: auto;
            }

            tr,
            td,
            th {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
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
            <i class="bi bi-bell-fill bell"></i>
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
                    <a href="{{ route('documentos') }}" class="menu-item" title="Documentos">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span class="menu-text">Documentos</span>
                    </a>
                </li>

                <li>
                    <div class="menu-item active" title="PAT">
                        <i class="bi bi-journal-text-fill"></i>
                        <span class="menu-text">PAT</span>
                    </div>
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
            <div class="page-title">Planeación de las Actividades de Tutorías (PAT)</div>

            <div class="action-buttons">
                <button class="btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download"></i> Descargar PDF
                </button>
                <button class="btn-secondary" onclick="printDocument()">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
                <button id="addSessionBtn" class="btn-secondary">
                    <i class="bi bi-plus-lg"></i> Agregar sesión
                </button>
            </div>

            <!-- DOCUMENTO PAT -->
            <section id="pat-content" class="pat">
                <div class="official-header">
                    <table class="official-table">
                        <tr>
                            <td class="logo-cell" rowspan="3">
                                <img src="{{ asset('imagenes/tecnm.png') }}" class="logo-oficial" alt="TecNM">
                            </td>
                            <td class="title-cell">INSTITUTO TECNOLÓGICO SUPERIOR DE TEPOSCOLULA</td>
                            <td class="logo-cell" rowspan="3">
                                <img src="{{ asset('imagenes/tepos.jpg') }}" class="logo-oficial" alt="ITST">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle-cell">
                                NOMBRE DEL FORMATO: Planeación de las Actividades de Tutorías (PAT)
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-cell">
                                <div class="meta-row">
                                    <span>Página: 1 de 3</span>
                                    <span>Versión: 2</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- INFORMACIÓN SUPERIOR -->
                <table class="info-table">
                    <tr>
                        <th>Semestre</th>
                        <th>Nombre y firma del tutor</th>
                        <th>División de adscripción</th>
                        <th>Núm. de tutorados</th>
                        <th>Núm. de horas asignadas</th>
                        <th>Fecha de Elaboración</th>
                    </tr>
                    <tr>
                        <td class="cell" contenteditable="true"></td>
                        <td class="cell" contenteditable="true"></td>
                        <td class="cell" contenteditable="true"></td>
                        <td class="cell" contenteditable="true"></td>
                        <td class="cell" contenteditable="true"></td>
                        <td class="cell">
                            <input type="date" class="input-date">
                        </td>
                    </tr>
                </table>

                <div class="section-title-pill">PLANEACIÓN DE LAS ACTIVIDADES DE TUTORÍAS</div>

                <table class="main-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Fecha</th>
                            <th>Modalidad</th>
                            <th>Tema</th>
                            <th>Descripción</th>
                            <th class="acciones-col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><input type="date" class="input-date"></td>
                                <td>
                                    <select class="select-modalidad">
                                        <option value="">Seleccione...</option>
                                        <option value="Individual">Individual</option>
                                        <option value="Grupal">Grupal</option>
                                    </select>
                                </td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td class="action-cell">
                                    <button class="btn-small" onclick="removeRow(this)">Eliminar</button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </section>

            <div class="watermark">
                <img src="{{ asset('imagenes/tepos.png') }}" alt="marca de agua">
            </div>
        </main>
    </div>

    <!-- Librería para PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const toggleIcon = toggleBtn.querySelector('i');

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
        });

        document.getElementById('addSessionBtn').addEventListener('click', addSessionRow);

        function addSessionRow() {
            const tbody = document.querySelector('.main-table tbody');
            const next = tbody.children.length + 1;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${next}</td>
                <td><input type="date" class="input-date"></td>
                <td>
                    <select class="select-modalidad">
                        <option value="">Seleccione...</option>
                        <option value="Individual">Individual</option>
                        <option value="Grupal">Grupal</option>
                    </select>
                </td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td class="action-cell">
                    <button class="btn-small" onclick="removeRow(this)">Eliminar</button>
                </td>
            `;
            tbody.appendChild(tr);
        }

        function removeRow(btn) {
            if (confirm('¿Está seguro de eliminar esta sesión?')) {
                btn.closest('tr').remove();
                renumberRows();
            }
        }

        function renumberRows() {
            const rows = document.querySelectorAll('.main-table tbody tr');
            rows.forEach((row, i) => row.children[0].textContent = i + 1);
        }

        function downloadPDF() {
            const content = document.getElementById("pat-content");

            // Elementos que no queremos en el PDF
            const elementosOcultar = document.querySelectorAll(
                '.acciones-col, .action-cell, .btn-small, .action-buttons, .sidebar, .header-top, .watermark'
            );

            // Guardar display original y ocultar
            elementosOcultar.forEach(el => {
                el.dataset._display = el.style.display;
                el.style.display = 'none';
            });

            // Ajustar estilo del contenedor para exportar
            content.classList.add('export-pdf');

            const opt = {
                margin: 10,
                filename: "PAT_Planeacion_Actividades.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: "mm",
                    format: "letter",
                    orientation: "portrait"
                }
            };

            html2pdf()
                .set(opt)
                .from(content)
                .save()
                .then(() => {
                    // Restaurar visibilidad y estilos
                    elementosOcultar.forEach(el => {
                        el.style.display = el.dataset._display || '';
                        delete el.dataset._display;
                    });
                    content.classList.remove('export-pdf');
                })
                .catch(() => {
                    // En caso de error, asegurarse de restaurar
                    elementosOcultar.forEach(el => {
                        el.style.display = el.dataset._display || '';
                        delete el.dataset._display;
                    });
                    content.classList.remove('export-pdf');
                });
        }

        function printDocument() {
            window.print();
        }
    </script>

</body>

</html>
