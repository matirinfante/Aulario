let d = document
const $inputStart = d.getElementById('start_time'),
    $inputFinish = d.getElementById('finish_time'),
    $errorStart = d.getElementById('errorStart'),
    $errorFinish = d.getElementById('errorFinish'),
    $button = d.getElementById('create_schedule_submit'),
    form = d.getElementById('form_schedule_create'),
    $container = d.querySelector('#container')

let v1 = false,
    v2 = false


const isNum = (value) => {
    let rta = false
    if (!isNaN(value)) {
        rta = true
    }
    return rta
}


form.addEventListener('click', e => {
    //Validamos que el nombre sea letras y no esté vacio
    $errorStart.textContent = ''
    $errorStart.classList.add('d-none')

    start = ($inputStart.value)
    finish = ($inputFinish.value)

    //Validamos el input de inicio no sea mayor que el de finalizacion
    if (!validator.isEmpty($inputFinish.value)) {
        if (isNum($inputFinish.value) || ($inputFinish.value).includes(':')) {
            v2 = true
            $errorFinish.classList.add('d-none')
        } else {
            $errorFinish.textContent = 'El apellido contiene numeros'
            $errorFinish.classList.remove('d-none')
        }
    } else {
        $errorFinish.textContent = 'El horario de finalizacion está vacio'
        $errorFinish.classList.remove('d-none')
    }

    if (!validator.isEmpty($inputStart.value)) {
        if (isNum($inputStart.value) || ($inputStart.value).includes(':')) {
            v1 = true
            $errorStart.classList.add('d-none')
        } else {
            $errorStart.textContent = 'El horario contiene letras '
            $errorStart.classList.remove('d-none')
        }
    } else {
        $errorStart.textContent = 'El horario de inicio está vacio '
        $errorStart.classList.remove('d-none')
    }



    if (v1 && v2) {
        $button.classList.remove('disabled')
    }
})