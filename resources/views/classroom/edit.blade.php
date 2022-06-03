@extends('layouts.app')


@section('content')
<style>
    form {
        width: 40%;
        min-width: 500px;
        margin: auto;
        background: #D9D9D9;
        padding: 25px;
        border-radius: 25px;
        text-align: center;
    }

    label {
        font-weight: 600;
    }

    .alerta {
        padding: 3px;
        font-size: 14px;
        color: #842029;
        background: #f8d7da;
        border: solid 1px #f5c2c7;
        border-radius: 5px;
        margin-top: 3px;
        width: 100%;
    }

</style>
<a class="btn btn-outline-light" href="{{ url('classrooms') }}" role="button" style="margin-left: 1%">Listado de Aulas</a>
    
<h3 class="text-center m-4">Modificación de un aula</h3>
<form id="form" name="form" class="form_style" method="get" action="{{route('classrooms.update', $classroom->id)}}">
    <div class="mb-3">
        <label for="classroom_name" class="form-label">Nombre del aula</label>
        <input type="text" class="form-control" name="classroom_name" id="classroom_name" placeholder=" {{$classroom->classroom_name}} ">
        <p class="alerta d-none" id="errorClassroomName">Error</p>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Locación en facultad</label>
        <input type="text" class="form-control" name="location" id="location" placeholder="{{$classroom->location}}">
        <p class="alerta d-none" id="errorLocation">Error</p>
    </div>
    <div class="mb-3">
        <label for="capacity" class="form-label">Capacidad</label>
        <input type="number" class="form-control" name="capacity" id="capacity" min="1000000" max="99999999"
               placeholder="{{$classroom->capacity}}">
        <p class="alerta d-none" id="errorDni">Error</p>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipo de aula</label>
        <input type="text" class="form-control" name="type" id="type" placeholder="{{$classroom->type}}">
        <p class="alerta d-none" id="errorEmail">Error</p>
    </div>
    
    <button id="submit" type="submit" class="btn btn-primary disabled" >Actualizar</button>
    @csrf
</form>
<script src="https://unpkg.com/validator@latest/validator.min.js"></script>
 
    
@endsection