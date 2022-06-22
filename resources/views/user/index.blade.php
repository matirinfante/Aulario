@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    @if ($errors->any())
        <div class="d-none" id="errorsMsj" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif

    <h3 class="text-center m-4">Listado de Usuarios</h3>

    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="users">
                @can('create users')
                    <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createModal" id="buttonCreate">Crear Usuario</button>
                @endcan
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Email</td>
                        @canany(['show users', 'edit users'])
                            <td>Accion</td>
                        @endcanany
                        @can('delete users')
                            <td>Cambiar estado</td>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td> {{ $user['name'] }} {{ $user['surname'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            @canany(['show users', 'edit users'])
                                <td>
                                    @can('show users')
                                        {{-- Ver Usuario --}}
                                        <a class="btn btn-primary btn-sm" style="pointer-events: auto;"
                                            onclick="seeUser({{ $user }})">Ver</a>
                                    @endcan
                                    @can('edit users')
                                        {{-- Boton editar / activa el modal --}}
                                        @if ($user['deleted_at'] == null)
                                            <button type="button" id="buttonEdit{{ $user['id'] }}"
                                                class="btn btn-secondary btn-sm"
                                                data-bs-toggle="modal"data-bs-target="#updateModal{{ $user->id }}">Editar</button>
                                        @else
                                            <button type="button" id="buttonEdit{{ $user['id'] }}"
                                                class="btn btn-secondary btn-sm disabled"
                                                data-bs-toggle="modal"data-bs-target="#updateModal{{ $user->id }}">Editar</button>
                                        @endif
                                        {{-- update modal --}}
                                        @include('user.edit', ['user' => $user])
                                    @endcan
                                </td>
                            @endcanany
                            @can('delete users')
                                <td>
                                    <div class="form-check form-switch">
                                        <input data-id="{{ $user->id }}" data-token="{{ csrf_token() }}"
                                            class="form-check-input activeSwitch" type="checkbox" role="switch"
                                            {{ !$user->trashed() ? 'checked' : '' }}>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <td colspan="4">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    @can('create users')
        <!-- Modal Crear-->
        @include('user.create')
    @endcan
    @can('show users')
        <!-- Modal Ver-->
        <button type="" class="btn btn-success m-3 d-none" data-bs-toggle="modal" data-bs-target="#showModal"
            id="buttonShow">Ver usuario</button>
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        </div>
    @endcan

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
        function seeUser(user) {
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
                                        <li class="list-group-item">Estado: ${user['deleted_at'] ? 'Deshabilitado' : 'Habilitado' } </li>
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
