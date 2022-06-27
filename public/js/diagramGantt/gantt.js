function addLog(type, message) {
    var $log = $('<tr />');
    $log.append($('<th />').text(type));
    $log.append($('<td />').text(message ? JSON.stringify(message) : ''));
    $("#logs table").prepend($log);
}
$.ajax({

    headers: {
        "X-CSRF-TOKEN": window.CSRF_TOKEN,
    },
    type: "POST",
    url: `/bookings/gantt`,
    cache: false,

    success: function (data) {
        //obtenemos en data un arreglo que contiene classroom y un arreglo de bookings desde el controlador
        datosAll=JSON.parse(data);
       let rta =`{`
       //Recorremos la primer posicion del arreglo obteniendo cada objeto para el valor necesario 
        datosAll.forEach(classroom => {
            for (let i = 0; i< classroom.length; i++) {
                const objClassroom = classroom[i];
                colbookings=objClassroom.bookings
                    rta += `"${i}": { 
                             "title":"${objClassroom.classroom_name}",
                             "schedule": [`
                             //si la posicion del arreglo es mayor a 0(contiene reservas) y generamos las schedules
                             //recorriendo el el array de reservas dentro del objeto
                    if(colbookings.length>0){
                        for (let j = 0; j < colbookings.length; j++) {
                            const bookings = colbookings[j];
                            rta+=`{    
                                "start": "${bookings.start_time}",
                                "end": "${bookings.finish_time}",
                                "text": "${bookings.name}",`;
                            if(bookings.tipo=="materia"){
                                rta+=`"data": {"class":"materia"} }`
                            }else{
                                rta+=`"data": {"class":"evento"} }`
                            }
                            
                                if(j+1 < colbookings.length ){
                                    rta+=`,`
                                }
                        }
                    }
                    rta+=`]}`
                    if(i+1 < classroom.length ){
                        rta+=`,`
                    }
                        
                    
                
            }
           
        });
        rta+=`}`
        //Se realiza el parse para generar el objeto que admite el schedule
        objGantt=JSON.parse(rta);
        $(function () {
            $("#logs").append('<table class="table">');
            var isDraggable = false;
            var isResizable = false;
            var $sc = $("#schedule").timeSchedule({
            
                startTime: "08:00:00", // schedule start time(HH:ii)
                endTime: "23:00:00",   // schedule end time(HH:ii)
                widthTime: 60 * 6,  // cell timestamp example 10 minutes
                timeLineY: 50,       // height(px)
                verticalScrollbar: 20,   // scrollbar (px)
                timeLineBorder: 2,   // border(top and bottom)
                bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
                draggable: isDraggable,
                resizable: isResizable,
                resizableLeft: true,
                rows: objGantt,
                onAppendSchedule: function(node, data){
                    if(data.data.class){
                        node.addClass(data.data.class);
                    }
                }
            });
            // $sc.timeSchedule('Rows', objGantt); //Pasa los datos del objeto al calendario
            
        }
        
    )}
             
});
//Funcion que se ejectua en el window 
//Cada un intervalo de tiempo escrito en milisegundos la pagina se refresca
// window.setInterval(e=>{
//     location.reload();
// },300000)



$(document).ready(function() {
  function moverScroll(){ 
    const horaActual = new Date().getHours(); // Hora actual sin minutos
    const primerHoraGantt = 8; // Primer cuadrado de hora de Gantt
    const horasAntesActual = 2; // Cantidad de horas para ver antes de la actual

    const scrollElement = document.querySelector(".sc_main_box"); // Div scrolleable
    
    scrollElement.scrollLeft += ((horaActual - primerHoraGantt) * 250) - (horasAntesActual * 250);
  }

  function colorHoraActual() {
    const horaActualC = new Date().getHours() + ":00"; // Hora actual con minutos en 00
    const tabHoraActual = $(".sc_header_scroll :contains('" + horaActualC + "')")[0]; // Selecciona un div dentro de sc_header_scroll con el texto de la hora actual

    if (new Date().getHours() > 7) { // Mayor que 7 evita las horas del 0 al 7
        $(tabHoraActual).addClass("hora-actual");
      }
  }

  function popper (){
    cuadradosE = document.querySelectorAll(".materia");
    cuadradosM = document.querySelectorAll(".evento");

    activarPopper(cuadradosE);
    activarPopper(cuadradosM);
  }

  function activarPopper(cuadrados) {
    cuadrados.forEach(cuadrado => {

      textoCuadrado = cuadrado.getElementsByTagName('span')[2]; 
  
      cantLetras = textoCuadrado.textContent.length;

      ejeX = (((cuadrado.clientWidth/2) * -1) + (cantLetras*4+5)); // HACER TABLA CON MEDIDAS SEGUN EL ANCHO DEL TEXTO

      Popper.createPopper(cuadrado, textoCuadrado, {
        placement: 'top',
          modifiers: [
            {
              name: 'offset',
              options: {
                offset: [ejeX, -45],
              },
            },
          ],
      });
    });
  }

  setTimeout(moverScroll, 0) // Si scrollElement no carga, aumentar el tiempo
  setTimeout(colorHoraActual, 0) // Si tabHoraActual no carga, aumentar el tiempo
  setTimeout(popper, 0)
});