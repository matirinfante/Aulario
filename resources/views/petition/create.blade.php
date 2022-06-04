@extends('layouts.app')

@section('content')
    <style>
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

<a class="btn btn-outline-dark" href="{{ url('petitions') }}" role="button" style="margin-left: 1%">Listado de Usuarios</a>



    <div id="container">
        <h3 class="text-center m-4">Creación de Usuario</h3>
        <form id="form" class="form_style" method="POST" action="{{route('petitions.store')}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Robert">
                <p class="alerta d-none" id="errorName">Error</p>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Kiyosaki">
                <p class="alerta d-none" id="errorSurname">Error</p>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="number" class="form-control" name="dni" id="dni" min="1000000" max="99999999"
                       placeholder="39504700">
                <p class="alerta d-none" id="errorDni">Error</p>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="robert@kiyosaki.com">
                <p class="alerta d-none" id="errorEmail">Error</p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password">
                <p class="alerta d-none" id="errorPassword">Error</p>
            </div>
            <button id="submit" type="submit" class="btn btn-primary disabled">Crear</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/validator@latest/validator.min.js"></script>
    <script type="text/javascript">
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
    </script>
@endsection
