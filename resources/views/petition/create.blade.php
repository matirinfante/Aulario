<div class="modal fade" id="createModal{{ $user }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datalles de Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="container">
                    <h3 class="text-center m-4">Crear Petición</h3>
                    <form id="form" class="form_style" method="POST" action="{{route('petitions.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}} {{$user->surname}}" disabled>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$user->id}}">
                        </div>
                        <div class="mb-3">
                            <label for="assignment_id" class="form-label">Materias</label>
                            {{-- <select name="assignment_id" class="form-select select2-user" aria-label="Materia" style="width: 100%">
                                <option value="-1" disabled></option>
                                @foreach ($assignments as $assignment)
                                <option value="{{ $assignment->id }}">
                            {{ $assignment->assignment_name }}
                            </option>
                            @endforeach
                            </select> --}}
                        </div>
                        <div class="mb-3">
                            <label for="estimated_people" class="form-label">Cantidad alumnos</label>
                            <input type="text" class="form-control" name="estimated_people" id="estimated_people">
                        </div>
                        <div class="mb-3">
                            <label for="classroom_type" class="form-label">Tipo Aula</label>
                            <input type="text" class="form-control" name="classroom_type" id="classroom_type" value="Híbrido">
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="finish_date" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" name="finish_date" id="finish_date">
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" name="start_time" id="start_time">
                        </div>
                        <div class="mb-3">
                            <label for="finish_time" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" name="finish_time" id="finish_time">
                        </div>
                        <div class="mb-3">
                            <label for="days" class="form-label">Dia</label>
                            <input type="text" class="form-control" name="days" id="days">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <input type="text" class="form-control" name="message" id="message">
                        </div>

                        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <script type="text/javascript">
       let d = document
        const $inputName = d.getElementById('name'),
            $inputSurname = d.getElementById('surname'),
            $inputEmail = d.getElementById('email'),
            $inputDni = d.getElementById('dni'),
            $inputPass = d.getElementById('password'),
            $button = d.getElementById('submit'),
            $errorName = d.getElementById('errorName'),
            $errorSurname = d.getElementById('errorSurname'),
            $errorDni = d.getElementById('errorDni'),
            $errorEmail = d.getElementById('errorEmail'),
            $errorPass = d.getElementById('errorPassword'),
            form = d.getElementById('form'),
            $container = d.querySelector('#container')
        let v1 = false,
            v2 = false,
            v3 = false,
            v4 = false,
            v5 = false
        form.addEventListener('click', e => {
            //Validamos que el nombre sea letras y no esté vacio
            if (!validator.isEmpty($inputName.value)) {
                if (validator.isAlpha($inputName.value)) {
                    v1 = true
                    $errorName.classList.add('d-none')
                } else {
                    $errorName.textContent = 'El nombre contiene numeros'
                    $errorName.classList.remove('d-none')
                }
            } else {
                $errorName.textContent = 'El nombre está vacio'
                $errorName.classList.remove('d-none')
            }
            //Validamos que el apellido sea letras y no esté vacio
            if (!validator.isEmpty($inputSurname.value)) {
                if (validator.isAlpha($inputSurname.value)) {
                    v2 = true
                    $errorSurname.classList.add('d-none')
                } else {
                    $errorSurname.textContent = 'El apellido contiene numeros'
                    $errorSurname.classList.remove('d-none')
                }
            } else {
                $errorSurname.textContent = 'El apellido está vacio'
                $errorSurname.classList.remove('d-none')
            }
            //Validamos que el dni sea numeros, no esté vacio y que el valor esté entre el 1.000.000
            // y los 99.999.999
            if (!validator.isEmpty($inputDni.value)) {
                if (validator.isNumeric($inputDni.value)) {
                    if ($inputDni.value < 99999999 && $inputDni.value > 1000000) {
                        v3 = true
                        $errorDni.classList.add('d-none')
                    } else {
                        $errorDni.textContent = 'El dni no es valido'
                        $errorDni.classList.remove('d-none')
                    }
                } else {
                    $errorDni.textContent = 'El dni no es numerico'
                    $errorDni.classList.remove('d-none')
                }
            } else {
                $errorDni.textContent = 'El dni está vacio'
                $errorDni.classList.remove('d-none')
            }
            //Validamos que el email no esté vacio y que cumpla con las caracteristicas
            if (!validator.isEmpty($inputEmail.value)) {
                if (validator.isEmail($inputEmail.value)) {
                    v4 = true
                    $errorEmail.classList.add('d-none')
                } else {
                    $errorEmail.textContent = 'El email no es valido'
                    $errorEmail.classList.remove('d-none')
                }
            } else {
                $errorEmail.textContent = 'El email está vacio'
                $errorEmail.classList.remove('d-none')
            }
            //Validamos que la contraseña no esté vacia y que tenga un minimo de 6 caracteres
            if (!validator.isEmpty($inputPass.value)) {
                if ($inputPass.value.length < 10 && $inputPass.value.length > 5) {
                    v5 = true
                    $errorPass.classList.add('d-none')
                } else {
                    $errorPass.textContent = 'La contaseña es demasiado corta'
                    $errorPass.classList.remove('d-none')
                }
            } else {
                $errorPass.textContent = 'La contraseña está vacia'
                $errorPass.classList.remove('d-none')
            }
            if (v1 && v2 && v3 && v4 && v5) {
                $button.classList.remove('disabled')
            }
        })
</script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/validator@latest/validator.min.js"></script>