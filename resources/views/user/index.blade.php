@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>  

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
                        <td>
                            @if (!($user->trashed()))
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
                            @endif
                        </td>
                        <td>
                            {{-- Ver Usuario --}}
                            <a class="btn btn-primary btn-sm" style="pointer-events: auto;" onclick="seeUser({{$user}})">Ver</a>
                            {{-- Boton editar / activa el modal --}}
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"data-bs-target="#updateModal{{ $user->id }}">Editar</button>
                            {{-- update modal --}}
                            <div class="modal fade updateModal" id="updateModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar materia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="form_update" method="post"
                                                action="{{ route('users.update', $user->id) }}">
                                                @csrf @method('PATCH')
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="name" value=" {{$user['name']}} ">
                                                   
                                                </div>
                                                <div class="mb-3">
                                                    <label for="surname" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control" name="surname"  value="{{$user['surname']}}">
                                                   
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dni" class="form-label">Dni</label>
                                                    <input type="number" class="form-control" name="dni"  min="1000000" max="99999999"
                                                        value="{{$user['dni']}}">
                                  
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"  value="{{$user['email']}}">
                                                   
                                                </div>
                                            
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </td>
                        <td>
                            {{-- Se corrigio metodo POST, se agrego condicion, si el usuario no esta borrado  --}}
                            @if(!($user->trashed()))
                            <form method="POST" 
                            action=" {{route('users.destroy',$user['id'] )}} ">
                            @csrf @method('delete')
                            <button class="btn btn-danger btn-sm">X</button>
                            </form>
                            @else
                            <form method="POST" 
                            action=" {{route('users.activate',$user['id'] )}} ">
                            @csrf @method('put')
                            <button class="btn btn-success btn-sm">X</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <td colspan="5">No hay registros</td>
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
                    <form id="form" method="POST" action="{{route('users.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="user_name" placeholder="Robert">
                            <p class="alerta d-none" id="errorName">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="surname" id="user_surname" placeholder="Kiyosaki">
                            <p class="alerta d-none" id="errorSurname">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">Dni</label>
                            <input type="number" class="form-control" name="dni" id="user_dni" min="1000000" max="99999999" placeholder="39504700">
                            <p class="alerta d-none" id="errorDni">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="user_email" placeholder="robert@kiyosaki.com">
                            <p class="alerta d-none" id="errorEmail">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="user_password">
                            <p class="alerta d-none" id="errorPassword">Error</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="create_submit" type="submit" class="btn btn-primary disabled">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ver-->
    <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#showModal" id="buttonShow">Ver usuario</button>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>

 
    
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
                    // CREACION DE USUARIO
                    case 'Se ha registrado correctamente el nuevo usuario':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Se ha registrado correctamente el nuevo usuario.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // MODIFICACION DE MATERIA
                    case 'Se actualizó correctamente al usuario':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Se actualizó correctamente al usuario.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ELIMINACION DE MATERIA
                    case 'Se eliminó correctamente al usuario':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Se DESHABILITÓ correctamente al usuario.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR CREACION DE USUARIO
                    case 'Ha ocurrido un error al registrar al usuario':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Ha ocurrido un error al registrar al usuario.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR MODIFICACION DE MATERIA
                    case 'Ha ocurrido un error al actualizar al usuario':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Ha ocurrido un error al actualizar al usuario',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                        
                    case 'Usuario habilitado correctamente':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Usuario habilitado correctamente',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                        break;
                }
            }
        });
    </script>
@endsection


