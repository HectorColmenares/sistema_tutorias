<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe del porcentaje de asistencia de tutorados</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Librería para descargar PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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

        /* DOCUMENTO INFORMES */
        .page {
            width: 800px;
            margin: 20px auto;
            padding: 40px 50px;
            background: #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            font-size: 13px;
            line-height: 1.5;
            border-radius: 10px;
        }

        /* Versión limpia para exportar a PDF */
        .page.export-pdf {
            box-shadow: none;
            border-radius: 0;
            margin: 0;
            width: 100%;
            padding: 20px 25px;
        }

        .official-header {
            margin-bottom: 30px;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
        }

        .official-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .official-table td {
            border: 1px solid #999;
            background: #f2f2f2;
            padding: 4px 6px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 90px;
            text-align: center;
        }

        .logo-oficial {
            width: 65px;
            height: auto;
        }

        .title-cell {
            text-align: center;
            font-weight: 700;
            font-size: 12px;
            color: var(--primary-blue);
        }

        .subtitle-cell {
            text-align: center;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 8px;
        }

        /* Campos en línea */
        .campo,
        .campo-corto {
            border: none;
            border-bottom: 1px solid #000;
            font-size: 13px;
            padding: 0 4px;
            background: transparent;
            outline: none;
        }

        .campo {
            min-width: 120px;
        }

        .campo-corto {
            width: 35px;
            text-align: center;
        }

        /* Fecha: día/mes/año numérico */
        .campo-dia,
        .campo-mes-num {
            width: 35px;
            text-align: center;
            border: none;
            border-bottom: 1px solid #000;
            padding: 0 4px;
            background: transparent;
            outline: none;
        }

        .campo-anio {
            width: 55px;
            text-align: center;
            border: none;
            border-bottom: 1px solid #000;
            padding: 0 4px;
            background: transparent;
            outline: none;
        }

        /* Select de meses y año del semestre */
        .select-mes,
        .select-anio {
            border: none;
            border-bottom: 1px solid #000;
            background: transparent;
            font-size: 13px;
            padding: 0 4px;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .select-mes {
            min-width: 90px;
        }

        .select-anio {
            width: 70px;
            text-align: center;
        }

        .ubicacion,
        .asunto,
        .cuerpo {
            margin: 10px 0;
            text-align: justify;
        }

        .ubicacion {
            text-align: right;
            margin-top: 20px;
        }

        .destinatario {
            margin: 25px 0 15px;
            font-weight: 600;
        }

        .tabla-informe {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0 40px;
        }

        .tabla-informe th,
        .tabla-informe td {
            border: 1px solid #000;
            text-align: center;
            padding: 6px;
        }

        .tabla-informe th {
            background: var(--primary-blue);
            color: white;
            font-size: 12px;
        }

        .tabla-informe td {
            height: 32px;
        }

        .firma-section {
            margin-top: 40px;
            text-align: center;
        }

        .atentamente {
            letter-spacing: 4px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--primary-blue);
        }

        .moto {
            font-size: 10px;
            margin: 0 0 35px;
        }

        .firma-nombre {
            font-weight: 700;
            margin-top: 10px;
        }

        .ccp {
            margin-top: 25px;
            font-size: 11px;
        }

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
        @media (max-width: 900px) {
            .page {
                width: 95%;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 80px;
                --sidebar-collapsed-width: 80px;
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
                padding: 15px;
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

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .page {
                padding: 15px;
                overflow-x: auto;
            }

            .tabla-informe {
                font-size: 0.9rem;
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

            .watermark {
                display: none;
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

        @media print {
            body {
                background: #fff;
                padding-top: 0;
            }

            .header-top,
            .sidebar,
            .action-buttons,
            .page-title,
            .watermark {
                display: none !important;
            }

            .content {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }

            .page {
                box-shadow: none;
                margin: 0;
                width: 100%;
                border-radius: 0;
            }

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

<body class="fade-in">

    <!-- ENCABEZADO SUPERIOR -->
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
                    <a href="{{ route('documentos') }}" class="menu-item" title="Documentos">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span class="menu-text">Documentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('tutorias') }}" class="menu-item" title="Tutorías">
                        <i class="bi bi-journal-text"></i>
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
                    <div class="menu-item active" title="Informe">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span class="menu-text">Informe</span>
                    </div>
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
            <div class="page-title">INFORME DE ASISTENCIA</div>

            <div class="action-buttons">
                <button class="btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download"></i> Descargar PDF
                </button>
                <button class="btn-secondary" onclick="printDocument()">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>

            <!-- DOCUMENTO FORMAL -->
            <div id="informe-content" class="page">

                <!-- ENCABEZADO OFICIAL -->
                <div class="official-header">
                    <table class="official-table">
                        <tr>
                            <td class="logo-cell" rowspan="3">
                                <img src="{{ asset('imagenes/tecnm.png') }}" class="logo-oficial" alt="TecNM">
                            </td>
                            <td class="title-cell">
                                INSTITUTO TECNOLÓGICO SUPERIOR DE TEPOSCOLULA
                            </td>
                            <td class="logo-cell" rowspan="3">
                                <img src="{{ asset('imagenes/tepos.jpg') }}" class="logo-oficial" alt="ITST">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle-cell">
                                NOMBRE DEL FORMATO: Formato para Informe de Asistencias de Tutorados
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-cell">
                                <div class="meta-row">
                                    <span>Página: 1 de 1</span>
                                    <span>Versión: 2</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- FECHA Y ASUNTO -->
                <p class="ubicacion">
                    San Pedro y San Pablo Teposcolula, Oaxaca, a
                    <input class="campo-dia" type="number" min="1" max="31" placeholder="dd"> /
                    <input class="campo-mes-num" type="number" min="1" max="12" placeholder="mm"> /
                    <input class="campo-anio" type="number" min="2000" max="2099" placeholder="aaaa">
                </p>

                <p class="asunto">
                    <strong>Asunto:</strong> Informe del porcentaje de asistencia de tutorados
                </p>

                <!-- DESTINATARIO -->
                <div class="destinatario">
                    NOMBRE:
                    <input class="campo" type="text" placeholder="Nombre de la jefa(o)"> <br>
                    JEFA DEL DEPARTAMENTO DESARROLLO ACADÉMICO<br>
                    PRESENTE
                </div>

                <!-- TEXTO PRINCIPAL -->
                <p class="cuerpo">
                    Por este medio, me dirijo a usted para hacer de su conocimiento el porcentaje de asistencia de
                    mis tutorados, obtenido del semestre
                    <select class="select-mes">
                        <option value="" selected disabled>mes</option>
                        <option>enero</option>
                        <option>febrero</option>
                        <option>marzo</option>
                        <option>abril</option>
                        <option>mayo</option>
                        <option>junio</option>
                        <option>julio</option>
                        <option>agosto</option>
                        <option>septiembre</option>
                        <option>octubre</option>
                        <option>noviembre</option>
                        <option>diciembre</option>
                    </select>
                    -
                    <select class="select-mes">
                        <option value="" selected disabled>mes</option>
                        <option>enero</option>
                        <option>febrero</option>
                        <option>marzo</option>
                        <option>abril</option>
                        <option>mayo</option>
                        <option>junio</option>
                        <option>julio</option>
                        <option>agosto</option>
                        <option>septiembre</option>
                        <option>octubre</option>
                        <option>noviembre</option>
                        <option>diciembre</option>
                    </select>
                    <select class="select-anio">
                        <option value="" selected disabled>año</option>
                        <option>2023</option>
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                    </select>,
                    para considerar aquellos que alcanzaron el 80%, son quienes tienen derecho a recibir su
                    constancia de cumplimiento de tutorías y a participar en el proceso de evaluación tutorial.
                </p>

                <p class="cuerpo">
                    Sin más por el momento, agradezco la atención que brinde al presente.
                </p>

                <!-- TABLA -->
                <table class="tabla-informe">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre del tutorado (a)</th>
                            <th>Semestre y grupo</th>
                            <th>Número de sesiones a las que fue convocado</th>
                            <th>Número de sesiones a las que asistió</th>
                            <th>Porcentaje alcanzado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td><input type="text" class="campo-corto" placeholder="Matrícula"></td>
                                <td><input type="text" class="campo" placeholder="Nombre"></td>
                                <td><input type="text" class="campo-corto" placeholder="Sem/Gpo"></td>
                                <td><input type="number" class="campo-corto" placeholder="0"></td>
                                <td><input type="number" class="campo-corto" placeholder="0"></td>
                                <td><input type="text" class="campo-corto" placeholder="0%"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <!-- FIRMA -->
                <div class="firma-section">
                    <p class="atentamente">A T E N T A M E N T E</p>
                    <p class="moto">Innovación Tecnológica y Desarrollo Regional Sustentable</p>

                    <p class="firma-nombre">
                        <input class="campo" type="text" placeholder="Nombre del tutor">
                    </p>

                    <p class="ccp">C.c.p Tutor</p>
                </div>
            </div>

            <div class="watermark">
                <img src="{{ asset('imagenes/tepos.jpg') }}" alt="Marca de agua">
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const toggleIcon = toggleBtn.querySelector('i');
            const bellIcon = document.getElementById('bellIcon');

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

            // Manejar notificaciones
            if (bellIcon) {
                bellIcon.addEventListener('click', function() {
                    alert(
                        'Notificaciones:\n\n• Informe de asistencia pendiente de revisión\n• 2 tutorías programadas para la próxima semana'
                    );
                });
            }
        });

        function downloadPDF() {
            const content = document.getElementById('informe-content');

            // Elementos que no queremos en el PDF
            const elementosOcultar = document.querySelectorAll(
                '.header-top, .sidebar, .action-buttons, .page-title, .watermark'
            );

            // Guardar display original y ocultar
            elementosOcultar.forEach(el => {
                el.dataset._display = el.style.display;
                el.style.display = 'none';
            });

            // Aplicar estilo limpio al documento
            content.classList.add('export-pdf');

            const opt = {
                margin: 10,
                filename: "Informe_Asistencia.pdf",
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
                    // Restaurar aunque haya error
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
