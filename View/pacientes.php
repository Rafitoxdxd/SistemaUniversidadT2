<!doctype html>
<html lang="es">
    <head>
        <title>pacientes</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="stylesheet" href="css/navegacion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="js/paciente.js"></script>

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
            .btn-historial { background: var(--color5); color: #fff; }
            .btn-historial:hover { background: #5a8ca1; }
            .btn-cita { background: #1abc9c; color: #fff; }
            .btn-cita:hover { background: #159c7c; }
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
            .input-group-text {
                background: var(--color1);
                border: none;
                color: var(--color5);
                font-size: 1.2rem;
            }
            .form-control:focus {
                border: 2px solid var(--color4);
                box-shadow: 0 0 0 0.1rem rgba(224, 195, 35, 0.18);
                background: #fff;
            }
            .modal-content {
                border-radius: 18px;
            }
            .modal-header {
                background: var(--color5);
                color: #fff;
                border-bottom: none;
            }
            .modal-title {
                font-weight: bold;
            }
            @media (max-width: 991.98px) {
                .sidebar {
                    position: static;
                    width: 100%;
                    height: auto;
                    box-shadow: none;
                }
                .main-content {
                    margin-left: 0;
                    padding: 1rem 0.2rem;
                }
            }
        </style>
    </head>
    <body>
        
        <!-- Menú de navegación responsive -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 d-lg-none">
                <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="?pagina=main" style="color: var(--color5);">Sistema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <div class="w-100 d-flex justify-content-center my-2">
    <img src="img/Logo3.png" alt="Logo Stephanie Quintero" style="max-width:90px; max-height:90px;">
</div>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'main' ? ' active' : '' ?>" href="?pagina=main"><i class="bi bi-house-door me-2"></i>Inicio</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'historial' ? ' active' : '' ?>" href="?pagina=historial"><i class="bi bi-clock-history me-2"></i>Historial</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'test' ? ' active' : '' ?>" href="?pagina=test"><i class="bi bi-clipboard-check me-2"></i>Test</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'pacientes' ? ' active' : '' ?>" href="?pagina=pacientes"><i class="bi bi-people me-2"></i>Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'cita' ? ' active' : '' ?>" href="?pagina=cita"><i class="bi bi-calendar2-plus me-2"></i>Citas</a></li>
                    <li class="nav-item"><a class="nav-link<?= ($_GET['pagina'] ?? '') === 'tratamiento' ? ' active' : '' ?>" href="?pagina=tratamiento"><i class="bi bi-capsule-pill me-2"></i>Tratamiento</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                </ul>
            </div>
            </div>
            </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-lg-block sidebar">
                    <div class="sidebar-sticky">
                        <div class="w-100 d-flex justify-content-center my-3">
                        <img src="img/Logo3.png" alt="Logo Stephanie Quintero" style="max-width:120px; max-height:120px;">
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'main' ? ' active' : '' ?>" href="?pagina=main">
                                    <i class="bi bi-house-door me-2"></i> Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'historial' ? ' active' : '' ?>" href="?pagina=historial">
                                    <i class="bi bi-clock-history me-2"></i> Historial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'test' ? ' active' : '' ?>" href="?pagina=test">
                                    <i class="bi bi-clipboard-check me-2"></i> Test
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'pacientes' ? ' active' : '' ?>" href="?pagina=pacientes">
                                    <i class="bi bi-people me-2"></i> Pacientes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'cita' ? ' active' : '' ?>" href="?pagina=cita">
                                    <i class="bi bi-calendar2-plus me-2"></i> Citas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= ($_GET['pagina'] ?? '') === 'tratamiento' ? ' active' : '' ?>" href="?pagina=tratamiento">
                                    <i class="bi bi-capsule-pill me-2"></i> Tratamiento
                                </a>
                            </li>
                            <li class="nav-item mt-auto">
                                <a class="nav-link" href="?pagina=logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4 ms-4 me-2">
    <h2 class="fw-bold" style="color:var(--color5);">Pacientes</h2>
    <div class="d-flex align-items-center gap-3">
        <a href='?pagina=profile' title="Mi Perfil" class="profile-icon-link d-flex align-items-center justify-content-center">
            <i class="bi bi-person" style="font-size: 32px; color: var(--color5);"></i>
        </a>
        <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#registropacienteModal">
            <i class="bi bi-plus-circle me-2"></i> Añadir paciente
        </button>
    </div>
</div>
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="buscarpaciente" class="form-control" placeholder="Buscar pacientes...">
                        </div>
                    </div>
                    <nav aria-label="Paginación de pacientes (arriba)">
                        <ul class="pagination justify-content-center" id="paginacionpacientesTop"></ul>
                    </nav>
                    <div class="card shadow-sm rounded-4 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cédula</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablapacientes">
<?php
    if (isset($pacientes) && !empty($pacientes)):
        foreach ($pacientes as $paciente):
?>
    <tr>
        <td><?= htmlspecialchars($paciente['id_paciente']) ?></td>
        <td><?= htmlspecialchars($paciente['nombre']) ?></td>
        <td><?= htmlspecialchars($paciente['apellido']) ?></td>
        <td><?= htmlspecialchars($paciente['cedula']) ?></td>
        <td><?= htmlspecialchars($paciente['telefono']) ?></td>
        <td>
            <button class="btn btn-accion btn-editar btn-sm" data-bs-toggle="modal" data-bs-target="#modificarpacienteModal" data-id="<?= htmlspecialchars($paciente['id_paciente']) ?>">
<i class="bi bi-pencil"></i> Editar</button>
            <a class="btn btn-accion btn-eliminar btn-sm" href="index.php?pagina=pacientes&accion=eliminarpaciente&id=<?= htmlspecialchars($paciente['id_paciente']) ?>"
            onclick="return confirm('¿Desea eliminar este paciente?');"><i class="bi bi-trash"></i> Eliminar</a>
            <a href="index.php?accion=verHistorial&paciente_id=<?= htmlspecialchars($paciente['id_paciente']) ?>" class="btn btn-accion btn-historial btn-sm"><i class="bi bi-journal-text"></i> Historial</a>
            <a href="index.php?accion=agendarCita&paciente_id=<?= htmlspecialchars($paciente['id_paciente']) ?>" class="btn btn-accion btn-cita btn-sm"><i class="bi bi-calendar-plus"></i> Cita</a>
        </td>
    </tr>
<?php
        endforeach;
    else:
?>
    <tr><td colspan="6">Cargando pacientes...</td></tr>
<?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav aria-label="Paginación de pacientes (abajo)">
                        <ul class="pagination justify-content-center" id="paginacionpacientesBottom"></ul>
                    </nav>

                    <div class="modal fade" id="registropacienteModal" tabindex="-1" aria-labelledby="registropacienteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registropacienteModalLabel">Añadir Nuevo paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formularioRegistropaciente" action="?pagina=pacientes" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="cedula" class="form-label">Cédula</label>
                                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="10">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="12">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Gmail</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        
                                            <div class="col-md-6">
                                                <label for="genero" class="form-label">Género</label>
                                                <select class="form-select" id="genero" name="genero">
                                                    <option value="">Seleccionar</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        
                                            <div class="col-md-6">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="pais" class="form-label">País</label>
                                                <input type="text" class="form-control" id="pais" name="pais">
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>

                                            <!-- Confirmar contraseña -->
                                            <div class="col-md-6">
                                                <label for="password2" class="form-label">Confirmar Contraseña</label>
                                                <input type="password" class="form-control" id="password2" name="password2" required>
                                            </div>
                                        </div>
                                        
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="guardara" value="guardara">Guardar paciente</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modificarpacienteModal" tabindex="-1" aria-labelledby="modificarpacienteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modificarpacienteModalLabel">Modificar paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formularioModificarpaciente" action="?pagina=pacientes" method="POST">
                                        <input type="hidden" id="modificar_id" name="id_paciente">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="modificar_nombre" name="nombre" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="modificar_apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_cedula" class="form-label">Cédula</label>
                                                <input type="text" class="form-control" id="modificar_cedula" name="cedula">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="modificar_telefono" name="telefono">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="modificar_fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_genero" class="form-label">Género</label>
                                                <select class="form-select" id="modificar_genero" name="genero">
                                                    <option value="">Seleccionar</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="modificar_direccion" name="direccion">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="modificar_ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="modificar_ciudad" name="ciudad">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="modificar_pais" class="form-label">País</label>
                                                <input type="text" class="form-control" id="modificar_pais" name="pais">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning" name="actualizar_paciente_submit">Guardar Cambios</button>
                                    </form>
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
       

    </body>
</html>