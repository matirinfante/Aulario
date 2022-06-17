@extends('layouts.app')

@section('styles')
@endsection
@php
    //   $bookings=[];
    // $bookings_assignments=[];
    // $classrooms=[];
@endphp
@section('content')
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

    <div class="container text-center">
        <h3>Datos de la reserva</h3>
        <form class="filter" method='POST' action="">
            @csrf
            <div class="col-auto">
                <span>Ingrese cantidad de participantes</span>
                <input required id="participants" class="form-control" type="number" placeholder="40">
            </div>
            <div class="col-auto">
                <span>Seleccione el aula</span>
                <select class="form-select" name="classroom_id" id="select">
                    <option value="">Cargamela...</option>
                    @forelse ($classrooms as $classroom)
                        <option
                            data-capacity="{{$classroom['capacity']}}"
                            data-classroomName="{{$classroom['classroom_name']}}"
                            data-building="{{$classroom['building']}}"
                            value="{{$classroom['id']}}">
                            Edificio: {{$classroom['building']}} Nombre: {{$classroom['classroom_name']}}
                            Capacidad: {{$classroom['capacity']}}
                        </option>
                    @empty
                        <option value="">No hay nada para robar :</option>
                    @endforelse
                </select>
            </div>
           
        </form>
    </div>

    @can('create bookings')
        @hasAnyRole('user|teacher')
        <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            <input type="text" class="form-control" name="description" id="createDescription" required>
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
        @endHasAnyRole
        @hasAnyRole('admin')
        //invocar vista adminCreate
        @endHasAnyRole
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
    <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    <script src="{{ asset('js/fullcalendar/es.js') }}" defer></script>
   
@endsection
