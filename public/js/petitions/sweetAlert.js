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
            //CREACION DE PETICION
            case 'Petición creada con exito.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Petición creada con exito.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            break;
            //ERROR AL CREAR PETICION
            case 'Error al crear la petición.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al crear la petición.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            break;
            //RECHAZAR PETICION
            case 'Se rechazo la petición.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se rechazo la petición.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;

            //ERROR AL RECHAZAR PETICION
            case 'Error al rechazar petición.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al rechazar petición.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            break;
            //ACEPTAR PETICION
            case 'Se aceptó la petición.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se aceptó la petición.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            break;
            //ERROR AL ACEPTAR PETICION
            case 'Error al aceptar la petición.':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al aceptar la petición.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
            break;
        }
    }
});