<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Tratamientos Psicológicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
        :root {
            --sidebar-bg-start: #343a40; /* Gris oscuro para el inicio del degradado */
            --sidebar-bg-end: #495057;    /* Gris medio para el final del degradado */
            --link-color-normal: #e9ecef; /* Gris claro para el texto normal */
            --link-color-hover: #ffffff;  /* Blanco puro para el texto al pasar el ratón */
            --link-bg-hover: #6c757d;      /* Gris azulado para el fondo al pasar el ratón */
            --link-color-active: #ffffff; /* Blanco puro para el texto activo */
            --link-bg-active: #007bff;    /* Azul brillante para el fondo activo */
            --header-color: #f8f9fa;       /* Blanco casi puro para el encabezado */
            --font-family-playful: 'Quicksand', sans-serif; /* Mantiene la fuente lúdica, aunque ahora en tonos serios */
            --main-content-bg: #f8f9fa; /* Un fondo general muy claro */
        }

        /* Importar fuente de Google Fonts (asegúrate de que el usuario tenga conexión) */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: var(--font-family-playful);
            background-color: var(--main-content-bg);
            min-height: 100vh;
        }

        /* Estilos generales del sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: 17%; /* Mantiene el ancho ajustado */
            background: linear-gradient(180deg, var(--sidebar-bg-start) 0%, var(--sidebar-bg-end) 100%); /* Degradado vertical en grises */
            box-shadow: 8px 0 20px rgba(0, 0, 0, 0.5); /* Sombra acentuada */
            padding-top: 8px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .sidebar-sticky {
            padding: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Estilos del título principal del sidebar (INICIO / MENU PRINCIPAL) */
        .sidebar .nav-item:first-child .nav-link {
            font-size: 1.2rem; /* Tamaño reducido */
            font-weight: 700;
            color: var(--header-color);
            text-align: center;
            margin-bottom: 20px;
            padding: 7px 4px;
            background-color: rgba(0, 0, 0, 0.25); /* Fondo más oscuro y sutil para el título */
            border-radius: 10px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5); /* Sombra de texto acentuada */
            animation: bounceIn 0.9s ease-out;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Animación para el título */
        @keyframes bounceIn {
            0% { transform: scale(0.05); opacity: 0; }
            60% { transform: scale(1.25); opacity: 1; }
            100% { transform: scale(1); }
        }

        /* Estilos de los enlaces de navegación */
        .sidebar .nav-link {
            color: var(--link-color-normal);
            font-size: 0.85rem; /* Tamaño reducido */
            font-weight: 700;
            padding: 5px 6px; /* Aumentado de 7px a 10px en vertical */
            margin: 10px 7px; /* Aumentado de 4px a 6px en vertical */
            border-radius: 18px;
            transition: all 0.35s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Sombra de los enlaces ligeramente más fuerte */
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Estilos específicos para "Casa" (primer link de navegación principal después del título) */
        .sidebar ul.nav.flex-column > li:nth-child(1) > .nav-link {
            padding: 7px 12px; /* Mantiene el padding original */
            margin: 4px 7px; /* Mantiene el margen original */
        }

        .sidebar .nav-link:hover {
            background-color: var(--link-bg-hover);
            color: var(--link-color-hover);
            transform: translateX(8px) scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35); /* Sombra al pasar el ratón acentuada */
        }

        .sidebar .nav-link.active {
            background: linear-gradient(45deg, var(--link-bg-active), #0056b3);
            color: var(--link-color-active);
            transform: scale(1.05);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.5); /* Sombra del activo más fuerte */
            border: 1px solid var(--link-bg-active); /* Borde con el color azul activo */
        }

        /* Estilo específico para "Cerrar Sesión" para que esté al final y en una línea */
        .sidebar .nav-item.mt-auto .nav-link {
            background: linear-gradient(90deg, #dc3545, #c8232e); /* Tonos de rojo más discretos */
            color: white;
            font-weight: 700;
            margin-top: auto;
            margin-bottom: 8px;
            padding: 10px 12px; /* Ajusta también el padding de este para consistencia */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            transition: all 0.35s ease-out;
        }

        .sidebar .nav-item.mt-auto .nav-link:hover {
            background: linear-gradient(90deg, #c8232e, #dc3545);
            transform: translateY(-1.5px) scale(1.015);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
        }

        /* Separador visual */
        .sidebar hr {
            border-top: 1px dashed rgba(255, 255, 255, 0.4); /* Separador punteado y visible */
            margin: 18px 0;
        }

        /* Ajuste para el contenido principal */
        .main-content {
            margin-left: 17%; /* Asegura que el contenido principal se desplace a la derecha */
            padding: 40px;
            background-color: var(--main-content-bg);
            min-height: 100vh;
        }

        /* Estilo para los datos del perfil dentro del card */
        .card {
            border: none;
            box-shadow: 0 12px 25px rgba(0,0,0,0.25); /* Sombra del card más fuerte */
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(160deg, #eaf2f8, #dee2e6); /* Degradado suave en grises muy claros */
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            color: #212529; /* Gris oscuro para el título del card */
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
        }

        .card ul {
            padding-left: 0;
        }

        .card li {
            list-style: none;
            padding: 12px 0;
            border-bottom: 1px dotted rgba(0, 0, 0, 0.2);
            color: #343a40;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            line-height: 1.5;
        }

        .card li strong {
            color: #212529;
            margin-right: 15px;
        }

        .card li:last-child {
            border-bottom: none;
        }

        /* Estilos específicos para los botones dentro del card-header del panel de tratamientos */
        .card-header .btn-success,
        .card-header .btn-info {
            padding: 8px 15px; /* Ajuste el padding para un mejor aspecto */
            font-size: 0.9rem; /* Un poco más pequeño */
            border-radius: 15px; /* Bordes redondeados */
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .card-header .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4dpx 8px rgba(0, 0, 0, 0.2);
        }

        /* --- Estilos para el icono de perfil --- */
        .profile-icon-container a {
            display: block; /* Para que el enlace envuelva bien la imagen */
            width: 40px; /* Tamaño del contenedor del icono */
            height: 40px;
            border-radius: 50%; /* Para hacerlo redondo */
            overflow: hidden; /* Oculta cualquier parte de la imagen que sobresalga */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Sombra sutil */
            transition: transform 0.2s ease-in-out; /* Animación al pasar el ratón */
            background-color: #f0f0f0; /* Fondo por si la imagen no carga o es transparente */
            border: 2px solid var(--link-bg-active);
            /* Centrar el icono dentro de su contenedor circular */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-icon-container {
            position: absolute;
            top: 10px; /* Distancia desde la parte superior */
            right: 20px; /* Distancia desde la parte derecha */
            z-index: 10; /* Asegura que esté por encima de otros elementos */
        }

        .profile-icon-container a:hover {
            transform: scale(1.05); /* Ligeramente más grande al pasar el ratón */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Sombra más pronunciada al pasar el ratón */
        }
        /* Fin de estilos del icono de perfil */
        /* --- Fin de estilos para el icono de perfil --- */


        /* Media query para pantallas pequeñas (ajustes para la diversión móvil) */
        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                height: auto;
                padding-top: 0;
                width: 100%;
                box-shadow: none;
                background: var(--sidebar-bg-start);
            }
            .main-content { /* Cambiado de .col-md-9.ml-sm-auto, .col-lg-10.px-4 a .main-content */
                margin-left: 0 !important; /* Restablece el margen izquierdo en móviles */
                width: 100%;
            }
            .sidebar-sticky {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                padding: 12px 0;
            }
            .sidebar .nav-link {
                margin: 5px;
                padding: 10px 15px;
                font-size: 0.95rem;
                border-radius: 15px;
                white-space: normal;
                text-overflow: clip;
                overflow: visible;
            }
            .sidebar .nav-item:first-child .nav-link {
                font-size: 1.4rem;
                margin-bottom: 12px;
            }
            .sidebar hr {
                display: none;
            }
            .sidebar .nav-item.mt-auto {
                margin-top: 10px !important;
            }
            .sidebar .nav-item.mt-auto .nav-link {
                width: auto;
            }
            /* Ajustes para el icono de perfil en móviles */
            .profile-icon-container {
                position: static; /* Cambia a posición estática para fluir con el contenido */
                margin: 10px auto; /* Centra el icono */
                text-align: center;
                width: fit-content; /* Ajusta el ancho al contenido */
            }
        }
    </style>
</head>
<body class="bg-light p-4">

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="?pagina=main">¡EXPLORA AQUÍ!</a>
                        </li>
                    </ul>

                    <?php
                        // Asegúrate de iniciar la sesión al principio de tu script si aún no lo has hecho.
                        // session_start();
                        if (isset($_SESSION["usuario"])) {
                            $v_usuario = $_SESSION["usuario"];
                        } else {
                            // Opcional: Redirigir o manejar si no hay sesión
                            // header("Location: ?pagina=login");
                            // exit();
                        }
                    ?>

                    <hr>

                    <ul class="nav flex-column flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link" href="?pagina=main">Casa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=historial'>Historial</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=test'>Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=pacientes'>Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=cita'>Citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=tratamiento'>Tratamientos</a>
                        </li>
                        <li class="nav-item mt-auto">
                            <a class="nav-link" href="?pagina=logout">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                <div class="profile-icon-container">
                    <a href='?pagina=profile' title="Mi Perfil">
                        <i class="bi bi-person" style="font-size: 40px; color: #6c757d;"></i>
                    </a>
                </div>
                <div class="container mt-4 mb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid mt-5">
                    <div class="card shadow-sm mx-auto" style="max-width: 1000px;">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                            <h4 class="mb-0">TRATAMIENTOS PSICOLÓGICOS</h4>
                            <div>
                                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#incluirPacienteModal">Incluir Paciente</button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal">Modificar Paciente</button>
                            </div>
                        </div>
                        <div class="card-body paciente-card ">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped caption-top">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class= "justify-content-between">
                                                NOMBRE DEL PACIENTE
                                            </th>
                                            <th scope="col" class=" justify-content-between">
                                                CÉDULA
                                            </th>
                                            <th scope="col" class=" justify-content-between">
                                                FECHA CREACIÓN
                                            </th> 
                                            <th></th> </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ana García</td>
                                            <td>12.345.678</td>
                                            <td>15/01/2023</td>
                                            <td> 
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Carlos Ruiz</td>
                                            <td>23.456.789</td>
                                            <td>01/03/2024</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Laura Fernández</td>
                                            <td>34.567.890</td>
                                            <td>20/06/2023</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="incluirPacienteModal" tabindex="-1" aria-labelledby="incluirPacienteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="incluirPacienteModalLabel">Incluir Nuevo Paciente</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="nombrePaciente" class="form-label">Nombre del Paciente</label>
                                        <input type="text" class="form-control" id="nombrePaciente" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cedulaPaciente" class="form-label">Cédula</label>
                                        <input type="text" class="form-control" id="cedulaPaciente" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="diagnosticoIncluir" class="form-label">Diagnóstico Psicológico</label>
                                        <textarea class="form-control" id="diagnosticoIncluir" rows="4" placeholder="Ej: Trastorno de ansiedad generalizada, con ataques de pánico ocasionales."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tratamientoIncluir" class="form-label">Plan de Tratamiento</label>
                                        <textarea class="form-control" id="tratamientoIncluir" rows="5" placeholder="Ej: Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estadoIncluir" class="form-label">Estado del Tratamiento</label>
                                        <select class="form-select" id="estadoIncluir">
                                            <option selected>Seleccione el estado</option>
                                            <option value="inicial">Fase Inicial</option>
                                            <option value="en_progreso">En Progreso</option>
                                            <option value="finalizado">Finalizado</option>
                                            <option value="pausado">Pausado Temporalmente</option>
                                            <option value="seguimiento">Seguimiento</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Guardar Paciente</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modificarPacienteModal" tabindex="-1" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Datos del Paciente</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="modificarNombrePaciente" class="form-label">Nombre del Paciente</label>
                                        <input type="text" class="form-control" id="modificarNombrePaciente" value="Ana García">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modificarCedulaPaciente" class="form-label">Cédula</label>
                                        <input type="text" class="form-control" id="modificarCedulaPaciente" value="12.345.678">
                                    </div>
                                    <div class="mb-3">
                                        <label for="diagnosticoModificar" class="form-label">Diagnóstico Psicológico</label>
                                        <textarea class="form-control" id="diagnosticoModificar" rows="4">Trastorno de ansiedad generalizada, con ataques de pánico ocasionales. Se observa mejora en el manejo del estrés.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tratamientoModificar" class="form-label">Plan de Tratamiento</label>
                                        <textarea class="form-control" id="tratamientoModificar" rows="5">Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual. Se redujo la frecuencia de sesiones a quincenal.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estadoModificar" class="form-label">Estado del Tratamiento</label>
                                        <select class="form-select" id="estadoModificar">
                                            <option value="inicial">Fase Inicial</option>
                                            <option value="en_progreso" selected>En Progreso</option>
                                            <option value="finalizado">Finalizado</option>
                                            <option value="pausado">Pausado Temporalmente</option>
                                            <option value="seguimiento">Seguimiento</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="verDetallesModal" tabindex="-1" aria-labelledby="verDetallesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="verDetallesModalLabel">Detalles del Paciente y Tratamiento</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Nombre del Paciente:</dt>
                                    <dd class="col-sm-8" id="detalleNombre">Ana García</dd> 

                                    <dt class="col-sm-4">Cédula:</dt>
                                    <dd class="col-sm-8" id="detalleCedula">12.345.678</dd>

                                    <dt class="col-sm-4">Fecha Creación:</dt>
                                    <dd class="col-sm-8" id="detalleFechaCreacion">15/01/2023</dd>

                                    <dt class="col-sm-4">Diagnóstico Psicológico:</dt>
                                    <dd class="col-sm-8" id="detalleDiagnostico">Trastorno de ansiedad generalizada, con ataques de pánico ocasionales. Se observa mejora en el manejo del estrés.</dd>

                                    <dt class="col-sm-4">Plan de Tratamiento:</dt>
                                    <dd class="col-sm-8" id="detalleTratamiento">Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual. Se redujo la frecuencia de sesiones a quincenal.</dd>

                                    <dt class="col-sm-4">Estado del Tratamiento:</dt>
                                    <dd class="col-sm-8" id="detalleEstado"><span class="badge bg-warning">En Progreso</span></dd>
                                </dl>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script> 
    function buscarPacientesEnTiempoReal() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const tableRows = document.querySelectorAll('.table tbody tr'); // Selecciona las filas de la tabla

        tableRows.forEach(row => {
            const nombre = row.cells[0].textContent.toLowerCase(); // Columna del nombre
            const cedula = row.cells[1].textContent.toLowerCase(); // Columna de la cédula

            if (nombre.includes(searchTerm) || cedula.includes(searchTerm)) {
                row.style.display = ''; // Muestra la fila
            } else {
                row.style.display = 'none'; // Oculta la fila
            }
        });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>