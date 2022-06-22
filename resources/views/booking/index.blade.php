@extends('layouts.app')

@section('styles')
@endsection
@php
//   $bookings=[];
// $bookings_assignments=[];
// $classrooms=[];
@endphp
@section('content')
    @hasanyrole('user|teacher')
        <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

        <div class="container text-center">
            <h3>Datos de la reserva</h3>
            <form class="filter" method='POST' action="">
                @csrf

                <div class="col-auto">
                    <span>Ingrese cantidad de participantes</span>
                    <input id="participants" class="form-control" type="number" min="1" placeholder="solo numeros">

                </div>
                <div class="d-none col-auto" id="select-aula">
                    <span>Seleccione el aula</span>
                    <select class="form-select filtro" name="classroom_id" id="select">
                        <option value="null">Seleccione un aula</option>
                        @forelse ($classrooms as $classroom)
                            <option data-capacity="{{ $classroom['capacity'] }}"
                                data-classroomName="{{ $classroom['classroom_name'] }}"
                                data-building="{{ $classroom['building'] }}" value="{{ $classroom['id'] }}">
                                Edificio: {{ $classroom['building'] }} Nombre: {{ $classroom['classroom_name'] }}
                                Capacidad: {{ $classroom['capacity'] }}
                            </option>
                        @empty
                            <option value="">No hay coincidencias:</option>
                        @endforelse
                    </select>
                </div>

            </form>
            <div class="mt-5" id="aviso_reserva">

            </div>
        </div>

        {{-- modal para envio de mail en caso de superar max participantes (siendo usuario común) --}}
        <div class="modal fade" id="mailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitar Reserva a administración</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="" method="POST" action="">
                            @csrf
                            <div class="mb-3">
                                <label for="subject" class="form-label">Asunto</label>
                                <input type="text" class="form-control" id="mailSubject" name="subject"
                                    placeholder="Parcial PWA">
                                <p class="alerta d-none" id="errorSubject">Error</p>
                            </div>
                            <div class="mb-3">
                                <label for="description">Descripción/Mensaje</label>
                                <textarea class="form-control" id="description" rows="3"></textarea>
                                <p class="alerta d-none" id="errorDescription">Error</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="submit_button" type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endhasanyrole

    @can('create bookings')
        @hasanyrole('user|teacher')
            <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Reserva de evento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createBookingForm" name="form_booking" method="POST"
                                action="{{ route('bookings.store') }}">
                                @csrf
                                {{-- nombre evento --}}
                                <div class="mb-3">
                                    <label for="booking_name" class="form-label">Nombre del evento</label>
                                    <input type="text" class="form-control" name="event_name" id="createName"
                                        placeholder="Parcial ADyDS" required>
                                    <small id="errorCreateBookingName"></small>
                                </div>

                                {{-- descripción --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" name="description" id="createDescription"
                                        required>
                                    <small id="errorCreateBookingDescription"></small>
                                </div>

                                {{-- horas disponibles (inicio) --}}
                                <div class="mb-3">
                                    <label for="startTime" class="form-label">Hora de inicio</label>
                                    <select name="start_time" class="form-select start_time">
                                        <option disabled selected>Elija una opción
                                        </option>
                                    </select>
                                    <small id="errorCreateBookingStartTime"></small>
                                </div>

                                {{-- horas disponibles (fin) --}}
                                <div class="mb-3">
                                    <label for="finishTime" class="form-label">Hora de fin</label>
                                    <select disabled name="finish_time" class="form-select finish_time">
                                        <option disabled selected>Elija una opción
                                        </option>
                                    </select>
                                    <small id="errorCreateBookingStartTime"></small>
                                </div>
                                {{-- los siguientes parametros en value serán los que lleguen desde el calendario --}}
                                <input type="hidden" class="classroomID" name="classroom_id" value="">
                                <input type="hidden" class="participants" name="participants" value="">

                                <div id="classroomdata">

                                </div>

                                <input type="hidden" class="bookingDate" name="booking_date" value="">

                                <button id="createBooking" type="submit" class="btn btn-primary">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endhasanyrole
        @hasrole('admin')
            <div class="container-fluid">
                <h3 class="text-center m-4">Bienvenid@ Admin </h3>
                <div class="row mt-4">
                    <div class="d-flex justify-content-center">
                        {{-- //invocar vista adminCreate --}}
                        <form class="w-50" width="400px" method="GET" action="{{ route('bookings.createAdmin') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Realizar reserva</button>
                        </form>
                    </div>
                </div>
            </div>
        @endhasrole
    @endcan

    <div id="bookings" class="d-none">

    </div>
    <div id="bookings_assignments" class="d-none">

    </div>


    <div id="calendar" class="p-5">
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    @hasanyrole('user|teacher')
        <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>
        <script src="{{ asset('js/fullcalendar/es.js') }}" defer></script>
    @endhasanyrole
@endsection
