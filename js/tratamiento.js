$(document).ready(function () {
    // Inicializar DataTable con AJAX
    const tablaTratamientos = $('#tablaTratamientos').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        responsive: true,
        ajax: {
            url: '?pagina=tratamiento',
            type: 'POST',
            data: {
                ajax_action: 'listar_tratamientos'
            },
            dataSrc: 'data'
        },
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return row.nombre + ' ' + row.apellido;
                }
            },
            {data: 'cedula'},
            {
                data: 'fecha_creacion',
                render: function (data, type, row) {
                    return formatDate(data);
                }
            },
            {
                data: 'estado_actual',
                render: function (data, type, row) {
                    const estadoClass = "badge-" + data;
                    const estadoText = data.replace('_', ' ');
                    return `<span class="badge ${estadoClass}">${estadoText.charAt(0).toUpperCase() + estadoText.slice(1)}</span>`;
                }
            },
            {
                data: 'id_tratamiento',
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning btn-editar" data-id="${data}">
                            <i class="fas fa-edit me-1"></i>Editar
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar" data-id="${data}">
                            <i class="fas fa-trash me-1"></i>Eliminar
                        </button>
                        <button class="btn btn-sm btn-info btn-detalles" data-id="${data}">
                            <i class="fas fa-info-circle me-1"></i>Detalles
                        </button>
                    `;
                },
                orderable: false
            }
        ]
    });

    // Establecer fecha actual por defecto en el formulario nuevo
    const today = new Date().toISOString().split('T')[0];
    $('#fecha_creacion').val(today);

    // Manejar búsqueda en tiempo real
    $('#buscarTratamiento').on('keyup', function () {
        tablaTratamientos.search(this.value).draw();
    });

    $('#btnBuscar').on('click', function () {
        tablaTratamientos.search($('#buscarTratamiento').val()).draw();
    });

    // Función para mostrar errores de validación
    function mostrarErrores(errors) {
        // Limpiar errores previos
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Mostrar nuevos errores
        for (const field in errors) {
            const input = $(`#${field}`);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${errors[field]}</div>`);
        }
    }

    $('#formNuevoTratamiento').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('ajax_action', 'crear_tratamiento');

        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Guardando...');

        $.ajax({
            url: '?pagina=tratamiento',
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Respuesta del servidor:', response);

                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Tratamiento creado correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#nuevoTratamientoModal').modal('hide');
                    tablaTratamientos.ajax.reload(null, false);
                    $('#formNuevoTratamiento')[0].reset();
                    $('#fecha_creacion').val(today);
                } else {
                    if (response.errors) {
                        mostrarErrores(response.errors);
                    } else {
                        let errorMsg = response.message || 'No se pudo crear el tratamiento';
                        if (response.error_details) {
                            errorMsg += '<br><small>' + response.error_details + '</small>';
                        }
                        Swal.fire({
                            title: 'Error',
                            html: errorMsg,
                            icon: 'error'
                        });
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al conectar con el servidor: ' + error,
                    icon: 'error'
                });
            },
            complete: function () {
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Enviar formulario editar tratamiento con AJAX y FormData
    $('#formEditarTratamiento').on('submit', function (e) {
        e.preventDefault();

        // Crear FormData
        const formData = new FormData(this);
        formData.append('ajax_action', 'actualizar_tratamiento');

        // Mostrar loading
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Actualizando...');

        $.ajax({
            url: '?pagina=tratamiento',
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Tratamiento actualizado correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#editarTratamientoModal').modal('hide');
                    // Recargar la tabla
                    tablaTratamientos.ajax.reload(null, false);
                } else {
                    if (response.errors) {
                        mostrarErrores(response.errors);
                    } else {
                        Swal.fire('Error', response.message || 'No se pudo actualizar el tratamiento', 'error');
                    }
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Error al actualizar el tratamiento: ' + error, 'error');
            },
            complete: function () {
                submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i>Actualizar');
            }
        });
    });

    // Manejar clic en botón Editar
    $(document).on('click', '.btn-editar', function () {
        const idTratamiento = $(this).data('id');

        $.ajax({
            url: '?pagina=tratamiento',
            method: 'POST',
            dataType: 'json',
            data: {
                ajax_action: 'obtener_tratamiento',
                id: idTratamiento
            },
            success: function (response) {
                if (response.success) {
                    const tratamiento = response.data;

                    $('#id_tratamiento_editar').val(tratamiento.id_tratamiento);
                    $('#id_paciente_editar').val(tratamiento.id_paciente);
                    $('#fecha_creacion_editar').val(tratamiento.fecha_creacion);
                    $('#tratamiento_tipo_editar').val(tratamiento.tratamiento_tipo);
                    $('#estado_actual_editar').val(tratamiento.estado_actual);
                    $('#diagnostico_descripcion_editar').val(tratamiento.diagnostico_descripcion);
                    $('#observaciones_editar').val(tratamiento.observaciones);

                    $('#editarTratamientoModal').modal('show');
                } else {
                    Swal.fire('Error', 'No se pudo cargar el tratamiento', 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Error al obtener datos del tratamiento: ' + error, 'error');
            }
        });
    });

    // Manejar clic en botón Detalles
    $(document).on('click', '.btn-detalles', function () {
        const idTratamiento = $(this).data('id');

        $.ajax({
            url: '?pagina=tratamiento',
            method: 'POST',
            dataType: 'json',
            data: {
                ajax_action: 'obtener_tratamiento',
                id: idTratamiento
            },
            success: function (response) {
                if (response.success) {
                    const tratamiento = response.data;

                    // Mostrar datos básicos
                    $('#detalleNombrePaciente').text(tratamiento.nombre + ' ' + tratamiento.apellido);
                    $('#detalleCedula').text('Cédula: ' + tratamiento.cedula);
                    $('#detalleFechaCreacion').text('Fecha inicio: ' + formatDate(tratamiento.fecha_creacion));

                    // Mostrar estado con el badge correspondiente
                    const estadoClass = "badge-" + tratamiento.estado_actual;
                    const estadoText = tratamiento.estado_actual.replace('_', ' ');
                    $('#detalleEstado').text(estadoText.charAt(0).toUpperCase() + estadoText.slice(1))
                        .removeClass().addClass('badge ' + estadoClass);

                    // Mostrar otros datos
                    $('#detalleTipoTratamiento').text(tratamiento.tratamiento_tipo);
                    $('#detalleDiagnostico').text(tratamiento.diagnostico_descripcion || 'No especificado');
                    $('#detalleObservaciones').text(tratamiento.observaciones || 'No hay observaciones');

                    $('#detallesTratamientoModal').modal('show');
                } else {
                    Swal.fire('Error', 'No se pudo cargar el tratamiento', 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Error al obtener datos del tratamiento: ' + error, 'error');
            }
        });
    });

    // Manejar clic en botón Eliminar
    $(document).on('click', '.btn-eliminar', function () {
        const idTratamiento = $(this).data('id');
        $('#id_tratamiento_eliminar').val(idTratamiento);
        $('#confirmarEliminarModal').modal('show');
    });

    // Confirmar eliminación
    $('#btnConfirmarEliminar').on('click', function () {
        const idTratamiento = $('#id_tratamiento_eliminar').val();

        $.ajax({
            url: '?pagina=tratamiento',
            method: 'POST',
            dataType: 'json',
            data: {
                ajax_action: 'eliminar_tratamiento',
                id: idTratamiento
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Tratamiento eliminado correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // Recargar la tabla
                    tablaTratamientos.ajax.reload(null, false);
                } else {
                    Swal.fire('Error', response.message || 'No se pudo eliminar el tratamiento', 'error');
                }
                $('#confirmarEliminarModal').modal('hide');
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Error al eliminar el tratamiento: ' + error, 'error');
                $('#confirmarEliminarModal').modal('hide');
            }
        });
    });

    // Formatear fecha para mostrar
    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    // Limpiar formulario cuando se cierra el modal
    $('#nuevoTratamientoModal').on('hidden.bs.modal', function () {
        $('#formNuevoTratamiento')[0].reset();
        $('#fecha_creacion').val(today);
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    });

    // Limpiar errores cuando se cierra el modal de edición
    $('#editarTratamientoModal').on('hidden.bs.modal', function () {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    });
});