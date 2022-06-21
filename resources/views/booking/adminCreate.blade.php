@extends('layouts.app')

@section('styles')
    <style>
        button {
            box-shadow: 1px 1px 3px #00000094;
        }
    </style>
@endsection

@section('content')
    @isset($petition)
    @endisset
    <div class="container-fluid">
        <h3 class="text-center m-4">¿Reserva de <span class="text-secondary fst-italic">evento masivo</span> o <span
                class="text-secondary fst-italic">materia</span>?</h3>
        <div class="row">
            <div class="d-flex justify-content-center">
                <form class="createEventAssignment w-50" method='POST' action="" width="400px">
                    @csrf
                    <div class="mb-3">
                        <span>Seleccione tipo de reserva</span>
                        <select class="form-select" name="optionType" id="optionType">
                            <option selected disabled>Tipo...</option>
                            <option value="assignment">Reserva Materia</option>
                            <option value="massiveEvent">Reserva Evento Masivo</option>
                        </select>
                    </div>
                    {{-- -------------------------------------------------------------------------------------------------------------------------- --}}
                    {{-- RESERVA SOLO DE MATERIAS --}}

                    {{-- materias disponibles --}}
                    <div class="assignment d-none">
                        <div class="mb-3">
                            <label for="assignment_id" class="form-label d-block">Materia</label>
                            <select name="assignment_id" class="form-select select2-assignment" aria-label="Materia"
                                required style="width: 100%;">
                                <option value="-1" disabled></option>
                                @foreach ($assignments as $assignment)
                                    <option value="{{ $assignment->id }}">
                                        {{ $assignment->assignment_name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <small id="errorCreateAssignmentName"></small> --}}
                        </div>

                        <div class="row">
                            {{-- fecha inicio --}}
                            <div class="mb-3 col">
                                <label for="start_date" class="form-label">Fecha inicio</label>
                                <input type="date" class="form-control" name="start_date" id="createStartDate" required>
                                {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                            </div>

                            {{-- fecha fin --}}
                            <div class="mb-3 col">
                                <label for="finish_date" class="form-label">Fecha fin</label>
                                <input type="date" class="form-control" name="finish_date" id="createFinishDate"
                                    required>
                                {{-- <small id="errorCreateAssignmentFinishDate"></small> --}}
                            </div>
                        </div>

                        {{-- profesores --}}
                        <div class="mb-3 col-md-5">
                            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
                            <select name="user_id[]" class="form-select select2-teacher" multiple="multiple"
                                aria-label="Profesor/a" style="width: 100%;">
                                <option value="-1" disabled></option>
                                {{-- @foreach ($users as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }},
                                        {{ $teacher->surname }}
                                    </option>
                                @endforeach --}}
                            </select>
                            {{-- <small id="errorCreateNameTeacher"></small> --}}
                        </div>

                        {{-- participantes --}}
                        <div class="mb-3 col">
                            <label for="cantParticipants" class="form-label">Cantidad de participantes</label>
                            <input class="form-control participants" name="participants" type="text" placeholder="120"
                                required>
                        </div>

                        <hr size="5">

                        @include('booking.moduleAdminCreate')
                    </div>

                    {{-- RESERVA DE EVENTOS MASIVOS --}}
                    <div class="massiveEvent d-none">
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Nombre del evento</label>
                            <input type="text" class="form-control" name="event_name" id="createName" placeholder="GDG"
                                required>
                            <small id="errorCreateBookingName"></small>
                        </div>

                        {{-- descripción --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description" id="createDescription" required>
                            <small id="errorCreateBookingDescription"></small>
                        </div>


                        {{-- fecha evento (masivo) --}}
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Fecha de evento</label>
                            <input type="date" class="form-control bookingDate" name="booking_date" id="event_date">
                            {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                        </div>

                        {{-- participantes --}}
                        <div class="mb-3 col">
                            <label for="cantParticipants" class="form-label">Cantidad de participantes</label>
                            <input class="form-control participants" name="participants" type="text" placeholder="120"
                                required>
                        </div>

                        <hr size="5">

                        {{-- datos de reserva --}}
                        @include('booking.moduleAdminCreateEvent')


                    </div>
                    <div class="row">
                        <div class="text-center mb-4">
                            <button id="addBooking" type="submit" class="btn btn-success w-100 d-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-patch-plus-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0z" />
                                </svg>
                                Añadir otra reserva
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center mb-4">
                            {{-- view modal button --}}
                            <button id="btnViewModal" type="button" class="btn btn-outline-secondary btn-sm d-none"
                                data-bs-toggle="modal" data-bs-target="#viewModal">Ver reservas creadas
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-center">
                            <button id="createBooking" type="submit" class="btn btn-primary w-100 d-none" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                </svg>
                                Crear
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Datos de reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>completar... (obtener datos de localStorage)</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
            integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- Select2 de materia --}}
    <script src="{{ asset('js/bookings/select2.js') }}" defer></script>
    <script>
        // SCRIPT PARA MOSTRAR EL FORMULARIO DE MATERIA O EVENTO MASIVO
        $("#optionType").change(function() {
            var opcion = $(this).find('option:selected').val();
            if (opcion === "assignment") {
                $('.assignment').removeClass('d-none');
                $('.massiveEvent').addClass('d-none');
                $('#addBooking').removeClass('d-none');
                $('.days').addClass('dayAssignment');
                $('.days').removeClass('dayMassiveEvent');
            } else {
                $('.assignment').addClass('d-none');
                $('.massiveEvent').removeClass('d-none');
                $('#addBooking').removeClass('d-none');
                $('.days').addClass('dayMassiveEvent');
                $('.days').removeClass('dayAssignment');
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            // inicialización de arreglo vacio para datos del form en local storage
            var bookings = [];
            window.localStorage.setItem('bookings', JSON.stringify(bookings));
            console.log(JSON.parse(localStorage.getItem('bookings')));


            $('.participants').on('change keyup', function() {

                $('.classrooms').empty();
                $('.classrooms').append(`<option disabled selected>Aula...</option>`)
                $('.classrooms').attr('disabled', true);
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

            // $('.createEventAssignment').repeaterVal();
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

            $('.classrooms').on('change', function() {
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.start_time').attr('disabled', false);
                var fechaInicio = $('.start_date').val();
                var fechaFin = $('.finish_date').val();
                var aula = $(this).val();
                var day = $('.days').val();
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
                        // console.log(data);
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

            $('.start_time').on('change', function() {
                $('.finish_time').empty();
                $('.finish_time').removeAttr('disabled');
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                var timeSet = $(this).find('option:selected').data("position-startset")
                var hourSet = $(this).find('option:selected').data("position-hourset")

                var aula = $('.classrooms').val();

                if ($(this).hasClass('dayAssignment')) {
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
                            // console.log(data);
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
                } else {
                    // ajax para evento masivo
                    var fechaReserva = $('.bookingDate').val();
                    $('.classrooms').removeAttr('disabled');
                    
                    $.ajax({
                        type: 'POST',
                        url: `/bookings/periods`,
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            booking_date: fechaReserva,
                            classroom_id: aula,
                        },
                        success: function(data) {
                            // console.log(data);
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
                }
            })
        });

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

            // habilitar boton para crear
            $('#createBooking').removeClass('d-none');
            $('#btnViewModal').removeClass('d-none');
        });
    </script>
@endsection
