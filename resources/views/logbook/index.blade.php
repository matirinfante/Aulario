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

    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">

            <table class="table table-striped table-hover" id="logbooks">

                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Fecha</td>
                        <td>Aula</td>
                        <td>Usuario</td>
                        <td>Hora ingreso</td>
                        <td>Hora salida</td>
                        <td>Observación</td>
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

                        </tr>
                    @empty
                        <td colspan="7" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
