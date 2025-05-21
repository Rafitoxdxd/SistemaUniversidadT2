<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <div class="container mt-4">
    
        <h2>Pacientes</h2>
    <div class="d-flex justify-content-end mb-3">
        
    
        
    </div>

    <div class="input-group mb-2">
        <input type="text" id="buscarPaciente" class="form-control" placeholder="Buscar pacientes..." >
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroPacienteModal">
            <i class="bi bi-plus-circle me-2"></i> Añadir paciente
        </button>
    </div>

    <h5 class="mb-3">Todos los pacientes</h5>

    <nav aria-label="Paginación de pacientes (arriba)">
            <ul class="pagination justify-content-center" id="paginacionPacientesTop">
                <!-- El contenido se generará con JavaScript -->
            </ul>
        </nav>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaPacientes">
        <?php
            // Verificar si hay productos antes de iterar
            if (isset($pacientes) && !empty($pacientes)):
                foreach ($pacientes as $paciente): // Usar $persona para claridad
            ?>
                <tr>
                    <td><?= htmlspecialchars($paciente['id']) ?></td>
                    <td><?= htmlspecialchars($paciente['nombre']) ?></td>
                    <td><?= htmlspecialchars($paciente['apellido']) ?></td>
                    <td><?= htmlspecialchars($paciente['cedula']) ?></td>
                    <td><?= htmlspecialchars($paciente['telefono']) ?></td>
                    
                    <td>
                        <a href="index.php?accion=editar&id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?accion=eliminar&id=<?= htmlspecialchars($paciente['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este paciente?');">Eliminar</a>
                        <!-- Botón para abrir el modal (CORREGIDO para Bootstrap 5) -->
                        <button type="button" class="btn btn-info btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modalConsulta">
                            Consultar 
                        </button>
                    </td>
                </tr>
            <?php
                endforeach;
            else: // Si no hay productos
            ?>
            <tr><td colspan="6">Cargando pacientes...</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <nav aria-label="Paginación de pacientes (abajo)">
            <ul class="pagination justify-content-center" id="paginacionPacientesBottom">
                <!-- El contenido se generará con JavaScript -->
            </ul>
        </nav>

    <div class="modal fade" id="registroPacienteModal" tabindex="-1" aria-labelledby="registroPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroPacienteModalLabel">Añadir Nuevo Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioRegistroPaciente" action="index.php?accion=guardarNuevoPaciente" method="POST">
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
            
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="guardara" value="guardara">Guardar Paciente</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modificarPacienteModal" tabindex="-1" aria-labelledby="modificarPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarPacienteModalLabel">Modificar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioModificarPaciente" action="index.php?accion=actualizarPaciente" method="POST">
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
                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buscarPacienteInput = document.getElementById('buscarPaciente');
        const tablaPacientesBody = document.getElementById('tablaPacientes');
        // --- OBTENER AMBAS LISTAS DE PAGINACIÓN ---
        const paginacionPacientesTop = document.getElementById('paginacionPacientesTop');
        const paginacionPacientesBottom = document.getElementById('paginacionPacientesBottom');
        // --- FIN OBTENER AMBAS LISTAS ---
        let pacientesData = [];
        const pacientesPorPagina = 15; // O el número que prefieras
        let paginaActual = 1;

        function cargarPacientes(pagina = 1, filtro = '') {
            // Ajusta la URL si tu backend soporta paginación y filtro
            // Por ahora, asumimos que listarPacientesAjax devuelve *todos* los pacientes
            // y la paginación/filtrado se hace en el frontend (como está implementado ahora)
            fetch(`index.php?accion=listarPacientesAjax&filtro=${filtro}`) // Quitamos pagina de la URL si el backend no la usa
                .then(response => response.json())
                .then(data => {
                    pacientesData = data.pacientes || []; // Asegurar que sea un array
                    paginaActual = 1; // Resetear a página 1 al cargar/filtrar
                    aplicarFiltroYPaginacion(); // Llama a la función que actualiza tabla y paginación
                })
                .catch(error => {
                    console.error('Error al cargar pacientes:', error);
                    tablaPacientesBody.innerHTML = '<tr><td colspan="6">Error al cargar los pacientes.</td></tr>';
                    paginacionPacientesTop.innerHTML = ''; // Limpiar paginación en error
                    paginacionPacientesBottom.innerHTML = ''; // Limpiar paginación en error
                });
        }

        // Función para actualizar la tabla (sin cambios, excepto la llamada a confirm en Eliminar)
        function actualizarTabla(pacientes) {
            tablaPacientesBody.innerHTML = '';
            if (pacientes.length > 0) {
                pacientes.forEach(paciente => {
                    const row = tablaPacientesBody.insertRow();
                    row.insertCell().textContent = paciente.id;
                    row.insertCell().textContent = paciente.nombre;
                    row.insertCell().textContent = paciente.apellido;
                    row.insertCell().textContent = paciente.cedula || '-';
                    row.insertCell().textContent = paciente.telefono || '-';
                    const accionesCell = row.insertCell();
                    accionesCell.innerHTML = `
                        <button class="btn btn-sm btn-warning btn-editar-paciente" data-bs-toggle="modal" data-bs-target="#modificarPacienteModal" data-id="${paciente.id}">Editar</button>
                        <a href="index.php?accion=eliminarPaciente&id=${paciente.id}"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Desea eliminar este paciente?');">Eliminar</a>
                        <a href="index.php?accion=verHistorial&paciente_id=${paciente.id}" class="btn btn-sm btn-info">Historial</a>
                        <a href="index.php?accion=agendarCita&paciente_id=${paciente.id}" class="btn btn-sm btn-success">Cita</a>
                    `;
                });
            } else {
                const filtro = buscarPacienteInput.value;
                tablaPacientesBody.innerHTML = `<tr><td colspan="6">${filtro ? 'No se encontraron pacientes con ese filtro.' : 'No hay pacientes registrados.'}</td></tr>`;
            }
        }

        // --- FUNCIÓN MODIFICADA PARA GENERAR AMBAS PAGINACIONES ---
        function generarPaginacion(totalPacientesFiltrados, pacientesPorPagina) {
            const totalPaginas = Math.ceil(totalPacientesFiltrados / pacientesPorPagina);
            // Limpiar ambas listas
            paginacionPacientesTop.innerHTML = '';
            paginacionPacientesBottom.innerHTML = '';

            if (totalPaginas > 1) {
                for (let i = 1; i <= totalPaginas; i++) {
                    // Crear el elemento LI una vez
                    const li = document.createElement('li');
                    li.classList.add('page-item');
                    if (i === paginaActual) {
                        li.classList.add('active');
                    }

                    // Crear el enlace A una vez
                    const a = document.createElement('a');
                    a.classList.add('page-link');
                    a.href = '#';
                    a.textContent = i;
                    a.dataset.page = i; // Guardar número de página para el listener

                    // Añadir listener al enlace A
                    a.addEventListener('click', handlePaginacionClick);

                    // Añadir el enlace A al LI
                    li.appendChild(a);

                    // Clonar el LI completo (con el enlace y listener ya dentro) para la segunda paginación
                    const liClone = li.cloneNode(true);
                    // El listener se clona, pero es mejor re-asignarlo o usar delegación de eventos
                    // Re-asignamos el listener al clon para asegurar que funciona
                    liClone.querySelector('a').addEventListener('click', handlePaginacionClick);


                    // Añadir el LI original a la paginación superior
                    paginacionPacientesTop.appendChild(li);
                    // Añadir el LI clonado a la paginación inferior
                    paginacionPacientesBottom.appendChild(liClone);
                }
            }
        }

        // --- NUEVA FUNCIÓN PARA MANEJAR CLICS EN PAGINACIÓN ---
        function handlePaginacionClick(e) {
            e.preventDefault();
            const targetPage = parseInt(e.target.dataset.page);
            if (targetPage !== paginaActual) {
                paginaActual = targetPage;
                aplicarFiltroYPaginacion(); // Re-calcula qué mostrar y actualiza paginación
            }
        }

        // --- NUEVA FUNCIÓN PARA CENTRALIZAR FILTRADO Y PAGINACIÓN ---
        function aplicarFiltroYPaginacion() {
            const filtro = buscarPacienteInput.value.toLowerCase();
            const pacientesFiltrados = pacientesData.filter(paciente =>
                paciente.nombre.toLowerCase().includes(filtro) ||
                paciente.apellido.toLowerCase().includes(filtro) ||
                (paciente.cedula && paciente.cedula.toLowerCase().includes(filtro)) ||
                (paciente.telefono && paciente.telefono.toLowerCase().includes(filtro)) // Añadido teléfono al filtro
                // (paciente.email && paciente.email.toLowerCase().includes(filtro)) // Puedes añadir email si lo deseas
            );

            const totalPacientesFiltrados = pacientesFiltrados.length;
            const inicio = (paginaActual - 1) * pacientesPorPagina;
            const fin = inicio + pacientesPorPagina;
            const pacientesPagina = pacientesFiltrados.slice(inicio, fin);

            actualizarTabla(pacientesPagina);
            generarPaginacion(totalPacientesFiltrados, pacientesPorPagina);
        }


        // Cargar los pacientes iniciales
        cargarPacientes();

        // Evento para la búsqueda en tiempo real
        buscarPacienteInput.addEventListener('input', function() {
            paginaActual = 1; // Resetear la página al buscar
            aplicarFiltroYPaginacion(); // Aplica filtro y actualiza tabla/paginación
        });

        // Evento para cargar los detalles del paciente en el modal de modificación (sin cambios)
        const modificarPacienteModal = document.getElementById('modificarPacienteModal');
        modificarPacienteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const pacienteId = button.getAttribute('data-id');
            // Busca en pacientesData que tiene *todos* los pacientes
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
                // No se suelen precargar email/password en modificar a menos que se muestren
            }
        });
    });
</script>

    </body>
</html>