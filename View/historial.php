<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pacientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/style.css">

    <style>
        /* Estilos CSS personalizados para la página */
        body{
            font-family: sans-serif; /* Tipo de letra general del cuerpo */
            background-color: #f4f4f4; /* Color de fondo de la página */
        }

        .container{
            max-width: 956px; /* Ancho máximo del contenedor principal */
            margin: 0 auto; /* Centrar el contenedor horizontalmente */
            padding: 20px; /* Espacio interno alrededor del contenido del contenedor */
        }
            .profile-button {
            width: 100px; /* Ancho del botón de perfil */
            height: 100px; /* Alto del botón de perfil */
            border-radius: 50%; /* Hacer el botón circular */
            overflow: hidden; /* Ocultar cualquier parte de la imagen que se salga del círculo */
            display: flex; /* Usar flexbox para centrar la imagen */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
        }

        .profile-button img {
            width: 100%; /* La imagen ocupa todo el ancho del botón */
            height: 100%; /* La imagen ocupa todo el alto del botón */
            object-fit: cover; /* Ajustar la imagen para cubrir el contenedor sin deformarla */
        }

    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-2 bg-dark text-white p-4 sticky-top" style="height: 100vh;">

                <div class="p-3 text-center sticky-top">
                    <img src="Styles/Screenshot_42.png" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 100px;">
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Casa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
            <main class="col-md-10 p-4" style="margin-top: 10px;">
                <header class="d-flex justify-content-between align-items-center mb-4 sticky-top bg-light shadow-sm p-3">
                    <h2>Historial de Pacientes</h2>
                    <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addPatientModal">Incluir Paciente</button>
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editPatientModal">Modificar Paciente</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePatientModal">Eliminar Paciente</button>
                    </div>
                </header>
                <div class="input-group mb-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4" id="pacientesContainer">
                    <?php
                    // Aquí se va ha iterar el array de pacientes en PHP
                    $pacientes = [
                        ['nombre' => 'María Pérez', 'cedula' => 'V-12345678', 'fecha_nacimiento' => '15/03/1988'],
                        ['nombre' => 'José Rodríguez', 'cedula' => 'E-98765432', 'fecha_nacimiento' => '28/09/1995'],
                        ['nombre' => 'Ana Gómez', 'cedula' => 'V-54321876', 'fecha_nacimiento' => '02/07/1979'],
                        ['nombre' => 'Carlos López', 'cedula' => 'E-11223344', 'fecha_nacimiento' => '20/01/2000'],
                        ['nombre' => 'Laura Vargas', 'cedula' => 'V-99887766', 'fecha_nacimiento' => '05/11/1992'],
                        ['nombre' => 'Sofía Martínez', 'cedula' => 'V-76543210', 'fecha_nacimiento' => '10/06/1990'],
                        // ... más pacientes
                    ];

                    foreach ($pacientes as $paciente) {
                        echo '<article class="col mb-4 paciente-card" data-nombre="' . htmlspecialchars($paciente['nombre']) . '" data-cedula="' . htmlspecialchars($paciente['cedula']) . '">';
                        echo '    <div class="card">';
                        echo '        <div class="card-body">';
                        echo '            <h5 class="card-title">' . htmlspecialchars($paciente['nombre']) . '</h5>';
                        echo '            <p class="card-text">Cédula: ' . htmlspecialchars($paciente['cedula']) . '</p>';
                        echo '            <p class="card-text">Fecha de Nacimiento: ' . htmlspecialchars($paciente['fecha_nacimiento']) . '</p>';
                        echo '            <div class="d-flex justify-content-between">';
                        echo '                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#verDetallesModal"';
                        echo '                        data-nombre-paciente="' . htmlspecialchars($paciente['nombre']) . '"';
                        echo '                        data-cedula-paciente="' . htmlspecialchars($paciente['cedula']) . '"';
                        echo '                        data-fecha-nacimiento="' . htmlspecialchars($paciente['fecha_nacimiento']) . '">';
                        echo '                    Ver Detalles';
                        echo '                </button>';
                        echo '                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</article>';
                    }
                    ?>
                </div>
            </main>
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

    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Historial de Pacientes. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>
</html>