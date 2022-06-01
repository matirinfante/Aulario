@extends('layouts.app')

@section('content')

    <h3 class="text-center m-4">Creación de una materia</h3>
    <form class="form_style" action="" method="POST">
        <div class="mb-3">
            <label for="nameAssignment" class="form-label">Nombre de materia</label>
            <input type="text" class="form-control" id="nameAssignment" placeholder="Programación Web Avanzada" required>
            <small id="errorNameAssignment"></small>
        </div>
        {{-- El profesor de la materia se selecciona según los usuarios cargados en sistema --}}
        <div class="mb-3">
            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
            <select class="form-select" aria-label="Profesor/a">
                <option selected="selected" disabled="disabled">Elija profesor/a</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <small id="errorNameTeacher"></small>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection