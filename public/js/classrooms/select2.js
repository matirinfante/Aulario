// Precargar edificio y tipo de aula en select al editar un aula

function precargarSelect(classroom) {
    var arregloEdificio = [];
    var arregloTipo = [];
    var elemEdificio = $("#updateModal" + classroom.id + "").find(".select2-building");
    var elemTipo = $("#updateModal" + classroom.id + "").find(".select2-type");

    // asigno el estado actual de 'building' en select de edificio
    arregloEdificio.push(classroom.building);

    elemEdificio.val(arregloEdificio);
    elemEdificio.trigger('change');

     // asigno el estado actual de 'type' en select de tipo de aula
     arregloTipo.push(classroom.type);

     elemTipo.val(arregloTipo);
     elemTipo.trigger('change');
}