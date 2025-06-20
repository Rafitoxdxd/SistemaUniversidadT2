$(document).ready(function() {
    // Variables globales
    let pacienteSeleccionado = null;
    let testSeleccionado = null;
    let pacientesCache = {};

    // Cargar todos los tests al iniciar
    cargarTests('');

    // Cargar pacientes en caché para obtener nombres rápidamente
    function cargarPacientesCache() {
        $.ajax({
            url: '',
            type: 'POST',
            data: { ajax_action: 'obtenerPacientes' },
            success: function(response) {
                if (response.success) {
                    response.data.forEach(function(p) {
                        pacientesCache[p.id_paciente] = p.apellido + ', ' + p.nombre;
                    });
                }
            }
        });
    }
    cargarPacientesCache();

    // Cargar tests cuando se selecciona un paciente
    $('#selectPaciente').change(function() {
        pacienteSeleccionado = $(this).val();
        // Si el select está vacío, mostrar todos los tests
        if (!pacienteSeleccionado) {
            cargarTests('');
        } else {
            cargarTests(pacienteSeleccionado);
        }
    });

    // Filtrar tests por tipo
    $('#filtroTest').change(function() {
        cargarTests(pacienteSeleccionado);
    });

    // Cargar formulario cuando se selecciona tipo de test
    $('#nuevoTestTipo').change(function() {
        const tipo = $(this).val();
        if (tipo) {
            cargarFormularioTest(tipo, 'nuevo');
        } else {
            $('#formularioTestContainer').html('');
        }
    });

    // Manejar envío de nuevo test
    $('#formNuevoTest').submit(function(e) {
        e.preventDefault();
        guardarTest('nuevo');
    });

    // Manejar envío de test editado
    $('#formEditarTest').submit(function(e) {
        e.preventDefault();
        guardarTest('editar');
    });

    // Función para cargar los tests de un paciente o todos
    function cargarTests(idPaciente) {
        // Destruir DataTable antes de recargar datos para evitar errores de reinicialización
        if ($.fn.DataTable.isDataTable('.table')) {
            $('.table').DataTable().destroy();
        }
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                ajax_action: 'obtenerTests',
                id_paciente: idPaciente
            },
            success: function(response) {
                if (response.success) {
                    mostrarTests(response.data);
                } else {
                    mostrarError('Error al cargar tests');
                }
            },
            error: function() {
                mostrarError('Error de conexión');
            }
        });
    }

    // Función para mostrar los tests en la tabla con DataTable
    function mostrarTests(tests) {
        // Elimina el filtrado por tipo y paciente
        let html = '';
        let contador = 1;

        function obtenerNombrePaciente(idPaciente) {
            if (pacientesCache[idPaciente]) return pacientesCache[idPaciente];
            // Buscar en todos los tests por idPaciente y usar nombre_paciente si está disponible
            for (const tipo of ['poms', 'confianza', 'importancia']) {
                if (tests[tipo] && Array.isArray(tests[tipo])) {
                    const encontrado = tests[tipo].find(t => t.id_paciente == idPaciente && t.nombre_paciente);
                    if (encontrado) {
                        return encontrado.nombre_paciente;
                    }
                }
            }
            // Si no se encuentra, retorna vacío
            return '';
        }

        // Mostrar todos los tests de todos los tipos
        if (tests.poms && tests.poms.length > 0) {
            tests.poms.forEach(test => {
                html += crearFilaTest(contador++, test.id_paciente, 'POMS', test.fecha, test.id, 'poms', obtenerNombrePaciente(test.id_paciente));
            });
        }
        if (tests.confianza && tests.confianza.length > 0) {
            tests.confianza.forEach(test => {
                html += crearFilaTest(contador++, test.id_paciente, 'Confianza', test.fecha, test.id, 'confianza', obtenerNombrePaciente(test.id_paciente));
            });
        }
        if (tests.importancia && tests.importancia.length > 0) {
            tests.importancia.forEach(test => {
                html += crearFilaTest(contador++, test.id_paciente, 'Importancia', test.fecha, test.id, 'importancia', obtenerNombrePaciente(test.id_paciente));
            });
        }

        if (html === '') {
            html = '<tr><td colspan="5">No se encontraron tests</td></tr>';
        }

        $('#tablaTests').html(html);

        // Inicializar o reinicializar DataTable
        if ($.fn.DataTable.isDataTable('.table')) {
            $('.table').DataTable().destroy();
        }
        $('.table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            order: [[0, 'asc']],
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-2"lp>rt',
            // Quita el scroll interno y muestra más filas por página
            pageLength: 25, // Puedes aumentar este valor si tienes muchos registros
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
            scrollY: false,
            scrollCollapse: false,
            initComplete: function() {
                // Estilos para los selects de DataTable
                $('.dataTables_length select').addClass('form-select').css({
                    'border-radius': '20px',
                    'padding': '0.375rem 1.75rem 0.375rem 0.75rem',
                    'font-size': '1rem',
                    'box-shadow': '0 2px 8px rgba(0,0,0,0.07)'
                });
                // Oculta el buscador interno de DataTable
                $('.dataTables_filter').hide();
                // Opcional: estilos para la paginación
                $('.dataTables_paginate').addClass('mt-0 mb-2');
            }
        });

        // Si el buscador externo no tiene evento, lo agregamos (solo una vez)
        if (!$('#buscarTest').data('dt-attached')) {
            $('#buscarTest').on('input', function() {
                $('.table').DataTable().search(this.value).draw();
            });
            $('#buscarTest').data('dt-attached', true);
        }
    }

    // Modifica para aceptar nombrePaciente como parámetro
    function crearFilaTest(contador, idPaciente, tipo, fecha, idTest, tipoTest, nombrePaciente) {
        return `
            <tr>
                <td>${contador}</td>
                <td>${nombrePaciente}</td>
                <td>${tipo}</td>
                <td>${fecha}</td>
                <td>
                    <button class="btn btn-accion btn-detalles" data-tipo="${tipoTest}" data-id="${idTest}" title="Ver detalles">
                        <i class="bi bi-eye-fill"></i> Detalles
                    </button>
                    <button class="btn btn-accion btn-editar" data-tipo="${tipoTest}" data-id="${idTest}" title="Editar">
                        <i class="bi bi-pencil-fill"></i> Modificar
                    </button>
                    <button class="btn btn-accion btn-eliminar" data-tipo="${tipoTest}" data-id="${idTest}" title="Eliminar">
                        <i class="bi bi-trash-fill"></i> Eliminar
                    </button>
                </td>
            </tr>
        `;
    }

    // Delegación de eventos para botones dinámicos
    $(document).on('click', '.btn-detalles', function() {
        const tipo = $(this).data('tipo');
        const id = $(this).data('id');
        mostrarDetallesTest(tipo, id);
    });

    $(document).on('click', '.btn-editar', function() {
        const tipo = $(this).data('tipo');
        const id = $(this).data('id');
        editarTest(tipo, id);
    });

    $(document).on('click', '.btn-eliminar', function() {
        const tipo = $(this).data('tipo');
        const id = $(this).data('id');
        eliminarTest(tipo, id);
    });

    // Función para mostrar detalles del test
    function mostrarDetallesTest(tipo, id) {
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                ajax_action: 'obtenerDetallesTest',
                tipo: tipo,
                id: id
            },
            success: function(response) {
                if (response.success) {
                    mostrarModalDetalles(response.test, response.paciente, tipo);
                } else {
                    mostrarError('Error al cargar detalles del test');
                }
            },
            error: function() {
                mostrarError('Error de conexión');
            }
        });
    }

    // Función para mostrar modal con detalles
    function mostrarModalDetalles(test, paciente, tipoTest) {
        // Crear contenido del modal según el tipo de test
        let contenidoTest = '';
        let respuestas = test.respuestas || {};
        
        switch(tipoTest) {
            case 'poms':
                contenidoTest = crearContenidoPOMS(respuestas);
                break;
            case 'confianza':
                contenidoTest = crearContenidoConfianza(respuestas);
                break;
            case 'importancia':
                contenidoTest = crearContenidoImportancia(test);
                break;
            default:
                contenidoTest = '<p>No se pudo cargar la información del test</p>';
        }

        // Crear modal
        const modalHTML = `
            <div class="modal fade" id="detallesTestModal" tabindex="-1" aria-labelledby="detallesTestModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="detallesTestModalLabel">Detalles del Test</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5>Información del Paciente</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Nombre:</strong> ${paciente.nombre} ${paciente.apellido}</li>
                                        <li class="list-group-item"><strong>Cédula:</strong> ${paciente.cedula}</li>
                                        <li class="list-group-item"><strong>Teléfono:</strong> ${paciente.telefono}</li>
                                        <li class="list-group-item"><strong>Fecha Nacimiento:</strong> ${paciente.fecha_nacimiento}</li>
                                        <li class="list-group-item"><strong>Género:</strong> ${paciente.genero}</li>
                                        <li class="list-group-item"><strong>Edad:</strong> ${test.edad ? test.edad : 'No especificada'}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Información del Test</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Tipo:</strong> ${tipoTest.toUpperCase()}</li>
                                        <li class="list-group-item"><strong>Fecha:</strong> ${test.fecha}</li>
                                        ${tipoTest === 'poms' ? `<li class="list-group-item"><strong>Deporte:</strong> ${test.deporte || 'No especificado'}</li>` : ''}
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="test-details-container">
                                <h5>Resultados del Test</h5>
                                ${contenidoTest}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Agregar modal al DOM y mostrarlo
        $('body').append(modalHTML);
        const modal = new bootstrap.Modal(document.getElementById('detallesTestModal'));
        modal.show();

        // Eliminar el modal cuando se cierre
        $('#detallesTestModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    }

    // Funciones para crear contenido específico de cada test
    function crearContenidoPOMS(respuestas) {
        let html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>';
        
        for (let i = 1; i <= 65; i++) {
            const valor = respuestas[i] !== undefined ? respuestas[i] : null;
            let textoRespuesta = 'No respondida';
            
            if (valor !== null) {
                switch(valor) {
                    case 0: textoRespuesta = 'Nada'; break;
                    case 1: textoRespuesta = 'Un poco'; break;
                    case 2: textoRespuesta = 'Moderadamente'; break;
                    case 3: textoRespuesta = 'Bastante'; break;
                    case 4: textoRespuesta = 'Extremadamente'; break;
                    default: textoRespuesta = `Valor no reconocido (${valor})`;
                }
            }
            
            html += `<tr><td>Pregunta ${i}</td><td>${textoRespuesta}</td></tr>`;
        }
        
        html += '</tbody></table></div>';
        return html;
    }

    function crearContenidoConfianza(respuestas) {
        let html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>';
        
        for (let i = 1; i <= 10; i++) {
            const valor = respuestas[i] !== undefined ? respuestas[i] : null;
            let textoRespuesta = 'No respondida';
            
            if (valor !== null) {
                switch(valor) {
                    case 1: textoRespuesta = 'Totalmente en desacuerdo'; break;
                    case 2: textoRespuesta = 'En desacuerdo'; break;
                    case 3: textoRespuesta = 'Neutral'; break;
                    case 4: textoRespuesta = 'De acuerdo'; break;
                    case 5: textoRespuesta = 'Totalmente de acuerdo'; break;
                    default: textoRespuesta = `Valor no reconocido (${valor})`;
                }
            }
            
            html += `<tr><td>Pregunta ${i}</td><td>${textoRespuesta}</td></tr>`;
        }
        
        html += '</tbody></table></div>';
        return html;
    }

    function crearContenidoImportancia(test) {
        const parte1 = test.parte1 || {};
        const parte2 = test.parte2 || {};
        
        let html = '<div class="row"><div class="col-md-6"><h6>Parte 1</h6><table class="table table-bordered"><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>';
        
        // Parte 1 (preguntas 1-17)
        for (let i = 1; i <= 17; i++) {
            const valor = parte1[i] !== undefined ? parte1[i] : null;
            html += `<tr><td>Pregunta ${i}</td><td>${valor !== null ? valor : 'No respondida'}</td></tr>`;
        }
        
        html += '</tbody></table></div><div class="col-md-6"><h6>Parte 2</h6><table class="table table-bordered"><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>';
        
        // Parte 2 (preguntas 18-34)
        for (let i = 18; i <= 34; i++) {
            const valor = parte2[i] !== undefined ? parte2[i] : null;
            html += `<tr><td>Pregunta ${i}</td><td>${valor !== null ? valor : 'No respondida'}</td></tr>`;
        }
        
        html += '</tbody></table></div></div>';
        return html;
    }

    // Función para editar un test
    function editarTest(tipo, id) {
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                ajax_action: 'obtenerTest',
                tipo: tipo,
                id: id
            },
            success: function(response) {
                if (response.success) {
                    testSeleccionado = response.data;
                    $('#editarTestId').val(id);
                    $('#editarTestTipo').val(tipo);
                    
                    // Cargar formulario de edición con los datos actuales
                    cargarFormularioTest(tipo, 'editar', response.data);
                    
                    // Mostrar modal de edición
                    const modal = new bootstrap.Modal(document.getElementById('editarTestModal'));
                    modal.show();
                } else {
                    mostrarError('Error al cargar test para edición');
                }
            },
            error: function() {
                mostrarError('Error de conexión');
            }
        });
    }

    // Función para cargar formulario de test
    function cargarFormularioTest(tipo, accion, datos = null) {
        let html = '';
        const containerId = accion === 'nuevo' ? 'formularioTestContainer' : 'formularioEditarTestContainer';
        
        switch(tipo) {
            case 'poms':
                html = crearFormularioPOMS(datos);
                break;
            case 'confianza':
                html = crearFormularioConfianza(datos);
                break;
            case 'importancia':
                html = crearFormularioImportancia(datos);
                break;
            default:
                html = '<p>Seleccione un tipo de test válido</p>';
        }
        
        $(`#${containerId}`).html(html);
    }

    // Funciones para crear formularios específicos de cada test
    function crearFormularioPOMS(datos) {
        let deporte = datos ? datos.deporte : '';
        let edad = datos ? datos.edad : '';
        let respuestas = datos && datos.respuestas ? datos.respuestas : {};

        let html = `
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="deporte" class="form-label">Deporte</label>
                    <input type="text" class="form-control" id="deporte" name="deporte" value="${deporte}" required>
                </div>
                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" value="${edad}" required>
                </div>
            </div>
            <div class="test-container">
                <h5 class="test-header">Perfil de Estados de Ánimo (POMS)</h5>
                <p>Por favor, indique cómo se ha sentido durante la última semana incluyendo hoy, marcando la opción que mejor describa su estado.</p>
                <div class="test-questions-container">
        `;
        
        // Preguntas POMS (1-65)
        for (let i = 1; i <= 65; i++) {
            const valorActual = respuestas[i] !== undefined ? respuestas[i] : 0;
            
            html += `
                <div class="test-question">
                    <p class="fw-bold">Pregunta ${i}:</p>
                    <div class="test-options-group">
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="p${i}_0" value="0" ${valorActual === 0 ? 'checked' : ''}>
                            <label class="form-check-label" for="p${i}_0">Nada</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="p${i}_1" value="1" ${valorActual === 1 ? 'checked' : ''}>
                            <label class="form-check-label" for="p${i}_1">Un poco</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="p${i}_2" value="2" ${valorActual === 2 ? 'checked' : ''}>
                            <label class="form-check-label" for="p${i}_2">Moderadamente</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="p${i}_3" value="3" ${valorActual === 3 ? 'checked' : ''}>
                            <label class="form-check-label" for="p${i}_3">Bastante</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="p${i}_4" value="4" ${valorActual === 4 ? 'checked' : ''}>
                            <label class="form-check-label" for="p${i}_4">Extremadamente</label>
                        </div>
                    </div>
                </div>
            `;
        }
        
        html += `</div></div>`;
        return html;
    }

    function crearFormularioConfianza(datos) {
        let edad = datos ? (datos.edad || '') : '';
        let respuestas = datos && datos.respuestas ? datos.respuestas : {};
        let html = `
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" value="${edad}" required>
                </div>
            </div>
            <div class="test-container">
                <h5 class="test-header">Test de Confianza</h5>
                <p>Por favor, indique su grado de acuerdo con cada una de las siguientes afirmaciones.</p>
                <div class="test-questions-container">
        `;
        
        // Preguntas Confianza (1-10)
        for (let i = 1; i <= 10; i++) {
            const valorActual = respuestas[i] !== undefined ? respuestas[i] : 1;
            
            html += `
                <div class="test-question">
                    <p class="fw-bold">Pregunta ${i}:</p>
                    <div class="test-options-group">
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="c${i}_1" value="1" ${valorActual === 1 ? 'checked' : ''}>
                            <label class="form-check-label" for="c${i}_1">Totalmente en desacuerdo</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="c${i}_2" value="2" ${valorActual === 2 ? 'checked' : ''}>
                            <label class="form-check-label" for="c${i}_2">En desacuerdo</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="c${i}_3" value="3" ${valorActual === 3 ? 'checked' : ''}>
                            <label class="form-check-label" for="c${i}_3">Neutral</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="c${i}_4" value="4" ${valorActual === 4 ? 'checked' : ''}>
                            <label class="form-check-label" for="c${i}_4">De acuerdo</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="pregunta_${i}" id="c${i}_5" value="5" ${valorActual === 5 ? 'checked' : ''}>
                            <label class="form-check-label" for="c${i}_5">Totalmente de acuerdo</label>
                        </div>
                    </div>
                </div>
            `;
        }
        
        html += `</div></div>`;
        return html;
    }

    function crearFormularioImportancia(datos) {
        let edad = datos ? (datos.edad || '') : '';
        let parte1 = datos && datos.parte1 ? datos.parte1 : {};
        let parte2 = datos && datos.parte2 ? datos.parte2 : {};
        
        let html = `
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" value="${edad}" required>
                </div>
            </div>
            <div class="test-container">
                <h5 class="test-header">Test de Importancia</h5>
                <p>Por favor, califique cada uno de los siguientes aspectos según su importancia.</p>
                <div class="test-questions-container">
                    <h6>Parte 1</h6>
        `;
        
        // Parte 1 (preguntas 1-17)
        for (let i = 1; i <= 17; i++) {
            const valorActual = parte1[i] !== undefined ? parte1[i] : 1;
            html += `
                <div class="test-question">
                    <p class="fw-bold">Pregunta ${i}:</p>
                    <div class="test-options-group">
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_1" value="1" ${valorActual == 1 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_1">1 - Muy poco importante</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_2" value="2" ${valorActual == 2 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_2">2</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_3" value="3" ${valorActual == 3 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_3">3</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_4" value="4" ${valorActual == 4 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_4">4</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_5" value="5" ${valorActual == 5 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_5">5</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte1_pregunta_${i}" id="parte1_${i}_6" value="6" ${valorActual == 6 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte1_${i}_6">6 - Extremadamente importante</label>
                        </div>
                    </div>
                </div>
            `;
        }
        
        html += `
                <h6 class="mt-4">Parte 2</h6>
        `;
        
        // Parte 2 (preguntas 18-34)
        for (let i = 18; i <= 34; i++) {
            const valorActual = parte2[i] !== undefined ? parte2[i] : 1;
            html += `
                <div class="test-question">
                    <p class="fw-bold">Pregunta ${i}:</p>
                    <div class="test-options-group">
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_1" value="1" ${valorActual == 1 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_1">1 - Muy poco importante</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_2" value="2" ${valorActual == 2 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_2">2</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_3" value="3" ${valorActual == 3 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_3">3</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_4" value="4" ${valorActual == 4 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_4">4</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_5" value="5" ${valorActual == 5 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_5">5</label>
                        </div>
                        <div class="form-check test-option">
                            <input class="form-check-input" type="radio" name="parte2_pregunta_${i}" id="parte2_${i}_6" value="6" ${valorActual == 6 ? 'checked' : ''}>
                            <label class="form-check-label" for="parte2_${i}_6">6 - Extremadamente importante</label>
                        </div>
                    </div>
                </div>
            `;
        }
        
        html += `</div></div>`;
        return html;
    }

    // Función para guardar test (nuevo o edición)
    function guardarTest(accion) {
        const formId = accion === 'nuevo' ? 'formNuevoTest' : 'formEditarTest';
        const formData = $(`#${formId}`).serializeArray();
        const tipoTest = $(`#${formId} [name="tipo_test"]`).val();

        $.ajax({
            url: '',
            type: 'POST',
            data: {
                ajax_action: accion === 'nuevo' ? 'guardar_test' : 'actualizar_test',
                ...Object.fromEntries(formData.map(item => [item.name, item.value]))
            },
            success: function(response) {
                if (response.success) {
                    mostrarExito(response.message);

                    // Cerrar modal
                    if (accion === 'nuevo') {
                        $('#nuevoTestModal').modal('hide');
                    } else {
                        $('#editarTestModal').modal('hide');
                    }

                    // Recargar todos los tests y actualizar DataTable
                    cargarTests(pacienteSeleccionado || '');
                } else {
                    mostrarError(response.message);
                }
            },
            error: function() {
                mostrarError('Error de conexión');
            }
        });
    }

    // Función para eliminar un test
    function eliminarTest(tipo, id) {
        if (confirm('¿Está seguro que desea eliminar este test? Esta acción no se puede deshacer.')) {
            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    ajax_action: 'eliminarTest',
                    tipo: tipo,
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        mostrarExito(response.message);
                        // Recargar todos los tests y actualizar DataTable
                        cargarTests(pacienteSeleccionado || '');
                    } else {
                        mostrarError(response.message);
                    }
                },
                error: function() {
                    mostrarError('Error de conexión');
                }
            });
        }
    }

    // Funciones auxiliares para mostrar mensajes
    function mostrarExito(mensaje) {
        // Elimina alertas previas
        $('.alert').remove();
        const alertHTML = `
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" role="alert" style="z-index: 2000; min-width:300px; max-width:90vw;">
                <strong>Éxito:</strong> ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        `;
        $('body').append(alertHTML);
        setTimeout(() => $('.alert').alert('close'), 3000);
    }

    function mostrarError(mensaje) {
        // Elimina alertas previas
        $('.alert').remove();
        const alertHTML = `
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" role="alert" style="z-index: 2000; min-width:300px; max-width:90vw;">
                <strong>Error:</strong> ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        `;
        $('body').append(alertHTML);
        setTimeout(() => $('.alert').alert('close'), 3000);
    }

    // Limpiar el formulario de registro cada vez que se abre el modal de "Nuevo Test"
    $('#nuevoTestModal').on('show.bs.modal', function () {
        $('#formNuevoTest')[0].reset();
        $('#formularioTestContainer').html('');
    });
});