$('.form-delete').submit(function(e) {
    e.preventDefault();
    Swal.fire({
        title: '¿Está seguro de que desea eliminar la materia?',
        text: "Esta acción es irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b02a37',
        cancelButtonColor: '#0a58ca',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    })
});
$(document).ready(function() {
    var flash = $('#flashMessage');
    if (flash.find('.alert.alert-success').length > 0) {
        var contentFlash = $("#flashMessage:first").text().trim();
        switch (contentFlash) {
            // CREACION DE USUARIO
            case 'Se ha registrado correctamente el nuevo usuario':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se ha registrado correctamente el nuevo usuario.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
                // MODIFICACION DE MATERIA
            case 'Se actualizó correctamente al usuario':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se actualizó correctamente al usuario.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
                // ELIMINACION DE MATERIA
            case 'Se eliminó correctamente al usuario':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Se DESHABILITÓ correctamente al usuario.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
                // ERROR CREACION DE USUARIO
            case 'Ha ocurrido un error al registrar al usuario':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Ha ocurrido un error al registrar al usuario.',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
                // ERROR MODIFICACION DE MATERIA
            case 'Ha ocurrido un error al actualizar al usuario':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#f27474',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Ha ocurrido un error al actualizar al usuario',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                break;
            case 'Usuario habilitado correctamente':
                var timerInterval
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    background: '#a5dc86',
                    color: '#000',
                    showConfirmButton: false,
                    html: 'Usuario habilitado correctamente',
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