<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="css/custom.css">
    <title>cita</title>
    <link rel="stylesheet" href="css/navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'>
    <link href='css/bootstrap-icons.v1.8.1.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
       
        /* Importar fuente de Google Fonts (asegúrate de que el usuario tenga conexión) */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        

        /* Estilos generales del sidebar */
        

        /* Animación para el título */
        @keyframes bounceIn {
            0% { transform: scale(0.05); opacity: 0; }
            60% { transform: scale(1.25); opacity: 1; }
            100% { transform: scale(1); }
        }

        /* Estilos de los enlaces de navegación */
        
        /* Contenido principal (calendario y modal) */
        

        /* Ocultar el header si está vacío o no es necesario con el sidebar fijo */
        
        

        /* Media query para pantallas pequeñas (ajustes para la diversión móvil) */
        @media (max-width: 767.98px) {
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
                        <form id="formEvento" method="POST" action="?pagina=cita">
                            <?php
                            require_once BASE_PATH . 'Model/pacientes.php';
                            $pacienteModel = new pacienteModulo();
                            $pacientes = $pacienteModel->listarpaciente();
                            ?>
                            <div class="row mb-3">
                                <label for="id_paciente" class="col-sm-2 col-form-label">Paciente</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="id_paciente" name="id_paciente" required>
                                        <option value="">Seleccione un paciente</option>
                                        <?php foreach($pacientes as $p): ?>
                                            <option value="<?php echo htmlspecialchars($p['id_paciente']); ?>"><?php echo htmlspecialchars($p['nombre'] . ' ' . $p['apellido']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
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
                            <div class="modal-footer">
                                <button type="submit" id="btnGuardarCita" name="guardar_cita" class="btn btn-success" aria-label="Guardar">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src='js/index.global.min.js'></script>
    <script src='js/bootstrap5/index.global.min.js'></script>
    <script src="js/custom.js"></script>
</body>
</html>

