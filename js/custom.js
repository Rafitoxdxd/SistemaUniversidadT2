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
      events: [
        {
          title: 'All Day Event',
          start: '2023-01-01'
        },
        {
          title: 'Long Event',
          start: '2023-01-07',
          end: '2023-01-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2023-01-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2023-01-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2023-01-11',
          end: '2023-01-13'
        },
        {
          title: 'Meeting',
          start: '2023-01-12T10:30:00',
          end: '2023-01-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2023-01-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2023-01-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2023-01-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2023-01-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2023-01-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2023-01-28'
        }
      ],

    select: function name(info) {
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

    const formEvento = document.getElementById("formEvent");

    if (formEvento) {

        formEvento.addEventListener("submit", async (e) => {
            e.preventDefault();

            const dadosForm = new FormData(formEvento);

            await fetch ("cita.php", {
                method: "POST",
                body: dadosForm
            });


        
    })
}


});
