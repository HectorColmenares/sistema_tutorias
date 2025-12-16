<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESA - Reporte Semestral de Acompañamiento</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Librería para generar PDF -->
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: var(--header-height);
            background-color: #f5f5f5;
        }

        /* HEADER - NARANJA */
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

        /* SIDEBAR - AZUL */
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

        .sidebar.collapsed .menu-text {
            display: none;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

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
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* BOTONES DE ACCIÓN */
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
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), #2a4a8a);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2a4a8a, var(--primary-blue));
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(27, 57, 106, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #6c757d);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        /* CONTENIDO RESA (PARA PDF) */
        #resa-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        /* Versión limpia para exportar a PDF */
        #resa-content.export-pdf {
            box-shadow: none;
            border-radius: 0;
            margin: 0;
            padding: 20px 25px;
        }

        /* ENCABEZADO OFICIAL */
        .official-header {
            margin-bottom: 30px;
            border: 2px solid #1B396A;
            border-radius: 8px;
            overflow: hidden;
        }

        .official-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 120px;
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .title-cell {
            text-align: center;
            font-size: 1.4rem;
            font-weight: bold;
            color: #1B396A;
            padding: 15px;
            background-color: #e9f7fe;
        }

        .subtitle-cell {
            text-align: center;
            font-size: 1.1rem;
            color: #495057;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .meta-cell {
            text-align: center;
            padding: 10px;
            background-color: #e9f7fe;
        }

        .meta-row {
            display: flex;
            justify-content: space-around;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .logo-oficial {
            width: 100px;
            height: auto;
        }

        /* DATOS DEL TUTOR */
        .resa-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #dee2e6;
        }

        .header-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .field-group {
            flex: 1;
        }

        .field-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }

        .field-group input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        /* TABLA PRINCIPAL */
        .table-wrapper {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        .resa-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            page-break-inside: auto;
        }

        .resa-table thead th {
            background-color: #1B396A;
            color: white;
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .header-row-1 th {
            background-color: #15294f;
        }

        .resa-table tbody td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        .resa-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .resa-table input {
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 6px 8px;
            font-size: 0.9rem;
        }

        .big-col {
            width: 200px;
        }

        .asig-col {
            width: 150px;
        }

        .inst-col {
            width: 250px;
        }

        .big-input input {
            width: 100%;
        }

        .small-input input {
            width: 80px;
        }

        .asig-input input {
            width: 100%;
        }

        .unit input {
            width: 50px;
            text-align: center;
        }

        .prob input {
            width: 100%;
        }

        .inst {
            background-color: #f8f9fa;
        }

        .inst label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.85rem;
        }

        .inst input[type="checkbox"] {
            width: auto;
            margin-right: 5px;
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

            .resa-table {
                font-size: 0.8rem;
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

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            #resa-content {
                padding: 15px;
            }

            .header-row {
                flex-direction: column;
                gap: 10px;
            }

            .resa-table {
                font-size: 0.7rem;
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
                margin-bottom: 20px;
            }

            .official-table {
                font-size: 0.8rem;
            }

            .title-cell {
                font-size: 1rem;
                padding: 8px;
            }

            .logo-oficial {
                width: 60px;
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

        /* Estilos para impresión nativa (Ctrl+P o botón Imprimir) */
        @media print {
            body {
                background: #fff;
                padding-top: 0;
            }

            .header-top,
            .sidebar,
            .action-buttons,
            .watermark,
            .page-title {
                display: none !important;
            }

            .content {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }

            #resa-content {
                box-shadow: none;
                margin: 0;
                width: 100%;
                border-radius: 0;
                padding: 10mm;
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
                    <a href="{{ route('documentos') }}" class="menu-item" title="Documentos">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span class="menu-text">Documentos</span>
                    </a>
                </li>

                <li>
                    <div class="menu-item active" title="RESA">
                        <i class="bi bi-journal-text-fill"></i>
                        <span class="menu-text">RESA</span>
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
            <!-- TÍTULO RESA (NO IMPRIMIBLE) -->
            <div class="page-title no-print">
                <i></i>REPORTE DE SEGUIMIENTO ACADÉMICO (RESA)
            </div>

            <!-- BOTONES DE ACCIÓN (NO IMPRIMIBLES) -->
            <div class="action-buttons no-print">
                <button class="btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download"></i> Descargar PDF
                </button>
                <button class="btn-secondary" onclick="printDocument()">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>

            <!-- TODO EL FORMATO QUE SE DESCARGA EN PDF -->
            <div id="resa-content" class="page">

                <!-- ENCABEZADO OFICIAL (IGUAL AL FORMATO) -->
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
                                <img src="{{ asset('imagenes/tepos.jpg') }}" class="logo-oficial" alt="tepos">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle-cell">
                                NOMBRE DEL FORMATO: Reporte de Seguimiento Académico (RESA)
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-cell">
                                <div class="meta-row">
                                    <span>Página: 1 de 2</span>
                                    <span>Versión: 2</span>
                                    <span>Fecha: {{ now()->format('d/m/Y') }}</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- DATOS DEL TUTOR -->
                <div class="resa-header">
                    <div class="header-row">
                        <div class="field-group">
                            <label>Nombre y firma del tutor (1):</label>
                            <input type="text" placeholder="Nombre completo del tutor">
                        </div>
                        <div class="field-group">
                            <label>Período mensual (2):</label>
                            <input type="text" placeholder="Ej: Enero 2024">
                        </div>
                    </div>

                    <div class="header-row">
                        <div class="field-group">
                            <label>División (3):</label>
                            <input type="text" placeholder="Ej: Sistemas y Computación">
                        </div>
                        <div class="field-group">
                            <label>Núm. de Tutorados (4):</label>
                            <input type="number" placeholder="0">
                        </div>
                        <div class="field-group">
                            <label>Fecha de entrega (5):</label>
                            <input type="date">
                        </div>
                    </div>
                </div>

                <!-- TABLA PRINCIPAL -->
                <div class="table-wrapper">
                    <table class="resa-table">
                        <thead>
                            <tr class="header-row-1">
                                <th rowspan="2" class="big-col">Nombre completo del tutorado (6)</th>
                                <th rowspan="2">Semestre y grupo (7)</th>
                                <th colspan="8">Calificaciones por asignatura y por unidad (8)</th>
                                <th colspan="2">Problemáticas identificadas (9)</th>
                                <th rowspan="2" class="inst-col">Instancia a la que se canalizó y/o acción
                                    realizada (10)</th>
                            </tr>
                            <tr class="header-row-2">
                                <th class="asig-col">Asignatura(s)</th>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>IV</th>
                                <th>V</th>
                                <th>VI</th>
                                <th>VII</th>
                                <th>Personales</th>
                                <th>Académicas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- FILA 1 -->
                            <tr>
                                <td class="big-input"><input type="text" placeholder="Nombre completo"></td>
                                <td class="small-input"><input type="text" placeholder="Ej: 5°A"></td>
                                <td class="asig-input"><input type="text" placeholder="Nombre asignatura"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="prob"><input type="text" placeholder="Problemática personal"></td>
                                <td class="prob"><input type="text" placeholder="Problemática académica"></td>
                                <td class="inst">
                                    <label><input type="checkbox"> Asesoría académica</label>
                                    <label><input type="checkbox"> Enfermería</label>
                                    <label><input type="checkbox"> Psicología</label>
                                    <label><input type="checkbox"> Jefatura de división</label>
                                    <label><input type="checkbox"> Otra: <input type="text" style="width:80px;"
                                            placeholder="Especificar"></label>
                                </td>
                            </tr>
                            <!-- FILA 2 -->
                            <tr>
                                <td class="big-input"><input type="text" placeholder="Nombre completo"></td>
                                <td class="small-input"><input type="text" placeholder="Ej: 5°A"></td>
                                <td class="asig-input"><input type="text" placeholder="Nombre asignatura"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="prob"><input type="text" placeholder="Problemática personal"></td>
                                <td class="prob"><input type="text" placeholder="Problemática académica"></td>
                                <td class="inst">
                                    <label><input type="checkbox"> Asesoría académica</label>
                                    <label><input type="checkbox"> Enfermería</label>
                                    <label><input type="checkbox"> Psicología</label>
                                    <label><input type="checkbox"> Jefatura de división</label>
                                    <label><input type="checkbox"> Otra: <input type="text" style="width:80px;"
                                            placeholder="Especificar"></label>
                                </td>
                            </tr>
                            <!-- FILA 3 -->
                            <tr>
                                <td class="big-input"><input type="text" placeholder="Nombre completo"></td>
                                <td class="small-input"><input type="text" placeholder="Ej: 5°A"></td>
                                <td class="asig-input"><input type="text" placeholder="Nombre asignatura"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="unit"><input type="number" min="0" max="100"
                                        placeholder="0-100"></td>
                                <td class="prob"><input type="text" placeholder="Problemática personal"></td>
                                <td class="prob"><input type="text" placeholder="Problemática académica"></td>
                                <td class="inst">
                                    <label><input type="checkbox"> Asesoría académica</label>
                                    <label><input type="checkbox"> Enfermería</label>
                                    <label><input type="checkbox"> Psicología</label>
                                    <label><input type="checkbox"> Jefatura de división</label>
                                    <label><input type="checkbox"> Otra: <input type="text" style="width:80px;"
                                            placeholder="Especificar"></label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 30px; text-align: center; font-size: 0.9rem; color: #6c757d;">
                    <p><strong>Nota:</strong> Este formato debe ser llenado por el tutor y entregado a la coordinación
                        de tutorías al final de cada mes.</p>
                </div>

            </div> <!-- fin #resa-content -->

            <!-- MARCA DE AGUA -->
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
                    const notifications = [{
                            id: 1,
                            text: "Recordatorio: Entrega de RESA este viernes",
                            time: "Hace 2 días",
                            read: false
                        },
                        {
                            id: 2,
                            text: "Nuevo tutorado asignado",
                            time: "Hace 1 semana",
                            read: true
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

                    // Crear y mostrar modal de notificaciones
                    const modal = new bootstrap.Modal(
                        document.getElementById('notificationsModal') || createNotificationModal()
                    );
                    const modalContent = document.getElementById('notificationsContent');
                    if (modalContent) {
                        modalContent.innerHTML = notificationHTML;
                    }
                    modal.show();
                });
            }

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
            console.log('Usuario en RESA:', {
                nombre: '{{ Auth::user()->name }}',
                email: '{{ Auth::user()->email }}',
                rol: '{{ Auth::user()->role }}'
            });
        @endauth
        });

        // Descargar PDF del contenido del formato RESA (solo el documento)
        function downloadPDF() {
            const content = document.getElementById("resa-content");

            // Elementos que NO deben salir en el PDF
            const elementosOcultar = document.querySelectorAll(
                '.header-top, .sidebar, .action-buttons, .watermark, .page-title'
            );

            // Guardar display original y ocultar
            elementosOcultar.forEach(el => {
                el.dataset._display = el.style.display;
                el.style.display = 'none';
            });

            // Aplicar estilo limpio al documento
            content.classList.add('export-pdf');

            html2pdf()
                .set({
                    margin: 10,
                    filename: "RESA_Reporte_Seguimiento_Academico.pdf",
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
                        orientation: "landscape"
                    },
                    pagebreak: {
                        mode: ['css', 'legacy'],
                        avoid: 'tr'
                    }
                })
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
                    // Restaurar aunque falle
                    elementosOcultar.forEach(el => {
                        el.style.display = el.dataset._display || '';
                        delete el.dataset._display;
                    });
                    content.classList.remove('export-pdf');
                });
        }

        // Imprimir usando los estilos @media print (sin abrir ventana nueva)
        function printDocument() {
            window.print();
        }
    </script>

</body>

</html>
