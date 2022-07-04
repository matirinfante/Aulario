@extends('layouts.app')

@section('styles')
@endsection

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

    <h3 class="text-center m-4">Disponibilidad horaria de aulas</h3>


    @can('show schedule')
        <div class="card" style="width: 1000px; margin: auto;">
            <div class="card-body">
                <table class="table table-striped table-hover" id="users">
                    @can('create schedule')
                        <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal"
                            data-bs-target="#createModal" id="buttonCreate">Crear Horario</button>
                    @endcan
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th>Aula</th>
                            <th>Día</th>
                            <th>Hora Inicio</th>
                            <th>Hora Final</th>
                            @can('delete schedule')
                                <th>Acción</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $scheduled)
                            <tr>
                                <td> {{ $scheduled->classroom->classroom_name }}</td>
                                <td>{{ $scheduled->day }}</td>
                                <td class="schedule_time_table" style="background: #B5FF9D; color: #1f7c00;">
                                    {{ $scheduled['start_time'] }}
                                </td>
                                <td class="schedule_time_table" style="background: #FFA39D; color: #871e16">
                                    {{ $scheduled['finish_time'] }}
                                </td>
                                @can('delete schedule')
                                    <td>
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input data-id="{{ $scheduled->id }}" data-token="{{ csrf_token() }}"
                                                class="form-check-input activeSwitch" type="checkbox" role="switch" checked>
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
    @endcan

    @include('schedule.create', $classrooms)

    {{-- <script src="{{ asset('js/scheduled/select2.js') }}"></script> --}}

@endsection


@section('scripts')
    <script src="{{ asset('js/scheduled/sweetAlert.js') }}"></script>
    <script src="{{ asset('js/scheduled/disabledSchedule.js') }}"></script>
    <script src="{{ asset('js/scheduled/validatorSchedule.js') }}"></script>
@endsection
