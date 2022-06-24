<h5 class="pb-3 mt-3 text-center">Datos de reserva</h5>
<div class="row mt-4">

    {{-- Aula --}}
    <div class="mb-3 col">
        <label for="classroom_id" class="form-label">Seleccione el aula <span class="text-secondary">(Paso
                5)</span></label>
        <select disabled class="form-select classroomsMassiveEvent" name="classroom_id">
            <option value="" selected disabled>Aula...</option>
        </select>
    </div>
</div>

<div class="row mt-4">
    {{-- horas disponibles (inicio) --}}
    <div class="mb-3 col-md-6 col-sm-12">
        <label for="startTime" class="form-label">Hora de inicio <span class="text-secondary">(Paso 6)</span></label>
        <select disabled name="start_time" class="form-select start_timeMassiveEvent">
            <option disabled selected>Elige una opción
            </option>
        </select>
        {{-- <small id="errorCreateBookingStartTime"></small> --}}
    </div>

    {{-- horas disponibles (fin) --}}
    <div class="mb-3 col-md-6 col-sm-12">
        <label for="finishTime" class="form-label">Hora de fin <span class="text-secondary">(Paso 7)</span></label>
        <select disabled name="finish_time" class="form-select finish_timeMassiveEvent">
            <option disabled selected>Elige una opción
            </option>
        </select>
        {{-- <small id="errorCreateBookingStartTime"></small> --}}
    </div>
</div>

<div class="row">
    <div class="text-center mb-4">
        <button id="addBookingMassiveEvent" type="button" disabled class="btn btn-success w-100 d-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-patch-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0z" />
            </svg>
            Añadir reserva
        </button>
    </div>
</div>

<div class="row">
    <div class="text-center mb-4">
        {{-- view modal button --}}
        <button id="btnViewModalMassiveEvent" type="button" class="btn btn-outline-secondary btn-sm w-100 d-none"
            data-bs-toggle="modal" data-bs-target="#viewModal">Ver reservas de eventos añadidos
        </button>
    </div>
</div>
