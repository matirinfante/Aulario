
$(document).ready(function () {

    var $errorMessage = $('#errorsMsj').text().trim();
    if ($('#errorsMsj').length > 0) {
        var timerInterval
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            background: '#f27474',
            color: '#000',
            showConfirmButton: false,
            html: $errorMessage,
            timer: 7000,
            timerProgressBar: true,
            willClose: () => {
                clearInterval(timerInterval)
            }
        })
    }


    var flash = $('#flashMessage');
    if (flash.find('.alert.alert-success').length > 0) {
        var contentFlash = $("#flashMessage:first").text().trim();
        switch (contentFlash) {
            // CREACION DE MATERIA
            case 'La materia se ha cargado exitosamente':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Materia creada con éxito.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // MODIFICACION DE MATERIA
            case 'Materia modificada con éxito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Materia modificada con éxito.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;

            case 'Ha ocurrido un error al añadir la materia':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al crear materia.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR MODIFICACION DE MATERIA
            case 'Ha ocurrido un error al actualizar la materia':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al modificar materia.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR MODIFICACION DE MATERIA
            case 'Ha ocurrido un error al eliminar la materia':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al cambiar estado de materia.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
        }
    }
});