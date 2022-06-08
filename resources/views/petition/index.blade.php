@extends('layouts.app')
@section('content')
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <h3 class="text-center m-4">Listado de Peticiones</h3>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="users">
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Id</td>
                        <td>Id_Usuario</td>
                        <td>Id_Materia</td>
                        <td>Personas Estimadas</td>
                        <td>Tipo Aula</td>
                        <td>Estado</td>
                        <td>Accion</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petitions as $petition)
                        <tr>
                            <td> {{ $petition['id'] }} </td>
                            <td>{{ $petition['user_id'] }}</td>
                            <td>{{ $petition['assignment_name'] }}</td>
                            <td>{{ $petition['estimated_people'] }}</td>
                            <td> {{ $petition['classroom_type'] }} </td>
                            <td>
                                @if ($petition['status'] == 'unsolved')
                                    <span class="badge bg-warning"> Sin resolver </span>
                                @elseif ($petition['status'] == 'rejected')
                                    <span class="badge bg-danger"> Cancelado </span>
                                @else
                                    <span class="badge bg-success"> Aceptada </span>
                                @endif

                                <div class="form-check form-switch">
                                    <button class="changeState" data-id="{{ $petition->id }}" value="1">
                                        Cambiar
                                    </button>
                                    {{-- <a href="{{ route('petitions.changeStatus', "$petition->id") }}">a</a> --}}
                                </div>

                            </td>
                            <td>
                                <a class="link-primary" href="{{ route('petitions.show', $petition['id']) }}">Ver
                                    Completo</a>
                                <a class="link-success"
                                    href=" {{ route('petitions.edit', $petition['id']) }}">Editar</a>
                                <a class="link-danger buttonDelete" href="">Borrar</a>
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
=======
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<h3 class="text-center m-4">Listado de Peticiones</h3>
<div class="card" style="width: 1000px; margin: auto;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="users">
            <thead class="bg-secondary text-light">
                <tr>
                    <td>Id</td>
                    <td>Id_Usuario</td>
                    <td>Id_Materia</td>
                    <td>Personas Estimadas</td>
                    <td>Tipo Aula</td>
                    <td>Estado</td>
                    <td>Accion</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($petitions as $petition)
                <tr>
                    <td> {{$petition['id']}} </td>
                    <td> {{$petition['user_id']}}</td>
                    <td> {{$petition['assignment_name']}}</td>
                    <td> {{$petition['estimated_people']}}</td>
                    <td> {{$petition['classroom_type']}} </td>
                    <td>
                        @if ($petition['status'] == 'unsolved')
                        <span class="badge bg-warning"> Sin resolver </span>
                        @elseif ($petition['status'] == 'rejected')
                        <span class="badge bg-danger"> Rechazada </span>
                        @else
                        <span class="badge bg-success"> Aceptada </span>
                        @endif
                    </td>
                    <td>
                        <!-- <a class="link-primary" href="{{route('petitions.show', $petition['id'])}}">Ver Completo</a> -->
                        <!-- Con modal -->
                        {{-- view modal button --}}
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $petition['id'] }}">Detalles</button>
                        <!--Pendiente: Modularizar-->
                        {{-- view modal --}}
                        <div class="modal fade" id="viewModal{{ $petition->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Datalles de Reserva</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="card-text"><span class="text-secondary">Id de Usuario (Nombre profesor):<br><br></span>
                                            {{ $petition->user_id }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">ID de la Materia(Materia):</span>
                                            {{ $petition->assignment_id }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">Días:</span>
                                            {{ $petition->days }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">Hora de Inicio:</span>
                                            {{ $petition->start_time }}
                                        </p>
                                        <p class="card-text"><span class="text-secondary">Hora de Fin:</span>
                                            {{ $petition->finish_time }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">Tipo de Aula:</span>
                                            {{ $petition->classroom_type }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">Mensaje:</span>
                                            {{ $petition->message }}
                                        </p>
                                        <hr>
                                        <p class="card-text"><span class="text-secondary">Estado:</span>
                                            @if ($petition['status'] == 'unsolved')
                                            <!-- <span class="badge bg-warning"> {{$petition['status']}} </span> -->
                                            <span class="badge bg-warning"> Sin resolver </span>
                                            @elseif ($petition['status'] == 'rejected')
                                            <!-- <span class="badge bg-danger"> {{$petition['status']}} </span> -->
                                            <span class="badge bg-danger"> Rechazada </span>
                                            @else
                                            <!-- <span class="badge bg-success"> {{$petition['status']}} </span> -->
                                            <span class="badge bg-success"> Aceptada </span>
                                            @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button action=''>
                            <a class="link-success" href=" {{route('petitions.edit', $petition['id'])}}">Editar</a>
                            <a class="link-danger buttonDelete" href="">Borrar</a>
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
>>>>>>> be0fb76aeed6d299daa3d8b98f4fed9bcdf32ee4
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- <script>
        $('.changeState').click(function(e) {
            var id = $(this).data('id');
            var status = $(this).val();
            console.log(id);
            console.log(status);
            // var url = "{{ route('petitions.changeStatus') }}";

            $.ajax({
                type: 'post',
                url: "url",
                data: 'data',
                success: function(response) {
                  console.log(response);
                }
            });
        });
    </script> --}}
@endsection
