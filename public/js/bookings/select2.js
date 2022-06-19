
// script para utilizar select2
$('.select2-assignment').select2({
    placeholder: {
        allowClear: true,
        text: 'Seleccione la materia'
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

$('.select2-teacher').select2({
    placeholder: {
        allowClear: true,
        text: 'Seleccione profesor'
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

