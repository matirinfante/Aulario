$(document).ready(function () {
    var flash = $('#flashMessage');
    if (flash.find('.alert.alert-success').length > 0) {
        var contentFlash = $("#flashMessage:first").text().trim();
        switch (contentFlash) {
            // CREACION DE EVENTO
            case 'Se ha creado un nuevo evento con éxito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Evento creado con exito',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // MODIFICACION DE EVENTO
            case 'Evento modificado con éxito':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se ha modificado su evento.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ELIMINACION DE EVENTO
            // case 'Se eliminó correctamente al usuario':
            //     var timerInterval
            //     Swal.fire({
            //         toast: true,
            //         position: 'bottom-end',
            //         background: '#a5dc86',
            //         color: '#000',
            //         showConfirmButton: false,
            //         html: 'Se DESHABILITÓ correctamente al usuario.',
            //         timer: 2000,
            //         timerProgressBar: true,
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     })
            //     break;
            // ERROR CREACION DE USUARIO
            case 'Ha ocurrido un error al crear un nuevo evento':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'No se pudo crear el evento.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // ERROR MODIFICACION DE MATERIA
            case 'Ha ocurrido un error al actualizar el evento':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'No se pudo actualizar el evento',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            // case 'Usuario habilitado correctamente':
            //     var timerInterval
            //     Swal.fire({
            //         toast: true,
            //         position: 'bottom-end',
            //         background: '#a5dc86',
            //         color: '#000',
            //         showConfirmButton: false,
            //         html: 'Usuario habilitado correctamente',
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