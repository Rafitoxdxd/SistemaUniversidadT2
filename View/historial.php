<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pacientes</title>
    <link rel="stylesheet" href="Styles/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

            /* Estilos del icono de perfil */
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
                top: -25px; /* Distancia desde la parte superior */
                right: 20px; /* Distancia desde la parte derecha */
                z-index: 100; /* Asegura que esté por encima de otros elementos */
            }

            .profile-icon-container a:hover {
                transform: scale(1.05); /* Ligeramente más grande al pasar el ratón */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Sombra más pronunciada al pasar el ratón */
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
                overflow: hidden;
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
                padding: 7px 12px; /* Mantiene el padding original */
                margin: 4px 7px; /* Mantiene el margen original */
            }

            .sidebar .nav-link:hover {
                background-color: var(--link-bg-hover);
                color: var(--link-color-hover);
                transform: translateX(8px) scale(1.03);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35); /* Sombra al pasar el ratón acentuada */
            }
            .header{
                margin-top: 50px;
                padding-top: 50px;
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
            .col-md-9.ml-sm-auto {
                margin-left: 17%;
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
                .col-md-9.ml-sm-auto {
                    margin-left: 0;
                    width: 100%;
                }
                .sidebar-sticky {
                    flex-direction: row;
                    flex-wrap: wrap;
                    justify-content: center;
                    padding: 12px 0;
                }
                .sidebar .nav-link {
                    margin: 5px ;
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
                /* Ajuste para el ícono de perfil en móviles para que no se superponga con el menú */
                .profile-icon-container {
                    position: static; /* Cambia a posición estática para que fluya con el contenido */
                    margin-left: auto; /* Centra o alinea a la derecha si es necesario dentro de un flexbox */
                    margin-right: 20px;
                    order: 1; /* Para controlar su orden en un contenedor flexbox */
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <header class="header d-flex justify-content-between align-items-center mb-4 sticky-top bg-light shadow-sm p-3">
                <h2>Historial de Pacientes</h2>
                
                <div class="profile-icon-container">  
                    <a href='?pagina=profile' title="Mi Perfil">  
                        <i class="bi bi-person" style="font-size: 40px; color: #6c757d;"></i>  
                    </a>  
                </div>

                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#incluirPacienteModal">Incluir Paciente</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal">Modificar Paciente</button>
                </div>
            </header>
            
            <div class="cont" id="pacientesContainer">
                <?php
                    //$pacientes = array();
                    
                    $pacientes = Historial::cargarHistoriales();

                    foreach ($pacientes as $paciente) {
                        $datosPaciente = json_decode($paciente->getDatos(), true);

                        echo '<article class="col mb-4 paciente-card " data-nombre="' . $datosPaciente['nombre'] . '" data-cedula="' . $datosPaciente['cedula'] . '" data-paciente-id="' . $paciente->getId() . '">';
                        echo '      <div class="card" style="width: 30rem;" >';
                        echo '           <div class="card-body">';
                        echo '               <h5 class="card-title">' . htmlspecialchars($datosPaciente['nombre']) . '</h5>';
                        echo '               <p class="card-text">Cédula: ' . htmlspecialchars($datosPaciente['cedula']) . '</p>';
                        echo '               <p class="card-text">Fecha de Nacimiento: ' . htmlspecialchars($datosPaciente['fecha_nacimiento']) . '</p>';
                        echo '               <div class="d-flex justify-content-between align-items-center">';
                        echo '                   <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal"';
                        echo '                               data-nombre-paciente="' . htmlspecialchars($datosPaciente['nombre']) . '"';
                        echo '                               data-cedula-paciente="' . htmlspecialchars($datosPaciente['cedula']) . '"';
                        echo '                               data-fecha-nacimiento="' . htmlspecialchars($datosPaciente['fecha_nacimiento']) . '">';
                        echo '                       Ver Detalles';
                        echo '                   </button>';
                        echo '                   <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarPacienteModal-' . $paciente->getId() . '">';
                        echo '                       <i class="bi bi-trash3-fill eliminar-icono-tarjeta"></i> Eliminar';
                        echo '                   </button>';
                        echo '               </div>';
                        echo '           </div>';
                        echo '      </div>';

                        // Modal de Eliminar Paciente para cada tarjeta
                        echo '<div class="modal fade" id="eliminarPacienteModal-' . $paciente->getId() . '" tabindex="-1" aria-labelledby="eliminarPacienteModalLabel-' . $paciente->getId() . '" aria-hidden="true">';
                        echo '    <div class="modal-dialog">';
                        echo '        <div class="modal-content">';

                        echo '        <form  action="" method="POST">';

                        echo '            <div class="modal-header bg-warning text-dark">';
                        echo '                <h5 class="modal-title" id="eliminarPacienteModalLabel-' . $paciente->getId() . '">Confirmar Eliminación</h5>';
                        echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                        echo '            </div>';
                        echo '            <div class="modal-body">';
                        echo '                <p>¿Está seguro de que desea eliminar a <strong>' . htmlspecialchars($datosPaciente['nombre']) . '</strong>?</p>';
                        echo '                <p class="text-danger">Esta acción no se puede deshacer.</p>';
                        echo '            </div>';
                        echo '            <div class="modal-footer">';
                        echo '                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
                        //hidden text
                        echo '                <input type="text" name="idPacienteEliminar" value="' . $paciente->getId() . '" hidden  name="eliminar"/>';    
                        echo '                <input type="submit" class="btn btn-danger" name="eliminar"/>';
                        echo '            </div>';

                        echo '        </form>';

                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';

                        echo '</article>';
                    }
                    ?>
            </div>
        </main>
    </div>

    <div class="modal fade" id="incluirPacienteModal" tabindex="-1" aria-labelledby="incluirPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="incluirPacienteModalLabel">Incluir Nuevo Paciente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <form action="" method="POST">
                        <header class="mb-4 text-center">
                            <h2 class="">Historia de Vida</h2>
                        </header>

                        <section class="mb-3">
                            <h2 class="h5">Datos Personales</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellido:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div>
                                    <label for="idPacienteModificar" class="form-label">Cédula de Identidad:</label><br>
                                    <input type="text" class="form-control" id="idPacienteModificar" name="cedula" placeholder="Cédula ( Inicia con V o E )"><br>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="edad" class="form-label">Edad:</label>
                                    <input type="number" class="form-control" id="Edad" name="Edad">
                                </div>
                                <div class="col-md-3">
                                    <label for="fecha_nacimiento" class="form-label">F. de nac:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                                <div class="col-md-6">
                                    <label for="localidad" class="form-label">Localidad:</label>
                                    <input type="text" class="form-control" id="Localidad" name="Localidad">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="estado_civil" class="form-label">Estado civil:</label>
                                    <select class="form-control" id="estado_civil" name="estado_civil">
                                        <option value=""></option>
                                        <option value="soltero">Soltero</option>
                                        <option value="casado">Casado</option>
                                        <option value="divorciado">Divorciado</option>
                                        <option value="viudo">Viudo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="profesion" class="form-label">Profesión:</label>
                                    <input type="text" class="form-control" id="profesion" name="profesion">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="estudios" class="form-label">Estudios:</label>
                                <input type="text" class="form-control" id="estudios" name="estudios">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">¿Cómo nos has conocido?</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="Amigos/familia" name="conocido" value="Amigos/familia">
                                    <label class="form-check-label" for="Amigos/familia">Amigos/familia</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="Instagram" name="conocido" value="Instagram">
                                    <label class="form-check-label" for="Instagram">Instagram</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="Google" name="conocido" value="Google">
                                    <label class="form-check-label" for="Google">Google</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="Otros" name="conocido" value="Otros">
                                    <label class="form-check-label" for="Otros">Otros</label>
                                </div>
                            </div>
                        </section>

                        <div class="alert alert-info" role="alert">
                            <b>A continuación, rellena aquellos apartados/preguntas que consideres que son necesarios para el tratamiento</b>
                        </div>

                        <section class="mb-3">
                            <h3 class="h5">Análisis funcional</h3>
                            <p><b>Del siguiente listado, ¿Qué sensación presentas actualmente?:</b></p>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="tensión" name="sintoma[]" value="tensión">
                                        <label class="form-check-label" for="Tensión">Tensión</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="taquicardia" name="sintoma[]" value="taquicardia">
                                        <label class="form-check-label" for="Taquicardia">Taquicardia</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Fracaso" name="sintoma[]" value="Fracaso">
                                        <label class="form-check-label" for="Fracaso">Fracaso</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Presión en el pecho" name="sintoma[]" value="Presión en el pecho">
                                        <label class="form-check-label" for="Presión en el pecho">Presión en el pecho</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Ansiedad" name="sintoma[]" value="Ansiedad">
                                        <label class="form-check-label" for="Tensión">Ansiedad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Presión" name="sintoma[]" value="Presión">
                                        <label class="form-check-label" for="Presión">Presión</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Celos" name="sintoma[]" value="Celos">
                                        <label class="form-check-label" for="Celos">Celos</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Problemas de pareja" name="sintoma[]" value="Problemas de pareja">
                                        <label class="form-check-label" for="Problemas de pareja">Problemas de pareja</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Flojedad" name="sintoma[]" value="Flojedad">
                                        <label class="form-check-label" for="Flojedad">Flojedad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Irritabilidad" name="Irritabilidad" value="Irritabilidad">
                                        <label class="form-check-label" for="Irritabilidad">Irritabilidad</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Miedo" name="sintoma[]" value="Miedo">
                                        <label class="form-check-label" for="Miedo">Miedo</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Dificultades sexuales" name="sintoma[]" value="Dificultades sexuales">
                                        <label class="form-check-label" for="Dificultades sexuales">Dificultades sexuales</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Sudor" name="sintoma[]" value="Sudor">
                                        <label class="form-check-label" for="Sudor">Sudor</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Culpa" name="sintoma[]" value="Culpa">
                                        <label class="form-check-label" for="Culpa">Culpa</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Desconfianza" name="sintoma[]" value="Desconfianza">
                                        <label class="form-check-label" for="Desconfianza">Desconfianza</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Problemas familiares" name="sintoma[]" value="Problemas familiares">
                                        <label class="form-check-label" for="Problemas familiares">Problemas familiares</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Mareo" name="sintoma[]" value="Mareo">
                                        <label class="form-check-label" for="Mareo">Mareo</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Cansancio" name="sintoma[]" value="Cansancio">
                                        <label class="form-check-label" for="Cansancio">Cansancio</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Sueño" name="sintoma[]" value="Sueño">
                                        <label class="form-check-label" for="Sueño">Sueño</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="Nerviosismo" name="sintoma[]" value="Nerviosismo">
                                        <label class="form-check-label" for="Nerviosismo">Nerviosismo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="otros_sintoma" class="form-label">Otros síntomas:</label>
                                <textarea class="form-control" id="otros_sintoma" name="otros_sintoma" rows="3"></textarea>
                            </div>
                        </section>

                        <section class="mb-3">
                            <h2 class="h2">Organismo</h2>

                            <div class="mb-3">
                                <label for="convivencia" class="form-label">¿Con quién convives actualmente?</label>
                                <textarea class="form-control" id="convivencia" name="convivencia" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="relacion_mejorar" class="form-label">¿Cambiarías/mejorarías tu relación con alguno de ellos? ¿Por qué?</label>
                                <textarea class="form-control" id="relacion_mejorar" name="relacion_mejorar" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="area_conflictiva" class="form-label">¿Destacarías alguna área conflictiva en tu relación con tu familia/pareja que quisieras trabajar en terapia? (Entendiendo área como comunicación, relaciones sexuales en el caso de tu pareja...)</label>
                                <textarea class="form-control" id="area_conflictiva" name="area_conflictiva" rows="3"></textarea>
                            </div>

                            <h3 class="h5">Hábitos y estilo de vida</h3>

                            <div class="mb-3">
                                <label class="form-label">¿Consumes alcohol?</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="alcohol_si" name="alcohol" value="si">
                                    <label class="form-check-label" for="alcohol_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="alcohol_no" name="alcohol" value="no">
                                    <label class="form-check-label" for="alcohol_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_alcohol" class="form-label">¿Con qué frecuencia y cuánta cantidad?</label>
                            <textarea class="form-control" id="frecuencia_alcohol" name="frecuencia_alcohol" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">¿Fumas o vapeas?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="fumar_si" name="fumar" value="si">
                                <label class="form-check-label" for="fumar_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="fumar_no" name="fumar" value="no">
                                <label class="form-check-label" for="fumar_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_fumar" class="form-label">¿Con qué frecuencia y cuánta cantidad?</label>
                            <textarea class="form-control" id="frecuencia_fumar" name="frecuencia_fumar" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">¿Consumes algún otro tipo de sustancia?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="sustancia_si" name="sustancia" value="si">
                                <label class="form-check-label" for="sustancia_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="sustancia_no" name="sustancia" value="no">
                                <label class="form-check-label" for="sustancia_no">No</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_sustancia" class="form-label">Indica cuál y con qué frecuencia</label>
                            <textarea class="form-control" id="frecuencia_sustancia" name="frecuencia_sustancia" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rutina_sueno" class="form-label">Explica brevemente tu rutina de sueño (tiempo, calidad y si haces siesta...)</label>
                            <textarea class="form-control" id="rutina_sueno" name="rutina_sueno" rows="3"></textarea>
                        </div>

                        <h3 class="h5">Tratamientos anteriores</h3>
                        <div class="mb-3">
                            <label class="form-label">¿Has acudido al psicólogo o psiquiatría anteriormente? ¿Qué tipo de tratamiento recibió?</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="no_acudido" name="acudido" value="no">
                                <label class="form-check-label" for="no_acudido">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="psicologo" name="acudido" value="psicólogo">
                                <label class="form-check-label" for="psicologo">Psicólogo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="psiquiatra" name="acudido" value="psiquiatra">
                                <label class="form-check-label" for="psiquiatra">Psiquiatra</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="otro_acudido" name="acudido" value="otro">
                                <label class="form-check-label" for="otro_acudido">Otro</label>
                            </div>
                            <textarea class="form-control mt-2" name="tratamiento_recibido" rows="2" placeholder="Especifica el tratamiento recibido"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="finalizado_tratamiento" class="form-label">¿Finalizaste el tratamiento? En caso negativo, ¿por qué razón?</label>
                            <textarea class="form-control" id="finalizado_tratamiento" name="finalizado_tratamiento" rows="2"></textarea>
                        </div>

                        <h3 class="h5">Preguntas relativas</h3>
                        <div class="mb-3">
                            <label for="personas_significativas" class="form-label">¿Cuáles son las personas más significativas de tu vida actualmente?</label>
                            <textarea class="form-control" id="personas_significativas" name="personas_significativas" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ayuda_terapia" class="form-label">¿Cuál o cuáles crees que podrían ayudarte durante tu terapia?</label>
                            <textarea class="form-control" id="ayuda_terapia" name="ayuda_terapia" rows="3"></textarea>
                        </div>

                        <h3 class="h5">Motivación y compromiso</h3>
                        <div class="mb-3">
                            <label for="espera_terapia" class="form-label">¿Qué esperas conseguir cuando finalice la terapia?</label>
                            <textarea class="form-control" id="espera_terapia" name="espera_terapia" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="compromiso_terapia" class="form-label">Del 1 al 10 ¿Cuál es tu compromiso hacia la terapia?</label>
                            <input type="number" class="form-control" id="compromiso_terapia" name="compromiso_terapia" min="1" max="10">
                        </div>

                        <div class="mb-3">
                            <label for="duracion_terapia" class="form-label">¿Cuánto tiempo crees que durará la terapia?</label>
                            <textarea class="form-control" id="duracion_terapia" name="duracion_terapia" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="importante_reflejar" class="form-label">¿Hay algo que no haya aparecido aquí pero consideras importante reflejar para abordar de manera adecuada el tratamiento? en caso afirmativo, indícalo</label>
                            <textarea class="form-control" id="importante_reflejar" name="importante_reflejar" rows="3"></textarea>
                        </div>
                    </section>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Guardar Pacientes" id="guardar" name="guardar" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modificarPacienteModal" tabindex="-1" role="dialog" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
        
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nombrePacienteModificar">Nombre:</label>
                        <input type="text" class="form-control" id="nombrePacienteModificar" placeholder="Ingrese el nuevo nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellidoPacienteModificar">Apellido:</label>
                        <input type="text" class="form-control" id="apellidoPacienteModificar" placeholder="Ingrese el nuevo apellido">
                    </div>
                    <div class="form-group">
                        <label for="idPacienteModificar">Cédula de identidad:</label>
                        <input type="text" class="form-control" id="idPacienteModificar" placeholder="Cédula ( Inicia con V o E )">
                    </div>
                </form>
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="verDetallesModal" tabindex="-1" role="dialog" aria-labelledby="verDetallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verDetallesModalLabel">Detalles del Paciente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioVerDetalles">
                    <div class="form-group">
                        <label for="nombre_detalle">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_detalle" name="nombre_detalle" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cedula_detalle">Cédula:</label>
                        <input type="text" class="form-control" id="cedula_detalle" name="cedula_detalle" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento_detalle">Fecha de Nacimiento:</label>
                        <input type="text" class="form-control" id="fecha_nacimiento_detalle" name="fecha_nacimiento_detalle" value="" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</body>



<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    
    function buscarPacientesEnTiempoReal() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const pacienteCards = document.querySelectorAll('.paciente-card');

        pacienteCards.forEach(card => {
            const nombre = card.dataset.nombre.toLowerCase();
            const cedula = card.dataset.cedula.toLowerCase();

            if (nombre.includes(searchTerm) || cedula.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    $(document).ready(function() {
        $('#verDetallesModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var nombre = button.data('nombre-paciente'); // Extrae la información de los atributos data-*
            var cedula = button.data('cedula-paciente');
            var fechaNacimiento = button.data('fecha-nacimiento');
            // Puedes extraer más datos aquí según los atributos data-* que hayas añadido

            var modal = $(this);
            modal.find('.modal-title').text('Detalles de ' + nombre); // Actualiza el título del modal
            modal.find('#nombre_detalle').val(nombre); // Llena los campos del formulario con la información
            modal.find('#cedula_detalle').val(cedula);
            modal.find('#fecha_nacimiento_detalle').val(fechaNacimiento);
            // Llena más campos del formulario aquí si es necesario
        });
    });

    function eliminarPaciente(pacienteId) {
        console.log('Eliminar paciente con ID:', pacienteId);

        const modal = document.getElementById('eliminarPacienteModal-' + pacienteId);
        const modalBootstrap = bootstrap.Modal.getInstance(modal);
        if (modalBootstrap) {
            modalBootstrap.hide();
        }
    }
</script>

</html>