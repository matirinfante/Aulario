@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>
    @hasanyrole('user|teacher')
        <h3 class="text-center m-4">Mis Eventos</h3>
    @else
        <h3 class="text-center m-4">Listado de Eventos</h3>
    @endhasanyrole
    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="events">
                @can('create events')
                    <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createModal" id="buttonCreate">Crear Evento</button>
                @endcan
                <thead class="bg-secondary text-light">
                    <tr>
                        <th scope='col' class='text-center'>Nombre</th>
                        <th scope='col' class='text-center'>Capacidad</th>
                        @canany(['show events', 'edit events'])
                            <th scope='col' class='text-center'>Acción</th>
                        @endcanany
                        @can('delete events')
                            <th scope='col' class='text-center'>Estado</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td class="text-center">{{ $event->event_name }}</td>
                            <td class="text-center">{{ $event->participants }}</td>
                            @canany(['show events', 'edit events'])
                                <td class="text-center">
                                    @can('show events')
                                        {{-- Boton ver evento --}}
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $event->id }}">Ver
                                        </button>
                                        {{-- Modulo ver evento en archivo show.blade.php --}}
                                        @include('event.show', ['event' => $event])
                                    @endcan

                                    @can('edit events')
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
                                    @endcan
                                </td>
                            @endcanany
                            @can('delete events')
                                <td class="text-center">
                                    {{-- Habilitar/Deshabilitar materia (botón switch) --}}
                                    <div class="form-check form-switch">
                                        <input data-id="{{ $event->id }}" data-token="{{ csrf_token() }}"
                                            class="form-check-input activeSwitch" type="checkbox" role="switch"
                                            {{ !$event->trashed() ? 'checked' : '' }}>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <td colspan="5" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @can('create events')
        <!-- Modulo crear evento en archivo create.blade.php-->
        @include('event.create')
    @endcan
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
