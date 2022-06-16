$('.form-select').on('change', function (e) {
    let classroom_id = ($(this).find('option:selected').val());
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        type: 'POST',
        url: `/bookings/filter`,
        cache: false,
        data: {
            classroom_id: classroom_id
        },
        success: function (data) {
            console.log(data)
            $('#bookings').textContent=data;
            $('#bookings_assignments').textContent=data;
        }


    })

})
const getBookings = () => {
    let bookings = document.getElementById('bookings').textContent
    let arraybookings=[];
    arraybookings.push(bookings);
    console.log(bookings)
    let eventos="";
    // let booking = JSON.parse(bookings)
for (let i = 0; i < arraybookings.length; i++) {
    const el = arraybookings[i];
     eventos +=`
     { 
            'title'= ${el.event_name} ${el.booking_description},
            'start'= ${el.booking_date}T${el.start_time},
            'end'= ${el.booking_date}T${el.finish_time},
            'color'= 'blue',
            'textColor'= 'yellow'}`
        }
        return JSON.parse(eventos.trim())
    
}
   

const getBookingsAssignments = () => {
    let bookings_assignments = document.getElementById('bookings_assignments').textContent
    console.log(bookings_assignments)
    // let booking_assignments = JSON.parse(bookings_assignments)
    let materias = bookings_assignments.foreach(el => {
        return {
            title: el.assignment_name, // Borra lo de id aula
            // title: el.classroom_id + " - " + el.classroom_name, //borrar
            description: el.booking_description,
            start: el.booking_date + "T" + el.start_time,
            end: el.booking_date + "T" + el.finish_time,
            color: 'green',
            textColor: 'white'

        }
    });

    return materias
}
const filter = (value) => {
    $select = document.getElementById('select')
    for (let i = 0; i < $select.length; i++) {
        const option = $select[i];
        if (parseInt(option.getAttribute('data-capacity')) < value) {
            option.classList.add('d-none')
        } else {
            option.classList.remove('d-none')
        }
    }
}

let $inputParticipants = document.getElementById('participants')

$inputParticipants.addEventListener('keyup', e => {
    participants = $inputParticipants.value
    filter(participants)
})


$('#select').on('change' , function (e) {

    var calendarEl = document.getElementById('calendar');
    let eventos = getBookings();
    let materias = getBookingsAssignments();
    console.log(eventos);
    let rta = eventos.concat(materias);
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: "es",
        headerToolbar: {
            left: 'prev, next, today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek'
        },
        timeZone: 'local',
        events: rta,
        contentHeight: 600,
        // eventColor: '#378006',
        // dateClick: function(info) {
        //     alert('info:' + info.date)
        // }
    });
         // calendar.eventAdd(event[])
        calendar.render();
    
});
