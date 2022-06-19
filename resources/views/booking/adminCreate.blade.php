@extends('layouts.app')

@section('content')
    @isset($petition)
    @endisset
    <div class="container-fluid">
        <h2 class="text-center">EVENTO O MATERIA?</h2>
        <div class="row">
            <div class="d-flex justify-content-center">
                <form class="createEventAssignment w-50" method='POST' action="" width="400px">
                    @csrf
                    <div class="mb-3">
                        <span>Seleccione tipo de reserva</span>
                        <select class="form-select" name="optionType" id="optionType">
                            <option selected disabled>Tipo de reserva...</option>
                            <option value="assignment">Materia</option>
                            <option value="massiveEvent">Evento masivo</option>
                        </select>
                    </div>
                    {{-- RESERVA SOLO DE MATERIAS --}}
                    <div class="assignment d-none">
                        <div class="mb-3">
                            <label for="assignment_name" class="form-label">Nombre de materia</label>
                            <input type="text" class="form-control" name="assignment_name" id="createAssignmentName"
                                placeholder="Programación Web Avanzada" required>
                            {{-- <small id="errorCreateAssignmentName"></small> --}}
                        </div>


                        {{-- fecha inicio --}}
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" name="start_date" id="createStartDate" required
                                disabled>
                            {{-- <small id="errorCreateAssignmentStartDate"></small> --}}
                        </div>

                        {{-- fecha fin --}}
                        <div class="mb-3">
                            <label for="finish_date" class="form-label">Fecha fin</label>
                            <input type="date" class="form-control" name="finish_date" id="createFinishDate" required
                                disabled>
                            {{-- <small id="errorCreateAssignmentFinishDate"></small> --}}
                        </div>
                        {{-- profesores --}}
                        <div class="mb-3 col-md-6">
                            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
                            <select name="user_id[]" class="form-select select2-user" multiple="multiple"
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
                        <div class="repeater">
                            <div data-repeater-list="assignments-list">
                                <div data-repeater-item>
                                    <label for="days" class="form-label">Día</label>
                                    <select name="days" class="form-select" aria-label="days" style="width: 100%">
                                        <option selected>Elige un dia...</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miercoles">Miercoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sábado">Sábado</option>
                                    </select>

                                    @include('booking.moduleAdminCreate')

                                    <input data-repeater-delete type="button" class="btn btn-danger"
                                        value="Eliminar materia" />
                                </div>
                            </div>
                            <input data-repeater-create type="button" class="btn btn-primary" value="Agregar materia" />
                        </div>
                    </div>

                    {{-- RESERVA DE EVENTOS MASIVOS --}}
                    <div class="massiveEvent d-none">
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Nombre del evento</label>
                            <input type="text" class="form-control" name="event_name" id="createName"
                                placeholder="Parcial ADyDS" required>
                            <small id="errorCreateBookingName"></small>
                        </div>

                        {{-- descripción --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description" id="createDescription" required>
                            <small id="errorCreateBookingDescription"></small>
                        </div>
                        {{-- <div class="inner-repeater-massive-event"> --}}
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

                                    <input data-repeater-delete type="button" class="btn btn-danger"
                                        value="Eliminar evento" />
                                </div>
                            </div>
                            {{-- </div> --}}
                            <input data-repeater-create type="button" class="btn btn-primary" value="Agregar evento" />
                        </div>
                    </div>
                    <div class="col-6">
                        <button id="createBooking" type="submit" class="btn btn-primary">Crear</button>
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
    <script src="{{ asset('js/assignments/select2.js') }}" defer></script>
    <script>
        // SCRIPT PARA MOSTRAR EL FORMULARIO DE MATERIA O EVENTO MASIVO
        $("#optionType").change(function() {
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
        $(document).ready(function() {
            $('.repeater').repeater({
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            });
            // $('.createEventAssignment').repeaterVal();
        });
    </script>
@endsection
