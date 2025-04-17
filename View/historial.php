<!DOCTYPE html>
<html lang="es"> <head>
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
    <div class="container-fluid"> <div class="row"> <nav class="col-md-2 bg-dark text-white p-4 sticky-top" style="height: 100vh;">
                <div class="p-3 text-center sticky-top">
                    <img src="Styles/Screenshot_42.png" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 100px;">
                    </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Casa</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Documentos</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Citas</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cerrar Sesión</a> </li>
                </ul>
            </nav>
            <main class="col-md-10 p-4" style="margin-top: 10px;">
                <header class="d-flex justify-content-between align-items-center mb-4 sticky-top bg-light shadow-sm p-3">
                    <h2>Historial de Pacientes</h2> <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addPatientModal">Incluir Paciente</button>
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editPatientModal">Modificar Paciente</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePatientModal">Eliminar Paciente</button>
                        </div>
                </header>
                <div class="input-group mb-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                    </div>
                <div class="row row-cols-1 row-cols-md-2 g-4" id="pacientesContainer">
                    <article class="col mb-4 paciente-card" data-nombre="María Pérez" data-cedula="V-12345678">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">María Pérez</h5> <p class="card-text">Cédula: V-12345678</p> <p class="card-text">Fecha de Nacimiento: 15/03/1988</p> <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                    </div>
                            </div>
                        </div>
                    </article>


                    <article class="col mb-4 paciente-card" data-nombre="José Rodríguez" data-cedula="E-98765432">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">José Rodríguez</h5>
                                <p class="card-text">Cédula: E-98765432</p>
                                <p class="card-text">Fecha de Nacimiento: 28/09/1995</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                </div>
                            </div>
                        </div>
                    </article>


                    <article class="col mb-4 paciente-card" data-nombre="Ana Gómez" data-cedula="V-54321876">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ana Gómez</h5>
                                <p class="card-text">Cédula: V-54321876</p>
                                <p class="card-text">Fecha de Nacimiento: 02/07/1979</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                </div>
                            </div>
                        </div>
                    </article>


                    <article class="col mb-4 paciente-card" data-nombre="María Pérez" data-cedula="V-12345678">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">María Pérez</h5>
                                <p class="card-text">Cédula: V-12345678</p>
                                <p class="card-text">Fecha de Nacimiento: 15/03/1988</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                </div>
                            </div>
                        </div>
                    </article>


                    <article class="col mb-4 paciente-card" data-nombre="Carlos López" data-cedula="E-11223344">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Carlos López</h5>
                                <p class="card-text">Cédula: E-11223344</p>
                                <p class="card-text">Fecha de Nacimiento: 20/01/2000</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                </div>
                            </div>
                        </div>
                    </article>


                    <article class="col mb-4 paciente-card" data-nombre="Laura Vargas" data-cedula="V-99887766">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Laura Vargas</h5>
                                <p class="card-text">Cédula: V-99887766</p>
                                <p class="card-text">Fecha de Nacimiento: 05/11/1992</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDetailsModal">Ver Detalles</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">Historial Clínico</button>
                                </div>
                            </div>
                        </div>
                    </article>


                </div>
            </main>
        </div>
    </div>

    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Historial de Pacientes. Todos los derechos reservados.</p>
        </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function buscarPacientesEnTiempoReal() {
            // Función para buscar pacientes en tiempo real
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            // Obtiene el valor del campo de búsqueda y lo convierte a minúsculas
            const pacienteCards = document.querySelectorAll('.paciente-card');
            // Selecciona todas las tarjetas de paciente

            pacienteCards.forEach(card => {
                // Itera sobre cada tarjeta de paciente
                const nombre = card.dataset.nombre.toLowerCase();
                // Obtiene el nombre del paciente del atributo data-nombre y lo convierte a minúsculas
                const cedula = card.dataset.cedula.toLowerCase();
                // Obtiene la cédula del paciente del atributo data-cedula y lo convierte a minúsculas

                if (nombre.includes(searchTerm) || cedula.includes(searchTerm)) {
                    // Si el nombre o la cédula contienen el término de búsqueda
                    card.style.display = 'block'; // Muestra la tarjeta del paciente
                } else {
                    // Si no contienen el término de búsqueda
                    card.style.display = 'none';  // Oculta la tarjeta del paciente
                }
            });
        }
    </script>
</body>
</html>