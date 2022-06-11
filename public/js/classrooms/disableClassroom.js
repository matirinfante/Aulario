//Habilitar/Deshabilitar un aula

$('.activeSwitch').change(function (e) {
    var $id = $(this).data('id');
    var status = $(this).prop('checked') == true ? 1 : 0;
    console.log($id);
    console.log(status);

    if (status == 0) { // deshabilitar aula
        var url = `/classrooms/${$id}`;
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
            success: function (data) {
                //Deshabilito el boton de editar cuando deshabilito un aula
                let buttonEdit = document.getElementById(`buttonEdit${$id}`)
                buttonEdit.classList.add('disabled')

                var elemStatusAssigment = $(`#viewModal${$id}`).find('.statusUpdate');
                elemStatusAssigment.html('<span class="text-secondary">Estado: </span>Deshabilitada');

                $('#flashMessage').html(
                    '<div class="alert alert-success">Se ha deshabilitado correctamente el aula</div>'
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
                        html: 'Aula deshabilitada con éxito.',
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
        // habilitar aula...
        var url = `/classrooms/${$id}`;
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
            success: function (data) {
                //Habilito el boton de editar cuando habilito un aula
                let buttonEdit = document.getElementById(`buttonEdit${$id}`)
                buttonEdit.classList.remove('disabled')

                var elemStatusAssigment = $(`#viewModal${$id}`).find('.statusUpdate');
                elemStatusAssigment.html('<span class="text-secondary">Estado: </span>Habilitada');

                $('#flashMessage').html(
                    '<div class="alert alert-success">Aula habilitada correctamente</div>'
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
                        html: 'Aula habilitada con éxito.',
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
