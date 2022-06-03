@extends('layouts.app')

@section('content')
    {{-- enlaces jquery para select2 (uso temporario de cdn ) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <a class="btn btn-outline-light" href="{{ url('classrooms') }}" role="button" style="margin-left: 1%">Listado de
        aulas</a>

    <h3 class="text-center m-4">Creación de un Aula</h3>
    <form id="form_classroom" name="form_classroom" class="form_style" method="POST"
        action="{{ route('classrooms.store') }}">
        @csrf
        <div class="mb-3">
            <label for="classroom_name" class="form-label">Nombre del aula</label>
            <input type="text" class="form-control" name="classroom_name" id="classroom_name" placeholder="I7">
            <p class="alerta d-none" id="errorClassroomName">Error</p>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Locación en facultad</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Planta Alta">
            <p class="alerta d-none" id="errorLocation">Error</p>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacidad</label>
            <input type="number" class="form-control" name="capacity" id="capacity" min="150" max="200" placeholder="30">
            <p class="alerta d-none" id="errorCapacity">Error</p>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo de aula</label>
            <input type="test" class="form-control" name="type" id="type" placeholder="Laboratorio">
            <p class="alerta d-none" id="errorType">Error</p>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection
