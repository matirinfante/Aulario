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
                        data-bs-target="#createModal" id="buttonCreate">Crear Evento <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                          </svg></button>
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
                                            data-bs-target="#viewModal{{ $event->id }}">Ver <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                              </svg>
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
                                                data-bs-target="#updateModal{{ $event->id }}">Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                  </svg>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-sm disabled">Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                              </svg></button>
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
    {{-- Script para las sweet alerts de reservas --}}
    <script src="{{ asset('js/bookings/sweetAlert.js') }}" defer></script>
    {{-- Deshabilitar evento --}}
    <script src="{{ asset('js/events/disableEvent.js') }}" defer></script>
@endsection
