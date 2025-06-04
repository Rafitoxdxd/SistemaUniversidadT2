<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Tratamientos Psicológicos</title>
    <link rel="stylesheet" href="css/navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Paleta de colores para un estilo más elegante en tonos de gris y azul */
  


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
            .main-content { /* Cambiado de .col-md-9.ml-sm-auto, .col-lg-10.px-4 a .main-content */
                margin-left: 0 !important; /* Restablece el margen izquierdo en móviles */
                width: 100%;
            }
            .sidebar-sticky {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                padding: 12px 0;
            }
            .sidebar .nav-link {
                margin: 5px;
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
            /* Ajustes para el icono de perfil en móviles */
            .profile-icon-container {
                position: static; /* Cambia a posición estática para fluir con el contenido */
                margin: 10px auto; /* Centra el icono */
                text-align: center;
                width: fit-content; /* Ajusta el ancho al contenido */
            }
        }
    </style>
</head>
<body class="bg-light p-4">

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
                            <a class="nav-link" href='?pagina=test'>Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=pacientes'>Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=cita'>Citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='?pagina=tratamiento'>Tratamientos</a>
                        </li>
                        <li class="nav-item mt-auto">
                            <a class="nav-link" href="?pagina=logout">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">

            <h1 class="text-center mb-4">Sistema de Tratamientos Psicológicos</h1>

            <div class="d-flex justify-content-center mb-4 gap-3">
            <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#incluirPacienteModal">Incluir Paciente</button>
            </div>

            <!-- Barra de búsqueda -->
                <form method="POST" action="?pagina=tratamiento" class="row mb-4">
                    <input type="hidden" name="accion" value="buscar">
                    <div class="col-md-8 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" name="termino" id="searchInput" placeholder="Buscar paciente por nombre o cédula..." onkeyup="buscarPacientesEnTiempoReal()">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>      
                               
                <div class="container-fluid mt-5">
                    <div class="card shadow-sm mx-auto" style="max-width: 1000px;">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                            <h4 class="mb-0">TRATAMIENTOS PSICOLÓGICOS</h4>
                            <div>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal">Modificar Paciente</button>
                            </div>
                        </div>
                        <div class="card-body paciente-card ">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped caption-top">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Cédula</th>
                                        <th>Fecha Inicio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php if (!empty($tratamientos) && is_array($tratamientos)): ?>
                                            <?php foreach ($tratamientos as $tratamiento):
                                                $estadoClass = "badge-{$tratamiento['estado_actual']}";
                                                $estadoText = ucwords(str_replace('_', ' ', $tratamiento['estado_actual']));
                                            ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($tratamiento['nombre_completo']) ?></td>
                                                    <td><?= htmlspecialchars($tratamiento['cedula']) ?></td>
                                                    <td><?= htmlspecialchars($tratamiento['fecha_creacion']) ?></td>
                                                    <td><span class="badge <?= $estadoClass ?>"><?= $estadoText ?></span></td>
                                                    <td>
                                                        <a href="index.php?accion=editarTratamiento&id=<?= $tratamiento['id'] ?>" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        <a href="index.php?accion=eliminarTratamiento&id=<?= $tratamiento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este tratamiento?')">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                        <button class="btn btn-sm btn-info btn-detalles" data-id="<?= $tratamiento['id'] ?>" data-bs-toggle="modal" data-bs-target="#detallesTratamientoModal">
                                                            <i class="fas fa-info-circle"></i> Detalles
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="5" class="text-center">No hay tratamientos registrados.</td></tr>
                                        <?php endif; ?>
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
                                <form method="POST" action="?pagina=tratamiento">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
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
                                            <label for="fechaCreacion" class="form-label">Fecha de Creación *</label>
                                            <input type="date" class="form-control" id="fechaCreacion" name="fecha_creacion" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="estadoTratamiento" class="form-label">Estado del Tratamiento *</label>
                                            <select class="form-select" id="estadoTratamiento" name="estado_actual" required>
                                                <option value="inicial">Fase Inicial</option>
                                                <option value="en_progreso">En Progreso</option>
                                                <option value="pausado">Pausado</option>
                                                <option value="seguimiento">Seguimiento</option>
                                                <option value="finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="diagnostico" class="form-label">Diagnóstico Psicológico *</label>
                                        <textarea class="form-control" id="diagnostico" name="diagnostico_descripcion" rows="5" placeholder="Describa el diagnóstico del paciente..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tratamiento" class="form-label">Plan de Tratamiento *</label>
                                        <textarea class="form-control" id="tratamiento" name="tratamiento_tipo" rows="5" placeholder="Describa el plan de tratamiento..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="observaciones" class="form-label">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Observaciones adicionales..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" name="guardar_tratamiento" class="btn btn-success">Guardar Paciente</button>
                                    </div>
                                </form>
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
                                <form id="formModificarTratamiento" method="post" action="?pagina=tratamiento">
                                    <input type="hidden" name="id_tratamiento" id="id_tratamiento_modificar" value="">
                                    <input type="hidden" name="id_paciente" id="id_paciente_modificar" value="">
                                    <input type="hidden" name="fecha_creacion" id="fecha_creacion_modificar" value="">
                                    <div class="mb-3">
                                        <label for="modificarNombrePaciente" class="form-label">Nombre del Paciente</label>
                                        <input type="text" class="form-control" id="modificarNombrePaciente" name="nombre_paciente" value="" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modificarCedulaPaciente" class="form-label">Cédula</label>
                                        <input type="text" class="form-control" id="modificarCedulaPaciente" name="cedula_paciente" value="" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="diagnosticoModificar" class="form-label">Diagnóstico Psicológico</label>
                                        <textarea class="form-control" id="diagnosticoModificar" name="diagnostico_descripcion" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tratamientoModificar" class="form-label">Plan de Tratamiento</label>
                                        <textarea class="form-control" id="tratamientoModificar" name="tratamiento_tipo" rows="5"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estadoModificar" class="form-label">Estado del Tratamiento</label>
                                        <select class="form-select" id="estadoModificar" name="estado_actual">
                                            <option value="inicial">Fase Inicial</option>
                                            <option value="en_progreso">En Progreso</option>
                                            <option value="finalizado">Finalizado</option>
                                            <option value="pausado">Pausado Temporalmente</option>
                                            <option value="seguimiento">Seguimiento</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" name="guardar_cambios_tratamiento">Guardar Cambios</button>
                                    </div>
                                </form>
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
            </main>
        </div>
    </div>

    <script> 
    function buscarPacientesEnTiempoReal() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const tableRows = document.querySelectorAll('.table tbody tr'); // Selecciona las filas de la tabla

        tableRows.forEach(row => {
            const nombre = row.cells[0].textContent.toLowerCase(); // Columna del nombre
            const cedula = row.cells[1].textContent.toLowerCase(); // Columna de la cédula

            if (nombre.includes(searchTerm) || cedula.includes(searchTerm)) {
                row.style.display = ''; // Muestra la fila
            } else {
                row.style.display = 'none'; // Oculta la fila
            }
        });
    }

    // Llenar el formulario al hacer click en editar
    const editarBtns = document.querySelectorAll('.btn-warning');
    editarBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Aquí deberías cargar los datos del tratamiento seleccionado (puedes usar AJAX o pasar datos con data-*)
            // Ejemplo básico:
            const row = btn.closest('tr');
            document.getElementById('id_tratamiento_modificar').value = btn.href.split('=')[2];
            document.getElementById('modificarNombrePaciente').value = row.children[0].textContent;
            document.getElementById('modificarCedulaPaciente').value = row.children[1].textContent;
            // Rellenar los campos ocultos si tienes los datos en el DOM o en data-*
            document.getElementById('id_paciente_modificar').value = row.getAttribute('data-id-paciente') || '';
            document.getElementById('fecha_creacion_modificar').value = row.children[2].textContent || '';
            // Si tienes los valores de diagnostico, tratamiento y estado en el DOM, rellénalos aquí
            document.getElementById('diagnosticoModificar').value = row.getAttribute('data-diagnostico') || '';
            document.getElementById('tratamientoModificar').value = row.getAttribute('data-tratamiento') || '';
            document.getElementById('estadoModificar').value = row.getAttribute('data-estado') || '';
            // Mostrar el modal
            var modal = new bootstrap.Modal(document.getElementById('modificarPacienteModal'));
            modal.show();
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>