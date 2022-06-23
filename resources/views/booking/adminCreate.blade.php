@extends('layouts.app')

@section('styles')
    <style>
        button {
            box-shadow: 1px 1px 3px #00000094;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <h3 class="text-center m-4">¿Reserva de <span class="text-secondary fst-italic">evento masivo</span> o <span
                class="text-secondary fst-italic">materia</span>?</h3>
        <div class="row">
            <div class="d-flex justify-content-center">
                <form id="formAdminCreate" class="createEventAssignment w-50" method="POST"
                    action="{{ route('bookings.store') }}" width="400px">
                    @csrf
                    {{-- Dependiendo del tipo de reserva, se visualizarán inputs distintos dentro del formulario --}}
                    <div class="mb-3">
                        <span>Seleccione tipo de reserva</span>
                        @isset($petition)
                            <select class="form-select" name="optionType" id="optionType" disabled>
                            @else
                                <select class="form-select" name="optionType" id="optionType">
                                @endisset
                                <option disabled selected>Tipo...</option>
                                @isset($petition)
                                    <option value="assignment" selected disabled>Reserva Materia</option>
                                @else
                                    <option value="assignment">Reserva Materia</option>
                                @endisset
                                <option value="massiveEvent">Reserva Evento Masivo</option>
                            </select>
                    </div>
                    {{-- -------------------------------------------------------------------------------------------------------------------------- --}}
                    {{-- RESERVA SOLO DE MATERIAS --}}

                    {{-- materias disponibles --}}
                    <div class="assignment d-none">
                        <div class="mb-3">
                            <label for="assignment_id" class="form-label d-block">Materia</label>
                            @isset($petition)
                                <select name="assignment_id" class="form-select select2-assignment" aria-label="Materia"
                                    style="width: 100%;" disabled>
                                @else
                                    <select name="assignment_id" class="form-select select2-assignment" aria-label="Materia"
                                        style="width: 100%;">
                                    @endisset
                                    <option value="-1" disabled></option>
                                    @foreach ($assignments as $assignment)
                                        @isset($petition)
                                            @if ($assignment->id === $petition->assignment_id)
                                                <option value="{{ $assignment->id }}" selected>
                                                    {{ $assignment->assignment_name }}
                                                </option>
                                            @else
                                                <option value="{{ $assignment->id }}">
                                                    {{ $assignment->assignment_name }}
                                                </option>
                                            @endif
                                        @else
                                            <option value="{{ $assignment->id }}">
                                                {{ $assignment->assignment_name }}
                                            </option>
                                        @endisset
                                    @endforeach
                                </select>
                                {{-- <small id="errorCreateAssignmentName"></small> --}}
                        </div>

                        <div class="row">
                            {{-- fecha inicio materia --}}
                            <div class="mb-3 col">
                                <label for="start_date" class="form-label">Fecha inicio</label>
                                @isset($petition)
                                    <input type="date" class="form-control start_date" name="start_date" id="createStartDate"
                                        value="{{ $petition->start_date }}" disabled>
                                @else
                                    <input type="date" class="form-control start_date" name="start_date"
                                        id="createStartDate">
                                @endisset
                                {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                            </div>

                            {{-- fecha fin materia --}}
                            <div class="mb-3 col">
                                <label for="finish_date" class="form-label">Fecha fin</label>
                                @isset($petition)
                                    <input type="date" class="form-control finish_date" name="finish_date"
                                        id="createFinishDate" value="{{ $petition->finish_date }}" disabled>
                                @else
                                    <input type="date" class="form-control finish_date" name="finish_date"
                                        id="createFinishDate">
                                @endisset
                                {{-- <small id="errorCreateAssignmentFinishDate"></small> --}}
                            </div>
                        </div>

                        {{-- tipo de aula materia --}}
                        <div class="mb-3 col">
                            <label for="type" class="form-label">Tipo de aula</label>
                            @isset($petition)
                                <select name="classroom_type" class="form-select classroom_type" style="width: 100%;" disabled>
                                @else
                                    <select name="classroom_type" class="form-select classroom_type" style="width: 100%;">
                                    @endisset
                                    {{-- ... --}}
                                    <option value="-1" disabled="" selected="">Seleccione un tipo de aula</option>
                                    @isset($petition)
                                        @if ($petition->classroom_type === 'Laboratorio')
                                            <option value="Laboratorio" selected>Laboratorio</option>
                                            <option value="Aula común">Aula común</option>
                                        @else
                                            <option value="Laboratorio">Laboratorio</option>
                                            <option value="Aula común" selected>Aula común</option>
                                        @endif
                                    @else
                                        <option value="Laboratorio">Laboratorio</option>
                                        <option value="Aula común">Aula común</option>
                                    @endisset
                                </select>
                                <p class="alerta d-none" id="errorType">Error</p>
                        </div>

                        {{-- participantes de materia --}}
                        <div class="mb-3 col">
                            <label for="cantParticipants" class="form-label">Cantidad de participantes</label><br>
                            <label for="cantParticipants" class="bg-warning p-2 bg-opacity-25">Recuerde que la cantidad
                                debe
                                ser particionada según la cantidad total de reservas a registrar</label>
                            @isset($petition)
                                <input class="form-control participants" name="participants" type="text"
                                    value="{{ $petition->estimated_people }}" disabled>
                            @else
                                <input class="form-control participants" name="participants" type="text" placeholder="60">
                            @endisset

                            {{-- <small id="errorCantParticipants"></small> --}}
                        </div>

                        <hr size="5">

                        {{-- se incluye el contenido del formulario para materia --}}
                        @include('booking.moduleAdminCreate')
                    </div>

                    {{-- -------------------------------------------------------------------------------------------------------------------------- --}}
                    {{-- RESERVA DE EVENTOS MASIVOS --}}

                    {{-- nombre del evento --}}
                    <div class="massiveEvent d-none">
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Nombre del evento</label>
                            <input type="text" class="form-control" name="event_name" id="createName"
                                placeholder="GDG">
                            <small id="errorCreateBookingName"></small>
                        </div>

                        {{-- descripción del evento --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description" id="createDescription">
                            <small id="errorCreateBookingDescription"></small>
                        </div>


                        {{-- fecha evento (masivo) --}}
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Fecha de evento</label>
                            <input type="date" class="form-control bookingDate" name="booking_date" id="event_date">
                            {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                        </div>

                        {{-- participantes de evento masivo --}}
                        <div class="mb-3 col">
                            <label for="cantParticipants" class="form-label">Cantidad de participantes</label>
                            <label for="cantParticipants" class="bg-warning p-2 bg-opacity-25">Recuerde que la cantidad
                                debe
                                ser particionada según la cantidad total de reservas a registrar</label>
                            <input class="form-control participantsMassiveEvent" name="participants_event" type="text"
                                placeholder="60">
                            {{-- <small id="errorCantParticipantsEvent"></small> --}}
                        </div>

                        <hr size="5">

                        {{-- se incluye el contenido del formulario para evento masivo --}}
                        @include('booking.moduleAdminCreateEvent')

                    </div>

                    {{-- input hidden con arreglo de local storage --}}
                    {{-- mediante este arreglo se accede a los valores ingresados en formulario, en bookingController --}}
                    <input type="hidden" name="arrayLocal" id="arrayLocal" value="">

                    {{-- boton submit del formulario --}}
                    <div class="row">
                        <div class="text-center">
                            <button id="createBooking" type="submit" class="btn btn-primary w-100 d-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                Cargar todas las reservas
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>



    {{-- modal con información de reservas cargadas en formulario --}}
    <div class="modal fade text-center" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Datos de reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- ... --}}
                </div>
                <div class="modal-footer">
                    {{-- ... --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @isset($petition)
        <script>
            $('.assignment').removeClass('d-none');
            $('#addBooking').removeClass('d-none');
            $('.days').attr('disabled', false);
            $('.massiveEvent').addClass('d-none');
            $('#btnViewModal').addClass('d-none');
            $('#btnViewModalMassiveEvent').addClass('d-none');
            $('#createBooking').addClass('d-none');
            var bookings = [];
            window.localStorage.setItem('bookings', JSON.stringify(bookings));
        </script>
    @endisset
    {{-- Select2 de Booking --}}
    <script src="{{ asset('js/bookings/select2.js') }}" defer></script>
    <script>
        // SCRIPT PARA MOSTRAR EL FORMULARIO DE MATERIA O EVENTO MASIVO
        $("#optionType").change(function() {
            // se busca la opcion seleccionada y condiciona lo que se muestra/oculta según el tipo de reserva
            var opcion = $(this).find('option:selected').val();
            if (opcion === "assignment") { // si la opción es materia
                $('.assignment').removeClass('d-none');
                $('.massiveEvent').addClass('d-none');
                $('#addBooking').removeClass('d-none');
                $('#btnViewModal').addClass('d-none');
                $('#btnViewModalMassiveEvent').addClass('d-none');
                $('#createBooking').addClass('d-none');
                var bookings = [];
                window.localStorage.setItem('bookings', JSON.stringify(bookings));
            } else { // si es evento masivo
                $('.assignment').addClass('d-none');
                $('.massiveEvent').removeClass('d-none');
                $('#addBookingMassiveEvent').removeClass('d-none');
                $('#btnViewModal').addClass('d-none');
                $('#btnViewModalMassiveEvent').addClass('d-none');
                $('#createBooking').addClass('d-none');
                var bookings = [];
                window.localStorage.setItem('bookings', JSON.stringify(bookings));
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // inicialización de arreglo vacio para datos del form en local storage
            // var bookings = [];
            // window.localStorage.setItem('bookings', JSON.stringify(bookings));
            // console.log(JSON.parse(localStorage.getItem('bookings')));

            // accion para modal (reserva de materia)
            $('#btnViewModal').on('click', function() {
                $('.modal-body').empty();
                var bookingsList = JSON.parse(localStorage.getItem('bookings'));
                bookingsList.forEach(booking => {
                    $('.modal-body').append(
                        `
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Dia de clase: ${booking['day']}</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Horario de comienzo: ${booking['start_time']}</li>
                                            <li class="list-group-item">Horario de fin: ${booking['finish_time']}</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        `
                    )
                });
            })

            // accion para modal (reserva evento masivo)
            $('#btnViewModalMassiveEvent').on('click', function() {
                $('.modal-body').empty();
                var bookingsList = JSON.parse(localStorage.getItem('bookings'));
                bookingsList.forEach(booking => {
                    var fecha = 'No disponible';
                    if (booking['booking_date'] != '') {
                        var arrayDate = booking['booking_date'].split('-');
                        var anio = arrayDate[0];
                        var mes = arrayDate[1];
                        var dia = arrayDate[2];
                        fecha = dia + '/' + mes + '/' + anio;
                    }
                    $('.modal-body').append(
                        `
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Fecha de evento: ${fecha}</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Horario de comienzo: ${booking['start_time']}</li>
                                            <li class="list-group-item">Horario de fin: ${booking['finish_time']}</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        `
                    )
                });
            })
            // ON CHANGE DE INPUT PARTICIPANTS DE EVENTO MASIVO
            $('.participantsMassiveEvent').on('change', function() {
                $('.classroomsMassiveEvent').empty();
                $('.classroomsMassiveEvent').append(`<option disabled selected>Aula...</option>`)
                $('.classroomsMassiveEvent').attr('disabled', true);


                var participants = $(this).val();
                var bookingDate = $('.bookingDate').val();

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    type: "POST",
                    url: `/bookings/create/getrooms`,
                    cache: false,
                    data: {
                        participants: participants,
                        booking_date: bookingDate,
                    },
                    success: function(response) {
                        $('.classroomsMassiveEvent').removeAttr('disabled');
                        response.forEach(function(elem) {
                            $('.classroomsMassiveEvent').append(
                                `<option value='${elem.id}'>${elem.classroom_name} Capacidad: ${elem.capacity} </option>`
                            )
                        })
                    }
                });
            });

            // ON CHANGE DE INPUT PARTICIPANTS DE MATERIA
            $('.participants').on('change', function() {
                $('.days').find('option:selected').remove('selected');
                $('.days').find($('.days').val('-1')).add('selected');
                if ($(this).val() != '') {
                    $('.days').removeAttr('disabled');

                } else {
                    $('.days').attr('disabled', true);
                }
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.start_time').append(`<option disabled selected>Elija una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
            });

            // onchange dias de materia para obtener aulas
            $('.days').on('change keyup', function() {
                $('.classrooms').empty();
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.classrooms').append(`<option disabled selected>Aula...</option>`)
                $('.start_time').append(`<option disabled selected>Elija una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                if ($(this).val() != '') {
                    $('.classrooms').removeAttr('disabled');
                } else {
                    $('.classrooms').attr('disabled', true);
                }
                var participants = $('.participants').val();
                var day = $(this).find('option:selected').val();
                var type = $('.classroom_type').find('option:selected').val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    type: "POST",
                    url: `/bookings/create/getrooms`,
                    cache: false,
                    data: {
                        participants: participants,
                        day: day,
                        classroom_type: type
                    },
                    success: function(response) {
                        response.forEach(function(elem) {
                            $('.classrooms').append(
                                `<option value='${elem.id}'>${elem.classroom_name} Capacidad: ${elem.capacity} </option>`
                            )
                        })
                    }
                });
            });

            // ONCHANGE DE AULAS (MATERIA)
            $('.classrooms').on('change', function() {
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.start_time').attr('disabled', false);
                var fechaInicio = $('.start_date').val();
                var fechaFin = $('.finish_date').val();
                var day = $('.days').val();
                var aula = $(this).val();
                var inicioArr = [];

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    type: "POST",
                    url: `/bookings/assignmentperiods`,
                    cache: false,
                    data: {
                        start_date: fechaInicio,
                        finish_date: fechaFin,
                        classroom_id: aula,
                        day: day
                    },
                    success: function(data) {

                        if (data.length > 1) {
                            data.forEach(function(elem) {
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
                            for (let k = 0; k < data[0].length - 1; k++) {
                                $('.start_time').append(
                                    `<option value="${data[0][k]}" data-position-startset="${k}" data-position-hourset="${k}">${data[0][k]}</option>`
                                )
                            }
                        }
                    }
                });
            });

            // ONCHANGE DE AULAS (EVENTO MASIVO)
            $('.classroomsMassiveEvent').on('change', function() {
                $('.start_timeMassiveEvent').empty();
                $('.finish_timeMassiveEvent').empty();
                $('.start_time').append(`<option disabled selected>Elija una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                $('.start_timeMassiveEvent').attr('disabled', false);
                var aula = $(this).val();
                var inicioArr = [];

                var fechaEvento = $('.bookingDate').val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    type: "POST",
                    url: `/bookings/periods`,
                    cache: false,
                    data: {
                        date: fechaEvento,
                        classroom_id: aula
                    },
                    success: function(data) {

                        if (data.length > 1) {
                            data.forEach(function(elem) {
                                elem.pop()
                                inicioArr.push(elem)
                            })
                            for (let i = 0; i < inicioArr.length; i++) {
                                for (let j = 0; j < inicioArr[i].length; j++) {
                                    $('.start_timeMassiveEvent').append(
                                        `<option value="${inicioArr[i][j]}" data-position-startset="${i}" data-position-hourset="${j}">${inicioArr[i][j]}</option>`
                                    )
                                }
                            }
                        } else {
                            for (let k = 0; k < data[0].length - 1; k++) {
                                $('.start_timeMassiveEvent').append(
                                    `<option value="${data[0][k]}" data-position-startset="${k}" data-position-hourset="${k}">${data[0][k]}</option>`
                                )
                            }
                        }
                    }
                });
            })

            // ONCHANGE DE HORA INICIO (MATERIA)
            $('.start_time').on('change', function() {
                $('.finish_time').empty();
                $('.finish_time').removeAttr('disabled');
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                var timeSet = $(this).find('option:selected').data("position-startset")
                var hourSet = $(this).find('option:selected').data("position-hourset")

                var aula = $('.classrooms').val();

                var fechaInicio = $('.start_date').val();
                var fechaFin = $('.finish_date').val();
                var day = $('.days').val();

                $.ajax({
                    type: 'POST',
                    url: `/bookings/assignmentperiods`,
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        start_date: fechaInicio,
                        finish_date: fechaFin,
                        classroom_id: aula,
                        day: day
                    },
                    success: function(data) {

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
            });

            // ONCHANGE HORA INICIO (EVENTO MASIVO)
            $('.start_timeMassiveEvent').on('change', function() {
                $('.finish_timeMassiveEvent').empty();
                $('.finish_timeMassiveEvent').removeAttr('disabled');
                $('.finish_timeMassiveEvent').append(`<option disabled selected>Elija una opción</option>`)
                var timeSet = $(this).find('option:selected').data("position-startset")
                var hourSet = $(this).find('option:selected').data("position-hourset")

                var aula = $('.classroomsMassiveEvent').val();
                var fechaReserva = $('.bookingDate').val();

                $('.classroomsMassiveEvent').removeAttr('disabled');

                $.ajax({
                    type: 'POST',
                    url: `/bookings/periods`,
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        date: fechaReserva,
                        classroom_id: aula
                    },
                    success: function(data) {

                        if (data.length > 1) {
                            for (let i = hourSet + 1; i < data[timeSet].length; i++) {
                                $('.finish_timeMassiveEvent').append(
                                    `<option value="${data[timeSet][i]}">${data[timeSet][i]}</option>`
                                )
                            }
                        } else {
                            for (let i = hourSet + 1; i < data[0].length; i++) {
                                $('.finish_timeMassiveEvent').append(
                                    `<option value="${data[0][i]}">${data[0][i]}</option>`
                                )
                            }
                        }
                    }
                });
            })
        });

        // accion del boton 'agregar reserva' para almacenar datos al localStorage (Materia)
        $('#addBooking').on('click', function(e) {
            var dia = $('.days').val();
            var aula = $('.classrooms').val();
            var horaInicio = $('.start_time').val();
            var horaFin = $('.finish_time').val();

            var arrayForm = {
                'day': dia,
                'classroom_id': aula,
                'start_time': horaInicio,
                'finish_time': horaFin
            };
            var localArray = JSON.parse(localStorage.getItem('bookings'));
            localArray.push(arrayForm);
            localStorage.setItem('bookings', JSON.stringify(localArray));

            // resetear campos de 'datos de reserva'
            $('.days').find('option:selected').remove('selected');
            $('.days').find($('.days').val('-1')).add('selected');
            $('.classrooms').empty();
            $('.start_time').empty();
            $('.finish_time').empty();
            $('.start_time').append(`<option disabled>Elija una opción</option>`);
            $('.finish_time').append(`<option disabled>Elija una opción</option>`);
            $('.classrooms').append(`<option disabled>Aula...</option>`);

            // habilitar boton para crear
            $('#createBooking').removeClass('d-none');
            $('#btnViewModal').removeClass('d-none');
        });

        // accion del boton 'agregar reserva' para almacenar datos al localStorage (Evento masivo)
        $('#addBookingMassiveEvent').on('click', function(e) {
            var aula = $('.classroomsMassiveEvent').val();
            var horaInicio = $('.start_timeMassiveEvent').val();
            var horaFin = $('.finish_timeMassiveEvent').val();
            var booking_date = $('.bookingDate').val();

            var arrayForm = {
                'classroom_id': aula,
                'start_time': horaInicio,
                'finish_time': horaFin,
                'booking_date': booking_date
            };

            var localArray = JSON.parse(localStorage.getItem('bookings'));
            localArray.push(arrayForm);
            localStorage.setItem('bookings', JSON.stringify(localArray));

            // resetear campos de 'datos de reserva'
            $('.classroomsMassiveEvent').empty();
            $('.start_timeMassiveEvent').empty();
            $('.finish_timeMassiveEvent').empty();
            $('.start_timeMassiveEvent').append(`<option disabled>Elija una opción</option>`);
            $('.finish_timeMassiveEvent').append(`<option disabled>Elija una opción</option>`);

            // habilitar boton para crear
            $('#createBooking').removeClass('d-none');
            $('#btnViewModalMassiveEvent').removeClass('d-none');
        });

        // Submit del formulario
        $('#createBooking').on('click', function(e) {
            $('#formAdminCreate').submit(function() {
                var arrayLocal = localStorage.getItem('bookings');
                $('#arrayLocal').val(arrayLocal);
            });
        });
    </script>
@endsection
