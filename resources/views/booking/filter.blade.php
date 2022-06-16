@extends('layouts.app')

@section('styles')
@endsection
@php
  $bookings=[];
$bookings_assignments=[];
// $classrooms=[];
@endphp
@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

        <div class="container text-center">
            <h3>Datos de la reserva</h3>
            {{-- <form class="filter" method='POST' action="{{route('bookings.filter')}}">
                @csrf
                <div class="col-auto">
                    <span>Ingrese cantidad de participantes</span>
                    <input id="participants" class="form-control" type="number" placeholder="40">
                </div>
                <div class="col-auto">
                    <span>Seleccione el aula</span>
                    <select class="form-select" name="classroom_id" id="select">
                        <option value="">Cargamela...</option>
                        @forelse ($classrooms as $classroom)
                            <option 
                            data-capacity="{{$classroom['capacity']}}" 
                            value="{{$classroom['id']}}"> 
                            Edificio: {{$classroom['building']}} Nombre: {{$classroom['classroom_name']}}   Capacidad: {{$classroom['capacity']}}
                        </option>
                        @empty
                            <option value="">No hay nada para robar :</option>
                        @endforelse
                    </select>
                </div>
                <button class="btn btn-primary m-3" id="filter-butom"> Filtrar </button>
            </form> --}}
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
    <script src="{{ asset('js/fullcalendar/es.js') }}" defer></script>
@endsection
