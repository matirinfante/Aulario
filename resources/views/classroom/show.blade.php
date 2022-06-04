@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-light" href="{{ url('classrooms') }}" role="button" style="margin-left: 1%">Listado de
        aulas</a>

    <h3 class="text-center m-4">Detalles del aula</h3>
    <div class="card m-auto mt-3 w-50">
        <div class="card-body text-center">
            <h5 class="card-title"><span class="text-secondary">Nombre del aula:</span> {{ $classroom->classroom_name }}</h5>
            <hr>
            <p class="card-text"><span class="text-secondary">Identificador:</span> {{ $classroom->id }}</p>
        </div>
    </div>
@endsection