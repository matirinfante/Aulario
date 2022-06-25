@extends('layouts.app')

@section('content')
    <div id="noFunca">
    </div>

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
                                    <button type="button" class="btn btn-success verQrModal m-3" data-bs-toggle="modal"
                                        data-bs-target="#modalQR{{ $booking->id }}"
                                        onclick="generarQr({{ auth()->user()->id }}, {{ $booking->id }});">VER QR</button>
                                    {{-- MODAL PARA VER EL QR DE LA RESERVA --}}
                                    <div class="modal fade" id="modalQR{{ $booking->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-center" id="exampleModalLabel">QR DE SU RESERVA</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body modalBodyQr{{ $booking->id }} img-fluid"
                                                    style="margin: auto;">
                                                    {{-- .. dynamic Qr .. --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    {{-- qr js --}}
    <script src="{{ asset('js/html5-qrcode/qrcode.js') }}"></script>
    <script src="{{ asset('js/html5-qrcode/ejemplo.js') }}"></script>

    <script>
        $('.verQrModal').on('click', function() {
            var json = ""
            var b_uuid = $(this).data('bs-b-uuid');


            // $('#modalQR').empty();

            // console.log(b_uuid)
            // console.log(u_uuid)

            // new QRious({
            //     element: document.getElementById('nofunca'),
            //     value: 'hola', // La URL o el texto
            //     size: 400,
            //     backgroundAlpha: 0, // 0 para fondo transparente
            //     foreground: "#8bc34a", // Color del QR
            //     level: "H", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
            // });
            // $('.modalBodyQr').html(qrcode);
        })

        function generarQr(u_uuid, b_uuid) {
            $('.modalBodyQr' + b_uuid).empty()
            var json = JSON.stringify({
                'b-uuid': b_uuid,
                'u-uuid': u_uuid
            });
            // var qrcode = new QRCode(document.getElementsByClassName('modalBodyQr'+b_uuid)[0], json);
            var qrcode = new QRCode(document.getElementsByClassName('modalBodyQr' + b_uuid)[0], {
                text: json,
                width: 200,
                height: 200,
                colorDark: "#000",
                colorLight: "#fff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            var qrcode = new QRCode(document.getElementByClassName("modalBodyQr"), "HOLIS");
        })
    </script> --}}
@endsection
