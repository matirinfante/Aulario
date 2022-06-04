@extends('layouts.app')

@section('content')
<a class="btn btn-outline-dark" href="{{ url('users') }}" role="button" style="margin-left: 1%">Listado de Usuarios</a>

<h3 class="text-center m-4">Detalles del Usuario</h3>
<div class="card m-auto mt-3 w-50">
    <div class="card-body text-center">
        <div class="card-body">
            <h5 class="card-title">Usuario: {{$user['name']}} </h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Apellido: {{$user['surname']}} </li>
            <li class="list-group-item">Dni: {{$user['dni']}} </li>
            <li class="list-group-item">Email: {{$user['email']}}</li>
          </ul>
          <div class="card-body">
            <a href="{{ url('users') }}" class="card-link">Volver Atras</a>
          </div>
    </div>
</div>

@endsection

    
