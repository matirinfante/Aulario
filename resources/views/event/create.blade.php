@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center m-4">Crear Evento</h3>
        <form action="" method="post" class="form_style col-md-4">
            <div class="mb-3">
                <label for="nombreAula" class="form-label">Nombre Aula</label>
                <input type="text" class="form-control" id="nombreAula" placeholder="I1">
            </div>
            <div class="mb-3">
                <label for="locacionFacultad" class="form-label">Locacion Facultad</label>
                <input type="text" class="form-control" id="locacionFacultad" placeholder="Planta Alta">
            </div>
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" class="form-control" id="capacidad" placeholder="150">
            </div>
            <div class="mb-3">
                <label for="tipoAula" class="form-label">Tipo de Aula</label>
                <input type="text" class="form-control" id="tipoAula" placeholder="Laboratorio">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
