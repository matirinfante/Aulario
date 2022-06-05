@extends('layouts.app')
@section('content')
<a class="btn btn-outline-dark" href="{{ url('petitions') }}" role="button" style="margin-left: 1%">Listado de Peticiones</a>

<h3 class="text-center m-4">Detalles de la Reserva</h3>
<div class="card m-auto mt-3 w-50">
    <div class="card-body text-center">
        <div class="card-body">
            <h5 class="card-title">Peticion: {{$petition['id']}} </h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Id del Usuario: {{$petition['user_id']}} </li>
            <li class="list-group-item">Tipo de Aula: {{$petition['classroom_type']}} </li>
            <li class="list-group-item">Id de la Materia: {{$petition['assignment_id']}}</li>
            <li class="list-group-item">Dias: {{$petition['days']}}</li>
            <li class="list-group-item">Hora Inicio: {{$petition['start_time']}} / Hora Fin: {{$petition['finish_time']}}</li>
            <li class="list-group-item">Estado: @if ($petition['status'] == 'unsolved')
                <span class="badge bg-warning"> {{$petition['status']}} </span>
                    @elseif ($petition['status'] == 'rejected')
                        <span class="badge bg-danger"> {{$petition['status']}} </span>
                    @else
                        <span class="badge bg-success"> {{$petition['status']}} </span>
                    @endif 
                </span>
            </li>

            <li class="list-group-item">Mensaje: {{$petition['message']}}</li>
          </ul>
          <div class="card-body">
            <a href="{{ url('petitions') }}" class="card-link">Volver Atras</a>
          </div>
    </div>
</div>

@endsection