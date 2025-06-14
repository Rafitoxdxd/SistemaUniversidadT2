<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tratamientos Psicológicos</title>
    <link rel="stylesheet" href="css/navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <?php require_once("menu/menu.php"); ?>

    <style>
        .badge-inicial {
            background-color: #6c757d;
        }

        .badge-en_progreso {
            background-color: #0d6efd;
        }

        .badge-pausado {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-seguimiento {
            background-color: #fd7e14;
        }

        .badge-finalizado {
            background-color: #198754;
        }

        .paciente-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-accion {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        
        
    </style>
</head>

<body class="bg-light p-4">
    

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                <!-- Mostrar mensajes -->
                <?php if (isset($_SESSION['mensaje'])): ?>
                    <div class="alert alert-<?= $_SESSION['mensaje']['tipo'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['mensaje']['texto'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['mensaje']); ?>
                <?php endif; ?>

                <h1 class="text-center mb-4">Gestión de Tratamientos Psicológicos</h1>

                <div class="d-flex justify-content-center mb-4 gap-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoTratamientoModal">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Tratamiento
                    </button>
                </div>

                <!-- Barra de búsqueda -->
                <div class="row mb-4">
                    <div class="col-md-8 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarTratamiento" placeholder="Buscar por nombre, cédula, estado o fecha...">
                            <button class="btn btn-primary" type="button" id="btnBuscar">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-5">
                    <div class="card shadow-sm mx-auto" style="max-width: 1000px;">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                            <h4 class="mb-0"><i class="fas fa-heartbeat me-2"></i>TRATAMIENTOS PSICOLÓGICOS</h4>
                        </div>
                        <div class="card-body paciente-card">
                            <div class="table-responsive">
                                <table id="tablaTratamientos" class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Paciente</th>
                                            <th>Cédula</th>
                                            <th>Fecha Inicio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tratamientos as $tratamiento): ?>
                                            <tr data-id="<?= $tratamiento['id_tratamiento'] ?>">
                                                <td><?= htmlspecialchars($tratamiento['nombre'] . ' ' . $tratamiento['apellido']) ?></td>
                                                <td><?= htmlspecialchars($tratamiento['cedula']) ?></td>
                                                <td><?= date('d/m/Y', strtotime($tratamiento['fecha_creacion'])) ?></td>
                                                <td>
                                                    <?php
                                                    $estadoClass = "badge-" . str_replace(' ', '_', strtolower($tratamiento['estado_actual']));
                                                    $estadoText = ucwords(str_replace('_', ' ', $tratamiento['estado_actual']));
                                                    ?>
                                                    <span class="badge <?= $estadoClass ?>"><?= $estadoText ?></span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning btn-editar" data-id="<?= $tratamiento['id_tratamiento'] ?>">
                                                        <i class="fas fa-edit me-1"></i>Editar
                                                    </button>
                                                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="<?= $tratamiento['id_tratamiento'] ?>">
                                                        <i class="fas fa-trash me-1"></i>Eliminar
                                                    </button>
                                                    <button class="btn btn-sm btn-info btn-detalles" data-id="<?= $tratamiento['id_tratamiento'] ?>">
                                                        <i class="fas fa-info-circle me-1"></i>Detalles
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Nuevo Tratamiento -->
                <div class="modal fade" id="nuevoTratamientoModal" tabindex="-1" aria-labelledby="nuevoTratamientoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="nuevoTratamientoModalLabel">
                                    <i class="fas fa-plus-circle me-2"></i>Nuevo Tratamiento
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formNuevoTratamiento" method="post">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="id_paciente" class="form-label">Paciente *</label>
                                            <select class="form-select" id="id_paciente" name="id_paciente" required>
                                                <option value="">Seleccione un paciente</option>
                                                <?php foreach ($pacientes as $paciente): ?>
                                                    <option value="<?= $paciente['id_paciente'] ?>">
                                                        <?= htmlspecialchars($paciente['nombre'] . ' ' . $paciente['apellido'] . ' - ' . $paciente['cedula']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fecha_creacion" class="form-label">Fecha de Creación *</label>
                                            <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="tratamiento_tipo" class="form-label">Tipo de Tratamiento *</label>
                                            <input type="text" class="form-control" id="tratamiento_tipo" name="tratamiento_tipo" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="estado_actual" class="form-label">Estado *</label>
                                            <select class="form-select" id="estado_actual" name="estado_actual" required>
                                                <option value="inicial">Fase Inicial</option>
                                                <option value="en_progreso">En Progreso</option>
                                                <option value="pausado">Pausado</option>
                                                <option value="seguimiento">Seguimiento</option>
                                                <option value="finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="diagnostico_descripcion" class="form-label">Diagnóstico *</label>
                                        <textarea class="form-control" id="diagnostico_descripcion" name="diagnostico_descripcion" rows="4" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="observaciones" class="form-label">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i>Cancelar
                                        </button>
                                        <button type="submit" name="guardar_tratamiento" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i>Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Tratamiento -->
                <div class="modal fade" id="editarTratamientoModal" tabindex="-1" aria-labelledby="editarTratamientoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editarTratamientoModalLabel">
                                    <i class="fas fa-edit me-2"></i>Editar Tratamiento
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formEditarTratamiento" method="post">
                                    <input type="hidden" id="id_tratamiento_editar" name="id_tratamiento">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="id_paciente_editar" class="form-label">Paciente *</label>
                                            <select class="form-select" id="id_paciente_editar" name="id_paciente" required>
                                                <option value="">Seleccione un paciente</option>
                                                <?php foreach ($pacientes as $paciente): ?>
                                                    <option value="<?= $paciente['id_paciente'] ?>">
                                                        <?= htmlspecialchars($paciente['nombre'] . ' ' . $paciente['apellido'] . ' - ' . $paciente['cedula']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fecha_creacion_editar" class="form-label">Fecha de Creación *</label>
                                            <input type="date" class="form-control" id="fecha_creacion_editar" name="fecha_creacion" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="tratamiento_tipo_editar" class="form-label">Tipo de Tratamiento *</label>
                                            <input type="text" class="form-control" id="tratamiento_tipo_editar" name="tratamiento_tipo" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="estado_actual_editar" class="form-label">Estado *</label>
                                            <select class="form-select" id="estado_actual_editar" name="estado_actual" required>
                                                <option value="inicial">Fase Inicial</option>
                                                <option value="en_progreso">En Progreso</option>
                                                <option value="pausado">Pausado</option>
                                                <option value="seguimiento">Seguimiento</option>
                                                <option value="finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="diagnostico_descripcion_editar" class="form-label">Diagnóstico *</label>
                                        <textarea class="form-control" id="diagnostico_descripcion_editar" name="diagnostico_descripcion" rows="4" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="observaciones_editar" class="form-label">Observaciones</label>
                                        <textarea class="form-control" id="observaciones_editar" name="observaciones" rows="3"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i>Cancelar
                                        </button>
                                        <button type="submit" name="actualizar_tratamiento" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Actualizar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detalles Tratamiento -->
                <div class="modal fade" id="detallesTratamientoModal" tabindex="-1" aria-labelledby="detallesTratamientoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="detallesTratamientoModalLabel">
                                    <i class="fas fa-info-circle me-2"></i>Detalles del Tratamiento
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="fas fa-user fa-3x mb-3 text-primary"></i>
                                                <h5 id="detalleNombrePaciente"></h5>
                                                <p class="text-muted mb-1" id="detalleCedula"></p>
                                                <p class="text-muted" id="detalleFechaCreacion"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Estado del Tratamiento</h5>
                                                <p class="card-text">
                                                    <span class="badge" id="detalleEstado"></span>
                                                </p>

                                                <h5 class="card-title mt-3">Tipo de Tratamiento</h5>
                                                <p class="card-text" id="detalleTipoTratamiento"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Diagnóstico Psicológico</h5>
                                    </div>
                                    <div class="card-body">
                                        <p id="detalleDiagnostico"></p>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Observaciones</h5>
                                    </div>
                                    <div class="card-body">
                                        <p id="detalleObservaciones"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Confirmar Eliminación -->
                <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmarEliminarModalLabel">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro que desea eliminar este tratamiento? Esta acción no se puede deshacer.</p>
                                <input type="hidden" id="id_tratamiento_eliminar">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Cancelar
                                </button>
                                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">
                                    <i class="fas fa-trash me-1"></i>Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/tratamiento.js"></script>

    </script>
</body>

</html>