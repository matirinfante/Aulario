@extends('layouts.app')

@section('content')

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Mis reservas</h3>

    {{-- mensajes de error --}}
    @if ($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
    @foreach ($bookings as $booking)
    <div class="" id="myBooking">
        <div class="">
                <div class="card text-center">
                    @isset($booking->assignment)
                        <h2 class="card-header">{{ $booking->assignment->assignment_name }}</h2>
                    @endisset
                    @isset($booking->event)
                        <h2 class="card-header">{{ $booking->event->event_name }}</h2>
                    @endisset
                    <div class="card-body">
                        <p>Fecha: {{ date('d/m/Y', strtotime($booking->booking_date)) }}</p>
                        <p>Inicio: {{ date('h:i', strtotime($booking->start_time)) }} Hs &nbsp;&nbsp;&nbsp; Fin:
                            {{ date('h:i', strtotime($booking->finish_time)) }} Hs</p>
                        <p>Descripción: {{ $booking->description }}</p>
                        <p class="classroom">Aula: {{ $booking->classroom->classroom_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="m-auto mt-5 w-50 ">
        @endforeach
@endsection

@section('scripts')
    {{-- Sweet alert --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
@endsection
