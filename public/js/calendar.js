const getBookings = () => {
    let bookings = document.getElementById('bookings').textContent
    let booking = JSON.parse(bookings)
    let eventos = booking.map(el => {
        return {
            title: `${el.event_name} ${el.booking_description}`,
            start: el.booking_date,
            finish: "2022-06-09 " + el.finish_time
        }
    });

    return eventos
}
const getBookingsAssignments = () => {
    let bookings_assignments = document.getElementById('bookings_assignments').textContent
    let booking_assignments = JSON.parse(bookings_assignments)
    let materias = booking_assignments.map(el => {
        return {
            title: el.assignment_name,
            description: el.booking_description,
            start: el.booking_date,
            finish: "2022-06-09"
        }
    });

    return materias
}
const filter = (value) => {
    $select = document.getElementById('select')
    for (let i = 0; i < $select.length; i++) {
        const option = $select[i];
        if (parseInt(option.getAttribute('data-capacity')) < value) {
            console.log($select[i])
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


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    let materias = getBookingsAssignments();
    let eventos = getBookings()


    let rta = Object.assign(materias, eventos)

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev, next, today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek'
        },
        contentHeight: 600,
        events: rta,
        eventColor: '#378006'
    });

    calendar.render();
});