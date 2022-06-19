<div class="mb-3">
    <label for="cantParticipants" class="form-label">Ingrese cantidad de
        participantes</label>
    <input class="form-control" name="participants" type="text" placeholder="40" required>
</div>

{{-- Aula --}}
<div class="mb-3">
    <span>Seleccione el aula</span>
    <select class="form-select" name="classroom_id">
        <option value="">Aula...</option>
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

{{-- horas disponibles (inicio) --}}
<div class="mb-3">
    <label for="startTime" class="form-label">Hora de inicio</label>
    <select name="start_time" class="form-select start_time">
        <option disabled selected>Elija una opción
        </option>
    </select>
    {{-- <small id="errorCreateBookingStartTime"></small> --}}
</div>

{{-- horas disponibles (fin) --}}
<div class="mb-3">
    <label for="finishTime" class="form-label">Hora de fin</label>
    <select disabled name="finish_time" class="form-select finish_time">
        <option disabled selected>Elija una opción
        </option>
    </select>
    {{-- <small id="errorCreateBookingStartTime"></small> --}}
</div>
