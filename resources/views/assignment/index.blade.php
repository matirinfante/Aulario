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
                <button type="submit" class="btn btn-sm btn-outline-success">Cambiar de cuatrimestre <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                  </svg>
                </button>
            </form>
            <table class="table table-striped table-hover" id="assignments">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                        id="buttonCreate">Crear Materia <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                          </svg>
                </button>

                <thead class="bg-secondary text-light">
                <tr>
                    <th>Nombre de materia</th>
                    <th style="width: 200px;">Profesor/a</th>
                    <th>Cursada</th>
                    <th class="text-center">Acción</th>
                    <th class="text-center">Estado</th>
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
                                    data-bs-target="#viewModal{{ $assignment->id }}">Ver <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                      </svg>
                            </button>

                            {{-- view modal --}}
                            @include('assignment.show', ['assignment' => $assignment])


                            {{-- update modal button --}}
                            @if ($assignment->deleted_at == null)
                                <button type="button" id="buttonEdit{{ $assignment->id }}"
                                        class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $assignment->id }}"
                                        onclick="precargarSelect({{ $assignment }}); validarUpdate({{ $assignment->id }});">
                                    Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                      </svg>
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm disabled">Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                  </svg></button>
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
