function validarUpdate($id) {
    let $inputName = $('#assignmentNameUpdate' + $id);

    // elementos de errores
    let $errorName = $('#errorAssignmentNameUpdate' + $id);
    let $errorStartDate = $('#errorAssignmentStartDateUpdate' + $id);
    let $errorFinishDate = $('#errorAssignmentFinishDateUpdate' + $id);


    $('#assignmentNameUpdate' + $id).bind("propertychange change keyup input paste", function () {
        if (!validator.isEmpty($inputName.val())) {
            if (validator.isAlpha($inputName.val())) {
                v1 = true;
                $errorName.addClass('d-none')
                $errorName.removeClass('alerta');
                $esVacio1 = campoVacio($('#assignmentNameUpdate' + $id).val());
                $esVacio2 = campoVacio($('#assignmentStartDateUpdate' + $id).val());
                $esVacio3 = campoVacio($('#assignmentFinishDateUpdate' + $id).val());
                if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                    if (!$('#errorAssignmentStartDateUpdate' + $id).hasClass('alerta') && !$('#errorAssignmentFinishDateUpdate' + $id).hasClass('alerta')) {
                        $('#updateSubmit' + $id).removeClass('disabled');
                    }
                }
            }
        } else {
            $errorName.html('El nombre está vacio');
            $errorName.removeClass('d-none');
            $errorName.addClass('alerta');
            $('#updateSubmit' + $id).addClass('disabled');
        }
    });

    $('#assignmentStartDateUpdate' + $id).change(function () {
        $('#updateSubmit' + $id).addClass('disabled');
        $errorFinishDate.addClass('d-none')
        $errorFinishDate.removeClass('alerta');
        $('#assignmentFinishDateUpdate' + $id).val('');
        $errorFinishDate.html('Fecha fin faltante');
        $errorFinishDate.removeClass('d-none');
        $errorFinishDate.addClass('alerta');

        $esValida = esfechavalida($('#assignmentStartDateUpdate' + $id).val());
        if ($esValida) {
            $errorStartDate.addClass('d-none')
            $errorStartDate.removeClass('alerta');
            $esVacio1 = campoVacio($('#assignmentNameUpdate' + $id).val());
            $esVacio2 = campoVacio($('#assignmentStartDateUpdate' + $id).val());
            $esVacio3 = campoVacio($('#assignmentFinishDateUpdate' + $id).val());
            if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                $('#updateSubmit' + $id).removeClass('disabled');
            }
        } else {
            v2 = false;
            $errorStartDate.html('Fecha inválida');
            $errorStartDate.removeClass('d-none');
            $errorStartDate.addClass('alerta');
        }
    });

    $('#assignmentFinishDateUpdate' + $id).change(function () {
        $esValida = esfechavalida(this.value);
        $comparacion = compararFechas($('#assignmentStartDateUpdate' + $id).val(), $('#assignmentFinishDateUpdate' + $id).val());
        $esMayor = $comparacion[0];
        $esIgual = $comparacion[1];
        if ($esValida) {
            if ($esMayor && !$esIgual) {
                $errorFinishDate.addClass('d-none')
                $errorFinishDate.removeClass('alerta');
                $esVacio1 = campoVacio($('#assignmentNameUpdate' + $id).val());
                $esVacio2 = campoVacio($('#assignmentStartDateUpdate' + $id).val());
                $esVacio3 = campoVacio($('#assignmentFinishDateUpdate' + $id).val());
                if ((!$esVacio1 && !$esVacio2 && !$esVacio3)) {
                    $('#updateSubmit' + $id).removeClass('disabled');
                }
            } else {
                if ($('#errorAssignmentStartDateUpdate' + $id).hasClass('alerta')) {
                    $errorFinishDate.html('La fecha de inicio no es válida. Por favor, elija una fecha correcta');
                } else {

                    $errorFinishDate.html('La fecha de fin no puede ser menor o igual a la de inicio');
                }
                $errorFinishDate.removeClass('d-none');
                $errorFinishDate.addClass('alerta');
                $('#updateSubmit' + $id).addClass('disabled');
            }
        } else {
            $errorFinishDate.html('Fecha inválida');
            $errorFinishDate.removeClass('d-none');
            $errorFinishDate.addClass('alerta');
            $('#updateSubmit' + $id).addClass('disabled');
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


    function campoVacio($valor) {
        var $esVacio = false;
        if ($valor == '') {
            $esVacio = true;
        }
        return $esVacio;
    }


}