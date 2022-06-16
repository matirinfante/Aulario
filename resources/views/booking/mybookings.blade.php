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
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach ($bookings as $booking)
                <div class="card text-center bg-success bg-opacity-25 mb-4">
                    @isset($booking->assignment)
                        <div class="card-header">{{ $booking->assignment->assignment_name }}</div>
                    @endisset
                    @isset($booking->event)
                        <div class="card-header">{{ $booking->event->event_name }}</div>
                    @endisset
                    <div class="card-body">
                        <p>Fecha: {{ date('d/m/Y', strtotime($booking->booking_date)) }}</p>
                        <p>Inicio: {{ date('h:i', strtotime($booking->start_time)) }} Hs &nbsp;&nbsp;&nbsp; Fin:
                            {{ date('h:i', strtotime($booking->finish_time)) }} Hs</p>
                        <p>Descripción: {{ $booking->description }}</p>
                        <p>Aula: {{ $booking->classroom->classroom_name }}</p>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Sweet alert --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
@endsection
