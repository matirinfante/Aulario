@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endsection
@php
//   $bookings=[];
// $bookings_assignments=[];
// $classrooms=[];
@endphp
@section('content')
    @hasanyrole('user|teacher')
        
        <div class="container text-center">
            <h3>Datos de la reserva</h3>
            <form class="filter" method='POST' action="">
                @csrf

                <div class="col-auto">
                    <span>Ingrese cantidad de participantes</span>
                    <input id="participants" class="form-control" type="number" min="1" placeholder="Sólo números">

                </div>
                <div class="d-none col-auto mt-3" id="select-aula">
                    <span>Seleccione el aula</span>
                    <select class="form-select filtro" name="classroom_id" id="select">
                        <option value="null" selected disabled>Elija una opción</option>
                        @forelse ($classrooms as $classroom)
                            <option data-capacity="{{ $classroom['capacity'] }}"
                                data-classroomName="{{ $classroom['classroom_name'] }}"
                                data-building="{{ $classroom['building'] }}" value="{{ $classroom['id'] }}">
                                Edificio: {{ $classroom['building'] }} Nombre: {{ $classroom['classroom_name'] }}
                                Capacidad: {{ $classroom['capacity'] }}
                                {{-- agregar el tipo del aula --}}
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
        @can('create bookings')
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
        @endcan
    @endhasanyrole

    @can('create bookings')
        @hasanyrole('user|teacher')
            {{-- modal para crear reserva, al hacer clic en fecha del calendar --}}
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
                <div class="card" style="padding:25px; width: 500px; margin: auto">
                <h3 class="text-center m-2">Sector de calendarios y reservas </h3>
                @can('create bookings')
                    <div class="row">
                        <div class="d-flex justify-content-center mt-2 mb-2">
                            {{-- //invocar vista adminCreate --}}
                            <form class="w-10" width="20px" method="GET" action="{{ route('bookings.createAdmin') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Realizar reserva</button>
                            </form>

                            
                        </div>
                        <h5 class="text-center "> Seleccione un aula:</h5>
                        <div style="width: 250px; margin:auto" class="d-flex">
                            
                        <select class="form-select filtro" name="classroom_id" id="select">
                            <option value="null" selected disabled>Elija una opción</option>
                            @forelse ($classrooms as $classroom)
                                <option data-capacity="{{ $classroom['capacity'] }}"
                                    data-classroomName="{{ $classroom['classroom_name'] }}"
                                    data-building="{{ $classroom['building'] }}" value="{{ $classroom['id'] }}">
                                    Edificio: {{ $classroom['building'] }} Nombre: {{ $classroom['classroom_name'] }}
                                    Capacidad: {{ $classroom['capacity'] }}
                                    {{-- agregar el tipo del aula --}}
                                </option>
                            @empty
                                <option value="">No hay coincidencias:</option>
                            @endforelse
                        </select>
                       
                        <button type="button"
                            class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top"
                            title="Seleccione el aula para cargar su calendario."><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="#d99949" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                            </svg>
                        </button>
                        </div>
                        </div>
                    </div>
                    <div id="calendar" class="p-5">
                    </div>
                @endcan
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
<script>
    
let storage = window.localStorage
let booking = storage.getItem('bookings')
 let select= document.getElementById('select');
 let bookings=JSON.parse(booking);
 console.log(select)
 if(bookings.length > 0){
    for (let i = 0; i < select.length; i++) {
       const element = select[i];
       console.log(element);
       console.log(bookings[0].classroom_id);
    //    if(element.value == )
        
    }
 }

console.log(booking)
    </script>
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    @hasanyrole('user|teacher|admin')
        <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>
        <script src="{{ asset('js/fullcalendar/es.js') }}" defer></script>
    @endhasanyrole
@endsection
