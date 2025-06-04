document.addEventListener('DOMContentLoaded', function() {
    // --- VARIABLES Y ELEMENTOS PRINCIPALES ---
    const buscarpacienteInput = document.getElementById('buscarpaciente');
    const tablapacientesBody = document.getElementById('tablapacientes');
    const paginacionpacientesTop = document.getElementById('paginacionpacientesTop');
    const paginacionpacientesBottom = document.getElementById('paginacionpacientesBottom');
    let pacientesData = [];
    const pacientesPorPagina = 15;
    let paginaActual = 1;

    // --- UTILIDADES DE VALIDACIÓN ---
    function mostrarError(input, mensaje) {
        let error = input.parentElement.querySelector('.invalid-feedback');
        if (!error) {
            error = document.createElement('div');
            error.className = 'invalid-feedback d-block';
            input.parentElement.appendChild(error);
        }
        error.textContent = mensaje;
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
    }

    function mostrarValido(input) {
        let error = input.parentElement.querySelector('.invalid-feedback');
        if (error) error.textContent = '';
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    // --- FUNCIONES PRINCIPALES DE PACIENTES ---
    function cargarpacientes(pagina = 1, filtro = '') {
        fetch('index.php?pagina=pacientes&ajax=1&filtro=' + encodeURIComponent(filtro))
            .then(response => response.json())
            .then(data => {
                pacientesData = data.pacientes || [];
                paginaActual = 1;
                aplicarFiltroYPaginacion();
            })
            .catch(error => {
                console.error('Error al cargar pacientes:', error);
                tablapacientesBody.innerHTML = '<tr><td colspan="6">Error al cargar los pacientes.</td></tr>';
                paginacionpacientesTop.innerHTML = '';
                paginacionpacientesBottom.innerHTML = '';
            });
    }

    function actualizarTabla(pacientes) {
        tablapacientesBody.innerHTML = '';
        if (pacientes.length > 0) {
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
            const filtro = buscarpacienteInput.value;
            tablapacientesBody.innerHTML = `<tr><td colspan="6">${filtro ? 'No se encontraron pacientes con ese filtro.' : 'No hay pacientes registrados.'}</td></tr>`;
        }
    }

    function generarPaginacion(totalpacientesFiltrados, pacientesPorPagina) {
        const totalPaginas = Math.ceil(totalpacientesFiltrados / pacientesPorPagina);
        paginacionpacientesTop.innerHTML = '';
        paginacionpacientesBottom.innerHTML = '';

        if (totalPaginas > 1) {
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

                const liClone = li.cloneNode(true);
                liClone.querySelector('a').addEventListener('click', handlePaginacionClick);

                paginacionpacientesTop.appendChild(li);
                paginacionpacientesBottom.appendChild(liClone);
            }
        }
    }

    function handlePaginacionClick(e) {
        e.preventDefault();
        const targetPage = parseInt(e.target.dataset.page);
        if (targetPage !== paginaActual) {
            paginaActual = targetPage;
            aplicarFiltroYPaginacion();
        }
    }

    function aplicarFiltroYPaginacion() {
        const filtro = buscarpacienteInput.value.toLowerCase();
        const pacientesFiltrados = pacientesData.filter(paciente =>
            paciente.nombre.toLowerCase().includes(filtro) ||
            paciente.apellido.toLowerCase().includes(filtro) ||
            (paciente.cedula && paciente.cedula.toLowerCase().includes(filtro)) ||
            (paciente.telefono && paciente.telefono.toLowerCase().includes(filtro))
        );

        const totalpacientesFiltrados = pacientesFiltrados.length;
        const inicio = (paginaActual - 1) * pacientesPorPagina;
        const fin = inicio + pacientesPorPagina;
        const pacientesPagina = pacientesFiltrados.slice(inicio, fin);

        actualizarTabla(pacientesPagina);
        generarPaginacion(totalpacientesFiltrados, pacientesPorPagina);
    }

    // --- EVENTOS PRINCIPALES ---
    cargarpacientes();

    buscarpacienteInput.addEventListener('input', function() {
        paginaActual = 1;
        aplicarFiltroYPaginacion();
    });

    // --- MODIFICAR PACIENTE: CARGA DATOS AL MODAL Y LIMPIA VALIDACIÓN ---
    let valoresOriginales = {};
    const modificarpacienteModal = document.getElementById('modificarpacienteModal');
    if (modificarpacienteModal) {
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
            // Limpia validación al abrir modal
            [
                'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
                'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
            ].forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.classList.remove('is-valid', 'is-invalid');
                    input.dataset.touched = "";
                    let error = input.parentElement.querySelector('.invalid-feedback');
                    if (error) error.textContent = '';
                }
            });
        });
    }

    // --- VALIDACIONES EN TIEMPO REAL PARA MODIFICAR PACIENTE ---
    [
        'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
        'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
    ].forEach(id => {
        const input = document.getElementById(id);
        if (!input) return;
        input.addEventListener('input', function() {
            input.dataset.touched = "true";
            if (id === 'modificar_nombre' || id === 'modificar_apellido' || id === 'modificar_direccion' || id === 'modificar_ciudad' || id === 'modificar_pais') {
                let val = input.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]/g, '');
                if (val.length > 0) val = val.charAt(0).toUpperCase() + val.slice(1);
                input.value = val;
                if (!/^[A-Z][a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]*$/.test(val)) {
                    mostrarError(input, 'Solo letras, primera letra mayúscula.');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'modificar_cedula') {
                input.value = input.value.replace(/\D/g, '').slice(0, 10);
                if (!/^\d{6,10}$/.test(input.value)) {
                    mostrarError(input, 'Solo números (6-10 dígitos).');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'modificar_telefono') {
                input.value = input.value.replace(/\D/g, '').slice(0, 12);
                if (!/^\d{7,12}$/.test(input.value)) {
                    mostrarError(input, 'Solo números (7-12 dígitos).');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'modificar_fecha_nacimiento') {
                input.setAttribute('max', '2011-12-31');
                if (!input.value) {
                    mostrarError(input, 'Seleccione una fecha.');
                } else if (input.value > '2011-12-31') {
                    mostrarError(input, 'Debe ser 2011 o antes.');
                } else {
                    mostrarValido(input);
                }
            }
        });
        if (id === 'modificar_fecha_nacimiento') {
            input.addEventListener('change', function() {
                input.dataset.touched = "true";
            });
        }
    });

    // --- VALIDACIÓN AL ENVIAR FORMULARIO DE MODIFICAR PACIENTE ---

    const formModificar = document.getElementById('formularioModificarpaciente');
    if (formModificar) {
        formModificar.addEventListener('submit', function(e) {
            let valido = true;
            [
                'modificar_nombre','modificar_apellido','modificar_cedula','modificar_telefono',
                'modificar_fecha_nacimiento','modificar_direccion','modificar_ciudad','modificar_pais'
            ].forEach(id => {
                const input = document.getElementById(id);
                if (input && input.dataset.touched === "true") {
                    if (!input.classList.contains('is-valid')) {
                        mostrarError(input, 'Corrija este campo.');
                        valido = false;
                    }
                }
            });
            if (!valido) e.preventDefault();
        });
    }
    

    // --- VALIDACIONES EN TIEMPO REAL PARA AÑADIR PACIENTE ---
    [
        'nombre','apellido','cedula','telefono',
        'fecha_nacimiento','direccion','ciudad','pais'
    ].forEach(id => {
        const input = document.getElementById(id);
        if (!input) return;
        input.addEventListener('input', function() {
            input.dataset.touched = "true";
            if (id === 'nombre' || id === 'apellido' || id === 'direccion' || id === 'ciudad' || id === 'pais') {
                let val = input.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]/g, '');
                if (val.length > 0) val = val.charAt(0).toUpperCase() + val.slice(1);
                input.value = val;
                if (!/^[A-Z][a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]*$/.test(val)) {
                    mostrarError(input, 'Solo letras, primera letra mayúscula.');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'cedula') {
                input.value = input.value.replace(/\D/g, '').slice(0, 10);
                if (!/^\d{6,10}$/.test(input.value)) {
                    mostrarError(input, 'Solo números (6-10 dígitos).');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'telefono') {
                input.value = input.value.replace(/\D/g, '').slice(0, 12);
                if (!/^\d{7,12}$/.test(input.value)) {
                    mostrarError(input, 'Solo números (7-12 dígitos).');
                } else {
                    mostrarValido(input);
                }
            }
            if (id === 'fecha_nacimiento') {
                input.setAttribute('max', '2011-12-31');
                if (!input.value) {
                    mostrarError(input, 'Seleccione una fecha.');
                } else if (input.value > '2011-12-31') {
                    mostrarError(input, 'Debe ser 2011 o antes.');
                } else {
                    mostrarValido(input);
                }
            }
        });
        if (id === 'fecha_nacimiento') {
            input.addEventListener('change', function() {
                input.dataset.touched = "true";
            });
        }
    });

    // --- VALIDACIÓN AL ENVIAR FORMULARIO DE AÑADIR PACIENTE ---
    const formAñadir = document.getElementById('formularioRegistropaciente');
    if (formAñadir) {
        formAñadir.addEventListener('submit', function(e) {
            let valido = true;
            [
                'nombre','apellido','cedula','telefono',
                'fecha_nacimiento','direccion','ciudad','pais'
            ].forEach(id => {
                const input = document.getElementById(id);
                if (input && !input.classList.contains('is-valid')) {
                    mostrarError(input, 'Corrija este campo.');
                    valido = false;
                }
            });
            if (!valido) e.preventDefault();
        });
    }
});