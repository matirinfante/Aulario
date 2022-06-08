@extends('layouts.app')

@section('content')
    {{-- enlaces jquery para select2 (uso temporario de cdn ) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <a class="btn btn-outline-light" href="{{ url('classrooms') }}" role="button" style="margin-left: 1%">Listado de
        aulas</a>

    <h3 class="text-center m-4">Creación de un Aula</h3>
    <form id="form_classroom" name="form_classroom" class="form_style" method="POST"
        action="{{ route('classrooms.store') }}">
        @csrf
        <div class="mb-3">
            <label for="classroom_name" class="form-label">Nombre del aula</label>
            <input type="text" class="form-control" name="classroom_name" id="classroom_name" placeholder="I7">
            <p class="alerta d-none" id="errorClassroomName">Error</p>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Locación en facultad</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Planta Alta">
            <p class="alerta d-none" id="errorLocation">Error</p>
        </div>
        <div class="mb-3">
            <label for="building" class="form-label">Edificio</label>
            <select name="building_type" id="building_type" class="form-select" style="width: 100%">
                <option value="-1" disabled></option>
                @foreach ($buildings as $building)
                    <option value="{{ $building }}">{{ $building }}</option>
                @endforeach
            </select>
            <p class="alerta d-none" id="errorBuilding">Error</p>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacidad</label>
            <input type="number" class="form-control" name="capacity" id="capacity" min="5" max="200" placeholder="30">
            <p class="alerta d-none" id="errorCapacity">Error</p>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo de aula</label>
            <select name="classroom_type" id="classroom_type" class="form-select" style="width: 100%">
                @foreach ($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <p class="alerta d-none" id="errorType">Error</p>
        </div>
        <div class="container mb-3">
            <div class="row">
                <label for="available_time" class="form-label">Horario disponible</label>
                <div class="col-6">
                    <label>Horario inicio</label>
                    <input type="time" class="form-control" name="available_start" id="available_start"
                        style="width: 100%">
                </div>
                <div class="col-6">
                    <label>Horario fin</label>
                    <input type="time" class="form-control" name="available_finish" id="available_finish"
                        style="width: 100%">
                </div>
                <p class="alerta d-none" id="errorAvailabilitySchedule">Error</p>
            </div>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/validator@latest/validator.min.js"></script>
    <script type="text/javascript">
        let d = document
        const $inputName = d.getElementById('classroom_name'),
            $inputLocation = d.getElementById('location'),
            $inputBuilding = d.getElementById('building'),
            $inputCapacity = d.getElementById('capacity'),
            $inputType = d.getElementById('classroom_type'),
            $button = d.getElementById('submit'),
            $errorName = d.getElementById('errorClassroomName'),
            $errorLocation = d.getElementById('errorLocation'),
            $errorBuilding = d.getElementById('errorBuilding'),
            $errorCapacity = d.getElementById('errorCapacity'),
            $errorType = d.getElementById('errorType'),
            form = d.getElementById('form_classroom'),
            $container = d.querySelector('#container')
        let v1 = false,
            v2 = false,
            v3 = false,
            v4 = false,
            v5 = false
        form.addEventListener('click', e => {
            //Validamos que el nombre no esté vacio
            if (!validator.isEmpty($inputName.value)) {

                v1 = true
                $errorName.classList.add('d-none')

            } else {
                $errorName.textContent = 'El nombre está vacio'
                $errorName.classList.remove('d-none')
            }

            //Validamos que la locación sea letras y no esté vacia
            if (!validator.isEmpty($inputLocation.value)) {
                if (validator.isAlpha($inputLocation.value)) {
                    v2 = true
                    $errorLocation.classList.add('d-none')
                } else {
                    $errorLocation.textContent = 'La locación contiene numeros'
                    $errorLocation.classList.remove('d-none')
                }
            } else {
                $errorLocation.textContent = 'La locación está vacia'
                $errorLocation.classList.remove('d-none')
            }

            //Validamos que la capacidad sea numeros, no esté vacia y que el valor esté entre el 5 y 200
            if (!validator.isEmpty($inputCapacity.value)) {
                if (validator.isNumeric($inputCapacity.value)) {
                    if ($inputCapacity.value < 5 && $inputCapacity.value > 200) {
                        v3 = true
                        $errorCapacity.classList.add('d-none')
                    } else {
                        $errorCapacity.textContent = 'La capacidad no es valida'
                        $errorCapacity.classList.remove('d-none')
                    }
                } else {
                    $errorCapacity.textContent = 'La capacidad no es numerica'
                    $errorCapacity.classList.remove('d-none')
                }
            } else {
                $errorCapacity.textContent = 'La capacidad está vacia'
                $errorCapacity.classList.remove('d-none')
            }






            if (v1 && v2 && v3 && v4 && v5) {
                $button.classList.remove('disabled')
            }
        })
    </script>
@endsection
