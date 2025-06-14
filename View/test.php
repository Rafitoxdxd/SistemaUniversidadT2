<!doctype html>
<html lang="es">
<head>
    <title>Tests Psicológicos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="css/navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php require_once("menu/menu.php"); ?>

    <style>
        .btn-accion {
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border: none;
        }
        .btn-editar { background: var(--color4); color: #4B4949; }
        .btn-editar:hover { background: #c7a91e; color: #222; }
        .btn-eliminar { background: #ff5c5c; color: #fff; }
        .btn-eliminar:hover { background: #e04a4a; }
        .btn-primary {
            background: var(--color5);
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 20px;
            padding: 0.6rem 1.5rem;
        }
        .btn-primary:hover {
            background: #c7a91e;
        }
        .test-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .test-question {
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .test-header {
            background-color: var(--color5);
            color: white;
            padding: 10px 15px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 15px;
        }
        .test-option {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        .test-options-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>
</head>
<body>
            <!-- Contenido principal -->
            <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4 ms-4 me-2">
                    <h2 class="fw-bold" style="color:var(--color5);">Tests Psicológicos</h2>
                    <div class="d-flex align-items-center gap-3">
                        <a href='?pagina=profile' title="Mi Perfil" class="profile-icon-link d-flex align-items-center justify-content-center">
                            <i class="bi bi-person" style="font-size: 32px; color: var(--color5);"></i>
                        </a>
                        <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#nuevoTestModal">
                            <i class="bi bi-plus-circle me-2"></i> Nuevo Test
                        </button>
                    </div>
                </div>

                <!-- Filtros y selección de paciente -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="selectPaciente" class="form-label">Seleccionar Paciente</label>
                                <select class="form-select" id="selectPaciente">
                                    <option value="">-- Seleccione un paciente --</option>
                                    <?php foreach ($pacientes as $paciente): ?>
                                        <option value="<?= $paciente['id_paciente'] ?>">
                                            <?= htmlspecialchars($paciente['apellido'] . ', ' . $paciente['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="filtroTest" class="form-label">Filtrar por tipo de test</label>
                                <select class="form-select" id="filtroTest">
                                    <option value="">Todos los tests</option>
                                    <option value="poms">POMS</option>
                                    <option value="confianza">Confianza</option>
                                    <option value="importancia">Importancia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de tests -->
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Tests Registrados</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paciente</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaTests">
                                <tr>
                                    <td colspan="5">Seleccione un paciente para ver sus tests</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal para nuevo test -->
                <div class="modal fade" id="nuevoTestModal" tabindex="-1" aria-labelledby="nuevoTestModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="nuevoTestModalLabel">Nuevo Test</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formNuevoTest">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nuevoTestPaciente" class="form-label">Paciente</label>
                                            <select class="form-select" id="nuevoTestPaciente" name="id_paciente" required>
                                                <option value="">-- Seleccione un paciente --</option>
                                                <?php foreach ($pacientes as $paciente): ?>
                                                    <option value="<?= $paciente['id_paciente'] ?>">
                                                        <?= htmlspecialchars($paciente['apellido'] . ', ' . $paciente['nombre']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nuevoTestTipo" class="form-label">Tipo de Test</label>
                                            <select class="form-select" id="nuevoTestTipo" name="tipo_test" required>
                                                <option value="">-- Seleccione un tipo --</option>
                                                <option value="poms">POMS</option>
                                                <option value="confianza">Confianza</option>
                                                <option value="importancia">Importancia</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Contenedor dinámico para el formulario del test seleccionado -->
                                    <div id="formularioTestContainer"></div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name="guardar_test">Guardar Test</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para editar test -->
                <div class="modal fade" id="editarTestModal" tabindex="-1" aria-labelledby="editarTestModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarTestModalLabel">Editar Test</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formEditarTest">
                                    <input type="hidden" id="editarTestId" name="id_test">
                                    <input type="hidden" id="editarTestTipo" name="tipo_test">
                                    
                                    <!-- Contenedor dinámico para el formulario del test -->
                                    <div id="formularioEditarTestContainer"></div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name="actualizar_test">Actualizar Test</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/test.js"></script>
</body>
</html>