let d = document;
let $formCreate = d.getElementById('createAssignmentForm');
let $buttonCreate = $('#createSubmit');

let $inputName = $('#createName');
let $startDate = $('#createStartDate');
let $finishDate = $('#createFinishDate');

let $errorName = $('#errorCreateAssignmentName');
let $errorStart = $('#errorCreateAssignmentStartDate');
let $errorFinish = $('#errorCreateAssignmentFinishDate');

$formCreate.addEventListener('click', e => {

    //Validamos que el nombre no esté vacio
    $inputName.bind("propertychange change keyup input paste", function () {
        if (!validator.isEmpty($(this).val())) {
            if (validator.isAlpha($(this).val())) {
                $errorName.addClass('d-none');
                $errorName.removeClass('alerta');
                $esVacio1 = campoVacio($(this).val());
                $esVacio2 = campoVacio($startDate.val());
                $esVacio3 = campoVacio($finishDate.val());
                if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                    if (!$errorStart.hasClass('alerta') && !$errorFinish.hasClass('alerta')) {
                        $buttonCreate.removeClass('disabled');
                    }
                }
            }
        } else {
            $errorName.html('El nombre está vacio');
            $errorName.removeClass('d-none');
            $errorName.addClass('alerta');
            $buttonCreate.addClass('disabled');
        }
    });

    $startDate.change(function () {
        $finishDate.val('');
        $buttonCreate.addClass('disabled');
        $errorFinish.addClass('d-none');
        $errorFinish.removeClass('alerta');
        $errorFinish.html('Fecha fin faltante');
        $errorFinish.removeClass('d-none');
        $errorFinish.addClass('alerta');

        $esValida = esfechavalida($(this).val());
        if ($esValida) {
            $errorStart.addClass('d-none');
            $errorStart.removeClass('alerta');
            $esVacio1 = campoVacio($inputName.val());
            $esVacio2 = campoVacio($(this).val());
            $esVacio3 = campoVacio($finishDate.val());
            if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                $buttonCreate.removeClass('disabled');
            }
        } else {
            $errorStart.html('Fecha inválida');
            $errorStart.removeClass('d-none');
            $errorStart.addClass('alerta');
        }
    });

    $finishDate.change(function () {
        $esValida = esfechavalida(this.value);
        $comparacion = compararFechas($startDate.val(), $(this).val());
        $esMayor = $comparacion[0];
        $esIgual = $comparacion[1];
        if ($esValida) {
            if ($esMayor && !$esIgual) {
                $errorFinish.addClass('d-none');
                $errorFinish.removeClass('alerta');
                $esVacio1 = campoVacio($inputName.val());
                $esVacio2 = campoVacio($startDate.val());
                $esVacio3 = campoVacio($(this).val());
                if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                    $buttonCreate.removeClass('disabled');
                }
            } else {
                if ($errorStart.hasClass('alerta')) {
                    $errorFinish.html('La fecha de inicio no es válida. Por favor, elija una fecha correcta');
                } else {
                    $errorFinish.html('La fecha de fin no puede ser menor o igual a la de inicio');
                }
                $errorFinish.removeClass('d-none');
                $errorFinish.addClass('alerta');
                $buttonCreate.addClass('disabled');
            }
        } else {
            $errorFinish.html('Fecha inválida');
            $errorFinish.removeClass('d-none');
            $errorFinish.addClass('alerta');
            $buttonCreate.addClass('disabled');
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

    function compararFechas($fechaInicio, $fechaFin) {
        var $esMenor = false;
        var $esIgual = false;
        var $retorno = [];
        // Mediante el delimitador "-" separa dia, mes y año
        var $inicio = $fechaInicio.split("-");
        var $anioInicio = parseInt($inicio[0]);
        var $mesInicio = parseInt($inicio[1]);
        var $diaInicio = parseInt($inicio[2]);
        // Mediante el delimitador "-" separa dia, mes y año
        var $fin = $fechaFin.split("-");
        var $anioFin = parseInt($fin[0]);
        var $mesFin = parseInt($fin[1]);
        var $diaFin = parseInt($fin[2]);

        var $comparaInicio = new Date($mesInicio + '/' + $diaInicio + '/' + $anioInicio);
        var $comparaFin = new Date($mesFin + '/' + $diaFin + '/' + $anioFin);
        if ($comparaInicio < $comparaFin) {
            $esMenor = true;
        }
        if ($comparaInicio == $comparaFin) {
            $esIgual = true;
        }

        $retorno = [$esMenor, $esIgual];
        return $retorno;
    }


    function campoVacio($valor) {
        var $esVacio = false;
        if ($valor == '') {
            $esVacio = true;
        }
        return $esVacio;
    }
});


