let d = document
const $inputName = d.getElementById('classroom_name_create'),
    $inputLocation = d.getElementById('location_create'),
    $inputCapacity = d.getElementById('capacity_create'),
    $button = d.getElementById('submit_create'),
    $errorName = d.getElementById('errorClassroomNameCreate'),
    $errorLocation = d.getElementById('errorLocationCreate'),
    $errorCapacity = d.getElementById('errorCapacityCreate'),
    form = d.getElementById('form_classroom_create')
let v1 = false,
    v2 = false,
    v3 = false

form.addEventListener('click', e => {
    //Validamos que el nombre sea letras y no esté vacio
    if (!validator.isEmpty($inputName.value)) {
        v1 = true
        $errorName.classList.add('d-none')
    } else {
        $errorName.textContent = 'El nombre está vacio'
        $errorName.classList.remove('d-none')
    }
    //Validamos que la locacion sea letras y no esté vacia
    if (!validator.isEmpty($inputLocation.value)) {
        v2 = true
        $errorLocation.classList.add('d-none')
    } else {
        $errorLocation.textContent = 'La locación está vacia'
        $errorLocation.classList.remove('d-none')
    }
    //Validamos que la capacidad sea numeros, no esté vacia y que el valor esté entre el 1 y los 200
    if (!validator.isEmpty($inputCapacity.value)) {
        if (validator.isNumeric($inputCapacity.value)) {
            if ($inputCapacity.value < 200 && $inputCapacity.value > 1) {
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


    if (v1 && v2 && v3) {
        $button.classList.remove('disabled')
    }
})