@extends('layouts.app')

@section('content')

    @section('styles')
        <style>
            .createModal,
            .updateModal {
                z-index: 1051;
            }

            .bg-warning {
                background-color: #ffd968 !important;
            }
        </style>
    @endsection

    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>

    <h3 class="text-center m-4">Listado de Materias</h3>
    @if($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif

    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">
            <form method="POST" action="{{ route('assignments.toggle') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-success">Cambiar de cuatrimestre
                </button>
            </form>
            <table class="table table-striped table-hover" id="assignments">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                        id="buttonCreate">Crear Materia
                </button>

                <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre de materia</td>
                    <td style="width: 200px;">Profesor/a</td>
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
                                <div>
                                <span class="label label-info bg-warning p-1 rounded">{{ $teacher->name }}
                                    {{ $teacher->surname }}</span>
                                </div>
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
                                <button type="button" id="buttonEdit{{ $assignment->id }}"
                                        class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $assignment->id }}"
                                        onclick="precargarSelect({{ $assignment }}); validarUpdate({{ $assignment->id }});">
                                    Editar
                                </button>
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
                    <td colspan="5" class="text-center text-secondary">No hay registros</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Crear-->
    @include('assignment.create', ['assignment' => $assignment])

@endsection

@section('scripts')

    {{-- Validator create--}}
    <script src="{{ asset('js/assignments/validationAssignmentCreate.js') }}" defer></script>
    {{-- Validator update--}}
    <script src="{{ asset('js/assignments/validationAssignmentUpdate.js') }}" defer></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('js/assignments/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar materia --}}
    <script src="{{ asset('js/assignments/disableAssignment.js') }}" defer></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/assignments/select2.js') }}" defer></script>

@endsection
