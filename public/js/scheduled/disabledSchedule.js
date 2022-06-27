$('.activeSwitch').change(function(e) {
    var $id = $(this).data('id');
    var status = $(this).prop('checked') == true ? 1 : 0;

    if (status == 0) { // deshabilitar usuario
        var url = `/schedules/${$id}destroy`;
        url = url.replace(':id', $id);
        var token = $(this).data("token");
        $.ajax({
            type: 'post',
            url: url,
            cache: false,
            data: {
                "id": $id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function(data) {
                $('#flashMessage').html(
                        '<div class="alert alert-success">Horario deshabilitado con éxito</div>')
                    .delay(1000);
                var flash = $('#flashMessage');
                if (flash.find('.alert.alert-success').length > 0) {
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#a5dc86',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Horario deshabilitado con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                    location.reload()
                }
            }

        });
    }
});