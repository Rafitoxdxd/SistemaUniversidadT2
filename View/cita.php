<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="css/custom.css">
    <title>cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
    <link href='css/bootstrap-icons.v1.8.1.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
        :root {
            --sidebar-bg-start: #343a40; /* Gris oscuro para el inicio del degradado */
            --sidebar-bg-end: #495057;    /* Gris medio para el final del degradado */
            --link-color-normal: #e9ecef; /* Gris claro para el texto normal */
            --link-color-hover: #ffffff;    /* Blanco puro para el texto al pasar el ratón */
            --link-bg-hover: #6c757d;      /* Gris azulado para el fondo al pasar el ratón */
            --link-color-active: #ffffff; /* Blanco puro para el texto activo */
            --link-bg-active: #007bff;     /* Azul brillante para el fondo activo */
            --header-color: #f8f9fa;        /* Blanco casi puro para el encabezado */
            --font-family-playful: 'Quicksand', sans-serif; /* Mantiene la fuente lúdica, aunque ahora en tonos serios */
            --main-content-bg: #f8f9fa; /* Un fondo general muy claro */
        }

        /* Importar fuente de Google Fonts (asegúrate de que el usuario tenga conexión) */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: var(--font-family-playful);
            background-color: var(--main-content-bg);
            min-height: 100vh;
            /* Usamos flexbox para el layout principal */
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Evita desbordamiento horizontal */
        }

        /* Estilos generales del sidebar */
        .sidebar {
            position: fixed; /* Fijo a la izquierda */
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
            overflow-y: auto; /* Permite scroll si hay muchos links */
            transition: width 0.3s ease; /* Suaviza el cambio de ancho en responsive */
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
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--header-color);
            text-align: center;
            margin-bottom: 20px;
            padding: 7px 4px;
            background-color: rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
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
            font-size: 0.85rem;
            font-weight: 700;
            margin: 10px 7px;
            border-radius: 18px;
            transition: all 0.35s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Estilos específicos para "Casa" (primer link de navegación principal después del título) */
        .sidebar ul.nav.flex-column > li:nth-child(1) > .nav-link {
            padding: 7px 12px;
            margin: 4px 7px;
        }

        .sidebar .nav-link:hover {
            background-color: var(--link-bg-hover);
            color: var(--link-color-hover);
            transform: translateX(8px) scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(45deg, var(--link-bg-active), #0056b3);
            color: var(--link-color-active);
            transform: scale(1.05);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--link-bg-active);
        }
        
        /* Estilo específico para "Cerrar Sesión" para que esté al final y en una línea */
        .sidebar .nav-item.mt-auto .nav-link {
            background: linear-gradient(90deg, #dc3545, #c8232e);
            color: white;
            font-weight: 700;
            margin-top: 15px; /* Ajustado para reducir la separación con "Citas" */
            margin-bottom: 8px;
            padding: 10px 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            transition: all 0.35s ease-out;
        }

        /* Sobrescribir el hover para "Cerrar Sesión" */
        .sidebar .nav-item.mt-auto .nav-link:hover {
            background: linear-gradient(90deg, #c8232e, #dc3545); /* Mantener el color de fondo para indicar interactividad */
            transform: none; /* Eliminar la transformación de escala y traslación */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); /* Mantener la sombra original o ajustarla */
        }

        /* Separador visual */
        .sidebar hr {
            border-top: 1px dashed rgba(255, 255, 255, 0.4);
            margin: 18px 0;
        }

        /* Contenido principal (calendario y modal) */
        .main-content {
            margin-left: 17%; /* Desplaza el contenido para dar espacio al sidebar */
            width: 83%; /* El resto del ancho para el contenido principal */
            padding: 20px; /* Espaciado interno */
            box-sizing: border-box; /* Incluye padding en el cálculo del ancho */
            flex-grow: 1; /* Permite que el contenido principal ocupe el espacio restante */
            position: relative; /* Necesario para posicionar el icono del usuario */
        }

        /* Ocultar el header si está vacío o no es necesario con el sidebar fijo */
        header {
            display: none;
        }
        

        /* Media query para pantallas pequeñas (ajustes para la diversión móvil) */
        @media (max-width: 767.98px) {
            body {
                flex-direction: column; /* Apila el sidebar y el contenido en móviles */
            }
            .sidebar {
                position: static; /* No fijo en móviles */
                height: auto;
                padding-top: 0;
                width: 100%; /* Ocupa todo el ancho en móviles */
                box-shadow: none;
                background: var(--sidebar-bg-start);
                flex-direction: row; /* Los links se disponen en fila */
                flex-wrap: wrap;
                justify-content: center;
                padding: 12px 0;
            }
            .sidebar-sticky {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                padding: 0;
            }
            .main-content {
                margin-left: 0; /* Sin margen en móviles */
                width: 100%; /* Ocupar todo el ancho disponible */
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
        }

            


    </style>
</head>
<body>
    

    <nav class="sidebar">
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
                    <a class="nav-link" href='?pagina=tratamiento'>Tratamiento</a>
                </li>
                <li class="nav-item mt-auto"> 
                    <a class="nav-link" href="?pagina=logout">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="main-content mt-8 bg-light border">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12"> <div id='calendar'></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="GuardarModal" tabindex="-1" aria-labelledby="GuardarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="GuardarModalLabel">Eventos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEvento">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titulo del evento">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion del evento">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="color" class="col-sm-2 col-form-label">Color</label>
                                <div class="col-sm-10">
                                    <input type="color" class="form-control" id="color" name="color" placeholder="Color del evento" value="#6610f2">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="textoColor" class="col-sm-2 col-form-label">Color de Letras</label>
                                <div class="col-sm-10">
                                    <input type="color" class="form-control" id="textoColor" name="textColor" placeholder="Color de Letras" value="#0d6efd">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="start" class="col-sm-2 col-form-label">Fecha de inicio</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="start" name="start">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="end" class="col-sm-2 col-form-label">Fecha de fin</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="end" name="end" placeholder="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnGuardarCita" class="btn btn-success" aria-label="Guardar">
                            <i class="bi bi-save-fill"></i> Guardar
                        </button>
                        <button type="button" id="btnModificarCita" class="btn btn-warning" aria-label="Modificar">
                            <i class="bi bi-pencil-square"></i> Modificar
                        </button>
                        <button type="button" id="btnEliminarCita" class="btn btn-danger" aria-label="Eliminar">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cerrar">
                            <i class="bi bi-x-lg"></i> Cerrar
                        </button>

        <div class="modal">
        
            <form id="formEvento" method="POST" action="?pagina=cita">
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Titulo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titulo del evento">

                    </div>
                </div>
            </div>
        </div>

    </main>
    
    <footer>
    </footer>

        <div class="modal-body">
            <!-- Botón para CREAR/GUARDAR -->
            <button type="submit" id="btnGuardarCita" name="guardar_cita" class="btn btn-success" aria-label="Guardar">
                <i class="bi bi-save-fill"></i>
            </button>
            <!-- Botón para MODIFICAR (inicialmente oculto) -->
            <button type="button" id="btnModificarCita" class="btn btn-warning"  aria-label="Modificar">
                <i class="bi bi-pencil-square"></i>
            </button>
            <!-- Botón para ELIMINAR (inicialmente oculto) -->
            <button type="button" id="btnEliminarCita" class="btn btn-danger"  aria-label="Eliminar">
                <i class="bi bi-trash-fill"></i>
            </button>
            <!-- Botón para CERRAR -->
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cerrar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        </div>
    </div>
    </div>
        </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src='js/index.global.min.js'></script>
    <script src='js/bootstrap5/index.global.min.js'></script>
    <script src="js/custom.js"></script>
</body>
</html>