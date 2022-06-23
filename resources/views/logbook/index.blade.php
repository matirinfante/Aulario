@extends('layouts.app')

@section('styles')
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
                        <td>Nombre de usuario</td>
                        <td>Hora de ingreso</td>
                        <td>Hora de salida</td>
                        <td>Observación</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($today_logbook as $logbook)
                        <tr>
                            {{-- nombre de la reserva (materia o evento) --}}
                            @isset($logbook->booking->assignment)
                                <td>{{ $logbook->booking->assignment->assignment_name }}</td>
                            @endisset
                            @isset($logbook->booking->event)
                                <td>{{ $logbook->booking->event->event_name }}</td>
                            @endisset

                            {{-- fecha de la reserva --}}
                            <td>{{ $logbook->date }}</td>

                            {{-- nombre completo de usuario --}}
                            <td>{{ $logbook->user->name }}, {{ $logbook->user->surname }}</td>

                            {{-- hora de ingreso --}}
                            @isset($logbook->check_in)
                                <td>{{ $logbook->check_in }}</td>
                            @else
                                <td>No disponible</td>
                            @endisset

                            {{-- hora de salida --}}
                            @isset($logbook->check_out)
                                <td>{{ $logbook->check_out }}</td>
                            @else
                                <td>No disponible</td>
                            @endisset


                            {{-- Observación --}}
                            @isset($logbook->check_out)
                                <td>{{ $logbook->commentary }}</td>
                            @else
                                <td>No disponible</td>
                            @endisset

                        </tr>
                    @empty
                        <td colspan="5" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
