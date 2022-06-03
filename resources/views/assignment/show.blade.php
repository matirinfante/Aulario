@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-light" href="{{ url('assignments') }}" role="button" style="margin-left: 1%">Listado de
        materias</a>

    <h3 class="text-center m-4">Detalles de la materia</h3>
    <div class="card m-auto mt-3 w-50">
        <div class="card-body text-center">
            <h5 class="card-title"><span class="text-secondary">Nombre:</span> {{ $assignment->assignment_name }}</h5>
            <hr>
            <p class="card-text"><span class="text-secondary">Identificador:</span> {{ $assignment->id }}</p>
        </div>
    </div>
@endsection
