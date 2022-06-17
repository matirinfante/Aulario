$('.filtro').on('change', function (e) {
    $('.start_time').empty();
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

            //modificar como se muestra la fecha de materias
            //arreglar el calendario que se renderiza tarde
            $('#bookings').html(JSON.stringify(data[0]));
            $('#bookings_assignments').html(JSON.stringify(data[1]));

            var calendarEl = document.getElementById('calendar');
            let eventos = getBookings();
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
                dateClick: function (info) {

                    let today = new Date().toISOString().slice(0, 10);
                    var currentDate = Date.parse(today);
                    var chosenDate = Date.parse(info.dateStr);
                    var dif = chosenDate - currentDate;
                    if (dif >= 0 && dif <= 1209600000) {

                        $('.bookingDate').val(info.dateStr);
                        $('.participants').val($('#participants').val());
                        let optionClassroom = $('#select').find('option:selected').val();
                        let classroomName = $('#select').find('option:selected').data('classroomName');
                        $('.classroomID').val(optionClassroom);
                        $('#classroomdata').text(classroomName);
                        // alert('info:' + info.date);
                        //no intentes comprender
                        $('#createModal').modal("show");
                        var url = `/bookings/periods`;
                        var classroomId = optionClassroom;
                        var date = $('.bookingDate').val();
                        var inicioArr = [];
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': window.CSRF_TOKEN
                            },
                            type: 'POST',
                            url: url,
                            cache: false,
                            data: {
                                classroom_id: classroomId,
                                date: date
                            },
                            success: function (data) {
                                console.log(data)
                                if (data.length > 1) {
                                    data.forEach(function (elem) {
                                        elem.pop()
                                        inicioArr.push(elem)
                                    })
                                    for (let i = 0; i < inicioArr.length; i++) {
                                        for (let j = 0; j < inicioArr[i].length; j++) {
                                            $('.start_time').append(
                                                `<option value="${inicioArr[i][j]}" data-position-startset="${i}" data-position-hourset="${j}">${inicioArr[i][j]}</option>`
                                            )
                                        }
                                    }
                                } else {
                                    if (data.length === 0) {
                                        $('.start_time').append(
                                            `<option value="" data-position-startset="" data-position-hourset="" disabled>NO HAY DATOS</option>`
                                        )
                                    } else {
                                        for (let k = 0; k < data[0].length; k++) {
                                            $('.start_time').append(
                                                `<option value="${data[0][k]}" data-position-startset="${k}" data-position-hourset="${k}">${data[0][k]}</option>`
                                            )
                                        }
                                    }
                                }
                            }
                        });

                        $('.start_time').on('change', function () {
                            $('.finish_time').empty();
                            $('.finish_time').removeAttr('disabled');
                            $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                            var timeSet = $(this).find('option:selected').data("position-startset")
                            var hourSet = $(this).find('option:selected').data("position-hourset")
                            var endTime = []
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': window.CSRF_TOKEN
                                },
                                type: 'POST',
                                url: url,
                                cache: false,
                                data: {
                                    classroom_id: classroomId,
                                    date: date
                                },
                                success: function (data) {
                                    if (data.length > 1) {
                                        for (let i = hourSet + 1; i < data[timeSet].length; i++) {
                                            $('.finish_time').append(
                                                `<option value="${data[timeSet][i]}">${data[timeSet][i]}</option>`
                                            )
                                        }
                                    } else {
                                        for (let i = hourSet + 1; i < data[0].length; i++) {
                                            $('.finish_time').append(
                                                `<option value="${data[0][i]}">${data[0][i]}</option>`
                                            )
                                        }
                                    }
                                }
                            });
                        })


                    }
                }
            });
            // calendar.eventAdd(event[])
            calendar.render();

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
            end: el.booking_date + "T" + el.finish_time
        }
    });

    return eventos
}


const getBookingsAssignments = () => {
    let bookings_assignments = document.getElementById('bookings_assignments').textContent

    let booking_assignments = JSON.parse(bookings_assignments)

    let materias = booking_assignments.map(ba => {
        return {
            title: ba.assignment_name, // Borra lo de id aula
            // title: el.classroom_id + " - " + el.classroom_name, //borrar
            description: ba.booking_description,
            start: ba.booking_date + "T" + ba.start_time,
            end: ba.booking_date + "T" + ba.finish_time,
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

$('#bookings').on('change', e => {
    console.log('hola holaaa')
})


// $('#select').on('change', function(e) {

//     var calendarEl = document.getElementById('calendar');
//     let eventos = getBookings();
//     let materias = getBookingsAssignments();

//     let rta = eventos.concat(materias);
//     var calendar = new FullCalendar.Calendar(calendarEl, {
//         initialView: 'dayGridMonth',
//         locale: "es",
//         headerToolbar: {
//             left: 'prev, next, today',
//             center: 'title',
//             right: 'dayGridMonth, timeGridWeek, listWeek'
//         },
//         timeZone: 'local',
//         events: rta,
//         contentHeight: 600,
//         // eventColor: '#378006',
//         // dateClick: function(info) {
//         //     alert('info:' + info.date)
//         // }
//     });
//     // calendar.eventAdd(event[])
//     calendar.render();

// });
