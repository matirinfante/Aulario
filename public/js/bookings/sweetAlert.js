// borrar reserva de myBookings con sweetAlert2
$('.form-delete').submit(function (e) {
    e.preventDefault();
    Swal.fire({
        title: '¿Está seguro de que desea eliminar la reserva?',
        text: "Esta acción es irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b02a37',
        cancelButtonColor: '#8f8f8f',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    })
});


// mensajes de error con sweetAlert
$(document).ready(function () {
    // var $errorMessage = $('#errorsMsj').text().trim();
    // if ($('#errorsMsj').length > 0) {
    //     var timerInterval
    //     Swal.fire({
    //         toast: true,
    //         position: 'bottom-end',
    //         background: '#f27474',
    //         color: '#000',
    //         showConfirmButton: false,
    //         html: $errorMessage,
    //         timer: 7000,
    //         timerProgressBar: true,
    //         willClose: () => {
    //             clearInterval(timerInterval)
    //         }
    //     })
    // }


    // mensajes de flash() con sweetAlert
    var flash = $('#flashMessage');
    if (flash.find('.alert.alert-success').length > 0) {
        var contentFlash = $("#flashMessage:first").text().trim();
        switch (contentFlash) {

            // CREACION DE RESERVA (USER/TEACHER) -> redirecciona a myBookings
            case 'Se ha registrado la reserva con exito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Reserva creada con éxito.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;

            // ERROR CREACION DE RESERVA
            case 'Ha ocurrido un error al agregar una nueva reserva':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al crear reserva.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;

            // MODIFICACION DE RESERVA
            // case 'Reserva modificada con éxito':
            //     var timerInterval
            //     Swal.fire({
            //         toast: true,
            //         position: 'bottom-end',
            //         background: '#a5dc86',
            //         color: '#000',
            //         showConfirmButton: false,
            //         html: 'Reserva modificada con éxito.',
            //         timer: 4000,
            //         timerProgressBar: true,
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     })
            //     break;

            // ERROR MODIFICACION DE MATERIA
            // case 'Ha ocurrido un error al actualizar la reserva':
            //     var timerInterval
            //     Swal.fire({
            //         toast: true,
            //         position: 'bottom-end',
            //         background: '#f27474',
            //         color: '#000',
            //         showConfirmButton: false,
            //         html: 'Error al modificar reserva.',
            //         timer: 4000,
            //         timerProgressBar: true,
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     })
            //     break;

            // ELIMINACION DE RESERVA (USER/TEACHER) -> myBookings
            case 'destroyTrue':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Reserva eliminada con éxito.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;

            // ERROR ELIMINACION DE RESERVA (USER/TEACHER) -> myBookings
            case 'destroyFalse':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Error al eliminar reserva.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;


            // -------------- RESERVA DE EVENTOS MASIVOS ----------------------------------------------------------
            // CREACION DE RESERVA EVENTO MASIVO (ADMIN)
            case 'Reservas de evento registradas con éxito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Reserva evento-masivo creada con éxito.',
                    timer: 4000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;


            // ------------------------------------------------------------------------
            // CREACION DE RESERVA MATERIA(ADMIN)
            case 'Reservas de materia registradas con éxito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Reserva de materia creada con éxito.',
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