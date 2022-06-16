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
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif
    <div>
        @foreach($bookings as $booking)
            <div class="card bg-success bg-opacity-25">
                @isset($booking->assignment)
                    <div class="card-header">{{$booking->assignment->assignment_name}}</div>
                @endisset
                @isset($booking->event)
                    <div class="card-header">{{$booking->event->event_name}}</div>
                @endisset
                <div class="card-body">
                    <p>{{$booking->start_time}} - {{$booking->finish_time}}</p>
                    <p>Aula: {{$booking->classroom->classroom_name}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    {{-- Sweet alert --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
@endsection
