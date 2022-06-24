@extends('layouts.app')

@section('styles')
    <style>
        button {
            box-shadow: 1px 1px 3px #00000094;
        }

        button.btn.btn-sm.btn-light {
            box-shadow: none;
            padding: 0;
        }

        .menu_sup.navbar-light .navbar-toggler {
            box-shadow: none;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <h3 class="text-center m-4">¿Reserva de <span class="text-secondary fst-italic">evento masivo</span> o <span
                class="text-secondary fst-italic">materia</span>?</h3>
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
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
                            <label for="assignment_id" class="form-label d-block">Materia <span class="text-secondary">(Paso
                                    1)</span></label>
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
                                <label for="start_date" class="form-label">Fecha inicio <span class="text-secondary">(Paso
                                        2)</span></label>
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
                                <label for="finish_date" class="form-label">Fecha fin <span class="text-secondary">(Paso
                                        3)</span></label>
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

                        <div class="row">
                            {{-- tipo de aula materia --}}
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label for="type" class="form-label">Tipo de aula <span class="text-secondary">(Paso
                                        4)</span></label>
                                @isset($petition)
                                    <select name="classroom_type" class="form-select classroom_type" disabled>
                                    @else
                                        <select name="classroom_type" class="form-select classroom_type">
                                        @endisset
                                        {{-- ... --}}
                                        <option value="-1" disabled="" selected="">Seleccione un tipo de aula
                                        </option>
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
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label for="cantParticipants" class="form-label">Cantidad de participantes <span
                                        class="text-secondary">(Paso 5)</span><button type="button"
                                        class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top"
                                        title="Si la reserva a realizar tiene más participantes de los permitidos, debe realizar 2 o más reservas. Ej: 120 participantes son 2 reservas de 60 personas."><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#d99949" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </button></label><br>
                                @isset($petition)
                                    <input class="form-control participants" name="participants" type="text"
                                        value="{{ $petition->estimated_people }}" disabled>
                                @else
                                    <input class="form-control participants" name="participants" type="text"
                                        placeholder="60">
                                @endisset

                                {{-- <small id="errorCantParticipants"></small> --}}
                            </div>
                        </div>

                        <hr size="5" class="mt-2 mb-2">

                        {{-- se incluye el contenido del formulario para materia --}}
                        @include('booking.moduleAdminCreate')
                    </div>

                    {{-- -------------------------------------------------------------------------------------------------------------------------- --}}
                    {{-- RESERVA DE EVENTOS MASIVOS --}}

                    {{-- nombre del evento --}}
                    <div class="massiveEvent d-none">
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Nombre del evento <span
                                    class="text-secondary">(Paso 1)</span></label>
                            <input type="text" class="form-control nameMassiveEvent" name="event_name"
                                id="createName" placeholder="Nombre del evento">
                            <small id="errorCreateBookingName"></small>
                        </div>

                        {{-- descripción del evento --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción <span class="text-secondary">(Paso
                                    2)</span></label>
                            <input type="text" class="form-control" name="description" id="createDescription"
                                placeholder="Descripción del evento (Opcional)">
                            <small id="errorCreateBookingDescription"></small>
                        </div>


                        <div class="row">
                            {{-- fecha evento (masivo) --}}
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label for="event_date" class="form-label">Fecha de evento <span
                                        class="text-secondary">(Paso
                                        3)</span></label>
                                <input type="date" class="form-control bookingDate" name="booking_date"
                                    id="event_date">
                                {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                            </div>

                            {{-- participantes de evento masivo --}}
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label for="cantParticipants" class="form-label">Cantidad de participantes <span
                                        class="text-secondary">(Paso 4)</span><button type="button"
                                        class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top"
                                        title="Si la reserva a realizar tiene más participantes de los permitidos, debe realizar 2 o más reservas. Ej: 120 participantes son 2 reservas de 60 personas."><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#d99949" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </button></label><br>
                                <input class="form-control participantsMassiveEvent" name="participants_event"
                                    type="text" placeholder="60">
                                {{-- <small id="errorCantParticipantsEvent"></small> --}}
                            </div>
                        </div>

                        <hr size="5" class="mt-2 mb-2">

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
            var modalData = [];
            window.localStorage.setItem('bookings', JSON.stringify(bookings));
            window.localStorage.setItem('modalData', JSON.stringify(modalData));
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
                var modalData = [];
                window.localStorage.setItem('modalData', JSON.stringify(modalData));

            } else { // si es evento masivo
                $('.assignment').addClass('d-none');
                $('.massiveEvent').removeClass('d-none');
                $('#addBookingMassiveEvent').removeClass('d-none');
                $('#btnViewModal').addClass('d-none');
                $('#btnViewModalMassiveEvent').addClass('d-none');
                $('#createBooking').addClass('d-none');
                var bookings = [];
                window.localStorage.setItem('bookings', JSON.stringify(bookings));
                var modalData = [];
                window.localStorage.setItem('modalData', JSON.stringify(modalData));

            }
        });
    </script>
    <script>
        function deleteAssignmentItem(indexAssignment) {
            var bookingsList = JSON.parse(localStorage.getItem('bookings'));
            var nuevoArray = [];
            for (let index = 0; index < bookingsList.length; index++) {
                if (index != indexAssignment) {
                    nuevoArray.push(bookingsList[index])
                }
            }
            window.localStorage.setItem('bookings', JSON.stringify(nuevoArray));
            $('#viewModal').modal('hide');
        };
    </script>
    <script>
        $(document).ready(function() {

            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

            // inicialización de arreglo vacio para datos del form en local storage
            // var bookings = [];
            // window.localStorage.setItem('bookings', JSON.stringify(bookings));
            // console.log(JSON.parse(localStorage.getItem('bookings')));

            // accion para modal (reserva de materia)
            $('#btnViewModal').on('click', function() {
                $('.modal-body').empty();
                var bookingsList = JSON.parse(localStorage.getItem('bookings'));
                var datosModal = JSON.parse(localStorage.getItem('modalData'));

                for (var index = 0; index < bookingsList.length; index++) {
                    $('.modal-body').append(
                        `
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Día de clases: ${bookingsList[index]['day']}</h5>
                                    <p>${datosModal[index]['inicio']} a ${datosModal[index]['fin']}</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>${datosModal[index]['materia']}</strong></li>
                                            <li class="list-group-item">${datosModal[index]['aula']} (${datosModal[index]['tipoAula']})</li>
                                            <li class="list-group-item">Reserva para ${datosModal[index]['cant']} participantes</li>
                                            <li class="list-group-item">Horario de comienzo: ${bookingsList[index]['start_time']}</li>
                                            <li class="list-group-item">Horario de fin: ${bookingsList[index]['finish_time']}</li>
                                        </ul> 
                                        <button type="button" class="btn btn-sm btn-outline-danger w-50" onclick="deleteAssignmentItem(${index});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            Eliminar reserva
                                        </button>    
                                </div>
                            </div>
                        </div>
                        `
                    )
                }
            });



            // accion para modal (reserva evento masivo)
            $('#btnViewModalMassiveEvent').on('click', function() {
                $('.modal-body').empty();
                var bookingsList = JSON.parse(localStorage.getItem('bookings'));
                var datosModal = JSON.parse(localStorage.getItem('modalData'));

                for (var index = 0; index < bookingsList.length; index++) {
                    var fecha = 'No disponible';
                    if (bookingsList[index]['booking_date'] != '') {
                        var arrayDate = bookingsList[index]['booking_date'].split('-');
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
                                    <p><strong>${datosModal[index]['evento']}</strong></p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Reserva para ${datosModal[index]['cant']} participantes</li>
                                            <li class="list-group-item">${datosModal[index]['aula']}</li>
                                            <li class="list-group-item">Horario de comienzo: ${bookingsList[index]['start_time']}</li>
                                            <li class="list-group-item">Horario de fin: ${bookingsList[index]['finish_time']}</li>
                                        </ul> 
                                        <button type="button" class="btn btn-sm btn-outline-danger w-50" onclick="deleteAssignmentItem(${index});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            Eliminar reserva
                                        </button>    
                                </div>
                            </div>
                        </div>
                        `
                    )
                }
            })


            // ON CHANGE DE INPUT PARTICIPANTS DE EVENTO MASIVO
            $('.participantsMassiveEvent').on('change', function() {
                $('#addBookingMassiveEvent').attr('disabled', true);
                $('.classroomsMassiveEvent').empty();
                $('.classroomsMassiveEvent').append(`<option disabled selected>Aula...</option>`)
                $('.classroomsMassiveEvent').attr('disabled', true);

                $('.start_timeMassiveEvent').empty();
                $('.finish_timeMassiveEvent').empty();
                $('.start_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`)
                $('.finish_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`)


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
                $('#addBooking').attr('disabled', true);
                $('.days').find('option:selected').remove('selected');
                $('.days').find($('.days').val('-1')).add('selected');
                if ($(this).val() != '') {
                    $('.days').removeAttr('disabled');

                } else {
                    $('.days').attr('disabled', true);
                }
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.start_time').append(`<option disabled selected>Elige una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elige una opción</option>`)
            });

            // onchange dias de materia para obtener aulas
            $('.days').on('change keyup', function() {
                $('#addBooking').attr('disabled', true);
                $('.classrooms').empty();
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.classrooms').append(`<option disabled selected>Aula...</option>`)
                $('.start_time').append(`<option disabled selected>Elige una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elige una opción</option>`)
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
                $('#addBooking').attr('disabled', true);
                $('.start_time').empty();
                $('.finish_time').empty();
                $('.start_time').append(`<option disabled selected>Elige una opción</option>`)
                $('.finish_time').append(`<option disabled selected>Elige una opción</option>`)
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
                $('#addBookingMassiveEvent').attr('disabled', true);
                $('.start_timeMassiveEvent').empty();
                $('.finish_timeMassiveEvent').empty();

                $('.start_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`)
                $('.finish_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`)
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
                $('#addBooking').attr('disabled', true);
                $('.finish_time').empty();
                $('.finish_time').removeAttr('disabled');
                $('.finish_time').append(`<option disabled selected>Elige una opción</option>`)
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
                $('#addBookingMassiveEvent').attr('disabled', true);
                $('.finish_timeMassiveEvent').empty();
                $('.finish_timeMassiveEvent').removeAttr('disabled');
                $('.finish_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`)
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
            $(this).attr('disabled', true);
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

            var nombreAula = $('.classrooms').find('option:selected').text().trim().split(
                'Capacidad'); // valor informativo para modal
            nombreAula = nombreAula[0];
            var nombreMateria = $('.select2-assignment').find('option:selected').text().trim();
            var inicio = $('.start_date').val().split("-");
            var fin = $('.finish_date').val().split("-");
            inicio = inicio[2] + '/' + inicio[1] + '/' + inicio[0];
            fin = fin[2] + '/' + fin[1] + '/' + fin[0];
            var tipoAula = $('.classroom_type').find('option:selected').text().trim();
            var participantesActuales = $('.participants').val();

            var arrayModal = {
                'aula': nombreAula,
                'materia': nombreMateria,
                'inicio': inicio,
                'fin': fin,
                'tipoAula': tipoAula,
                'cant': participantesActuales,
            };
            var localArrayModal = JSON.parse(localStorage.getItem('modalData'));
            localArrayModal.push(arrayModal);
            localStorage.setItem('modalData', JSON.stringify(localArrayModal));

            $('.participants').val('');
            $('.participants').val(participantesActuales).trigger('change');

            // resetear campos de 'datos de reserva'
            $('.days').find('option:selected').remove('selected');
            $('.days').find($('.days').val('-1')).add('selected');
            $('.classrooms').empty();
            $('.start_time').empty();
            $('.finish_time').empty();
            $('.start_time').append(`<option disabled selected>Elige una opción</option>`);
            $('.finish_time').append(`<option disabled selected>Elige una opción</option>`);
            $('.classrooms').append(`<option disabled selected>Aula...</option>`);

            // habilitar boton para crear
            $('#createBooking').removeClass('d-none');
            $('#btnViewModal').removeClass('d-none');
        });

        // accion del boton 'agregar reserva' para almacenar datos al localStorage (Evento masivo)
        $('#addBookingMassiveEvent').on('click', function(e) {
            $(this).attr('disabled', true);
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

            var nombreAula = $('.classroomsMassiveEvent').find('option:selected').text().trim().split(
                'Capacidad'); // valor informativo para modal
            nombreAula = nombreAula[0];
            var nombreEvento = $('.nameMassiveEvent').val();
            var participantesActuales = $('.participantsMassiveEvent').val();

            var arrayModal = {
                'aula': nombreAula,
                'evento': nombreEvento,
                'cant': participantesActuales
            };
            var localArrayModal = JSON.parse(localStorage.getItem('modalData'));
            localArrayModal.push(arrayModal);
            localStorage.setItem('modalData', JSON.stringify(localArrayModal));

            // resetear campos de 'datos de reserva'
            $('.participantsMassiveEvent').val('');
            $('.participantsMassiveEvent').val(participantesActuales).trigger('change');
            $('.classroomsMassiveEvent').empty();
            $('.start_timeMassiveEvent').empty();
            $('.finish_timeMassiveEvent').empty();
            $('.start_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`);
            $('.finish_timeMassiveEvent').append(`<option disabled selected>Elige una opción</option>`);
            $('.classroomsMassiveEvent').append(`<option disabled selected>Aula...</option>`)

            // habilitar boton para crear
            $('#createBooking').removeClass('d-none');
            $('#btnViewModalMassiveEvent').removeClass('d-none');


        });

        // habilitar boton añadir reserva (materia) cuando se selecciona hora fin
        $('.finish_time').on('change', function() {
            $('#addBooking').removeAttr('disabled');
        });

        // habilitar boton añadir reserva (evento) cuando se selecciona hora fin
        $('.finish_timeMassiveEvent').on('change', function() {
            $('#addBookingMassiveEvent').removeAttr('disabled');
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
