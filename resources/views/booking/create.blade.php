@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger d-none" id="errorsMsj" role="alert">

            @foreach ($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Ver
    </button>


    <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Reserva de evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createBookingForm" name="form_booking" method="POST"
                          action="{{ route('bookings.store') }}">
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
                            <select name="start_time" class="form-select start_time">
                                <option disabled selected>Elija una opción
                                </option>
                            </select>
                            <small id="errorCreateBookingStartTime"></small>
                        </div>

                        {{-- horas disponibles (fin) --}}
                        <div class="mb-3">
                            <label for="finishTime" class="form-label">Hora de fin</label>
                            <select disabled name="finish_time" class="form-select finish_time">
                                <option disabled selected>Elija una opción
                                </option>
                            </select>
                            <small id="errorCreateBookingStartTime"></small>
                        </div>
                        {{-- los siguientes parametros en value serán los que lleguen desde el calendario --}}
                        <input type="hidden" class="classroomID" name="classroom_id" value="7">
                        <input type="hidden" class="participants" name="participants" value="10">
                        <input type="hidden" class="bookingDate" name="booking_date" value="2022-06-21">

                        <button id="createBooking" type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var url = `/bookings/periods`;
            var classroomId = $('.classroomID').val();
            var date = $('.bookingDate').val();
            var inicioArr = [];
            $.ajax({
                type: 'POST',
                url: url,
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    classroom_id: classroomId,
                    date: date
                },
                success: function (data) {
                    if (data.length > 1) {
                        data.forEach(function (elem) {
                            elem.pop()
                            inicioArr.push(elem)
                        })
                        for (let i = 0; i < inicioArr.length; i++) {
                            for (let j = 0; j < inicioArr[i].length; j++) {
                                $('.start_time').append(
                                    `<option value="${inicioArr[i][j]}" data-position-startset="${i}" data-position-hourset="${j}">${inicioArr[i][j]}</option>`
                                )
                            }
                        }
                    } else {
                        for (let k = 0; k < data[0].length; k++) {
                            $('.start_time').append(
                                `<option value="${data[0][k]}" data-position-startset="${k}" data-position-hourset="${k}">${data[0][k]}</option>`
                            )
                        }
                    }
                }
            });

            $('.start_time').on('change', function () {
                $('.finish_time').empty();
                $('.finish_time').removeAttr('disabled');
                $('.finish_time').append(`<option disabled selected>Elija una opción</option>`)
                var timeSet = $(this).find('option:selected').data("position-startset")
                var hourSet = $(this).find('option:selected').data("position-hourset")
                var endTime = []
                $.ajax({
                    type: 'POST',
                    url: url,
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        classroom_id: classroomId,
                        date: date
                    },
                    success: function (data) {
                        if (data.length > 1) {
                            for (let i = hourSet + 1; i < data[timeSet].length; i++) {
                                $('.finish_time').append(
                                    `<option value="${data[timeSet][i]}">${data[timeSet][i]}</option>`
                                )
                            }
                        } else {
                            for (let i = hourSet + 1; i < data[0].length; i++) {
                                $('.finish_time').append(
                                    `<option value="${data[0][i]}">${data[0][i]}</option>`
                                )
                            }
                        }
                    }
                });
            })
        });
    </script>
@endsection
