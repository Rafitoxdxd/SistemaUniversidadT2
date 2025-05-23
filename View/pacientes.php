<!doctype html>
<html lang="es">
    <head>
        <title>Pacientes</title>
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
                --link-bg-hover: #6c757d;     /* Gris azulado para el fondo al pasar el ratón */
                --link-color-active: #ffffff; /* Blanco puro para el texto activo */
                --link-bg-active: #007bff;    /* Azul brillante para el fondo activo */
                --header-color: #f8f9fa;      /* Blanco casi puro para el encabezado */
                --font-family-playful: 'Quicksand', sans-serif; /* Mantiene la fuente lúdica, aunque ahora en tonos serios */
                --main-content-bg: #f8f9fa; /* Un fondo general muy claro */
            }

 

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

                

    </style>
</head>
<body>
    <div class="profile-icon-container">
        <a href='?pagina=profile' title="Mi Perfil">
            <i class="bi bi-person" style="font-size: 40px; color: #6c757d;"></i>
        </a>
    </div>

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
                                <a class="nav-link" href="#">Exámenes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Documentos</a>
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

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Pacientes</h1>
                    </div> 

                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroPacienteModal">
                            <i class="bi bi-plus-circle me-2"></i> Añadir paciente
                        </button>
                    </div>

                    <div class="mb-3">
                        <input type="text" id="buscarPaciente" class="form-control" placeholder="Buscar pacientes...">
                    </div>

                    <h5 class="mb-3">Todos los pacientes</h5>

                    <nav aria-label="Paginación de pacientes (arriba)">
                        <ul class="pagination justify-content-center" id="paginacionPacientesTop">
                            </ul>
                    </nav>

                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPacientes">
                        <?php
                            // Verificar si hay productos antes de iterar
                            if (isset($pacientes) && !empty($pacientes)):
                                foreach ($pacientes as $paciente): // Usar $persona para claridad
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($paciente['id']) ?></td>
                                    <td><?= htmlspecialchars($paciente['nombre']) ?></td>
                                    <td><?= htmlspecialchars($paciente['apellido']) ?></td>
                                    <td><?= htmlspecialchars($paciente['cedula']) ?></td>
                                    <td><?= htmlspecialchars($paciente['telefono']) ?></td>
                                    
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-editar-paciente" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal" data-id="<?= htmlspecialchars($paciente['id']) ?>">Editar</button>
                                        <a href="index.php?accion=eliminarPaciente&id=<?= htmlspecialchars($paciente['id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Desea eliminar este paciente?');">Eliminar</a>
                                        <a href="index.php?accion=verHistorial&paciente_id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-info btn-sm">Historial</a>
                                        <a href="index.php?accion=agendarCita&paciente_id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-success btn-sm">Cita</a>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            else: // Si no hay productos
                            ?>
                            <tr><td colspan="6">Cargando pacientes...</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <nav aria-label="Paginación de pacientes (abajo)">
                        <ul class="pagination justify-content-center" id="paginacionPacientesBottom">
                            </ul>
                    </nav>

                    <div class="modal fade" id="registroPacienteModal" tabindex="-1" aria-labelledby="registroPacienteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registroPacienteModalLabel">Añadir Nuevo Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formularioRegistroPaciente" action="index.php?accion=guardarNuevoPaciente" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="cedula" class="form-label">Cédula</label>
                                                <input type="text" class="form-control" id="cedula" name="cedula">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Gmail</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="genero" class="form-label">Género</label>
                                                <select class="form-select" id="genero" name="genero">
                                                    <option value="">Seleccionar</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="pais" class="form-label">País</label>
                                                <input type="text" class="form-control" id="pais" name="pais">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="guardara" value="guardara">Guardar Paciente</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modificarPacienteModal" tabindex="-1" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formularioModificarPaciente" action="index.php?accion=actualizarPaciente" method="POST">
                                        <input type="hidden" id="modificar_id" name="id">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="modificar_nombre" name="nombre" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="modificar_apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_cedula" class="form-label">Cédula</label>
                                                <input type="text" class="form-control" id="modificar_cedula" name="cedula">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="modificar_telefono" name="telefono">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="modificar_fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_genero" class="form-label">Género</label>
                                                <select class="form-select" id="modificar_genero" name="genero">
                                                    <option value="">Seleccionar</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="modificar_direccion" name="direccion">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="modificar_ciudad" name="ciudad">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_pais" class="form-label">País</label>
                                                <input type="text" class="form-control" id="modificar_pais" name="pais">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                                    </form>
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buscarPacienteInput = document.getElementById('buscarPaciente');
                const tablaPacientesBody = document.getElementById('tablaPacientes');
                // --- OBTENER AMBAS LISTAS DE PAGINACIÓN ---
                const paginacionPacientesTop = document.getElementById('paginacionPacientesTop');
                const paginacionPacientesBottom = document.getElementById('paginacionPacientesBottom');
                // --- FIN OBTENER AMBAS LISTAS ---
                let pacientesData = [];
                const pacientesPorPagina = 15; // O el número que prefieras
                let paginaActual = 1;

                function cargarPacientes(pagina = 1, filtro = '') {
                    fetch(`index.php?accion=listarPacientesAjax&filtro=${filtro}`) // Quitamos pagina de la URL si el backend no la usa
                        .then(response => response.json())
                        .then(data => {
                            pacientesData = data.pacientes || []; // Asegurar que sea un array
                            paginaActual = 1; // Resetear a página 1 al cargar/filtrar
                            aplicarFiltroYPaginacion(); // Llama a la función que actualiza tabla y paginación
                        })
                        .catch(error => {
                            console.error('Error al cargar pacientes:', error);
                            tablaPacientesBody.innerHTML = '<tr><td colspan="6">Error al cargar los pacientes.</td></tr>';
                            paginacionPacientesTop.innerHTML = ''; // Limpiar paginación en error
                            paginacionPacientesBottom.innerHTML = ''; // Limpiar paginación en error
                        });
                }

                function actualizarTabla(pacientes) {
                    tablaPacientesBody.innerHTML = '';
                    if (pacientes.length > 0) {
                        pacientes.forEach(paciente => {
                            const row = tablaPacientesBody.insertRow();
                            row.insertCell().textContent = paciente.id;
                            row.insertCell().textContent = paciente.nombre;
                            row.insertCell().textContent = paciente.apellido;
                            row.insertCell().textContent = paciente.cedula || '-';
                            row.insertCell().textContent = paciente.telefono || '-';
                            const accionesCell = row.insertCell();
                            accionesCell.innerHTML = `
                                <button class="btn btn-warning btn-sm btn-editar-paciente" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal" data-id="${paciente.id}">Editar</button>
                                <a href="index.php?accion=eliminarPaciente&id=${paciente.id}"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Desea eliminar este paciente?');">Eliminar</a>
                                <a href="index.php?accion=verHistorial&paciente_id=${paciente.id}" class="btn btn-info btn-sm">Historial</a>
                                <a href="index.php?accion=agendarCita&paciente_id=${paciente.id}" class="btn btn-success btn-sm">Cita</a>
                            `;
                        });
                    } else {
                        const filtro = buscarPacienteInput.value;
                        tablaPacientesBody.innerHTML = `<tr><td colspan="6">${filtro ? 'No se encontraron pacientes con ese filtro.' : 'No hay pacientes registrados.'}</td></tr>`;
                    }
                }

                // --- FUNCIÓN MODIFICADA PARA GENERAR AMBAS PAGINACIONES ---
                function generarPaginacion(totalPacientesFiltrados, pacientesPorPagina) {
                    const totalPaginas = Math.ceil(totalPacientesFiltrados / pacientesPorPagina);
                    // Limpiar ambas listas
                    paginacionPacientesTop.innerHTML = '';
                    paginacionPacientesBottom.innerHTML = '';

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
                            // Re-asignamos el listener al clon para asegurar que funciona
                            liClone.querySelector('a').addEventListener('click', handlePaginacionClick);

                            // Añadir el LI original a la paginación superior
                            paginacionPacientesTop.appendChild(li);
                            // Añadir el LI clonado a la paginación inferior
                            paginacionPacientesBottom.appendChild(liClone);
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
                    const filtro = buscarPacienteInput.value.toLowerCase();
                    const pacientesFiltrados = pacientesData.filter(paciente =>
                        paciente.nombre.toLowerCase().includes(filtro) ||
                        paciente.apellido.toLowerCase().includes(filtro) ||
                        (paciente.cedula && paciente.cedula.toLowerCase().includes(filtro)) ||
                        (paciente.telefono && paciente.telefono.toLowerCase().includes(filtro))
                    );

                    const totalPacientesFiltrados = pacientesFiltrados.length;
                    const inicio = (paginaActual - 1) * pacientesPorPagina;
                    const fin = inicio + pacientesPorPagina;
                    const pacientesPagina = pacientesFiltrados.slice(inicio, fin);

                    actualizarTabla(pacientesPagina);
                    generarPaginacion(totalPacientesFiltrados, pacientesPorPagina);
                }

                // Cargar los pacientes iniciales
                cargarPacientes();

                // Evento para la búsqueda en tiempo real
                buscarPacienteInput.addEventListener('input', function() {
                    paginaActual = 1; // Resetear la página al buscar
                    aplicarFiltroYPaginacion(); // Aplica filtro y actualiza tabla/paginación
                });

                // Evento para cargar los detalles del paciente en el modal de modificación (sin cambios)
                const modificarPacienteModal = document.getElementById('modificarPacienteModal');
                modificarPacienteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const pacienteId = button.getAttribute('data-id');
                    const paciente = pacientesData.find(p => p.id === parseInt(pacienteId));
                    if (paciente) {
                        document.getElementById('modificar_id').value = paciente.id;
                        document.getElementById('modificar_nombre').value = paciente.nombre;
                        document.getElementById('modificar_apellido').value = paciente.apellido;
                        document.getElementById('modificar_cedula').value = paciente.cedula || '';
                        document.getElementById('modificar_telefono').value = paciente.telefono || '';
                        document.getElementById('modificar_fecha_nacimiento').value = paciente.fecha_nacimiento || '';
                        document.getElementById('modificar_genero').value = paciente.genero || '';
                        document.getElementById('modificar_direccion').value = paciente.direccion || '';
                        document.getElementById('modificar_ciudad').value = paciente.ciudad || '';
                        document.getElementById('modificar_pais').value = paciente.pais || '';
                    }
                });
            });
        </script>
    </body>
</html>