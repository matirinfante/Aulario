let d = document;
const $inputName = d.getElementById('createName'),
    $startDate = d.getElementById('createStartDate'),
    $finishDate = d.getElementById('createFinishDate'),

    $buttonCreate = d.getElementById('createSubmit'),
    $errorName = d.getElementById('errorCreateAssignmentName'),
    $errorStartDate = d.getElementById('errorCreateAssignmentStartDate'),
    $errorFinishDate = d.getElementById('errorCreateAssignmentFinishDate'),

    $formCreate = d.getElementById('createAssignmentForm'),
    $container = d.querySelector('#container')
let v1 = false,
    v2 = false,
    v3 = false

$formCreate.addEventListener('click', e => {

    //Validamos que el nombre no esté vacio

    $('#createName').bind("propertychange change keyup input paste", function () {
        if (!validator.isEmpty($inputName.value)) {
            if (validator.isAlpha($inputName.value)) {
                v1 = true;
                $errorName.classList.add('d-none')
                $errorName.classList.remove('alerta');
            }
        } else {
            $errorName.textContent = 'El nombre está vacio'
            $errorName.classList.remove('d-none');
            $errorName.classList.add('alerta');
        }
    });

    $('#createStartDate').change(function () {
        $esValida = esfechavalida(this.value);
        if ($esValida) {
            v2 = true;
            $errorStartDate.classList.add('d-none')
            $errorStartDate.classList.remove('alerta');
        } else {
            $errorStartDate.textContent = 'Fecha inválida';
            $errorStartDate.classList.remove('d-none');
            $errorStartDate.classList.add('alerta');
        }
    });

    $('#createFinishDate').change(function () {
        $esValida = esfechavalida(this.value);
        if ($esValida) {
            v3 = true;
            $errorFinishDate.classList.add('d-none')
            $errorFinishDate.classList.remove('alerta');
        } else {
            $errorFinishDate.textContent = 'Fecha inválida';
            $errorFinishDate.classList.remove('d-none');
            $errorFinishDate.classList.add('alerta');
        }
    });

    if (v1 && v2 && v3) {
        $buttonCreate.classList.remove('disabled');
    }
});


function esfechavalida($fecha) {
    var $error = false;

    // La longitud de la fecha debe tener exactamente 10 caracteres
    if ($fecha.length != 10) {
        $error = true;
    }

    // Mediante el delimitador "/" separa dia, mes y año
    var $fecha = $fecha.split("-");
    var $anio = parseInt($fecha[0]);
    var $mes = parseInt($fecha[1]);
    var $dia = parseInt($fecha[2]);

    // Verifica que dia, mes, año, solo sean numeros
    if ((isNaN($dia) || isNaN($mes) || isNaN($anio)) && !$error) {
        $error = true;
    }

    // Verifica que valores no sean cero
    if (($dia == 0) || ($mes == 0) || ($anio == 0)) {
        $error = true;
    }

    // Lista de dias en los meses, por defecto no es año bisiesto
    var $listaDias = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if (($mes == 1 || $mes > 2) && !$error) {
        if ($dia > $listaDias[$mes - 1] || $dia < 0 || $listaDias[$mes - 1] == undefined) {
            $error = true;
        }
    }

    // Detecta si es año bisiesto y asigna a febrero 29 dias
    if (($mes == 2) && !$error) {
        var $anioB;
        if ((!($anio % 4) && $anio % 100) || !($anio % 400)) {
            $anioB = true;
        } else {
            $anioB = false;
        }
        if (($anioB == false) && ($dia >= 29)) {
            $error = true;
        }

        if (($anioB == true) && ($dia > 29)) {
            $error = true;
        }
    }

    var $retorno = true;
    if ($error == true) {
        $retorno = false;
    }
    return $retorno;
}
