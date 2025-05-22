<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Tratamientos Psicológicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light p-4">

    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="text" class="form-control" id="searchInput" placeholder="Buscar paciente por nombre, cédula..." onkeyup="buscarPacientesEnTiempoReal()">
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 1000px;">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h4 class="mb-0">TRATAMIENTOS PSICOLÓGICOS</h4>
                <div>
                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#incluirPacienteModal">Incluir Paciente</button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal">Modificar Paciente</button>
                </div>
            </div>
            <div class="card-body paciente-card ">
                <div class="table-responsive">
                    <table class="table table-hover table-striped caption-top">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class= "justify-content-between">
                                    NOMBRE DEL PACIENTE
                                </th>
                                <th scope="col" class=" justify-content-between">
                                    CÉDULA
                                </th>
                                <th scope="col" class=" justify-content-between">
                                    FECHA CREACIÓN
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ana García</td>
                                <td>12.345.678</td>
                                <td>15/01/2023</td>
                                <td> 
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Carlos Ruiz</td>
                                <td>23.456.789</td>
                                <td>01/03/2024</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Laura Fernández</td>
                                <td>34.567.890</td>
                                <td>20/06/2023</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verDetallesModal">Ver detalles</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="incluirPacienteModal" tabindex="-1" aria-labelledby="incluirPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="incluirPacienteModalLabel">Incluir Nuevo Paciente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombrePaciente" class="form-label">Nombre del Paciente</label>
                            <input type="text" class="form-control" id="nombrePaciente" required>
                        </div>
                        <div class="mb-3">
                            <label for="cedulaPaciente" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="cedulaPaciente" required>
                        </div>
                        <div class="mb-3">
                            <label for="diagnosticoIncluir" class="form-label">Diagnóstico Psicológico</label>
                            <textarea class="form-control" id="diagnosticoIncluir" rows="4" placeholder="Ej: Trastorno de ansiedad generalizada, con ataques de pánico ocasionales."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tratamientoIncluir" class="form-label">Plan de Tratamiento</label>
                            <textarea class="form-control" id="tratamientoIncluir" rows="5" placeholder="Ej: Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="estadoIncluir" class="form-label">Estado del Tratamiento</label>
                            <select class="form-select" id="estadoIncluir">
                                <option selected>Seleccione el estado</option>
                                <option value="inicial">Fase Inicial</option>
                                <option value="en_progreso">En Progreso</option>
                                <option value="finalizado">Finalizado</option>
                                <option value="pausado">Pausado Temporalmente</option>
                                <option value="seguimiento">Seguimiento</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar Paciente</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modificarPacienteModal" tabindex="-1" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Datos del Paciente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="modificarNombrePaciente" class="form-label">Nombre del Paciente</label>
                            <input type="text" class="form-control" id="modificarNombrePaciente" value="Ana García">
                        </div>
                        <div class="mb-3">
                            <label for="modificarCedulaPaciente" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="modificarCedulaPaciente" value="12.345.678">
                        </div>
                        <div class="mb-3">
                            <label for="diagnosticoModificar" class="form-label">Diagnóstico Psicológico</label>
                            <textarea class="form-control" id="diagnosticoModificar" rows="4">Trastorno de ansiedad generalizada, con ataques de pánico ocasionales. Se observa mejora en el manejo del estrés.</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tratamientoModificar" class="form-label">Plan de Tratamiento</label>
                            <textarea class="form-control" id="tratamientoModificar" rows="5">Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual. Se redujo la frecuencia de sesiones a quincenal.</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="estadoModificar" class="form-label">Estado del Tratamiento</label>
                            <select class="form-select" id="estadoModificar">
                                <option value="inicial">Fase Inicial</option>
                                <option value="en_progreso" selected>En Progreso</option>
                                <option value="finalizado">Finalizado</option>
                                <option value="pausado">Pausado Temporalmente</option>
                                <option value="seguimiento">Seguimiento</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="verDetallesModal" tabindex="-1" aria-labelledby="verDetallesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="verDetallesModalLabel">Detalles del Paciente y Tratamiento</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nombre del Paciente:</dt>
                        <dd class="col-sm-8" id="detalleNombre">Ana García</dd> 

                        <dt class="col-sm-4">Cédula:</dt>
                        <dd class="col-sm-8" id="detalleCedula">12.345.678</dd>

                        <dt class="col-sm-4">Fecha Creación:</dt>
                        <dd class="col-sm-8" id="detalleFechaCreacion">15/01/2023</dd>

                        <dt class="col-sm-4">Diagnóstico Psicológico:</dt>
                        <dd class="col-sm-8" id="detalleDiagnostico">Trastorno de ansiedad generalizada, con ataques de pánico ocasionales. Se observa mejora en el manejo del estrés.</dd>

                        <dt class="col-sm-4">Plan de Tratamiento:</dt>
                        <dd class="col-sm-8" id="detalleTratamiento">Terapia Cognitivo-Conductual (TCC) semanal, técnicas de relajación, exposición gradual. Se redujo la frecuencia de sesiones a quincenal.</dd>

                        <dt class="col-sm-4">Estado del Tratamiento:</dt>
                        <dd class="col-sm-8" id="detalleEstado"><span class="badge bg-warning">En Progreso</span></dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

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

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>