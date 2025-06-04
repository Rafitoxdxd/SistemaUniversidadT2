document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

    // Aqui inclui el boostrap de forma local 
    themeSystem: 'bootstrap5',

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      locale: 'es',
      

      initialDate: '2023-01-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(arg) {
        var title = prompt('Event Title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }
        calendar.unselect()
      },
      eventClick: function(arg) {
        if (confirm('Are you sure you want to delete this event?')) {
          arg.event.remove()
        }
      },
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: async function(fetchInfo, successCallback, failureCallback) {
        try {
          const response = await fetch('Controller/cita.php?ajax=1');
          const data = await response.json();
          if (Array.isArray(data.pacientes)) {
            // Si la respuesta es {pacientes: [...]}, ignora
            successCallback([]);
            return;
          }
          if (Array.isArray(data.citas)) {
            // Si la respuesta es {citas: [...]}, úsala
            successCallback(data.citas);
            return;
          }
          if (Array.isArray(data)) {
            // Si la respuesta es un array plano
            successCallback(data);
            return;
          }
          successCallback([]);
        } catch (e) {
          failureCallback(e);
        }
      },
    select: function(info) {
        console.log(info);

        const GuardarModal = new bootstrap.Modal(document.getElementById("GuardarModal"));

        document.getElementById("start").value = converterData(info.startStr);
        document.getElementById("end").value = converterData(info.endStr);

        GuardarModal.show();

        
    }


    });

    calendar.render();

    //Convierto a tiempo
    function converterData(data) {
    
        //Convierto a string un dato de tiempo
        const dataobj = new Date (data);
        
        //Extrae las fechas
        const año = dataobj.getFullYear();
        const mes = String( dataobj.getMonth() + 1).padStart(2, '0');
        const dia = String(dataobj.getDate()).padStart(2, '0');
        const hora = String(dataobj.getHours()).padStart(2, '0');
        const minuto = String(dataobj.getMinutes()).padStart(2, '0');

        //Retorno los datos
        return '${año}-${mes}-${dia}T${hora}:${minuto}';
    }

    // CORRECCIÓN: El id correcto del formulario es "formEvento"
    const formEvento = document.getElementById("formEvento");

    if (formEvento) {
        formEvento.addEventListener("submit", async function(e) {
            e.preventDefault(); // Prevenir el envío normal

            const formData = new FormData(formEvento);

            // Enviar por AJAX
            const response = await fetch('Controller/cita.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                // Cierra el modal
                bootstrap.Modal.getInstance(document.getElementById("GuardarModal")).hide();
                // Recarga los eventos del calendario
                calendar.refetchEvents();
            } else {
                alert("Error al guardar la cita");
            }
        });
    }

    // Mostrar modal al hacer click en un evento del calendario
    if (typeof FullCalendar !== 'undefined') {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = FullCalendar.getCalendar(calendarEl);
            if (calendar) {
                calendar.on('eventClick', function(info) {
                    const GuardarModal = new bootstrap.Modal(document.getElementById("GuardarModal"));
                    GuardarModal.show();
                    // Aquí puedes rellenar los campos del modal con info.event.extendedProps
                });
            }
        }
    }

});
