@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

        <div class="container text-center">
            <h3>Datos de la reserva</h3>
<<<<<<< HEAD
            <form class="filter" action="{{route('bookings.filter')}}" method="POST">
            @csrf
=======
            <form class="filter" method='POST' action="{{route('bookings.filter')}}">
                @csrf
>>>>>>> 59c253864b3c2b0ff77587cffabd866d4733d0cb
                <div class="col-auto">
                    <span>Ingrese cantidad de participantes</span>
                    <input id="participants" name="participants" class="form-control" type="number" placeholder="40">
                </div>
                <div class="col-auto">
                    <span>Seleccione el aula</span>
<<<<<<< HEAD
                    <select class="form-select" id="select">
=======
                    <select class="form-select" name="classroom_id" id="select">
>>>>>>> 59c253864b3c2b0ff77587cffabd866d4733d0cb
                        <option value="">Cargamela...</option>
                        @forelse ($classrooms as $classroom)
                            <option 
                            data-capacity="{{$classroom['capacity']}}" 
                            value="{{$classroom['id']}}"> 
                            Edificio: {{$classroom['building']}} Nombre: {{$classroom['classroom_name']}}   Capacidad: {{$classroom['capacity']}}
                        </option>
                        @empty
                            <option value="">No hay ningun aula cargada</option>
                        @endforelse
                    </select>
                </div>
                <button type="submit" class="btn btn-primary m-3"> Filtrar </button>
            </form>
        </div>
    
    <div id="bookings" class="d-none">
        {{$bookings}}
    </div>
    <div id="bookings_assignments" class="d-none">
        {{$bookings_assignments}}
    </div>
<<<<<<< HEAD

=======
    
    
>>>>>>> 59c253864b3c2b0ff77587cffabd866d4733d0cb
    <div id="calendar" class="p-5">
    </div>

    <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
@endsection
