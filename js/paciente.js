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
                // Guarda los valores originales al abrir el modal
let valoresOriginales = {};
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
        // Guarda los valores originales
        valoresOriginales = {
            modificar_nombre: paciente.nombre,
            modificar_apellido: paciente.apellido,
            modificar_cedula: paciente.cedula || '',
            modificar_telefono: paciente.telefono || '',
            modificar_fecha_nacimiento: paciente.fecha_nacimiento || '',
            modificar_direccion: paciente.direccion || '',
            modificar_ciudad: paciente.ciudad || '',
            modificar_pais: paciente.pais || ''
        };
    }
});
            });
        
// VALIDACIONES EN TIEMPO REAL PARA MODIFICAR PACIENTE 

    document.addEventListener('DOMContentLoaded', function() {
        // --- UTILIDADES DE VALIDACIÓN ---
        // Función para mostrar un mensaje de error debajo del input
function mostrarError(input, mensaje) {
    // Busca si ya existe un div de error en el padre del input
    let error = input.parentElement.querySelector('.invalid-feedback');
    // Si no existe, lo crea y lo agrega
    if (!error) {
        error = document.createElement('div');
        error.className = 'invalid-feedback d-block';
        input.parentElement.appendChild(error);
    }
    // Coloca el mensaje y aplica la clase de error visual
    error.textContent = mensaje;
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
}

// Función para marcar el input como válido y limpiar el mensaje de error
function mostrarValido(input) {
    let error = input.parentElement.querySelector('.invalid-feedback');
    if (error) error.textContent = '';
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
}

// --- VALIDACIONES EN TIEMPO REAL PARA MODIFICAR PACIENTE ---

// Lista de IDs de los campos del formulario de modificar paciente
[
    'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
    'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
].forEach(id => {
    const input = document.getElementById(id);
    if (!input) return; // Si el input no existe, lo ignora

    // Cada vez que el usuario escribe o cambia el valor, se ejecuta esta función
    input.addEventListener('input', function() {
        input.dataset.touched = "true"; // Marca el campo como "tocado" (editado por el usuario)

        // Validación para campos de texto (nombre, apellido, dirección, ciudad, país)
        if (id === 'modificar_nombre' || id === 'modificar_apellido' || id === 'modificar_direccion' || id === 'modificar_ciudad' || id === 'modificar_pais') {
            // Solo permite letras y espacios, y pone la primera letra en mayúscula
            let val = input.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]/g, '');
            if (val.length > 0) val = val.charAt(0).toUpperCase() + val.slice(1);
            input.value = val;
            // Si no cumple el formato, muestra error
            if (!/^[A-Z][a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]*$/.test(val)) {
                mostrarError(input, 'Solo letras, primera letra mayúscula.');
            } else {
                mostrarValido(input);
            }
        }

        // Validación para cédula (solo números, entre 6 y 10 dígitos)
        if (id === 'modificar_cedula') {
            input.value = input.value.replace(/\D/g, '').slice(0, 10); // Solo números y máximo 10 dígitos
            if (!/^\d{6,10}$/.test(input.value)) {
                mostrarError(input, 'Solo números (6-10 dígitos).');
            } else {
                mostrarValido(input);
            }
        }

        // Validación para teléfono (solo números, entre 7 y 12 dígitos)
        if (id === 'modificar_telefono') {
            input.value = input.value.replace(/\D/g, '').slice(0, 12); // Solo números y máximo 12 dígitos
            if (!/^\d{7,12}$/.test(input.value)) {
                mostrarError(input, 'Solo números (7-12 dígitos).');
            } else {
                mostrarValido(input);
            }
        }

        // Validación para fecha de nacimiento (no mayor a 2011-12-31)
        if (id === 'modificar_fecha_nacimiento') {
            input.setAttribute('max', '2011-12-31'); // Limita la fecha máxima seleccionable
            if (!input.value) {
                mostrarError(input, 'Seleccione una fecha.');
            } else if (input.value > '2011-12-31') {
                mostrarError(input, 'Debe ser 2011 o antes.');
            } else {
                mostrarValido(input);
            }
        }
    });

    // Para el campo de fecha, también marca como tocado si el usuario cambia la fecha con el selector
    if (id === 'modificar_fecha_nacimiento') {
        input.addEventListener('change', function() {
            input.dataset.touched = "true";
        });
    }
});

// --- VALIDACIÓN AL ENVIAR FORMULARIO DE MODIFICAR PACIENTE ---

// Obtiene el formulario de modificar paciente
const formModificar = document.getElementById('formularioModificarpaciente');
if (formModificar) {
    // Cuando el usuario intenta enviar el formulario...
    formModificar.addEventListener('submit', function(e) {
        let valido = true; // Bandera para saber si todo está correcto

        // Recorre todos los campos relevantes
        [
            'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
            'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
        ].forEach(id => {
            const input = document.getElementById(id);
            // Solo valida los campos que el usuario haya tocado (editado)
            if (input && input.dataset.touched === "true") {
                // Si el campo no es válido, muestra error y marca el formulario como no válido
                if (!input.classList.contains('is-valid')) {
                    mostrarError(input, 'Corrija este campo.');
                    valido = false;
                }
            }
        });

        // Si algún campo tocado no es válido, evita que se envíe el formulario
        if (!valido) e.preventDefault();
    });
}

// --- LIMPIA VALIDACIÓN AL ABRIR EL MODAL DE MODIFICAR PACIENTE ---

    // Obtiene el modal de modificar paciente
    const modificarpacienteModal = document.getElementById('modificarpacienteModal');
    if (modificarpacienteModal) {
        // Cuando se abre el modal...
        modificarpacienteModal.addEventListener('show.bs.modal', function () {
            [
                'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
                'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
            ].forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    // Quita las clases de validación y el atributo de "tocado"
                    input.classList.remove('is-valid', 'is-invalid');
                    input.dataset.touched = "";
                    // Limpia cualquier mensaje de error que haya quedado
                    let error = input.parentElement.querySelector('.invalid-feedback');
                    if (error) error.textContent = '';
                }
            });
        });
    }
});