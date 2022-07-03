@extends('layouts.app')

@section('content')

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Listado de Aulas</h3>

    {{-- Mensaje de error --}}
    @if ($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif

    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="classroom">
                @can('create classrooms')
                    <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createModal" id="buttonCreate">Crear Aula <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                          </svg>
                    </button>
                @endcan
                <thead class="bg-secondary text-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Edificio</th>
                        <th>Capacidad</th>
                        <th>Tipo de aula</th>
                        @canany(['show classrooms', 'edit classrooms'])
                            <th>Acción</th>
                        @endcanany
                        @can('delete classrooms')
                            <th>Estado</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classrooms as $class)
                        <tr>
                            <td> {{ $class->classroom_name }} </td>
                            <td>{{ $class->building }}</td>
                            <td>{{ $class->capacity }}</td>
                            <td>{{ $class->type }}</td>
                            @canany(['show classrooms', 'edit classrooms'])
                                <td>
                                    @can('show classrooms')
                                        {{-- Boton Ver --}}
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $class->id }}">Ver <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                              </svg>
                                        </button>
                                        {{-- Modal Ver --}}
                                        @include('classroom.show', ['classroom' => $class])
                                    @endcan

                                    @can('edit classrooms')
                                        {{-- Boton editar --}}
                                        @if ($class->deleted_at == null)
                                            <button type="button" id="buttonEdit{{ $class->id }}"
                                                class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $class->id }}"
                                                onclick="precargarSelect({{ $class }});">Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                  </svg>
                                            </button>
                                        @else
                                            <button type="button" id="buttonEdit{{ $class->id }}"
                                                class="btn btn-secondary btn-sm disabled" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $class->id }}">Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                  </svg>
                                            </button>
                                        @endif
                                        {{-- Modal Editar --}}
                                        @include('classroom.edit', ['classroom' => $class])
                                    @endcan

                                </td>
                            @endcanany
                            @can('delete classrooms')
                                <td>
                                    {{-- Boton Deshabilitar/Habilitar --}}
                                    <div class="form-check form-switch">
                                        <input data-id="{{ $class->id }}" data-token="{{ csrf_token() }}"
                                            class="form-check-input activeSwitch" type="checkbox" role="switch"
                                            {{ !$class->trashed() ? 'checked' : '' }}>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <td colspan="8" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @can('create classrooms')
        <!-- Modal Crear-->
        @include('classroom.create')
    @endcan

@endsection
@section('scripts')
    {{-- Validator --}}
    <script src="{{ asset('js/classrooms/validationClassroomCreate.js') }}" defer></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('js/classrooms/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar aula --}}
    <script src="{{ asset('js/classrooms/disableClassroom.js') }}" defer></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/classrooms/select2.js') }}" defer></script>
@endsection
