let d = document
const $inputName = d.getElementById('user_name'),
    $inputSurname = d.getElementById('user_surname'),
    $inputEmail = d.getElementById('user_email'),
    $inputDni = d.getElementById('user_dni'),
    $inputPass = d.getElementById('user_password'),
    $button = d.getElementById('create_submit'),
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

const isString = (value) => {
    let rta = false
    if (isNaN(value)) {
        rta = true
    }
    return rta
}
form.addEventListener('click', e => {
    //Validamos que el nombre sea letras y no esté vacio

    if (!validator.isEmpty($inputName.value)) {
        if (isString($inputName.value)) {
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
        if (isString($inputSurname.value)) {
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