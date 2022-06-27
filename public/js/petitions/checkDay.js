$('#create_petition').submit(function(){
    let fecha = ($('#start_date').val())+'T00:00:00';   //Parche de la zona horaria
    var date = new Date(fecha);
    var day = date.toLocaleDateString("es-ES", { weekday: 'long' });    //Almaceno el día de la fecha elegida        
    var str = day.charAt(0).toUpperCase() + day.slice(1);   //Cambio a mayuscula la primer letra
    var selectedDay= ($('#days').val());
    if (!(str==selectedDay)){
        //Si no coinciden cancela el submit y genera un alerta.
        event.preventDefault();
        alert('La fecha de inicio y el día elegido no coinciden.');
    }
})