document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    let bookings = document.getElementById('bookings').textContent
    let bookings_assignments = document.getElementById('bookings_assignments').textContent

    let booking = JSON.parse(bookings)
    let booking_assignments = JSON.parse(bookings_assignments)


    let eventos = booking.map(el => {
        return {
            title: `${el.event_name} ${el.booking_description}`,
            start: el.booking_date,
            finish: "2022-06-09 " + el.finish_time
        }
    });

    let materias = booking_assignments.map(el => {
        console.log(el)
        return {
            title: el.assignment_name,
            description: el.booking_description,
            start: el.booking_date,
            finish: "2022-06-09 " + el.finish_time,
        }
    });

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