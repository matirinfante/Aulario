let d = document
const $inputName = d.getElementById('name'),
    $inputParticipants = d.getElementById('event_participants'),
    $errorName = d.getElementById('errorName'),
    $errorParticipants = d.getElementById('errorParticipants'),
    form = d.getElementById('event-form'),
    $button = d.getElementById('submit_button')

let v1 = false,
    v2 = false

form.addEventListener('click', e => {
    //Validamos que el nombre del evento sena letras y no esté vacio
    if (!validator.isEmpty($inputName.value)) {
        if (validator.isAlpha($inputName.value)) {
            console.log('goasldasd')
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
    console.log($inputParticipants)
    //Validamos que la cantidad de participantes sean numeros y sean mayores a 1 y menores que 200
    if (!validator.isEmpty($inputParticipants.value)) {
        if (validator.isNumeric($inputParticipants.value)) {
            if ($inputParticipants.value > 1 && $inputParticipants.value < 200) {
                console.log("valida")
                v2 = true
                $errorParticipants.classList.add('d-none')
            } else {
                console.log("no valida")
                $errorParticipants.textContent = 'La cantidad de participantes no es valida'
                $errorParticipants.classList.remove('d-none')
            }
        } else {
            $errorParticipants.textContent = 'Los participantes no son numericos'
            $errorParticipants.classList.remove('d-none')
        }
    } else {
        console.log('La cantidad de participantes esta vacia')
        $errorParticipants.textContent = 'La cantidad de participantes esta vacia'
        $errorParticipants.classList.remove('d-none')
    }

    if (v1 && v2) {
        $button.classList.remove('disabled')
    }
})