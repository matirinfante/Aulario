<!--
    -(Usa los permisos, mas facil que crear una vista)  Crear vista de reservas segun el usuario que reservo, sus propias reservas.
    -Si el admin no puede crear reserva, entonces que el id de usuario y nombre que las crea, sea predefinido en el sistema, y evitar cambios.
    -Hacer la comprobacion de campos.
-->

@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <h3 class="text-center m-4">Listado de Peticiones</h3>
    <div>
        <div class="row" align=center>
            <div class="col-12 pb-3">
                <!-- Traemos el usuario al cual le vamos a sacar la inf. Es un obj. -->
                @php
                $user = auth()->user();
                @endphp
                <button type='button' class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#createModal{{ $user->id }}">Crear nueva peticion
                </button>
                @include('petition.create', ['user' => $user])
            </div>
        </div>
    </div>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="petitions_tab">
                <thead class="bg-secondary text-light">
                    <tr>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Usuario
                        </th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Materia
                        </th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Personas Estimadas
                        </th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Tipo Aula
                        </th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Estado
                        </th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Accion
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petitions as $petition)
                    <tr>
                        <td style="vertical-align: middle;"> {{$petition->user->name}} {{$petition->user->surname}}</td>
                        <td style="vertical-align: middle;"> {{$petition->assignment->assignment_name}}</td>
                        <td style="vertical-align: middle;"> {{$petition['estimated_people']}}</td>
                        <td style="vertical-align: middle;"> {{$petition['classroom_type']}} </td>
                        <td style="vertical-align: middle;">
                            @if ($petition['status'] == 'unsolved')
                            <span class="badge bg-warning"> Sin resolver </span>
                            @elseif ($petition['status'] == 'rejected')
                            <span class="badge bg-danger"> Rechazada </span>
                            @else
                            <span class="badge bg-success"> Aceptada </span>
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            <!-- Boton Modal Detalles -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $petition['id'] }}">Detalles
                            </button>
                            @include('petition.show', ['petition' => $petition])
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            @if ($petition['status'] == 'unsolved')
                            <div class="container">
                                <!-- Boton Aceptar Peticion -->
                                <div align='center' style="margin-bottom: 5px;">
                                    <form method="post" action="{{route('bookings.petition')}}">
                                        @csrf
                                        <input hidden value="{{$petition->id}}" name="id">
                                        <button type="submit" class="btn btn-success btn-sm" data-bs-target="{{ $petition['id'] }}">Asignar aulas</button>
                                    </form>
                                </div>
                                <!-- Boton Rechazar Peticion -->
                                <div align='center'>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedModal{{ $petition['id'] }}">Rechazar</button>
                                </div>
                            </div>
                            <!-- Modal Rechazar Detalles -->
                            @include('petition.edit', ['petition' => $petition])
                            @endif
                        </td>
                    </tr>
                    @empty
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#petitions_tab').DataTable();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

@endsection