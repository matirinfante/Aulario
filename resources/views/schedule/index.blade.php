@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="card" style="width: 1000px; margin: auto;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="users">
            <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal" id="buttonCreate">Crear Horario</button>
            <thead class="bg-secondary text-light">
            <tr>
                <td>Aula</td>
                <td>Dia</td>
                <td>Hora Inicio</td>
                <td>Hora Final</td>
                <td>Accion</td>
            </tr>
            </thead>
            <tbody>
            @forelse ($schedules as $scheduled)
                <tr>
                    <td> {{$scheduled->classroom->classroom_name}}</td>
                    <td>{{$scheduled->day}}</td>
                    <td class="schedule_time_table" style="background: #B5FF9D; color: #1f7c00;">
                        {{$scheduled['start_time']}}
                    </td>
                    <td class="schedule_time_table" style="background: #FFA39D; color: #871e16">
                        {{$scheduled['finish_time']}}
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input data-id="{{ $scheduled->id }}" data-token="{{ csrf_token() }}"
                                class="form-check-input activeSwitch" type="checkbox" role="switch">
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="5">No hay registros</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('schedule.create' , $classrooms)
    <script src="{{ asset('js/scheduled/select2.js') }}"></script>
    {{-- <script src="{{ asset('js/scheduled/validatorSchedule.js') }}"></script> --}}
@endsection



