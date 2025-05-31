<!doctype html>
<html lang="es">
    <head>
        <title>pacientes</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <style>
            :root {
                --color1: #DBE1F0;
                --color2: #A7D0D8;
                --color3: #ABCDDD;
                --color4: #E0C323;
                --color5: #75A5B8;
            }
            body {
                font-family: 'Quicksand', 'Segoe UI', Arial, sans-serif;
                background: linear-gradient(135deg, var(--color1) 0%, var(--color2) 40%, var(--color3) 100%);
                min-height: 100vh;
            }
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1000;
                width: 17%;
                background: linear-gradient(180deg, var(--color1) -10%, var(--color5) 100%);
                box-shadow: 8px 0 20px rgba(117,165,184,0.13);
                padding-top: 8px;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                overflow: hidden;
            }
            .sidebar-sticky {
                padding: 0;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .sidebar .nav-link {
                color: #507685;
                font-size: 1rem;
                font-weight: 700;
                padding: 10px 18px;
                margin: 6px 7px;
                border-radius: 16px;
                transition: background 0.2s, color 0.2s, transform 0.15s;
                display: flex;
                align-items: center;
                gap: 8px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .sidebar .nav-link:hover {
                background: var(--color3);
                color: #222;
                transform: translateX(6px) scale(1.04);
                box-shadow: 0 4px 12px rgba(171,205,221,0.18);
            }
            .sidebar .nav-link.active,
            .sidebar .nav-link[aria-current="page"] {
                background: linear-gradient(90deg, var(--color5), var(--color3));
                color: #fff;
                font-weight: bold;
                box-shadow: 0 6px 16px rgba(224,195,35,0.13);
                border: 1.5px solid var(--color5);
                transform: scale(1.05);
            }
            .sidebar .nav-item.mt-auto .nav-link {
                background: linear-gradient(90deg,rgb(206, 62, 77), #c8232e);
                color: #fff;
                font-weight: 700;
            }
            .sidebar .nav-item.mt-auto .nav-link:hover {
                background: linear-gradient(90deg, #c8232e, #dc3545);
                color: #fff;
            }
            .main-content {
                margin-left: 17%;
                padding: 2.5rem 2rem;
                background: #fff;
                border-radius: 24px;
                box-shadow: 0 8px 32px rgba(117,165,184,0.10);
                min-height: 100vh;
                margin-top: 2.5rem;
                margin-bottom: 2.5rem;
            }
            .profile-icon-container {
                position: absolute;
                top: 18px;
                right: 32px;
                z-index: 10;
            }
            .profile-icon-container a {
                display: block;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                overflow: hidden;
                background-color: var(--color1);
                border: 2px solid var(--color5);
                box-shadow: 0 2px 5px rgba(0,0,0,0.15);
                transition: transform 0.2s;
            }
            .profile-icon-container a:hover {
                transform: scale(1.07);
                box-shadow: 0 4px 8px rgba(0,0,0,0.22);
            }
            .profile-icon-link {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--color1);
    border: 2px solid var(--color5);
    box-shadow: 0 2px 5px rgba(0,0,0,0.10);
    transition: transform 0.2s, box-shadow 0.2s;
    margin-right: 8px;
}
.profile-icon-link:hover {
    transform: scale(1.08);
    box-shadow: 0 4px 12px rgba(117,165,184,0.18);
    background: var(--color3);
}
.main-content {
    margin-left: 17%;
    padding: 2.5rem 2rem;
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(117,165,184,0.10);
    min-height: 100vh;
    margin-top: 2.5rem;
    margin-bottom: 2.5rem;
}
@media (max-width: 991.98px) {
    .main-content {
        margin-left: 0;
        padding: 1rem 0.2rem;
    }
}
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
        
        </div>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block sidebar">
                    <div class="sidebar-sticky">
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
                                        <td><?= htmlspecialchars($paciente['id']) ?></td>
                                        <td><?= htmlspecialchars($paciente['nombre']) ?></td>
                                        <td><?= htmlspecialchars($paciente['apellido']) ?></td>
                                        <td><?= htmlspecialchars($paciente['cedula']) ?></td>
                                        <td><?= htmlspecialchars($paciente['telefono']) ?></td>
                                        <td>
                                            <button class="btn btn-accion btn-editar btn-sm" data-bs-toggle="modal" data-bs-target="#modificarpacienteModal" data-id="<?= htmlspecialchars($paciente['id']) ?>"><i class="bi bi-pencil"></i> Editar</button>
                                            <a class="btn btn-accion btn-eliminar btn-sm" href="index.php?accion=eliminarpaciente&id=<?= htmlspecialchars($paciente['id']) ?>"
                                            onclick="return confirm('¿Desea eliminar este paciente?');"><i class="bi bi-trash"></i> Eliminar</a>
                                            <a href="index.php?accion=verHistorial&paciente_id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-accion btn-historial btn-sm"><i class="bi bi-journal-text"></i> Historial</a>
                                            <a href="index.php?accion=agendarCita&paciente_id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-accion btn-cita btn-sm"><i class="bi bi-calendar-plus"></i> Cita</a>
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
                                                <input type="text" class="form-control" id="cedula" name="cedula">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Gmail</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="genero" class="form-label">Género</label>
                                                <select class="form-select" id="genero" name="genero">
                                                    <option value="">Seleccionar</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="pais" class="form-label">País</label>
                                                <input type="text" class="form-control" id="pais" name="pais">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="guardara" value="guardara">Guardar paciente</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
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
                                        <input type="hidden" id="modificar_id" name="id">
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buscarpacienteInput = document.getElementById('buscarpaciente');
                const tablapacientesBody = document.getElementById('tablapacientes');
                // --- OBTENER AMBAS LISTAS DE PAGINACIÓN ---
                const paginacionpacientesTop = document.getElementById('paginacionpacientesTop');
                const paginacionpacientesBottom = document.getElementById('paginacionpacientesBottom');
                // --- FIN OBTENER AMBAS LISTAS ---
                let pacientesData = [];
                const pacientesPorPagina = 15; // O el número que prefieras
                let paginaActual = 1;

                // --- Función principal para cargar pacientes desde el backend (AJAX) ---
                function cargarpacientes(pagina = 1, filtro = '') {
                    // Hacemos una petición fetch al backend, pasando el filtro si existe
                    fetch('index.php?pagina=pacientes&ajax=1&filtro=' + encodeURIComponent(filtro))
                        .then(response => response.json())
                        .then(data => {
                            // Guardamos los pacientes recibidos en la variable global
                            pacientesData = data.pacientes || [];
                            // Siempre que se cargan pacientes, volvemos a la página 1
                            paginaActual = 1;
                            // Aplicamos el filtro y la paginación para mostrar los datos
                            aplicarFiltroYPaginacion();
                        })
                        .catch(error => {
                            // Si hay un error, mostramos un mensaje en la tabla y limpiamos la paginación
                            console.error('Error al cargar pacientes:', error);
                            tablapacientesBody.innerHTML = '<tr><td colspan="6">Error al cargar los pacientes.</td></tr>';
                            paginacionpacientesTop.innerHTML = '';
                            paginacionpacientesBottom.innerHTML = '';
                        });
                }

                // --- Función para actualizar la tabla con los pacientes de la página actual ---
                function actualizarTabla(pacientes) {
                    tablapacientesBody.innerHTML = '';
                    if (pacientes.length > 0) {
                        // Por cada paciente, agregamos una fila a la tabla con sus datos y botones de acción
                        pacientes.forEach(paciente => {
                            const row = tablapacientesBody.insertRow();
                            row.insertCell().textContent = paciente.id;
                            row.insertCell().textContent = paciente.nombre;
                            row.insertCell().textContent = paciente.apellido;
                            row.insertCell().textContent = paciente.cedula || '-';
                            row.insertCell().textContent = paciente.telefono || '-';
                            const accionesCell = row.insertCell();
                            accionesCell.innerHTML = `
                                <button class="btn btn-accion btn-editar btn-sm" data-bs-toggle="modal" data-bs-target="#modificarpacienteModal" data-id="${paciente.id}"><i class="bi bi-pencil"></i> Editar</button>
                                <a class="btn btn-accion btn-eliminar btn-sm" href="index.php?accion=eliminarpaciente&id=${paciente.id}"
                                onclick="return confirm('¿Desea eliminar este paciente?');"><i class="bi bi-trash"></i> Eliminar</a>
                                <a href="index.php?accion=verHistorial&paciente_id=${paciente.id}" class="btn btn-accion btn-historial btn-sm"><i class="bi bi-journal-text"></i> Historial</a>
                                <a href="index.php?accion=agendarCita&paciente_id=${paciente.id}" class="btn btn-accion btn-cita btn-sm"><i class="bi bi-calendar-plus"></i> Cita</a>
                            `;
                        });
                    } else {
                        // Si no hay pacientes, mostramos un mensaje acorde al filtro
                        const filtro = buscarpacienteInput.value;
                        tablapacientesBody.innerHTML = `<tr><td colspan="6">${filtro ? 'No se encontraron pacientes con ese filtro.' : 'No hay pacientes registrados.'}</td></tr>`;
                    }
                }

                // --- Función para generar la paginación tanto arriba como abajo de la tabla ---
                function generarPaginacion(totalpacientesFiltrados, pacientesPorPagina) {
                    const totalPaginas = Math.ceil(totalpacientesFiltrados / pacientesPorPagina);
                    // Limpiamos ambas listas de paginación
                    paginacionpacientesTop.innerHTML = '';
                    paginacionpacientesBottom.innerHTML = '';

                    if (totalPaginas > 1) {
                        // Creamos los botones de página para ambas paginaciones
                        for (let i = 1; i <= totalPaginas; i++) {
                            const li = document.createElement('li');
                            li.classList.add('page-item');
                            if (i === paginaActual) {
                                li.classList.add('active');
                            }
                            const a = document.createElement('a');
                            a.classList.add('page-link');
                            a.href = '#';
                            a.textContent = i;
                            a.dataset.page = i;
                            a.addEventListener('click', handlePaginacionClick);
                            li.appendChild(a);

                            // Clonamos el elemento para la paginación inferior
                            const liClone = li.cloneNode(true);
                            liClone.querySelector('a').addEventListener('click', handlePaginacionClick);

                            paginacionpacientesTop.appendChild(li);
                            paginacionpacientesBottom.appendChild(liClone);
                        }
                    }
                }

                // --- Función que maneja el clic en los botones de paginación ---
                function handlePaginacionClick(e) {
                    e.preventDefault();
                    const targetPage = parseInt(e.target.dataset.page);
                    if (targetPage !== paginaActual) {
                        paginaActual = targetPage;
                        aplicarFiltroYPaginacion();
                    }
                }

                // --- Función central que aplica el filtro de búsqueda y la paginación ---
                function aplicarFiltroYPaginacion() {
                    // Tomamos el filtro del input y filtramos los pacientes
                    const filtro = buscarpacienteInput.value.toLowerCase();
                    const pacientesFiltrados = pacientesData.filter(paciente =>
                        paciente.nombre.toLowerCase().includes(filtro) ||
                        paciente.apellido.toLowerCase().includes(filtro) ||
                        (paciente.cedula && paciente.cedula.toLowerCase().includes(filtro)) ||
                        (paciente.telefono && paciente.telefono.toLowerCase().includes(filtro))
                    );

                    // Calculamos el rango de pacientes a mostrar en la página actual
                    const totalpacientesFiltrados = pacientesFiltrados.length;
                    const inicio = (paginaActual - 1) * pacientesPorPagina;
                    const fin = inicio + pacientesPorPagina;
                    const pacientesPagina = pacientesFiltrados.slice(inicio, fin);

                    // Actualizamos la tabla y la paginación
                    actualizarTabla(pacientesPagina);
                    generarPaginacion(totalpacientesFiltrados, pacientesPorPagina);
                }

                // --- Inicialización al cargar la página ---
                cargarpacientes();

                // --- Evento para búsqueda en tiempo real ---
                buscarpacienteInput.addEventListener('input', function() {
                    paginaActual = 1; // Volvemos a la primera página al buscar
                    aplicarFiltroYPaginacion();
                });

                // --- Evento para cargar los datos del paciente en el modal de modificación ---
                const modificarpacienteModal = document.getElementById('modificarpacienteModal');
                modificarpacienteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const pacienteId = button.getAttribute('data-id');
                    const paciente = pacientesData.find(p => p.id === parseInt(pacienteId));
                    if (paciente) {
                        document.getElementById('modificar_id').value = paciente.id;
                        document.getElementById('modificar_nombre').value = paciente.nombre;
                        document.getElementById('modificar_apellido').value = paciente.apellido;
                        document.getElementById('modificar_cedula').value = paciente.cedula || '';
                        document.getElementById('modificar_telefono').value = paciente.telefono || '';
                        document.getElementById('modificar_fecha_nacimiento').value = paciente.fecha_nacimiento || '';
                        document.getElementById('modificar_genero').value = paciente.genero || '';
                        document.getElementById('modificar_direccion').value = paciente.direccion || '';
                        document.getElementById('modificar_ciudad').value = paciente.ciudad || '';
                        document.getElementById('modificar_pais').value = paciente.pais || '';
                    }
                });
            });
        </script>
    </body>
</html>