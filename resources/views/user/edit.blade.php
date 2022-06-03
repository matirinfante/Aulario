@extends('layouts.app')


@section('content')
<style>
    form {
        width: 40%;
        min-width: 500px;
        margin: auto;
        background: #D9D9D9;
        padding: 25px;
        border-radius: 25px;
        text-align: center;
    }

    label {
        font-weight: 600;
    }

    .alerta {
        padding: 3px;
        font-size: 14px;
        color: #842029;
        background: #f8d7da;
        border: solid 1px #f5c2c7;
        border-radius: 5px;
        margin-top: 3px;
        width: 100%;
    }

</style>
<a class="btn btn-outline-light" href="{{ url('users') }}" role="button" style="margin-left: 1%">Listado de Usuarios</a>
    
<h3 class="text-center m-4">Modificación de un usuario</h3>
<form id="form" name="form" class="form_style" method="get" action="{{route('users.update', $user['id'])}}">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" id="name" placeholder=" {{$user['name']}} ">
        <p class="alerta d-none" id="errorName">Error</p>
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Apellido</label>
        <input type="text" class="form-control" name="surname" id="surname" placeholder="{{$user['surname']}}">
        <p class="alerta d-none" id="errorSurname">Error</p>
    </div>
    <div class="mb-3">
        <label for="dni" class="form-label">Dni</label>
        <input type="number" class="form-control" name="dni" id="dni" min="1000000" max="99999999"
               placeholder="{{$user['dni']}}">
        <p class="alerta d-none" id="errorDni">Error</p>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="{{$user['email']}}">
        <p class="alerta d-none" id="errorEmail">Error</p>
    </div>
    
    <button id="submit" type="submit" class="btn btn-primary disabled" >Actualizar</button>
    @csrf
</form>
<script src="https://unpkg.com/validator@latest/validator.min.js"></script>
    <script>
        let d = document
        const $inputName = d.getElementById('name'),
            $inputSurname = d.getElementById('surname'),
            $inputEmail = d.getElementById('email'),
            $inputDni = d.getElementById('dni'),
            $button = d.getElementById('submit'),
            $errorName = d.getElementById('errorName'),
            $errorSurname = d.getElementById('errorSurname'),
            $errorDni = d.getElementById('errorDni'),
            $errorEmail = d.getElementById('errorEmail'),
            form = d.getElementById('form'),
            $container = d.querySelector('#container')
        let v1 = false,
            v2 = false,
            v3 = false,
            v4 = false
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
            
            if (v1 && v2 && v3 && v4) {
                $button.classList.remove('disabled')
            }
        })
    </script>
    
@endsection