<!doctype html>
<html lang="en">
    <head>
        <title>test</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
       
        <style>
            /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
            :root {
                --sidebar-bg-start: #343a40; /* Gris oscuro para el inicio del degradado */
                --sidebar-bg-end: #495057;    /* Gris medio para el final del degradado */
                --link-color-normal: #e9ecef; /* Gris claro para el texto normal */
                --link-color-hover: #ffffff;   /* Blanco puro para el texto al pasar el ratón */
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
            }

            /* Estilos del icono de perfil */
            .profile-icon-container {
                position: absolute;
                top: 10px; /* Distancia desde la parte superior */
                right: 20px; /* Distancia desde la parte derecha */
                z-index: 10; /* Asegura que esté por encima de otros elementos */
            }
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
                display: flex; /* Para centrar el icono */
                justify-content: center; /* Centrado horizontal */
                align-items: center; /* Centrado vertical */
            }
            .profile-icon-container a:hover {
                transform: scale(1.05); /* Ligeramente más grande al pasar el ratón */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Sombra más pronunciada al pasar el ratón */
            }
            .profile-icon-container .bi {
                font-size: 24px; /* Ajusta el tamaño del icono de Bootstrap Icons */
                color: #6c757d; /* Color del icono */
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
                /* MODIFICACIÓN CLAVE: Padding superior e inferior para los links normales */
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
                    padding: 7px 12px; /* Mantiene el padding original de los links principales */
                    margin: 4px 7px; /* Mantiene el margen original de los links principales */
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
                box-shadow: 0 7px 14px rgba(0, 0, 0, 0.5);
                border: 1px solid var(--link-bg-active);
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
                border-top: 1px dashed rgba(255, 255, 255, 0.4);
                margin: 18px 0;
            }

            /* Ajuste para el contenido principal */
            .main-content {
                margin-left: 17%; /* Empuja el contenido para que el sidebar no lo cubra */
                padding: 20px 40px; /* Ajusta el padding general */
                background-color: var(--main-content-bg);
                min-height: 100vh;
            }

            /* Estilo para los datos del perfil dentro del card (si se usan en el contenido principal) */
            .card {
                border: none;
                box-shadow: 0 12px 25px rgba(0,0,0,0.15); /* Sombra del card */
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
                text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
            }

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
                .main-content {
                    margin-left: 0; /* Elimina el margen en móviles */
                    width: 100%;
                    padding: 20px; /* Ajusta el padding para móviles */
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
                .profile-icon-container {
                    position: static; /* Ajusta la posición para móviles si es necesario */
                    margin-bottom: 10px;
                    display: flex;
                    justify-content: center;
                }
            }
        </style>
    </head>

    <body>
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
                            <i class="bi bi-person"></i>   
                        </a>   
                    </div> 
                    <div class="container mt-4">

                   
                    <h2>test</h2>
                <div class="d-flex justify-content-end mb-3">
                   
                   
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrotestModal">
                        <i class="bi bi-plus-circle me-2"></i> Añadir test
                    </button>
                </div>

                <div class="mb-3">
                    <input type="text" id="buscartest" class="form-control" placeholder="Buscar test...">
                </div>

                <h5 class="mb-3">Todos los test</h5>

                <nav aria-label="Paginación de test (arriba)">
                                <ul class="pagination justify-content-center" id="paginaciontestTop">
                                    </ul>
                                </nav>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Cédula</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablatest">
                    <?php
                        // Verificar si hay productos antes de iterar
                        if (isset($test) && !empty($test)):
                            foreach ($test as $test): // Usar $persona para claridad
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($test['id']) ?></td>
                                    <td><?= htmlspecialchars($test['nombre']) ?></td>
                                    <td><?= htmlspecialchars($test['apellidos']) ?></td>
                                    <td><?= htmlspecialchars($test['cedula']) ?></td>
                                   
                                    <td>
                                        <a href="index.php?accion=editar&id=<?= htmlspecialchars($test['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="index.php?accion=eliminar&id=<?= htmlspecialchars($test['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este test?');">Eliminar</a>
                                        <button type="button" class="btn btn-info btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#modalConsulta">
                                            Consultar 
                                        </button>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        else: // Si no hay productos
                        ?>
                                <tr><td colspan="6">Cargando test...</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <nav aria-label="Paginación de test (abajo)">
                                <ul class="pagination justify-content-center" id="paginaciontestBottom">
                                    </ul>
                                </nav>

                <div class="modal fade" id="registrotestModal" tabindex="-1" aria-labelledby="registrotestModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="registrotestModalLabel">Añadir Nuevo test</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formularioRegistropaciente" action="?pagina=pacientes" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="apellidos" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="cedula" class="form-label">Cédula</label>
                                            <input type="text" class="form-control" id="cedula" name="cedula">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="edad" class="form-label">Edad:</label>
                                            <input type="text" class="form-control" id="edad" name="edad"> <br>
                                        </div>
                                    </div>

                                        <h3 class="h5">Preguntas sobre la competencia</h3>

                                    <div class="mb-3">
                                        <label for="nombre_competencia" class="form-label">Nombre de la competencia</label>
                                        <textarea class="form-control" id="nombre_competencia" name="nombre_competencia" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ubicacion_competencia" class="form-label">Ubicacion de la competencia</label>
                                        <textarea class="form-control" id="ubicacion_competencia" name="ubicacion_competencia" rows="3"></textarea>
                                    </div>

                                        <div class="md-3 col-md-6">
                                            <label for="fecha_competencia" class="form-label">Fecha de la competencia:</label>
                                            <input type="date" class="form-control" id="fecha_competencia" name="fecha_competencia">
                                        </div> <br>

                                    <h3 class="h5">Preguntas sobre preparación</h3>

                                    <div class="mb-3">
                                        <label for="preparado_competencia" class="form-label">¿Te sientes preparado para la competencia que se aproxima y porque?</label>
                                        <textarea class="form-control" id="preparado_competencia" name="preparado_competencia" rows="2"></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="entrenado_previo" class="form-label">¿Cómo has entrenado en las semanas previas a la competición?</label>
                                        <textarea class="form-control" id="entrenado_previo" name="entrenado_previo" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="estrategia_previa" class="form-label">¿Qué estrategias utilizas para asegurarte de estar en la mejor forma posible?</label>
                                        <textarea class="form-control" id="estrategia_previa" name="estrategia_previa" rows="3"></textarea>
                                    </div>

                                    <h3 class="h5">Preguntas sobre ansiedad y nervios</h3>

                                    <div class="mb-3">
                                        <label for="descripcion_nervios" class="form-label">¿Sientes nervios antes de una competición y porque?</label>
                                        <textarea class="form-control" id="descripcion_nervios" name="descripcion_nervios" rows="2"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="antes_competir" class="form-label">¿Qué haces para calmarte cuando sientes ansiedad antes de competir?</label>
                                        <textarea class="form-control" id="antes_competir" name="antes_competir" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="experiencia_pasada" class="form-label">¿Has tenido alguna experiencia pasada que te haya hecho sentir más nervioso en competiciones?</label>
                                        <textarea class="form-control" id="experiencia_pasada" name="experiencia_pasada" rows="3"></textarea>
                                    </div>


                                    <h3 class="h5">Preguntas sobre motivacion</h3>

                                    <div class="mb-3">
                                        <label for="motivacion_competencia" class="form-label">¿Qué te motiva a dar lo mejor de ti en la competición?</label>
                                        <textarea class="form-control" id="motivacion_competencia" name="motivacion_competencia" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="esperar_competicion" class="form-label">¿Hay algo que esperas aprender o mejorar en esta próxima competición?</label>
                                        <textarea class="form-control" id="esperar_competicion" name="esperar_competicion" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lograr_competencia" class="form-label">¿Qué te gustaría lograr en esta competencia?</label>
                                        <textarea class="form-control" id="lograr_competencia" name="lograr_competencia" rows="3"></textarea>
                                    </div>

                                    <h3 class="h5">Preguntas sobre enfoque mental</h3>

                                    <div class="mb-3">
                                        <label for="rutina_mental" class="form-label">¿Tienes alguna rutina mental que sigues antes de competir?</label>
                                        <textarea class="form-control" id="rutina_mental" name="rutina_mental" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pensamiento_positivo" class="form-label">¿Qué pensamientos positivos te dices a ti mismo antes de una competición?</label>
                                        <textarea class="form-control" id="pensamiento_positivo" name="pensamiento_positivo" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="preparacion_mental" class="form-label">¿Cómo te preparas mentalmente para enfrentar desafíos durante la competición?</label>
                                        <textarea class="form-control" id="preparacion_mental" name="preparacion_mental" rows="3"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="guardara" value="guardara">Guardar test</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modificartestModal" tabindex="-1" aria-labelledby="modificartestModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modificartestModalLabel">Modificar test</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formularioModificartest" action="index.php?accion=actualizartest" method="POST">
                                    <input type="hidden" id="modificar_id" name="id">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="modificar_nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="modificar_nombre" name="nombre" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="modificar_apellidos" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="modificar_apellidos" name="apellidos" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="modificar_cedula" class="form-label">Cédula</label>
                                            <input type="text" class="form-control" id="modificar_cedula" name="cedula">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="modificar_edad" class="form-label">Edad:</label>
                                            <input type="text" class="form-control" id="modificar_edad" name="edad" placeholder="Cédula ( Inicia con V o E )"> <br>
                                      

                                        <div class="mb-3">
                                            <label for="nombre_competencia" class="form-label">Nombre de la competencia</label>
                                            <textarea class="form-control" id="nombre_competencia" name="nombre_competencia" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modificar_ubicacion_competencia" class="form-label">Ubicacion de la competencia</label>
                                            <textarea class="form-control" id="modificar_ubicacion_competencia" name="ubicacion_competencia" rows="3"></textarea>
                                        </div>

                                            <div class="md-3 col-md-6">
                                                <label for="modificar_fecha_competencia" class="form-label">Fecha de la competencia:</label>
                                                <input type="date" class="form-control" id="modificar_fecha_competencia" name="fecha_competencia">
                                            </div> <br>

                                        

                                        <div class="mb-3">
                                            <label for="modificar_preparado_competencia" class="form-label">¿Te sientes preparado para la competencia que se aproxima y porque?</label>
                                            <textarea class="form-control" id="modificar_preparado_competencia" name="preparado_competencia" rows="2"></textarea>
                                        </div>


                                        <div class="mb-3">
                                            <label for="modificar_entrenado_previo" class="form-label">¿Cómo has entrenado en las semanas previas a la competición?</label>
                                            <textarea class="form-control" id="modificar_entrenado_previo" name="entrenado_previo" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_estrategia_previa" class="form-label">¿Qué estrategias utilizas para asegurarte de estar en la mejor forma posible?</label>
                                            <textarea class="form-control" id="modificar_estrategia_previa" name="estrategia_previa" rows="3"></textarea>
                                        </div>

                                        

                                        <div class="mb-3">
                                            <label for="modificar_descripcion_nervios" class="form-label">¿Sientes nervios antes de una competición y porque?</label>
                                            <textarea class="form-control" id="modificar_descripcion_nervios" name="descripcion_nervios" rows="2"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_antes_competir" class="form-label">¿Qué haces para calmarte cuando sientes ansiedad antes de competir?</label>
                                            <textarea class="form-control" id="modificar_antes_competir" name="antes_competir" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_experiencia_pasada" class="form-label">¿Has tenido alguna experiencia pasada que te haya hecho sentir más nervioso en competiciones?</label>
                                            <textarea class="form-control" id="modificar_experiencia_pasada" name="experiencia_pasada" rows="3"></textarea>
                                        </div>


                                      

                                        <div class="mb-3">
                                            <label for="modificar_motivacion_competencia" class="form-label">¿Qué te motiva a dar lo mejor de ti en la competición?</label>
                                            <textarea class="form-control" id="modificar_motivacion_competencia" name="motivacion_competencia" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_esperar_competicion" class="form-label">¿Hay algo que esperas aprender o mejorar en esta próxima competición?</label>
                                            <textarea class="form-control" id="modificar_esperar_competicion" name="esperar_competicion" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_lograr_competencia" class="form-label">¿Qué te gustaría lograr en esta competencia?</label>
                                            <textarea class="form-control" id="modificar_lograr_competencia" name="lograr_competencia" rows="3"></textarea>
                                        </div>

                                  

                                        <div class="mb-3">
                                            <label for="modificar_rutina_mental" class="form-label">¿Tienes alguna rutina mental que sigues antes de competir?</label>
                                            <textarea class="form-control" id="modificar_rutina_mental" name="rutina_mental" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_pensamiento_positivo" class="form-label">¿Qué pensamientos positivos te dices a ti mismo antes de una competición?</label>
                                            <textarea class="form-control" id="modificar_pensamiento_positivo" name="pensamiento_positivo" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="modificar_preparacion_mental" class="form-label">¿Cómo te preparas mentalmente para enfrentar desafíos durante la competición?</label>
                                            <textarea class="form-control" id="modificar_preparacion_mental" name="preparacion_mental" rows="3"></textarea>
                                        </div>

                                        </div>
                                    
                                        <button type="submit" class="btn btn-warning" name="actualizar_test_submit">Guardar Cambios</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buscartestInput = document.getElementById('buscartest');
                const tablatestBody = document.getElementById('tablatest');
                // --- OBTENER AMBAS LISTAS DE PAGINACIÓN ---
                const paginaciontestTop = document.getElementById('paginaciontestTop');
                const paginaciontestBottom = document.getElementById('paginaciontestBottom');
                // --- FIN OBTENER AMBAS LISTAS ---
                let testData = [];
                const testPorPagina = 15; // O el número que prefieras
                let paginaActual = 1;

                function cargartest(pagina = 1, filtro = '') {
                    // Ajusta la URL si tu backend soporta paginación y filtro
                    // Por ahora, asumimos que listartestAjax devuelve *todos* los test
                    // y la paginación/filtrado se hace en el frontend (como está implementado ahora)
                    fetch(`index.php?accion=listartestAjax&filtro=${filtro}`) // Quitamos pagina de la URL si el backend no la usa
                        .then(response => response.json())
                        .then(data => {
                            testData = data.test || []; // Asegurar que sea un array
                            paginaActual = 1; // Resetear a página 1 al cargar/filtrar
                            aplicarFiltroYPaginacion(); // Llama a la función que actualiza tabla y paginación
                        })
                        .catch(error => {
                            console.error('Error al cargar test:', error);
                            tablatestBody.innerHTML = '<tr><td colspan="6">Error al cargar los test.</td></tr>';
                            paginaciontestTop.innerHTML = ''; // Limpiar paginación en error
                            paginaciontestBottom.innerHTML = ''; // Limpiar paginación en error
                        });
                }

                // Función para actualizar la tabla (sin cambios, excepto la llamada a confirm en Eliminar)
                function actualizarTabla(test) {
            tablatestBody.innerHTML = '';
            if (test.length > 0) {
                test.forEach(test => {
                    const row = tablatestBody.insertRow();
                    row.insertCell().textContent = test.id;
                    row.insertCell().textContent = test.nombre;
                    row.insertCell().textContent = test.apellidos;
                    row.insertCell().textContent = test.cedula || '-';
                    row.insertCell().textContent = test.edad || '-';
                    row.insertCell().textContent = test.nombre_competencia;
                    row.insertCell().textContent = test.ubicacion_competencia;
                    row.insertCell().textContent = test.fecha_competencia;
                    row.insertCell().textContent = test.preparado_competencia;
                    row.insertCell().textContent = test.entrenado_previo;
                    row.insertCell().textContent = test.estrategia_previa;
                    row.insertCell().textContent = test.descripcion_nervios;
                    row.insertCell().textContent = test.antes_competir;
                    row.insertCell().textContent = test.experiencia_pasada;
                    row.insertCell().textContent = test.motivacion_competencia;
                    row.insertCell().textContent = test.esperar_competicion;
                    row.insertCell().textContent = test.lograr_competencia;
                    row.insertCell().textContent = test.rutina_mental;
                    row.insertCell().textContent = test.pensamiento_positivo;
                    row.insertCell().textContent = test.preparacion_mental;
                    const accionesCell = row.insertCell();
                    accionesCell.innerHTML = `
                        <button class="btn btn-sm btn-warning btn-editar-test" data-bs-toggle="modal" data-bs-target="#modificartestModal" data-id="${test.id}">Editar</button>
                        <a href="index.php?accion=eliminartest&id=${test.id}"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Desea eliminar este test?');">Eliminar</a>
                        <a href="index.php?accion=verHistorial&test_id=${test.id}" class="btn btn-sm btn-info">Historial</a>
                        <a href="index.php?accion=agendarCita&test_id=${test.id}" class="btn btn-sm btn-success">Cita</a>
                    `;
                });
            } else {
                const filtro = buscartestInput.value;
                tablatestBody.innerHTML = `<tr><td colspan="6">${filtro ? 'No se encontraron test con ese filtro.' : 'No hay test registrados.'}</td></tr>`;
            }
        }

        // --- FUNCIÓN MODIFICADA PARA GENERAR AMBAS PAGINACIONES ---
        function generarPaginacion(totaltestFiltrados, testPorPagina) {
            const totalPaginas = Math.ceil(totaltestFiltrados / testPorPagina);
            // Limpiar ambas listas
            paginaciontestTop.innerHTML = '';
            paginaciontestBottom.innerHTML = '';

            if (totalPaginas > 1) {
                for (let i = 1; i <= totalPaginas; i++) {
                    // Crear el elemento LI una vez
                    const li = document.createElement('li');
                    li.classList.add('page-item');
                    if (i === paginaActual) {
                        li.classList.add('active');
                    }

                    // Crear el enlace A una vez
                    const a = document.createElement('a');
                    a.classList.add('page-link');
                    a.href = '#';
                    a.textContent = i;
                    a.dataset.page = i; // Guardar número de página para el listener

                    // Añadir listener al enlace A
                    a.addEventListener('click', handlePaginacionClick);

                    // Añadir el enlace A al LI
                    li.appendChild(a);

                    // Clonar el LI completo (con el enlace y listener ya dentro) para la segunda paginación
                    const liClone = li.cloneNode(true);
                    // El listener se clona, pero es mejor re-asignarlo o usar delegación de eventos
                    // Re-asignamos el listener al clon para asegurar que funciona
                    liClone.querySelector('a').addEventListener('click', handlePaginacionClick);


                    // Añadir el LI original a la paginación superior
                    paginaciontestTop.appendChild(li);
                    // Añadir el LI clonado a la paginación inferior
                    paginaciontestBottom.appendChild(liClone);
                }
            }
        }

        // --- NUEVA FUNCIÓN PARA MANEJAR CLICS EN PAGINACIÓN ---
        function handlePaginacionClick(e) {
            e.preventDefault();
            const targetPage = parseInt(e.target.dataset.page);
            if (targetPage !== paginaActual) {
                paginaActual = targetPage;
                aplicarFiltroYPaginacion(); // Re-calcula qué mostrar y actualiza paginación
            }
        }

        // --- NUEVA FUNCIÓN PARA CENTRALIZAR FILTRADO Y PAGINACIÓN ---
        function aplicarFiltroYPaginacion() {
            const filtro = buscartestInput.value.toLowerCase();
            const testFiltrados = testData.filter(test =>
                test.nombre.toLowerCase().includes(filtro) ||
                test.apellidos.toLowerCase().includes(filtro) ||
                (test.cedula && test.cedula.toLowerCase().includes(filtro)) ||
                test.edad.toLowerCase().includes(filtro) ||
                test.nombre_competencia.toLowerCase().includes(filtro) ||
                test.ubicacion_competencia.toLowerCase().includes(filtro) ||
                test.fecha_competencia.toLowerCase().includes(filtro) ||
                test.preparado_competencia.toLowerCase().includes(filtro) ||
                test.entrenado_previo.toLowerCase().includes(filtro) ||
                test.estrategia_previa.toLowerCase().includes(filtro) ||
                test.descripcion_nervios.toLowerCase().includes(filtro) ||
                test.antes_competir.toLowerCase().includes(filtro) ||
                test.experiencia_pasada.toLowerCase().includes(filtro) ||
                test.motivacion_competencia.toLowerCase().includes(filtro) ||
                test.esperar_competicion.toLowerCase().includes(filtro) ||
                test.lograr_competencia.toLowerCase().includes(filtro) ||
                test.rutina_mental.toLowerCase().includes(filtro) ||
                test.pensamiento_positivo.toLowerCase().includes(filtro) ||
                test.preparacion_mental.toLowerCase().includes(filtro) ||
                // Añadido teléfono al filtro
                // (test.email && test.email.toLowerCase().includes(filtro)) // Puedes añadir email si lo deseas
            );

            const totaltestFiltrados = testFiltrados.length;
            const inicio = (paginaActual - 1) * testPorPagina;
            const fin = inicio + testPorPagina;
            const testPagina = testFiltrados.slice(inicio, fin);

            actualizarTabla(testPagina);
            generarPaginacion(totaltestFiltrados, testPorPagina);
        }


        // Cargar los test iniciales
        cargartest();

        // Evento para la búsqueda en tiempo real
        buscartestInput.addEventListener('input', function() {
            paginaActual = 1; // Resetear la página al buscar
            aplicarFiltroYPaginacion(); // Aplica filtro y actualiza tabla/paginación
        });

        // Evento para cargar los detalles del test en el modal de modificación (sin cambios)
        const modificartestModal = document.getElementById('modificartestModal');
        modificartestModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const testid = button.getAttribute('data-id');
            // Busca en testData que tiene *todos* los test
            const test = testData.find(p => p.id === parseInt(testid));
            if (test) {
                document.getElementById('modificar_id').value = test.id;
                document.getElementById('modificar_nombre').value = test.nombre;
                document.getElementById('modificar_apellidos').value = test.apellidos;
                document.getElementById('modificar_cedula').value = test.cedula || '';
                document.getElementById('modificar_edad').value = test.edad || '';
                document.getElementById('modificar_nombre_competencia').value = test.nombre_competencia;
                document.getElementById('modificar_ubicacion_competencia').value = test.ubicacion_competencia;
                document.getElementById('modificar_fecha_competencia').value = test.fecha_competencia;
                document.getElementById('modificar_preparado_competencia').value = test.preparado_competencia;
                document.getElementById('modificar_entrenado_previo').value = test.entrenado_previo;
                document.getElementById('modificar_estrategia_previa').value = test.estrategia_previa;
                document.getElementById('modificar_descripcion_nervios').value = test.descripcion_nervios;
                document.getElementById('modificar_antes_competir').value = test.antes_competir;
                document.getElementById('modificar_experiencia_pasada').value = test.experiencia_pasada;
                document.getElementById('modificar_motivacion_competencia').value = test.motivacion_competencia;
                document.getElementById('modificar_esperar_competicion').value = test.esperar_competicion;
                document.getElementById('modificar_lograr_competencia').value = test.lograr_competencia;
                document.getElementById('modificar_rutina_mental').value = test.rutina_mental;
                document.getElementById('modificar_pensamiento_positivo').value = test.pensamiento_positivo;
                document.getElementById('modificar_preparacion_mental').value = test.preparacion_mental;
                // No se suelen precargar email/password en modificar a menos que se muestren
            }
        });
    });
</script>

    </body>
</html>