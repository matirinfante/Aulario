@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

        <div class="container">
            <h3>Datos de la reserva</h3>
            <div class="col-auto">
                <span>Ingrese cantidad de participantes</span>
                <input type="number" placeholder="">
            </div>
            <div class="col-auto">
                <span>Seleccione el aula</span>
                <select name="" id="">
                    @forelse ($classrooms as $classroom)
                        <option 
                        data-bs-capacity="{{$classroom['capacity']}}" 
                        value="{{$classroom['id']}}"> 
                        Edificio: {{$classroom['building']}} Nombre: {{$classroom['classroom_name']}}   Capacidad: {{$classroom['capacity']}}
                    </option>
                    @empty
                        <option value="">No hay nada para robar :</option>
                    @endforelse
                </select>
            </div>
            <div class="col-auto">
                <span>Input copado</span>
                <input type="text" placeholder="">
            </div>

        </div>
    
   

    <div id="bookings" class="d-none">
        {{$bookings}}
    </div>
    <div id="bookings_assignments" class="d-none">
        {{$bookings_assignments}}
    </div>


    <div id="calendar" class="p-5">
    </div>


    <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
@endsection
