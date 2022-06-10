@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Listado de Aulas</h3>

    {{-- Mensaje de error --}}
    @if($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach($errors->all() as $error)
                {{ $error }}<br/>
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
                        <td>Edificio</td>
                        <td>Capacidad</td>
                        <td>Tipo de aula</td>
                        <td>Acción</td>
                        <td>Estado</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classrooms as $class)
                        <tr>
                            <td> {{ $class->classroom_name }} </td>
                            <td>{{ $class->building }}</td>
                            <td>{{ $class->capacity }}</td>
                            <td>{{ $class->type }}</td>
                            <td>
                                {{-- Boton Ver --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $class->id }}">Ver
                                </button>
                                {{-- Modal Ver --}}
                                @include('classroom.show', ['classroom' => $class])

                                {{-- Boton editar --}}
                                @if ($class->deleted_at == null)
                                    <button type="button" id="buttonEdit{{ $class->id }}"
                                        class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $class->id }}" onclick="precargarSelect({{ $class }});">Editar</button>
                                @else
                                    <button type="button" id="buttonEdit{{ $class->id }}"
                                        class="btn btn-secondary btn-sm disabled" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $class->id }}">Editar</button>
                                @endif
                                {{-- Modal Editar --}}
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
    {{-- Select2 --}}
    <script src="{{ asset('js/classrooms/select2.js') }}" defer></script>

@endsection
