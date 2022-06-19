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
                                <input type="date" class="form-control" name="start_date" id="createStartDate" required
                                       disabled>
                                {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                            </div>

                            {{-- fecha fin --}}
                            <div class="mb-3 col">
                                <label for="finish_date" class="form-label">Fecha fin</label>
                                <input type="date" class="form-control" name="finish_date" id="createFinishDate"
                                       required
                                       disabled>
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
                        <hr size="5">

                        <div class="repeater">
                            <div data-repeater-list="assignments-list" id="padre">
                                <div data-repeater-item>
                                    <h5 class="pb-3">Datos de reserva</h5>
                                    <label for="days" class="form-label">Día</label>
                                    <select name="days" class="form-select days" aria-label="days" style="width: 100%">
                                        <option disabled selected>Elige un día...</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miercoles">Miercoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sábado">Sábado</option>
                                    </select>

                                    @include('booking.moduleAdminCreate')

                                    <div class="mb-3">
                                        <button data-repeater-delete type="button" class="btn btn-danger w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            Eliminar reserva
                                        </button>
                                    </div>
                                    <hr size="5">
                                </div>
                            </div>
                            <div class="mb-3">
                                <button data-repeater-create type="button" class="btn btn-success w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                    </svg>
                                    Agregar reserva
                                </button>
                            </div>
                        </div>
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
                        <div class="repeater">
                            <div data-repeater-list="massive-event-list">
                                <div data-repeater-item>
                                    {{-- fecha evento (masivo) --}}
                                    <div class="mb-3">
                                        <label for="event_date" class="form-label">Fecha de evento</label>
                                        <input type="date" class="form-control" name="booking_date" id="event_date"
                                               required disabled>
                                        {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                                    </div>

                                    @include('booking.moduleAdminCreate')

                                    <div class="mb-3">
                                        {{-- <input data-repeater-delete type="button" class="btn btn-danger"
                                            value="Eliminar evento" /> --}}
                                        <button data-repeater-delete type="button" class="btn btn-danger w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            Eliminar reserva
                                        </button>
                                    </div>
                                    <hr size=5>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button data-repeater-create type="button" class="btn btn-success w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                    </svg>
                                    Agregar reserva
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <button id="createBooking" type="submit" class="btn btn-primary w-100" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                                </svg>
                                Crear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
            integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Select2 de materia --}}
    <script src="{{ asset('js/bookings/select2.js') }}" defer></script>
    <script>
        // SCRIPT PARA MOSTRAR EL FORMULARIO DE MATERIA O EVENTO MASIVO
        $("#optionType").change(function () {
            var opcion = $(this).find('option:selected').val();
            if (opcion === "assignment") {
                $('.assignment').removeClass('d-none');
                $('.massiveEvent').addClass('d-none');

            } else {
                $('.assignment').addClass('d-none');
                $('.massiveEvent').removeClass('d-none');
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.repeater').repeater({
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            });
            // $('.createEventAssignment').repeaterVal();
            $('input[name*="assignments-list"].participants').on('change', function () {
                console.log('llegue');
                $('.classrooms').empty();
                var participants = $(this).val();
                var day = $('.days').find('option:selected').val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": '{{csrf_token()}}',
                    },
                    type: "POST",
                    url: `/bookings/create/getrooms`,
                    cache: false,
                    data: {
                        participants: participants,
                        day: day,
                    },
                    success: function (response) {
                        response.forEach(function (elem) {
                            $('.classrooms').append(`<option value='${elem.id}'>${elem.classroom_name} Capacidad: ${elem.capacity} </option>`)
                        })
                    }
                });
            });
        });


    </script>

@endsection
