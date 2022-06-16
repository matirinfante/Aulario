
$('.form-select').on('change',function (e) {
let classroom_id=($(this).find('option:selected').val());
    $.ajax({
    
        type:'POST',
        url:`/bookings/filter`,
        cache:false,
        data:{_token:'{{csrf_token()}}',classroom_id:classroom_id},
        success:function(data){
            console.log(data)
        }
        
        
    })  

})
const getBookings = () => {
    let bookings = document.getElementById('bookings').textContent
    let booking = JSON.parse(bookings)
    let eventos = booking.map(el => {
        return {
            title: `${el.event_name} ${el.booking_description}`,
            // title: el.classroom_id + " - " + el.classroom_name, //borrar

            start: el.booking_date + "T" + el.start_time,
            end: el.booking_date + "T" + el.finish_time,
            color:'blue',
            textColor:'yellow'
        }
    });

    return eventos
}
const getBookingsAssignments = () => {
    let bookings_assignments = document.getElementById('bookings_assignments').textContent
    let booking_assignments = JSON.parse(bookings_assignments)
    let materias = booking_assignments.map(el => {
        return {
            title: el.assignment_name, // Borra lo de id aula
            // title: el.classroom_id + " - " + el.classroom_name, //borrar
            description: el.booking_description,
            start: el.booking_date + "T" + el.start_time,
            end: el.booking_date + "T" + el.finish_time,
            color:'green',
            textColor:'white'

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


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    $('#calendar').empty();
    let rta;
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
    calendar.render();
    let btnfilter=document.getElementById('filter-butom');

    btnfilter.addEventListener('click',function(e){
       
        // e.preventDefault();

    let eventos = getBookings()
    let materias = getBookingsAssignments();

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
})
});