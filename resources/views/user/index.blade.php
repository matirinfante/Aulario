@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <h3 class="text-center m-4">Listado de Usuarios</h3>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="users">
                <button type="" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#createModal" id="buttonCreate">Crear Usuario</button>
                <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>Estado</td>
                    <td>Accion</td>
                    <td>Cambiar estado</td>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user['name']}} {{$user['surname']}}</td>
                        <td>{{$user['email']}}</td>
                        <td class="text-secondary">
                            {{-- @if ($user['deleted_at'] != null)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08"
                                    class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            @endif --}}
                           hola
                        </td>
                      
                        <td>
                            <a class="btn btn-primary" style="pointer-events: auto;" onclick="seeUser({{$user}})">Ver</a>
                            <a class="btn btn-secondary" onclick="editUser({{$user}})" >Editar</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="">X</a>
                        </td>
                    </tr>
                @empty
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form id="form" class="" method="POST" action="{{route('users.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Robert">
                            <p class="alerta d-none" id="errorName">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Kiyosaki">
                            <p class="alerta d-none" id="errorSurname">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">Dni</label>
                            <input type="number" class="form-control" name="dni" id="dni" min="1000000" max="99999999"
                                placeholder="39504700">
                            <p class="alerta d-none" id="errorDni">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="robert@kiyosaki.com">
                            <p class="alerta d-none" id="errorEmail">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <p class="alerta d-none" id="errorPassword">Error</p>
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
    <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#showModal" id="buttonShow">Ver usuario</button>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <!-- Modal Editar-->
    <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#editModal" id="buttonEdit">editar usuario</button>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/validator@latest/validator.min.js"></script>
    <script src="{{ asset('js/validationUserCreate.js') }}" defer></script>
    <script>
        function seeUser(user){
            document.getElementById('showModal').innerHTML = `<div></div>`
            html = `
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center m-4">Detalles del Usuario</h3>
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body" id="modal_body_user_see">
                                    <h5 class="card-title">Usuario: ${user['name']} </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Apellido: ${user['surname']} </li>
                                        <li class="list-group-item">Dni: ${user['dni']} </li>
                                        <li class="list-group-item">Email: ${user['email']}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
           
            `
            document.getElementById('showModal').innerHTML = html 
            $('#buttonShow').click()
        }
        function editUser(user){
            document.getElementById('editModal').innerHTML = `<div></div>`
            html = `
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center m-4">Editar Usuario</h3>
                        <div class="card m-auto mt-3">
                            <div class="card-body text-center">
                                <div class="card-body" id="modal_body_user_see">
                                    <h5 class="card-title">Usuario: ${user['name']} </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Apellido: ${user['surname']} </li>
                                        <li class="list-group-item">Dni: ${user['dni']} </li>
                                        <li class="list-group-item">Email: ${user['email']}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
           
            `
            document.getElementById('editModal').innerHTML = html 
            $('#buttonEdit').click()
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });

        $('.form-delete').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Está seguro de que desea eliminar la materia?',
                text: "Esta acción es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b02a37',
                cancelButtonColor: '#0a58ca',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });



        $(document).ready(function () {
            var flash = $('#flashMessage');
            if (flash.find('.alert.alert-success').length > 0) {
                var contentFlash = $("#flashMessage:first").text().trim();
                switch (contentFlash) {
                    // CREACION DE MATERIA
                    case 'La materia se ha cargado exitosamente':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia creada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // MODIFICACION DE MATERIA
                    case 'Materia modificada con éxito':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia modificada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ELIMINACION DE MATERIA
                    case 'Materia eliminada con éxito':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia eliminada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR CREACION DE MATERIA
                    case 'Ha ocurrido un error al añadir la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al crear materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR MODIFICACION DE MATERIA
                    case 'Ha ocurrido un error al actualizar la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al modificar materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR MODIFICACION DE MATERIA
                    case 'Ha ocurrido un error al eliminar la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al eliminar materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                }
            }
        });
    



    </script>
@endsection


