@extends('layouts.app')

@section('content')

    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <style>
            .createModal,
            .updateModal {
                z-index: 1051;
            }
        </style>
    @endsection

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Listado de Materias</h3>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif 

    <p class="text-center">Estados: <br>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08" class="bi bi-check-circle"
             viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
        </svg>
         Habilitado&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle"
             viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
         Deshabilitado
    </p>

    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="assignments">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                        id="buttonCreate">Crear Materia
                </button>
                <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre de materia</td>
                    <td>Profesor/a</td>
                    <td>Cursada</td>
                    <td class="text-center">Acción</td>
                    <td class="text-center">Estado</td>
                </tr>
                </thead>
                <tbody>
                @forelse ($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->assignment_name }} </td>
                        <td>
                            @foreach ($assignment->users as $teacher)
                                <span class="label label-info bg-warning p-1 rounded">{{ $teacher->name }}
                                    {{ $teacher->surname }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if ($assignment->active == 1)
                                En curso
                            @else
                                Inactiva
                            @endif
                        </td>

                        <td>
                            {{-- view modal button --}}
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $assignment->id }}">Ver
                            </button>

                            {{-- view modal --}}
                            @include('assignment.show', ['assignment' => $assignment])


                            {{-- update modal button --}}
                            @if ($assignment->deleted_at == null)
                                <button type="button" id="buttonEdit{{ $assignment->id }}" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateModal{{ $assignment->id }}"
                                onclick="precargarSelect({{ $assignment }});">Editar</button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm disabled">Editar</button>
                            @endif

                            {{-- update modal --}}
                            @include('assignment.edit', ['assignment' => $assignment])


                        </td>

                        <td>
                            {{-- Habilitar/Deshabilitar materia (botón switch) --}}
                            <div class="form-check form-switch">
                                <input data-id="{{ $assignment->id }}" data-token="{{ csrf_token() }}"
                                       class="form-check-input activeSwitch" type="checkbox" role="switch"
                                    {{ !$assignment->trashed() ? 'checked' : '' }}>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="6" class="text-center text-secondary">No hay registros</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Crear-->
@include('assignment.create', ['assignment' => $assignment])


@endsection

@section('scripts')

    {{-- Validator --}}
    <script src="{{ asset('js/assignments/validationAssignmentCreate.js') }}" defer></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('js/assignments/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar usuario --}}
    <script src="{{ asset('js/assignments/disableAssignment.js') }}" defer></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/assignments/select2.js') }}" defer></script>

@endsection
