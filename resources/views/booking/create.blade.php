@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Ver
    </button>


    <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Reserva de evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form id="createBookingForm" name="form_booking" method="POST" action="{{ route('bookings.store') }}"> --}}
                    <form id="createBookingForm" name="form_booking" method="POST"
                        action="{{ route('bookings.store', [
                            'participants' => 10,
                            'classroom_id' => 8,
                            'booking_date' => '2022-06-15',
                        ]) }}">
                        {{-- pasar como parámetros en action = 'classroom_id', 'participants', 'booking_date' --}}
                        @csrf
                        {{-- nombre evento --}}
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Nombre del evento</label>
                            <input type="text" class="form-control" name="event_name" id="createName"
                                placeholder="Parcial ADyDS" required>
                            <small id="errorCreateBookingName"></small>
                        </div>

                        {{-- descripción --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description" id="createDescription" required>
                            <small id="errorCreateBookingDescription"></small>
                        </div>

                        {{-- horas disponibles (inicio) --}}
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Hora de inicio</label>
                            <select name="start_time" class="form-select">
                                <option value="-1" disabled selected></option>
                                <option value="1">16:00</option>
                                <option value="2">16:30</option>
                            </select>
                            <small id="errorCreateBookingStartTime"></small>
                        </div>

                        {{-- horas disponibles (fin) --}}
                        <div class="mb-3">
                            <label for="finishTime" class="form-label">Hora de fin</label>
                            <select name="finish_time" class="form-select">
                                <option value="-1" disabled selected></option>
                                <option value="1">17:00</option>
                                <option value="2">17:30</option>
                            </select>
                            <small id="errorCreateBookingStartTime"></small>
                        </div>
                        <input type="hidden" class="classroomID" name="classroom_id" data-classId="8">
                        <button id="createBooking" type="submit" class="btn btn-primary disabled">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var url = `/bookings/periods`;
            // var classroomId = $('.classroomID').data("classId");
            var classroomId = 8;
            var date = "2022-06-27";
            $.ajax({
                type: 'POST',
                url: url,
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    classroom_id: classroomId,
                    date: date
                },
                success: function(data) {
                    alert(data);
                }
            });
        });
    </script>
@endsection
