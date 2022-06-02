@extends('layouts.app')

@section('content')
    <h3 class="text-center m-4">Detalles de la materia</h3>
    <div class="card m-auto mt-3 w-50">
        <div class="card-body text-center">
            <h5 class="card-title"><span class="text-secondary">Nombre:</span> {{ $assignment->assignment_name }}</h5>
            <hr>
            <p class="card-text"><span class="text-secondary">Identificador:</span> {{ $assignment->id }}</p>
            <a class="btn btn-primary" href="{{ url('assignments') }}" role="button">Volver al listado</a>
        </div>
    </div>
    <div class="alert alert-warning text-center fw-bold mt-5" role="alert">
        &#128679; Under construction...! &#128679;
    </div>
@endsection
