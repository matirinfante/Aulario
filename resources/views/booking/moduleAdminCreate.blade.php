<div class="row mt-4">

    <div class="mb-3 col">
        <label for="cantParticipants" class="form-label">Cantidad de participantes</label>
        <input class="form-control participants" name="participants" type="text" placeholder="120" required>
    </div>

    {{-- Aula --}}
    <div class="mb-3 col">
        <label for="classroom_id" class="form-label">Seleccione el aula</label>
        <select class="form-select classrooms" name="classroom_id">
            <option value="" selected disabled>Aula...</option>
            {{-- @forelse ($classrooms as $classroom)
            <option data-capacity="{{ $classroom['capacity'] }}"
                data-classroomName="{{ $classroom['classroom_name'] }}"
                data-building="{{ $classroom['building'] }}" value="{{ $classroom['id'] }}">
                Edificio: {{ $classroom['building'] }} Nombre:
                {{ $classroom['classroom_name'] }}
                Capacidad: {{ $classroom['capacity'] }}
            </option>
            @empty
            <option value="">No hay nada para robar :</option>
        @endforelse --}}
        </select>
    </div>
</div>

<div class="row mt-4">
    {{-- horas disponibles (inicio) --}}
    <div class="mb-3 col">
        <label for="startTime" class="form-label">Hora de inicio</label>
        <select name="start_time" class="form-select start_time">
            <option disabled selected>Elija una opción
            </option>
        </select>
        {{-- <small id="errorCreateBookingStartTime"></small> --}}
    </div>

    {{-- horas disponibles (fin) --}}
    <div class="mb-3 col">
        <label for="finishTime" class="form-label">Hora de fin</label>
        <select disabled name="finish_time" class="form-select finish_time">
            <option disabled selected>Elija una opción
            </option>
        </select>
        {{-- <small id="errorCreateBookingStartTime"></small> --}}
    </div>
</div>
