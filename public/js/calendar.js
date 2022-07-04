
$(".filtro").on("change", function (e) {
    $(".start_time").empty();

    let classroom_id = $(this).find("option:selected").val();
    let mensaje= "Aula Seleccionada: "
    //select del aula
    let name= $("#select").find("option:selected").data().classroomname;
   let h3=document.getElementById("classroom_name")
    h3.textContent=mensaje+name;
    h3.classList.remove("d-none");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": window.CSRF_TOKEN,
        },
        type: "POST",
        url: `/bookings/filter`,
        cache: false,
        data: {
            classroom_id: classroom_id,
        },
        success: function (data) {
            // Se asigna el valor a un div
            $("#bookings").html(JSON.stringify(data[0]));
            $("#bookings_assignments").html(JSON.stringify(data[1]));

            //Se obtienen los objetos eventos y materias con la informacion del front
            var calendarEl = document.getElementById("calendar"); //guarda el calendario en una variable
            let eventos = getBookings();
            let materias = getBookingsAssignments();

            let rta = eventos.concat(materias);// se unen un una sola variable

            var calendar = new FullCalendar.Calendar(calendarEl, { //se inicializa el calendario, con el formato indicado por la libreria
                initialView: "dayGridMonth",
                locale: "es",
                headerToolbar: {
                    left: "prev, next, today",
                    center: "title",
                    right: "dayGridMonth, timeGridWeek, listWeek",
                },
                timeZone: "local",
                events: rta,
                contentHeight: 600,
                dateClick: function (info) { //se hace click en un dia
                    let today = new Date().toISOString().slice(0, 10); //se extra solo la fecha
                    var currentDate = Date.parse(today); 
                    var chosenDate = Date.parse(info.dateStr);
                    var dif = chosenDate - currentDate;
                    if (dif >= 0 && dif <= 1209600000) {
                        $(".bookingDate").val(info.dateStr);
                        $(".participants").val($("#participants").val());
                        let optionClassroom = $("#select")
                            .find("option:selected")
                            .val();
                        let classroomName = $("#select")
                            .find("option:selected")
                            .data("classroomName");
                        $(".classroomID").val(optionClassroom);
                        $("#classroomdata").text(classroomName);
                       
                        $("#createModal").modal("show");
                        var url = `/bookings/periods`; //se obtienen los rangos de disponibilidad del aula
                        var classroomId = optionClassroom;
                        var date = info.dateStr;
                        var inicioArr = [];
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": window.CSRF_TOKEN,
                            },
                            type: "POST",
                            url: url,
                            cache: false,
                            data: {
                                classroom_id: classroomId,
                                date: date,
                            },
                            success: function (data) {
                                $(".start_time").empty();
                                $(".finish_time").empty();
                                if (data.length > 1) {
                                    data.forEach(function (elem) {
                                        elem.pop();
                                        inicioArr.push(elem);
                                    });
                                    for (let i = 0; i < inicioArr.length; i++) {
                                        for (
                                            let j = 0;
                                            j < inicioArr[i].length;
                                            j++
                                        ) {
                                            $(".start_time").append(
                                                `<option value="${inicioArr[i][j]}" data-position-startset="${i}" data-position-hourset="${j}">${inicioArr[i][j]}</option>`
                                            );
                                        }
                                    }
                                } else {
                                    if (data.length === 0) {
                                        $(".start_time").append(
                                            `<option value="" data-position-startset="" data-position-hourset="" disabled selected>No existen horarios disponibles</option>`
                                        );
                                    } else {
                                        data[0].pop();
                                        for (
                                            let k = 0;
                                            k < data[0].length;
                                            k++
                                        ) {
                                            $(".start_time").append(
                                                `<option value="${data[0][k]}" data-position-startset="${k}" data-position-hourset="${k}">${data[0][k]}</option>`
                                            );
                                        }
                                    }
                                }
                            },
                        });
                    }
                },
            });
          
            calendar.render();
        },
    });
});

$(".start_time").on("change", function () {
    var url = `/bookings/periods`;
    var classroomId = $("#select").find("option:selected").val();
    var date = $(".bookingDate").val();
    $(".finish_time").removeAttr("disabled");
    $(".finish_time").append(
        `<option disabled selected>Elija una opción</option>`
    );
    var timeSet = $(this).find("option:selected").data("position-startset");
    var hourSet = $(this).find("option:selected").data("position-hourset");
    var endTime = [];
    
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": window.CSRF_TOKEN,
        },
        type: "POST",
        url: url,
        cache: false,
        data: {
            classroom_id: classroomId,
            date: date,
        },
        success: function (data) {
            $(".finish_time").empty();
            if (data.length > 1) {
                for (let i = hourSet + 1; i < data[timeSet].length; i++) {
                    $(".finish_time").append(
                        `<option value="${data[timeSet][i]}">${data[timeSet][i]}</option>`
                    );
                }
            } else {
                for (let i = hourSet + 1; i < data[0].length; i++) {
                    $(".finish_time").append(
                        `<option value="${data[0][i]}">${data[0][i]}</option>`
                    );
                }
            }
        },
    });
});

const getBookings = () => {
    let bookings = document.getElementById("bookings").textContent;

    let booking = JSON.parse(bookings);

    let eventos = booking.map((el) => {
        return {
            title: `${el.event_name} ${el.booking_description}`,
            start: el.booking_date + "T" + el.start_time,
            end: el.booking_date + "T" + el.finish_time,
        };
    });

    return eventos; //se retornan los eventos existentes con el formato requerido
};

const getBookingsAssignments = () => {
    let bookings_assignments = document.getElementById(
        "bookings_assignments"
    ).textContent;

    let booking_assignments = JSON.parse(bookings_assignments);

    let materias = booking_assignments.map((ba) => {
        return {
            title: ba.assignment_name, // Borra lo de id aula
            // title: el.classroom_id + " - " + el.classroom_name, //borrar
            description: ba.booking_description,
            start: ba.booking_date + "T" + ba.start_time,
            end: ba.booking_date + "T" + ba.finish_time,
            color: "green",
            textColor: "white",
        };
    });

    return materias;//se retornan las materias existentes con el formato requerido
};
const filter = (value) => {
    $select = document.getElementById("select");

    for (let i = 0; i < $select.length; i++) {
        const option = $select[i];
        if (parseInt(option.getAttribute("data-capacity")) < value) {
            option.classList.add("d-none");
        } else {
            option.classList.remove("d-none");
        }
    }
};

let $inputParticipants = document.getElementById("participants");

$inputParticipants.addEventListener("keyup", (e) => {
   //Si el valor del select se modifica despues de cargado el formulario, desaparece el calendar
    $('#calendar').html("");

    participants = $inputParticipants.value;
   
    comp1 = !isNaN(participants); //Devuelve true si es numero
    comp2 = participants != "" && participants > 0; //
  
   //si la cantidad de participantes es mayor a 120 se muestra el mensaje para cargar peticion
    if (comp1 && comp2) {
        //fixme numero de participantes sea dinamico en base a las aulas de INFORMATICA 
        // ver lo del link del boton(ademas no tiene permisos)
        if (participants > 120)  {
            $("#aviso_reserva").html(`<div class="alert alert-warning">Supero la cantidad de participantes cargue una peticion  </div>
            <button type="" class="btn btn-primary m-3 w-50" data-bs-toggle="modal"
                        data-bs-target="#mailModal" id="buttonCreate"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                      </svg> Solicitar Reserva</button>`)
            
            $("#select-aula").addClass("d-none");
            $('#calendar').addClass("d-none");
        } else {
            filter(participants);
            $("#select-aula").removeClass("d-none");
            $('#calendar').removeClass("d-none");
            $("#aviso_reserva").html('')
        }
    } else {

        $("#select-aula").addClass("d-none");
        $("#aviso_reserva").html('')
    }
   
});
