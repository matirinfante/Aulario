@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        {{-- Mensaje del controlador al realizar acción --}}
        <div id="flashMessage" class="text-center d-none">
            @include('flash::message')
        </div>

        @can('see own bookings')
            <h3 class="text-center m-4">Mis reservas</h3>

            {{-- mensajes de error --}}
            @if ($errors->any())
                <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
                </div>
            @endif
            <div class="row justify-content-center" id="myBookings">
                @forelse ($bookings as $booking)
                    <div class="col-xl-3 col-md-6 col-sm-12 myBooking">
                        <div class="">
                            <div class="text-center">
                                @isset($booking->assignment)
                                    <h2 class="">{{ $booking->assignment->assignment_name }}</h2>
                                @endisset
                                @isset($booking->event)
                                    <h2 class="">{{ $booking->event->event_name }}</h2>
                                @endisset
                                <hr>
                                <div class="card-body">
                                    <p>Fecha: {{ date('d/m/Y', strtotime($booking->booking_date)) }}</p>
                                    <p>Inicio: {{ date('H:i', strtotime($booking->start_time)) }}Hs
                                        Fin:
                                        {{ date('H:i', strtotime($booking->finish_time)) }}Hs</p>
                                    <p>Descripción: {{ $booking->description }}</p>
                                    <p class="classroom">Aula: {{ $booking->classroom->classroom_name }}</p>
                                </div>
                                @can('cancel own bookings')
                                    <div class="modal-footer justify-content-center">
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                            class="form-delete" style="width: 100%">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-50">Eliminar</button>
                                        </form>
                                    </div>
                                @endcan {{-- cancel own bookings --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="alert alert-primary d-flex" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                    role="img" aria-label="Warning:">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <div>
                                    Usted no posee reservas actualmente
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        @endcan {{-- see own bookings --}}
    </div>
@endsection

@section('scripts')
    {{-- Sweet alert --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
@endsection
