@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-light" href="{{ url('assignments') }}" role="button" style="margin-left: 1%">Listado de
        materias</a>

    <h3 class="text-center m-4">Detalles de la materia</h3>
    <div class="card m-auto mt-3 w-50">
        <div class="card-body text-center">
            <h5 class="card-title"><span class="text-secondary">Nombre:<br><br></span> {{ $assignment->assignment_name }}</h5>
            <hr>
            <p class="card-text"><span class="text-secondary">Identificador:</span> {{ $assignment->id }}</p>
            <hr>
            <p class="card-text"><span class="text-secondary">Creación:</span>
                @if (isset($assignment->created_at))
                    {{ $assignment->created_at }}
                @else
                    No disponible
                @endif
            </p>
            <hr>
            <p class="card-text"><span class="text-secondary">Última modificación:</span>
                @if (isset($assignment->updated_at))
                    {{ $assignment->updated_at }}
                @else
                    No disponible
                @endif
            </p>
        </div>
    </div>
@endsection