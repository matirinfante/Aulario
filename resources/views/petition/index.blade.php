<!--
    -(Usa los permisos, mas facil que crear una vista)  Crear vista de reservas segun el usuario que reservo, sus propias reservas.
    -Si el admin no puede crear reserva, entonces que el id de usuario y nombre que las crea, sea predefinido en el sistema, y evitar cambios.
    -Hacer la comprobacion de campos.
    -Flash alert para aceptados, rechazados, o creados
    -Arreglar bugs de la vista como th y el datatable
    -Permisos de los profesores
-->

@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @hasanyrole('teacher')
    <h3 class="text-center m-4">Mis Peticiones</h3>
    @else
    <h3 class="text-center m-4">Listado de Peticiones</h3>
    @endhasanyrole
    <div>
        <div class="row" align=center>
            <div class="col-12 pb-3">
                @can('create petitions')
                <!-- Traemos el usuario al cual le vamos a sacar la inf. Es un obj. -->
                @php
                $user = auth()->user();
                @endphp
                <button type='button' class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#createModal{{ $user->id }}">Crear nueva petición
                </button>
                @include('petition.create', ['user' => $user])
                @endcan
            </div>
        </div>
    </div>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="petitions_tab">
                <thead class="bg-secondary text-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Materia</th>
                        <th>Personas Estimadas</th>
                        <th>Tipo Aula</th>
                        <th>Estado</th>
                        @can('show petitions')
                        <th>Acción</th>
                        @endcan
                        @canany(['reject petitions', 'accept petitions'])
                        <th></th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petitions as $petition)
                    <tr>
                        <td style="vertical-align: middle;"> {{ $petition->user->name }}
                            {{ $petition->user->surname }}
                        </td>
                        <td style="vertical-align: middle;"> {{ $petition->assignment->assignment_name }}</td>
                        <td style="vertical-align: middle;"> {{ $petition['estimated_people'] }}</td>
                        <td style="vertical-align: middle;"> {{ $petition['classroom_type'] }} </td>
                        <td style="vertical-align: middle;">
                            @if ($petition['status'] == 'unsolved')
                            <span class="badge bg-warning"> Sin resolver </span>
                            @elseif ($petition['status'] == 'rejected')
                            <span class="badge bg-danger"> Rechazada </span>
                            @else
                            <span class="badge bg-success"> Aceptada </span>
                            @endif
                        </td>
                        @can('show petitions')
                        <td style="vertical-align: middle; text-align: center;">
                            <!-- Boton Modal Detalles -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $petition['id'] }}">Detalles
                            </button>
                            @include('petition.show', ['petition' => $petition])
                        </td>
                        @endcan
                        @canany(['reject petitions', 'accept petitions'])
                        <td style="vertical-align: middle; text-align: center;">
                            @if ($petition['status'] == 'unsolved')
                            <div class="container">
                                @can('accept petitions')
                                <!-- Boton Aceptar Peticion -->
                                <div align='center' style="margin-bottom: 5px;">
                                    <form method="get" action="{{ route('bookings.petition') }}">
                                        <input hidden value="{{ $petition->id }}" name="id">
                                        <button type="submit" class="btn btn-success btn-sm" data-bs-target="{{ $petition['id'] }}">Asignar aulas
                                        </button>
                                    </form>
                                </div>
                                @endcan
                                @can('delete petitions')
                                <!-- Boton Rechazar Peticion -->
                                <div align='center'>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedModal{{ $petition['id'] }}">Rechazar
                                    </button>
                                </div>
                                @endcan
                            </div>
                            @can('delete petitions')
                            <!-- Modal Rechazar Detalles -->
                            @include('petition.edit', ['petition' => $petition])
                            @endcan
                            @endif
                        </td>
                        @endcanany
                    </tr>
                    @empty
                    @canany(['reject petitions', 'accept petitions'])
                    <td class="text-center text-secondary" colspan="6">No hay registros</td>
                    @else
                    <td class="text-center text-secondary" colspan="7">No hay registros</td>
                    @endcanany
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection