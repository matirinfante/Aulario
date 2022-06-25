@extends('layouts.app')

@section('styles')
    <style>
        /* estilo para boton de descarga (pdf) */
        button.btn.btn-secondary.buttons-pdf.buttons-html5 {
            background-color: #c7be57;
        }
    </style>
@endsection

@section('content')
    <h3 class="text-center m-4">Libro de entrada</h3>
    <div class="text-center">
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all"
                viewBox="0 0 16 16">
                <path
                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
            </svg> Registrar salida &nbsp;&nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-vector-pen" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z" />
                <path fill-rule="evenodd" d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z" />
            </svg> Editar observaciones &nbsp;&nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
            </svg> Ingresar con Token
        </p>
    </div>

    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">

            <table class="table table-striped table-hover" id="logbooks">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#qrModal"
                    id="buttonQR">Escanear QR</button>
                <thead class="bg-secondary text-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Aula</th>
                        <th>Usuario</th>
                        <th>Hora ingreso</th>
                        <th>Hora salida</th>
                        <th>Observación</th>
                        <th></th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($today_logbook as $logbook)
                        <tr>
                            {{-- nombre de la reserva (materia o evento) --}}
                            @isset($logbook->booking->assignment->assignment_name)
                                <td>{{ $logbook->booking->assignment->assignment_name }}</td>
                            @endisset
                            @isset($logbook->booking->event->event_name)
                                <td>{{ $logbook->booking->event->event_name }}</td>
                            @endisset

                            {{-- fecha de la reserva --}}
                            <td>{{ date('d/m/Y', strtotime($logbook->date)) }}</td>

                            {{-- aula --}}
                            <td>{{ $logbook->booking->classroom->classroom_name }}</td>

                            {{-- nombre completo de usuario --}}
                            @isset($logbook->user->name, $logbook->user->surname)
                                <td>{{ $logbook->user->name }}, {{ $logbook->user->surname }}</td>
                            @else
                                <td>No disp</td>
                            @endisset

                            {{-- hora de ingreso --}}
                            @isset($logbook->check_in)
                                <td>{{ date('H:i', strtotime($logbook->check_in)) }}</td>
                            @else
                                <td>No disp</td>
                            @endisset

                            {{-- hora de salida --}}
                            @isset($logbook->check_out)
                                <td>{{ date('H:i', strtotime($logbook->check_out)) }}</td>
                            @else
                                <td>No disp</td>
                            @endisset


                            {{-- Observación --}}
                            @isset($logbook->commentary)
                                <td>{{ $logbook->commentary }}</td>
                            @else
                                <td></td>
                            @endisset

                            {{-- si existe hora de ingreso --}}
                            @if ($logbook->check_in != null)
                                <td><button type="button" class="btn btn-outline-secondary btn-sm"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                            <path
                                                d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                        </svg></button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-vector-pen" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z" />
                                            <path fill-rule="evenodd"
                                                d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z" />
                                        </svg></button>
                                </td>
                            @else
                                <td><a type="button" class="btn btn-sm btn-outline-secondary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
                                        </svg></button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <td colspan="7" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
            {{-- MODAL PARA ESCANEAR EL QR DE LA RESERVA --}}
            <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div id="reader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/html5-qrcode/html5-qrcode.min.js') }}"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            // ...
            html5QrcodeScanner.clear();
            $('.modal').modal('hide');
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection
