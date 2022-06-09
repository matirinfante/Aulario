@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>
    <h3 class="text-center m-4">Listado de Eventos</h3>
    <p class="text-center">Estados: <br>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08" class="bi bi-check-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>
        = Habilitado(H)&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
        </svg>
        = Deshabilitado(D)
    </p>
    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="events">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                    id="buttonCreate">Crear Evento</button>
                <thead class="bg-secondary text-light">
                    <tr>
                        <th scope='col' class='text-center'>Nombre</th>
                        <th scope='col' class='text-center'>Capacidad</th>
                        <th scope='col' class='text-center'>Accion</th>
                        <th scope='col' class='text-center'>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td class="text-center">{{ $event->event_name }}</td>
                            <td class="text-center">{{ $event->participants }}</td>
                            <td class="text-center">
                                {{-- Boton ver evento --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $event->id }}">Ver
                                </button>
                                {{-- Modulo ver evento en archivo show.blade.php --}}
                                @include('event.show', ['event' => $event])

                                {{-- Boton actualizar evento --}}
                                @if ($event->deleted_at == null)
                                    {{-- {{dd($event)}} --}}
                                    <button type="button" id="buttonEdit{{ $event->id }}"
                                        class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $event->id }}">Editar
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm disabled">Editar</button>
                                @endif
                                {{-- Modulo editar evento en archivo edit.blade.php --}}
                                @include('event.edit', ['event' => $event])
                            </td>
                            <td class="text-center">
                                {{-- Habilitar/Deshabilitar materia (botón switch) --}}
                                <div class="form-check form-switch">
                                    <input data-id="{{ $event->id }}" data-token="{{ csrf_token() }}"
                                        class="form-check-input activeSwitch" type="checkbox" role="switch"
                                        {{ !$event->trashed() ? 'checked' : '' }}>
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
    <!-- Modulo crear evento en archivo create.blade.php-->
    @include('event.create')
@endsection

{{-- Seccion de scripts --}}
@section('scripts')
    {{-- Script para validar el formulario de crear evento --}}
    <script src="{{ asset('js/events/validationEventCreate.js') }}" defer></script>
    {{-- Script para las sweet alerts de eventos --}}
    <script src="{{ asset('js/events/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar evento --}}
    <script src="{{ asset('js/events/disableEvent.js') }}" defer></script>
@endsection
