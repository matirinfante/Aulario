$(document).ready(function () {
    // MENSAJE DE ERROR
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
            // CREACION DE PETICION
            case 'Se ha creado una nueva petición':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Aula creada con éxito.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // SE RECHAZA LA PETICION
            case 'Se ha rechazado la petición':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Aula modificada con éxito.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR AL CREAR PETICION
            case 'Ha ocurrido un error al crear una petición':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al crear el aula.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR MODIFICACION PETICION
            case 'Ha ocurrido un error al actualizar una petición':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al modificar el aula.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR DESHABILITACION DE AULA
            // case 'Ha ocurrido un error al deshabilitar el aula':
            //     var timerInterval
            //     Swal.fire({
            //         toast: true,
            //         position: 'bottom-end',
            //         background: '#f27474',
            //         color: '#000',
            //         showConfirmButton: false,
            //         html: 'Error al cambiar estado del aula.',
            //         timer: 2000,
            //         timerProgressBar: true,
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     })
            //     break;
        }
    }
});