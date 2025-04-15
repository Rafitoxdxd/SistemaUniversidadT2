<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pacientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/style.css">

    <style>
    body{
        font-family: sans-serif;
        background-color: #f4f4f4;
    }

    .container{
        max-width: 956px;
        margin: 0 auto;
        padding: 20px;
    }
        .profile-button {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .profile-button img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                    <input type="text" class="form-control" placeholder="Buscar paciente por nombre, cédula...">
                    <button class="btn btn-outline-secondary" type="button">Buscar</button>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <article class="col mb-4">
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


                    <article class="col mb-4">
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


                    <article class="col mb-4">
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


                    <article class="col mb-4">
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


                    <article class="col mb-4">
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


                    <article class="col mb-4">
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


                </div>
            </main>
        </div>
    </div>

    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Historial de Pacientes. Todos los derechos reservados.</p>
    </footer>

    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="addPatientModalLabel">Incluir Paciente</h5><button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" class="btn btn-primary">Guardar</button></div></div></div>
    </div>

    <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="editPatientModalLabel">Modificar Paciente</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" class="btn btn-primary">Guardar</button></div></div></div>
    </div>

    <div class="modal fade" id="deletePatientModal" tabindex="-1" aria-labelledby="deletePatientModalLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="deletePatientModalLabel">Eliminar Paciente</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" class="btn btn-danger">Eliminar</button></div></div></div>
    </div>

    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="viewDetailsModalLabel">Detalles del Paciente</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div></div></div>
    </div>

    <div class="modal fade" id="medicalHistoryModal" tabindex="-1" aria-labelledby="medicalHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="medicalHistoryModalLabel">Historial Clínico</h5><button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div></div></div>
    </div>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>