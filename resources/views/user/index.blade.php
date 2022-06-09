@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    @if ($errors->any())
    @foreach ($errors as $error)
        <h1> {{$error}} </h1>
    @endforeach
@endif


    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <h3 class="text-center m-4">Listado de Usuarios</h3>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif <div class="card" style="width: 1000px; margin: auto;">
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
                        <td  data-statusSvg="{{ $user->id }}">
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
                            @if ($user['deleted_at'] == null)
                                <button type="button" id="buttonEdit{{$user['id']}}" class="btn btn-secondary btn-sm" data-bs-toggle="modal"data-bs-target="#updateModal{{ $user->id }}">Editar</button>
                            @else
                                <button type="button" id="buttonEdit{{$user['id']}}" class="btn btn-secondary btn-sm disabled" data-bs-toggle="modal"data-bs-target="#updateModal{{$user->id}}">Editar</button>
                            @endif
                            {{-- update modal --}}
                            @include('user.edit' , ['user' => $user])
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input data-id="{{ $user->id }}" data-token="{{ csrf_token() }}"
                                    class="form-check-input activeSwitch" type="checkbox" role="switch"
                                    {{ !$user->trashed() ? 'checked' : '' }}>
                            </div>
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
   @include('user.create')
    <!-- Modal Ver-->
    <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#showModal" id="buttonShow">Ver usuario</button>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
  
    <script>
        $(document).ready(function() {
            $('.select_role').select2();
        });
    </script>

    {{-- Validator --}}
    <script src="{{ asset('js/users/validationUserCreate.js') }}" defer></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('js/users/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar usuario --}}
    <script src="{{ asset('js/users/disabledUser.js') }}" defer></script>

    {{-- Ver usuario --}}
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

    
@endsection


