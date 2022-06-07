@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center m-4">Crear Evento</h3>
        <form action="{{ route('events.store') }}" method="POST" class="form_style col-md-4" id="form_event"
            name="form_event">
            @csrf
            <div class="mb-3">
                <label for="event_name" class="form-label">Nombre Evento</label>
                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Parcial PWA">
            </div>
            <div class="mb-3">
                <label for="participants" class="form-label">Participantes</label>
                <input type="number" class="form-control" id="participants" name="participants" placeholder="50">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
