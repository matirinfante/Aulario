$('.activeSwitch').change(function(e) {
    var $id = $(this).data('id');
    var status = $(this).prop('checked') == true ? 1 : 0;

    if (status == 0) { // deshabilitar usuario
        var url = `/events/${$id}`;
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

                let buttonEdit = document.getElementById(`buttonEdit${$id}`)

                buttonEdit.classList.add('disabled')

                // var $elementSvg = $("td[data-statusSvg='" + $id + "']");
                // $elementSvg.replaceWith('<td class="text-secondary" data-statussvg="' + $id +
                //     '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" /></svg></td>'
                // );

                $('#flashMessage').html(
                        '<div class="alert alert-success">Evento deshabilitado con éxito</div>')
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
                        html: 'Evento deshabilitado con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                }
            }

        });
    } else {
        // habilitar usuario...
        var url = `/events/${$id}`
        url = url.replace(':id', $id);
        var token = $(this).data("token");
        $.ajax({
            type: 'POST',
            url: url,
            cache: false,
            data: {
                "id": $id,
                "_method": 'PUT',
                "_token": token
            },
            success: function(data) {
                let buttonEdit = document.getElementById(`buttonEdit${$id}`)
                buttonEdit.classList.remove('disabled')
                // var $elementSvg = $("td[data-statusSvg='" + $id + "']");
                // $elementSvg.replaceWith('<td class="text-secondary" data-statussvg="' + $id +
                //     '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" /></svg></td>'
                // );

                $('#flashMessage').html(
                        '<div class="alert alert-success">Evento habilitado correctamente</div>'
                    )
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
                        html: 'Evento habilitado con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                }
            }
        });
    }
});