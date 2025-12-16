<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAC - Reporte de Actividades</title>

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

        /* SUBIR FOTOS */
        .photo-upload-bar {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .upload-btn {
            background: var(--primary-orange);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        #photoInput {
            display: none;
        }

        /* DOCUMENTO REAC */
        .page {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Versión limpia para exportar a PDF */
        .page.export-pdf {
            box-shadow: none;
            border-radius: 0;
            max-width: 100%;
            margin: 0;
            padding: 20px 25px;
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

        .reac-title {
            text-align: center;
            color: var(--primary-blue);
            margin: 25px 0;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary-blue);
        }

        /* TABLAS */
        .info-table,
        .reac-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .info-table td,
        .reac-table th,
        .reac-table td {
            border: 1px solid #dee2e6;
            padding: 12px;
        }

        /* 🔹 Evitar que las filas se corten entre páginas en el PDF */
        .reac-table {
            page-break-inside: auto;
        }

        .reac-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .info-label {
            font-weight: 600;
            background-color: #f8f9fa;
            width: 30%;
        }

        .line-input,
        .cell-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .reac-table th {
            background-color: var(--primary-blue);
            color: white;
            font-weight: 600;
        }

        .subheader th {
            background-color: #2a4a8a;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .check-cell {
            text-align: center;
        }

        .check-cell input[type="checkbox"] {
            transform: scale(1.3);
        }

        /* SECCIÓN DE FOTOS */
        .section-title {
            color: var(--primary-blue);
            margin: 30px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-blue);
        }

        .photo-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .photo-card {
            border: 2px dashed #bdc3c7;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .photo-img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .text-input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
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

            .page {
                padding: 15px;
                overflow-x: auto;
            }

            .info-table,
            .reac-table {
                font-size: 0.9rem;
            }

            .photo-container {
                grid-template-columns: 1fr;
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

        /* Estilos para impresión */
        @media print {
            body {
                background: #fff;
                padding-top: 0;
            }

            .header-top,
            .sidebar,
            .action-buttons,
            .photo-upload-bar,
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
                    <div class="menu-item active" title="REAC">
                        <i class="bi bi-journal-text-fill"></i>
                        <span class="menu-text">REAC</span>
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
            <div class="page-title">REPORTE DE ACTIVIDADES (REAC)</div>

            <div class="action-buttons">
                <button class="btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download"></i> Descargar PDF
                </button>
                <button class="btn-secondary" onclick="printDocument()">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>

            <!-- SUBIR FOTOS -->
            <div class="photo-upload-bar">
                <label for="photoInput" class="upload-btn">
                    <i class="bi bi-image"></i> Añadir fotos (máx. 2)
                </label>
                <input type="file" id="photoInput" accept="image/*" multiple>
            </div>

            <!-- DOCUMENTO REAC -->
            <div id="reac-content" class="page">
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
                                NOMBRE DEL FORMATO: Reporte de Actividades (REAC)
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

                <h3 class="reac-title">REPORTE DE ACTIVIDADES (REAC)</h3>

                <!-- DATOS GENERALES -->
                <table class="info-table">
                    <tr>
                        <td class="info-label">Nombre y firma del tutor (1):</td>
                        <td class="info-input">
                            <input type="text" class="line-input" placeholder="Nombre del tutor">
                        </td>
                        <td class="info-label">Fecha de entrega (2):</td>
                        <td class="info-input">
                            <input type="date" class="line-input">
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">División (3):</td>
                        <td class="info-input">
                            <input type="text" class="line-input" placeholder="Ej. Ingeniería Informática">
                        </td>
                        <td class="info-label">Semestre/Grupo (4):</td>
                        <td class="info-input">
                            <input type="text" class="line-input" placeholder="Ej. VI / A">
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">Núm. de tutorados (5):</td>
                        <td class="info-input">
                            <input type="number" class="line-input">
                        </td>
                        <td class="info-label">Horas de tutorías/semana (6):</td>
                        <td class="info-input">
                            <input type="number" class="line-input">
                        </td>
                    </tr>
                </table>

                <!-- TABLA DE SESIONES -->
                <table class="reac-table">
                    <thead>
                        <tr>
                            <th>No. Sesión (7)</th>
                            <th>Fecha (8)</th>
                            <th>Hora de sesión (9)</th>
                            <th colspan="2">Modalidad (10)</th>
                            <th>Tema (11)</th>
                        </tr>
                        <tr class="subheader">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Individual</th>
                            <th>Grupal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 8; $i++)
                            <tr>
                                <td><input type="number" class="cell-input" value="{{ $i + 1 }}"></td>
                                <td><input type="date" class="cell-input"></td>
                                <td><input type="time" class="cell-input"></td>
                                <td class="check-cell"><input type="checkbox"></td>
                                <td class="check-cell"><input type="checkbox"></td>
                                <td><input type="text" class="cell-input"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <!-- EVIDENCIA FOTOGRÁFICA -->
                <h3 class="section-title">Evidencia fotográfica (máx. 2 fotos)</h3>
                <div class="photo-section">
                    <div id="photoPreview" class="photo-container"></div>
                </div>
            </div>

            <div class="watermark">
                <img src="{{ asset('imagenes/tepos.jpg') }}" alt="marca de agua">
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

        // Descargar PDF (solo documento REAC, sin menú, header ni botones)
        function downloadPDF() {
            const content = document.getElementById("reac-content");

            // Elementos que NO deben salir en el PDF
            const elementosOcultar = document.querySelectorAll(
                '.header-top, .sidebar, .action-buttons, .photo-upload-bar, .page-title, .watermark'
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
                    filename: "REAC_Reporte_Actividades.pdf",
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
                    },
                    // 🔹 Intentar evitar que las filas (tr) se corten entre páginas
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

        // Imprimir
        function printDocument() {
            window.print();
        }

        // Manejo de fotos
        const input = document.getElementById("photoInput");
        const preview = document.getElementById("photoPreview");
        let photos = [];

        input.addEventListener("change", (e) => {
            const files = Array.from(e.target.files);

            if (photos.length + files.length > 2) {
                alert("Solo se permiten 2 fotografías como máximo.");
                input.value = "";
                return;
            }

            files.forEach(file => {
                const reader = new FileReader();

                reader.onload = () => {
                    const container = document.createElement("div");
                    container.className = "photo-card";

                    container.innerHTML = `
                        <img src="${reader.result}" class="photo-img" alt="Evidencia ${photos.length + 1}">
                        <div class="mt-2">
                            <label class="d-block text-start">Descripción:</label>
                            <input type="text" class="text-input" placeholder="Descripción de la imagen">
                        </div>
                        <div class="mt-2">
                            <label class="d-block text-start">Fecha:</label>
                            <input type="date" class="text-input">
                        </div>
                    `;

                    preview.appendChild(container);
                    photos.push(file);
                };

                reader.readAsDataURL(file);
            });

            input.value = "";
        });
    </script>

</body>

</html>
