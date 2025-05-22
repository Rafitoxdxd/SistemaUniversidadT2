<!doctype html>
<html lang="es">
    <head>
        <title>Perfil</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="Styles/Bootstrap/css/bootstrap.min.css"
            rel="stylesheet"
        />
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
                /* MODIFICACIÓN CLAVE: Padding superior e inferior para los links normales */
                padding: 10px 12px; /* Aumentado de 7px a 10px en vertical */
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

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Mi Perfil</h1>
        </div> 

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Información del Usuario</h5>
                        <ul>
                        <?php
                            if (isset($v_usuario)) {
                                echo "<li><strong>Nombre:</strong> ".$v_usuario->getNombre()."</li>";
                                echo "<li><strong>Apellido:</strong> ".$v_usuario->getApellido()."</li>";
                                echo "<li><strong>Correo:</strong> ".$v_usuario->getCorreo()."</li>";
                                echo "<li><strong>Fecha de Nacimiento:</strong> ".$v_usuario->getFNacimiento()."</li>";
                                echo "<li><strong>Género:</strong> ".$v_usuario->getGenero()."</li>";
                            } else {
                                echo "<li>No hay información de usuario disponible.</li>";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
            
        <footer>
            </footer>
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
    </body>
</html>