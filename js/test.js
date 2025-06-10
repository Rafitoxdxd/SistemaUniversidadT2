document.addEventListener('DOMContentLoaded', function() {
    // Variables globales
    let testsData = [];
    let currentTestType = '';
    let currentTestId = 0;
    let currentPatientId = '';
    
    // Inicialización
    initEventListeners();
    showStatusMessages();
    
    function showStatusMessages() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const error = urlParams.get('error');
        
        if (status === 'test_guardado') {
            showAlert('Test guardado correctamente', 'success');
        } else if (status === 'test_actualizado') {
            showAlert('Test actualizado correctamente', 'success');
        } else if (status === 'test_eliminado') {
            showAlert('Test eliminado correctamente', 'success');
        } else if (status === 'error') {
            showAlert('Error: ' + (error || 'Ocurrió un error desconocido'), 'danger');
        }
        
        // Limpiar parámetros de la URL
        if (status) {
            urlParams.delete('status');
            urlParams.delete('error');
            window.history.replaceState({}, document.title, window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : ''));
        }
    }
    
    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        document.querySelector('.main-content').insertAdjacentHTML('afterbegin', alertHtml);
        
        // Auto cerrar después de 5 segundos
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
    
    function initEventListeners() {
        // Selección de paciente
        $('#selectPaciente').change(function() {
            currentPatientId = $(this).val();
            if (currentPatientId) {
                cargarTestsPaciente(currentPatientId);
            } else {
                $('#tablaTests').html('<tr><td colspan="5">Seleccione un paciente para ver sus tests</td></tr>');
            }
        });
        
        // Filtro por tipo de test
        $('#filtroTest').change(function() {
            filtrarTests();
        });
        
        // Cambio de tipo de test en el modal nuevo
        $('#nuevoTestTipo').change(function() {
            const tipoTest = $(this).val();
            if (tipoTest) {
                cargarFormularioTest(tipoTest, 'nuevo');
            } else {
                $('#formularioTestContainer').empty();
            }
        });
        
        // Envío del formulario nuevo test
        $('#formNuevoTest').on('submit', function(e) {
            e.preventDefault();
            guardarTest();
        });
        
        // Envío del formulario editar test
        $('#formEditarTest').on('submit', function(e) {
            e.preventDefault();
            actualizarTest();
        });
        
        // Limpiar formulario cuando se cierra el modal
        $('#nuevoTestModal').on('hidden.bs.modal', function() {
            $('#formNuevoTest')[0].reset();
            $('#formularioTestContainer').empty();
        });
    }
    
    function guardarTest() {
        const formData = new FormData(document.getElementById('formNuevoTest'));
        formData.append('ajax_action', 'guardar_test');
        
        if (!formData.get('id_paciente') || !formData.get('tipo_test')) {
            showAlert('Debe seleccionar un paciente y un tipo de test', 'danger');
            return;
        }
        
        const submitBtn = $('#formNuevoTest').find('[name="guardar_test"]');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
        
        $.ajax({
            url: 'index.php?pagina=test',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    $('#nuevoTestModal').modal('hide');
                    recargarTablaTests();
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al guardar test:', error);
                showAlert('Error al guardar el test', 'danger');
            },
            complete: function() {
                submitBtn.prop('disabled', false).html('Guardar Test');
            }
        });
    }
    
    function actualizarTest() {
        const formData = new FormData(document.getElementById('formEditarTest'));
        formData.append('ajax_action', 'actualizar_test');
        
        const submitBtn = $('#formEditarTest').find('[name="actualizar_test"]');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...');
        
        $.ajax({
            url: 'index.php?pagina=test',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    $('#editarTestModal').modal('hide');
                    recargarTablaTests();
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al actualizar test:', error);
                showAlert('Error al actualizar el test', 'danger');
            },
            complete: function() {
                submitBtn.prop('disabled', false).html('Actualizar Test');
            }
        });
    }
    
    function recargarTablaTests() {
        if (currentPatientId) {
            cargarTestsPaciente(currentPatientId);
        }
    }
    
    // Cargar tests de un paciente
    function cargarTestsPaciente(idPaciente) {
        $('#tablaTests').html('<tr><td colspan="5"><div class="text-center my-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div></td></tr>');
        
        $.ajax({
            url: 'index.php?pagina=test',
            type: 'POST',
            data: {
                ajax_action: 'obtenerTests',
                id_paciente: idPaciente
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    testsData = {
                        poms: response.data.poms || [],
                        confianza: response.data.confianza || [],
                        importancia: response.data.importancia || []
                    };
                    filtrarTests();
                } else {
                    showAlert(response.message, 'danger');
                    $('#tablaTests').html('<tr><td colspan="5" class="text-danger">Error al cargar los tests</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar tests:', error);
                showAlert('Error al cargar los tests', 'danger');
                $('#tablaTests').html('<tr><td colspan="5" class="text-danger">Error al cargar los tests</td></tr>');
            }
        });
    }
    
    // Filtrar tests por tipo
    function filtrarTests() {
        const tipoFiltro = $('#filtroTest').val();
        let testsMostrar = [];
        
        if (!tipoFiltro) {
            testsMostrar = testsMostrar.concat(
                testsData.poms.map(t => ({...t, tipo: 'poms'})),
                testsData.confianza.map(t => ({...t, tipo: 'confianza'})),
                testsData.importancia.map(t => ({...t, tipo: 'importancia'}))
            );
        } else {
            testsMostrar = testsData[tipoFiltro].map(t => ({...t, tipo: tipoFiltro}));
        }
        
        testsMostrar.sort((a, b) => new Date(b.fecha) - new Date(a.fecha));
        actualizarTablaTests(testsMostrar);
    }
    
    // Actualizar la tabla de tests
    function actualizarTablaTests(tests) {
        const $tabla = $('#tablaTests');
        $tabla.empty();
        
        if (tests.length === 0) {
            $tabla.append('<tr><td colspan="5">No se encontraron tests</td></tr>');
            return;
        }
        
        const nombrePaciente = $('#selectPaciente option:selected').text();
        
        tests.forEach(test => {
            let tipoTest = '';
            switch (test.tipo) {
                case 'poms': tipoTest = 'POMS'; break;
                case 'confianza': tipoTest = 'Confianza'; break;
                case 'importancia': tipoTest = 'Importancia'; break;
            }
            
            const fecha = new Date(test.fecha).toLocaleDateString();
            
            $tabla.append(`
                <tr>
                    <td>${test.id}</td>
                    <td>${nombrePaciente}</td>
                    <td>${tipoTest}</td>
                    <td>${fecha}</td>
                    <td>
                        <button class="btn btn-accion btn-editar btn-sm" onclick="editarTest('${test.tipo}', ${test.id})">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button class="btn btn-accion btn-eliminar btn-sm" onclick="eliminarTest('${test.tipo}', ${test.id})">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            `);
        });
    }
    
    // Cargar formulario de test según tipo
    function cargarFormularioTest(tipoTest, accion) {
        const $container = accion === 'nuevo' ? $('#formularioTestContainer') : $('#formularioEditarTestContainer');
        $container.empty();
        $container.html('<div class="text-center my-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando formulario...</span></div></div>');
        
        setTimeout(() => {
            switch (tipoTest) {
                case 'poms':
                    cargarFormularioPOMS($container, accion);
                    break;
                case 'confianza':
                    cargarFormularioConfianza($container, accion);
                    break;
                case 'importancia':
                    cargarFormularioImportancia($container, accion);
                    break;
            }
        }, 300);
    }
    
    // Cargar formulario POMS
    function cargarFormularioPOMS($container, accion) {
        let deporte = '';
        let edad = '';
        let respuestas = {};
        
        if (accion === 'editar') {
            $.ajax({
                url: 'index.php?pagina=test',
                type: 'POST',
                data: {
                    ajax_action: 'obtenerTest',
                    tipo: 'poms',
                    id: currentTestId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        deporte = response.data.deporte || '';
                        edad = response.data.edad || '';
                        respuestas = response.data.respuestas ? JSON.parse(response.data.respuestas) : {};
                        renderFormularioPOMS($container, deporte, edad, respuestas);
                    } else {
                        $container.html(`<div class="alert alert-danger">${response.message}</div>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar test POMS:', error);
                    $container.html('<div class="alert alert-danger">Error al cargar el test POMS</div>');
                }
            });
        } else {
            renderFormularioPOMS($container, deporte, edad, respuestas);
        }
    }
    
    function renderFormularioPOMS($container, deporte, edad, respuestas) {
        $container.html(`
            <div class="test-container">
                <div class="test-header">
                    <h5>POMS - Perfil de Estados de Ánimo</h5>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="deporte" class="form-label">Deporte</label>
                        <input type="text" class="form-control" id="deporte" name="deporte" required value="${deporte}">
                    </div>
                    <div class="col-md-6">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="edad" name="edad" min="1" max="120" required value="${edad}">
                    </div>
                </div>
                <p><strong>Indicaciones:</strong> A continuación hay una lista de palabras que describen sentimientos. Por favor, lea cuidadosamente cada una y marque el número que describa mejor cómo se ha sentido durante el último tiempo, hasta hoy.</p>
                <p><strong>Escala:</strong> 0 = Nada, 1 = Un poco, 2 = Moderadamente, 3 = Bastante, 4 = Muchísimo</p>
                
                <div id="preguntasPOMS"></div>
            </div>
        `);
        
        const preguntasPOMS = [
            "Amigable", "Tenso", "Enojado", "Agotado", "Infeliz", "Lúcido", "Vívaz", "Confuso", 
            "Arrepentido", "Tembloroso", "Apático", "Irritado", "Considerado", "Triste", "Activo", 
            "Desbordado", "Malhumorado", "Caído", "Energizado", "Con pánico", "Desesperanzado", 
            "Relajado", "Torpe", "Málicioso", "Sorpresivo", "Intranquilo", "Inquieto", 
            "Sin concentración", "Fatigado", "Colaborador", "Molesto", "Desanimado", "Resentido", 
            "Nervioso", "Solo", "Desdichado", "Aturdido", "Alegre", "Amargado", "Exhausto", 
            "Ansioso", "Luchador", "De buen humor", "Deprimido", "Desesperado", "Desprolijo", 
            "Rebelde", "Desamparado", "Cansado", "Desorientado", "Alerta", "Engañado", "Furioso", 
            "Eficiente", "Confiado", "Dinámico", "Enojadizo", "Desvalorizado", "Olvídadizo", 
            "Despreocupado", "Aterrorizado", "Culpable", "Vigoroso", "Inseguro", "Abatido"
        ];
        
        const $preguntasContainer = $('#preguntasPOMS');
        
        preguntasPOMS.forEach((pregunta, index) => {
            const numPregunta = index + 1;
            const valorSeleccionado = respuestas[numPregunta] || 0;
            
            $preguntasContainer.append(`
                <div class="test-question">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>${numPregunta}. ${pregunta}</strong>
                    </div>
                    <div class="test-options-group">
                        ${[0, 1, 2, 3, 4].map(val => `
                            <div class="test-option">
                                <input type="radio" id="pregunta_${numPregunta}_${val}" name="pregunta_${numPregunta}" 
                                    value="${val}" ${valorSeleccionado == val ? 'checked' : ''} required>
                                <label for="pregunta_${numPregunta}_${val}" class="ms-2">${val} (${getDescripcionPOMS(val)})</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `);
        });
    }
    
    function getDescripcionPOMS(valor) {
        const descripciones = {
            0: 'Nada',
            1: 'Un poco',
            2: 'Moderadamente',
            3: 'Bastante',
            4: 'Muchísimo'
        };
        return descripciones[valor] || '';
    }
    
    // Cargar formulario Confianza
    function cargarFormularioConfianza($container, accion) {
        let respuestas = {};
        
        if (accion === 'editar') {
            $.ajax({
                url: 'index.php?pagina=test',
                type: 'POST',
                data: {
                    ajax_action: 'obtenerTest',
                    tipo: 'confianza',
                    id: currentTestId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        respuestas = response.data.respuestas ? JSON.parse(response.data.respuestas) : {};
                        renderFormularioConfianza($container, respuestas);
                    } else {
                        $container.html(`<div class="alert alert-danger">${response.message}</div>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar test Confianza:', error);
                    $container.html('<div class="alert alert-danger">Error al cargar el test de Confianza</div>');
                }
            });
        } else {
            renderFormularioConfianza($container, respuestas);
        }
    }
    
    function renderFormularioConfianza($container, respuestas) {
        $container.html(`
            <div class="test-container">
                <div class="test-header">
                    <h5>Test de Confianza</h5>
                </div>
                <p><strong>Indicaciones:</strong> Por favor, indique el grado de confianza que tiene respecto a cada una de las siguientes capacidades.</p>
                
                <div id="preguntasConfianza"></div>
            </div>
        `);
        
        const preguntasConfianza = [
            "Su capacidad para ejecutar las destrezas de su deporte o ejercicio",
            "Su capacidad para tomar decisiones fundamentales durante la competición",
            "Su capacidad para concentrarse",
            "Su capacidad para actuar bajo presión",
            "Su capacidad para ejecutar una estrategia satisfactoriamente",
            "Su capacidad para emplear el esfuerzo necesario para lograr el éxito",
            "Su capacidad para controlar sus emociones durante la competición",
            "Su capacidad para relacionarse satisfactoriamente con sus entrenadores",
            "Su capacidad para reaccionar cuando anda retrasado o está teniendo una mala actuación",
            "Su entrenamiento o preparación física"
        ];
        
        const $preguntasContainer = $('#preguntasConfianza');
        
        preguntasConfianza.forEach((pregunta, index) => {
            const numPregunta = index + 1;
            const valorSeleccionado = respuestas[numPregunta] || 1;
            
            $preguntasContainer.append(`
                <div class="test-question">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>${numPregunta}. ${pregunta}</strong>
                    </div>
                    <div class="test-options-group">
                        ${[1, 2, 3].map(val => `
                            <div class="test-option">
                                <input type="radio" id="pregunta_${numPregunta}_${val}" name="pregunta_${numPregunta}" 
                                    value="${val}" ${valorSeleccionado == val ? 'checked' : ''} required>
                                <label for="pregunta_${numPregunta}_${val}" class="ms-2">${getDescripcionConfianza(val)}</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `);
        });
    }
    
    function getDescripcionConfianza(valor) {
        const descripciones = {
            1: 'Poca confianza',
            2: 'Confianza adecuada',
            3: 'Exceso de confianza'
        };
        return descripciones[valor] || '';
    }
    
    // Cargar formulario Importancia
    function cargarFormularioImportancia($container, accion) {
        let parte1 = {};
        let parte2 = {};
        
        if (accion === 'editar') {
            $.ajax({
                url: 'index.php?pagina=test',
                type: 'POST',
                data: {
                    ajax_action: 'obtenerTest',
                    tipo: 'importancia',
                    id: currentTestId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        parte1 = response.data.parte1 ? JSON.parse(response.data.parte1) : {};
                        parte2 = response.data.parte2 ? JSON.parse(response.data.parte2) : {};
                        renderFormularioImportancia($container, parte1, parte2);
                    } else {
                        $container.html(`<div class="alert alert-danger">${response.message}</div>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar test Importancia:', error);
                    $container.html('<div class="alert alert-danger">Error al cargar el test de Importancia</div>');
                }
            });
        } else {
            renderFormularioImportancia($container, parte1, parte2);
        }
    }
    
    function renderFormularioImportancia($container, parte1, parte2) {
        $container.html(`
            <div class="test-container">
                <div class="test-header">
                    <h5>Test de Importancia</h5>
                </div>
                <p><strong>Indicaciones:</strong> Por favor, indique qué tan importante es cada uno de los siguientes aspectos para usted.</p>
                <p><strong>Escala:</strong> 1 = Nada importante, 7 = Muy importante</p>
                
                <h6 class="mt-4">Parte 1</h6>
                <div id="preguntasImportanciaParte1"></div>
                
                <h6 class="mt-4">Parte 2</h6>
                <div id="preguntasImportanciaParte2"></div>
            </div>
        `);
        
        const preguntasImportanciaParte1 = [
            "Mantengo mi concentración en el juego o en el partido",
            "Me siento bien con mi peso",
            "Veo que mis compañeros me animan",
            "Creo en las capacidades de mi entrenador",
            "Veo jugar un buen partido",
            "Juego en un ambiente que me gusta",
            "Domino nuevas habilidades",
            "Demuestro que soy mejor que los otros",
            "Consigo mentalizarme",
            "Me siento bien con mi aspecto",
            "Sé que cuento con el apoyo de los demás",
            "Sé que mi entrenador va a tomar decisiones acertadas",
            "Veo a otro futbolista jugar",
            "Mejoro en alguna acción técnica",
            "Sé que estoy mentalmente preparado",
            "Me siento a gusto con mi cuerpo",
            "Sé que los demás creen en mi"
        ];
        
        const preguntasImportanciaParte2 = [
            "Sé que el entrenador es un buen líder",
            "Observo como un compañero juega bien",
            "Me siento cómodo en el campo",
            "Mejoro mis habilidades técnicas",
            "Sé que técnicamente soy mejor que mis rivales",
            "Me mantengo centrado en lo que tengo que hacer",
            "Creo en las decisiones de mi entrenador",
            "Veo a un amigo jugar bien",
            "Me gusta el ambiente en el que juego",
            "Aumento el número de acciones técnicas que puedo realizar",
            "Demuestro que soy mejor que el rival",
            "Me preparo física y mentalmente",
            "Siento que mi entrenador actúa como un líder",
            "Desarrollo nuevas habilidades técnicas y mejoro",
            "Demuestro que soy uno de los mejores",
            "Creo que puedo esforzarme al máximo",
            "El publico me anima"
        ];
        
        const $parte1Container = $('#preguntasImportanciaParte1');
        const $parte2Container = $('#preguntasImportanciaParte2');
        
        // Parte 1
        preguntasImportanciaParte1.forEach((pregunta, index) => {
            const numPregunta = index + 1;
            const valorSeleccionado = parte1[numPregunta] || 1;
            
            $parte1Container.append(`
                <div class="test-question">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>${numPregunta}. ${pregunta}</strong>
                    </div>
                    <div class="test-options-group">
                        ${[1, 2, 3, 4, 5, 6, 7].map(val => `
                            <div class="test-option">
                                <input type="radio" id="parte1_pregunta_${numPregunta}_${val}" name="parte1_pregunta_${numPregunta}" 
                                    value="${val}" ${valorSeleccionado == val ? 'checked' : ''} required>
                                <label for="parte1_pregunta_${numPregunta}_${val}" class="ms-2">${val}</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `);
        });
        
        // Parte 2
        preguntasImportanciaParte2.forEach((pregunta, index) => {
            const numPregunta = index + 18;
            const valorSeleccionado = parte2[numPregunta] || 1;
            
            $parte2Container.append(`
                <div class="test-question">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>${numPregunta}. ${pregunta}</strong>
                    </div>
                    <div class="test-options-group">
                        ${[1, 2, 3, 4, 5, 6, 7].map(val => `
                            <div class="test-option">
                                <input type="radio" id="parte2_pregunta_${numPregunta}_${val}" name="parte2_pregunta_${numPregunta}" 
                                    value="${val}" ${valorSeleccionado == val ? 'checked' : ''} required>
                                <label for="parte2_pregunta_${numPregunta}_${val}" class="ms-2">${val}</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `);
        });
    }
    
    // Hacer funciones accesibles globalmente
    window.cargarFormularioTest = cargarFormularioTest;
    window.editarTest = editarTest;
    window.eliminarTest = eliminarTest;
});

// Función global para editar test
function editarTest(tipoTest, testId) {
    // Guardar el tipo y ID del test actual
    window.currentTestType = tipoTest;
    window.currentTestId = testId;
    
    $('#editarTestId').val(testId);
    $('#editarTestTipo').val(tipoTest);
    
    const $container = $('#formularioEditarTestContainer');
    $container.empty();
    $container.html('<div class="text-center my-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>');
    
    // Mostrar el modal inmediatamente
    $('#editarTestModal').modal('show');
    
    // Cargar el formulario correspondiente
    cargarFormularioTest(tipoTest, 'editar');
}

// Función global para eliminar test
function eliminarTest(tipoTest, testId) {
    if (confirm('¿Está seguro que desea eliminar este test? Esta acción no se puede deshacer.')) {
        $.ajax({
            url: 'index.php?pagina=test',
            type: 'POST',
            data: {
                ajax_action: 'eliminarTest',
                tipo: tipoTest,
                id: testId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    // Recargar los tests del paciente actual
                    if (window.currentPatientId) {
                        cargarTestsPaciente(window.currentPatientId);
                    }
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function(xhr, status, error) {
                showAlert('Error al eliminar test: ' + error, 'danger');
            }
        });
    }
}