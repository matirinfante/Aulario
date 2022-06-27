@extends('layouts.app')

@section('content')
    <div class="container-fluid text-center">
        <div class="card text-center w-50 mt-5 shadow-sm" style="margin: auto;">
            <h4 class="card-header">Registro de Entrada</h4>
            <div class="card-body text-secondary">
                @isset($logbook->booking->assignment->assignment_name)
                    <h5 class="m-4">Materia: {{ $logbook->booking->assignment->assignment_name }}</h5>
                @endisset
                @isset($logbook->booking->event->event_name)
                    <h5 class="m-4">Nombre Evento: {{ $logbook->booking->event->event_name }}</h5>
                @endisset
                <h5 class="m-4">Aula: {{ $logbook->booking->classroom->classroom_name }}
                    ({{ $logbook->booking->classroom->building }})</h5>
                <h5 class="m-4">Fecha: {{ date('d/m/Y', strtotime($logbook->date)) }}</h5>
                <h5 class="m-4">Hora Inicio: {{ date('H:i', strtotime($logbook->booking->start_time)) }}Hs</h5>
                <h5 class="m-4">Hora Fin: {{ date('H:i', strtotime($logbook->booking->finish_time)) }}Hs</h5>
                <h5 class="m-4">Descripción: {{ $logbook->booking->description }}</h5>
                <h5 class="m-4">Profesor: {{ $user->name }} {{ $user->surname }}</h3>
            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('logbook.checkin') }}">
                    @csrf
                    <input type="hidden" name="logbook_id" value="{{ $logbook->id }}">
                    <input type="hidden" name="uuid" value="{{ $user->user_uuid }}">
                    <button type="submit" class="btn btn-sm btn-success w-100"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-check-square-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                        </svg> Firmar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
