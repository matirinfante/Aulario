@extends('layouts.app')

@section('content')
    {{-- enlaces jquery para select2 (uso temporario de cdn ) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <a class="btn btn-outline-light" href="{{ url('assignments') }}" role="button" style="margin-left: 1%">Listado de
        materias</a>
        
    <h3 class="text-center m-4">Modificación de una materia</h3>
    <form id="form_assignment" name="form_assignment" class="form_style" method="POST" action="{{route('assignments.update',$assignment->id)}}">
        <div class="mb-3">
            <label for="assignment_name" class="form-label">Nombre de materia</label>
            <input type="text" class="form-control" name="assignment_name" id="assignment_name" value="{{ $assignment->assignment_name }}" required>
            <small id="errorAssignmentName"></small>
        </div>
        {{-- El profesor de la materia se selecciona según los usuarios cargados en sistema --}}
        <div class="mb-3">
            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
            <select name="user_id" id="user_id" class="form-select" aria-label="Profesor/a" style="width: 100%">
                <option selected="selected" disabled="disabled">Elija profesor/a</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <small id="errorNameTeacher"></small>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
        @csrf
    </form>

    {{-- script para utilizar select2 --}}
    <script>
        $('#user_id').select2({
            placeholder: 'Elija profesor',
            allowClear: false
        });
    </script>
@endsection
