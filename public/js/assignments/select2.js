// script para utilizar select2

$('.select2-user').select2({
    placeholder: {
        allowClear: true,
        text: 'Seleccione el profesor asignado'
    },
    language: {

        noResults: function () {

            return "No hay resultado";
        },
        searching: function () {

            return "Buscando..";
        }
    }
});

$('.select2-active').select2({
    placeholder: {
        allowClear: true,
        text: 'Seleccione estado de cuatrimestre'
    },
    language: {

        noResults: function () {

            return "No hay resultado";
        },
        searching: function () {

            return "Buscando..";
        }
    }
});


// Precargar cuatrimestre y profesores en select al editar una materia

function precargarSelect(assignment) {
    var profesores = assignment.users;
    var arregloSelected = [];
    var arregloCuatrimestre = [];
    var elemCuatrimestre = $("#updateModal" + assignment.id + "").find(".select2-active");
    var elemProfesor = $("#updateModal" + assignment.id + "").find(".select2-user");

    // asigno el estado actual de 'active' en select de cuatrimestre
    arregloCuatrimestre.push(assignment.active);

    elemCuatrimestre.val(arregloCuatrimestre);
    elemCuatrimestre.trigger('change');

    $.each(profesores, function (key, value) {
        arregloSelected.push(value.id);
    });
    if (arregloSelected.length != 0) { // si existen profesores en la materia
        elemProfesor.val(arregloSelected);
        elemProfesor.trigger('change');
    } else {
        elemProfesor.val('');
        elemProfesor.trigger('change');
    }
}
