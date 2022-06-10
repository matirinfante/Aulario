@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Listado de Aulas</h3>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="classroom">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                    id="buttonCreate">Crear Aula
                </button>
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Locación</td>
                        <td>Edificio</td>
                        <td>Capacidad</td>
                        <td>Tipo de aula</td>
                        <td>Estado</td>
                        <td>Acción</td>
                        <td>H/D</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classrooms as $class)
                        <tr>
                            <td> {{ $class->classroom_name }} </td>
                            <td>{{ $class->location }}</td>
                            <td>{{ $class->building }}</td>
                            <td>{{ $class->capacity }}</td>
                            <td>{{ $class->type }}</td>
                            <td class="text-secondary" data-statusSvg="{{ $class->id }}">
                                @if (!isset($class->deleted_at))
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
                                {{-- view modal button --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $class->id }}">Ver
                                </button>
                                {{-- view modal --}}
                                @include('classroom.show', ['classroom' => $class])

                                {{-- update modal button --}}
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#updateModal{{ $class->id }}">Editar
                                </button>
                                {{-- update modal --}}
                                @include('classroom.edit', ['classroom' => $class])

                                {{-- Boton Deshabilitar/Habilitar --}}
                            <td>
                                <div class="form-check form-switch">
                                    <input data-id="{{ $class->id }}" data-token="{{ csrf_token() }}"
                                        class="form-check-input activeSwitch" type="checkbox" role="switch"
                                        {{ !$class->trashed() ? 'checked' : '' }}>
                                </div>
                            </td>
                            </td>
                        </tr>
                    @empty
                        <td colspan="8" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear-->
    @include('classroom.create')


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>


    {{-- Validator --}}
    <script src="{{ asset('js/classrooms/validationClassroomCreate.js') }}" defer></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('js/classrooms/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar aula --}}
    <script src="{{ asset('js/classrooms/disableClassroom.js') }}" defer></script>

@endsection
