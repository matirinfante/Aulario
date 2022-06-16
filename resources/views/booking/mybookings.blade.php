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


@endsection

@section('scripts')
    {{-- Sweet alert --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
@endsection
