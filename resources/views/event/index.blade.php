@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center m-4">Bienvenido a la página principal de Eventos</h3>
        <div class="card m-auto mt-3" style="width: 1000px;">
            <div class="card-body">
                <table class="table table-striped table-hover" id="events">
                    <button type="" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#createModal"
                        id="buttonCreate">Crear Evento</button>
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Capacidad</th>
                            <th scope='col' class='text-center'>Accion</th>
                            <th scope='col' class='text-center'>Eliminar Evento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td class="text-center">{{ $event->event_name }}</td>
                                <td class="text-center">{{ $event->participants }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" style="pointer-events: auto;"
                                        onclick="seeEvent({{ $event }})">Ver</a>
                                    <a class="btn btn-secondary" onclick="editEvent({{ $event }})">Editar</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger" href="">X</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="3" class="text-center text-secondary">No hay registros</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Crear-->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" class="" method="POST" action="{{ route('events.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="event_name" class="form-label">Nombre Evento</label>
                                <input type="text" class="form-control" id="event_name" name="event_name"
                                    placeholder="Parcial PWA">
                            </div>
                            <div class="mb-3">
                                <label for="participants" class="form-label">Participantes</label>
                                <input type="number" class="form-control" id="participants" name="participants"
                                    placeholder="50">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="submit" type="submit" class="btn btn-primary disabled">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Ver-->
        <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#showModal"
            id="buttonShow">Ver usuario</button>
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        </div>
        <!-- Modal Editar-->
        <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#editModal"
            id="buttonEdit">Editar Evento</button>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/validator@latest/validator.min.js"></script>

        <script>
            function editEvent(event) {
                document.getElementById('editModal').innerHTML = `<div></div>`
                html = `
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="form" class="" method="POST" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="event_name" class="form-label">Nombre Evento</label>
                                        <input type="text" class="form-control" id="event_name" name="event_name" value="${ event['event_name'] }">
                                    </div>
                                    <div class="mb-3">
                                        <label for="participants" class="form-label">Participantes</label>
                                        <input type="number" class="form-control" id="participants" name="participants value="${event['participants']}">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button id="submit" type="submit" class="btn btn-primary disabled">Modificar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    `
                document.getElementById('editModal').innerHTML = html
                $('#buttonEdit').click()
            }

            function seeEvent(event) {
                document.getElementById('showModal').innerHTML = `<div></div>`
                html = `
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center m-4">Detalles del Evento</h3>
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body" id="modal_body_user_see">
                                    <h5 class="card-title">Nombre: ${event['event_name']} </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Participantes: ${event['participants']} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
                document.getElementById('showModal').innerHTML = html
                $('#buttonShow').click()
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#events').DataTable();
            });
        </script>
    </div>
@endsection
