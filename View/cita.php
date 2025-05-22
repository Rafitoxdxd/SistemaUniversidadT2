<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="stylesheet" href="css/custom.css">
        <title>cita</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"crossorigin="anonymous"/>
        <link href='css/bootstrap.v5.1.3.min.css' rel='stylesheet'> <!-- Bootstrap 5.1.3 Local -->
        <link href='css/bootstrap-icons.v1.8.1.css' rel='stylesheet'> <!-- Bootstrap Icons 1.8.1 Local -->
        <link rel="stylesheet" href="css/fullcalendar.min.css">
        <script src="js/fullcalendar.min.js"></script>
        <script src="js/es.js"></script>

    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <div class="container">
            <div class="row"></div>
                
                <div > <div id='calendar'></div> </div>
                
            </div>

            <!-- Modal Guardar, modificar y eliminar -->
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
            <!-- Botón para CREAR/GUARDAR -->
            <button type="submit" id="btnGuardarCita" class="btn btn-success" aria-label="Guardar">
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
        <script src='js/index.global.min.js'></script>
        <script src='js/bootstrap5/index.global.min.js'></script>
        <script src="js/custom.js"></script> <!-- Your existing custom script for FullCalendar initialization -->

        

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="js/bootstrap.bundle.min.js"></script>

    </body>
</html>
