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

    success: function(data) {
        // console.log(data)
        dataResponse = JSON.stringify(data.response)
        dataClassrooms = JSON.stringify(data.classrooms)

        datos = JSON.parse(dataResponse);
        datosClassrooms = JSON.parse(dataClassrooms)
            // console.log(data)
            // console.log(dataClassrooms)
        let datosGantt = "{";
        let flag = false; //Para que no me concatene la "," la primera vez

        // console.log(data.classrooms[0].classroom_name + data.classrooms[0].building)

        //Funcion para obtener las aulas que se insertaran en el diagrama 
        function obtenerAulas(dataClassrooms) {
            let respuesta = ''

            for (let i = 0; i < dataClassrooms.length; i++) {
                const el = dataClassrooms[i];
                respuesta += ` 
                    "${i}": {
                        "title": "${el.classroom_name}"
                    }
                `
            }
            // console.log(respuesta)
            return respuesta
        }

        // console.log(obtenerAulas(datosClassrooms))


        //Funcion para dar formato jQuery Scheduled a la informacion entrante
        function formato(elem, index) {
            let rta =
                `"${index}": { 
                "title":"aula de prueba",
                "schedule": [`
            let flag2 = false; //Para que no me concatene la "," la primera vez    
            Object.values(elem).forEach(val => {
                if (flag2) {
                    rta += ","
                }
                flag2 = true;
                rta +=
                    `   {    
                        "start": "${val.start_time}",
                        "end": "${val.finish_time}",
                        "text": "${val.description}",
                        "data": {}
                    }`
            });

            rta += `]}`
            return rta;
        }


        datos.find((object, index) => {
            if (object.length != 0) { //Para evitar objetos (aulas) vacios
                if (flag) {
                    datosGantt += ","
                }
                flag = true;
                datosGantt += formato(object, index)
                    // if(Array.isArray(object)==false){
                    //     datosGantt+=formato(object, index)
                    // }
            }
        })
        datosGantt += "}"
        objGantt = JSON.parse(datosGantt);


        aulas = obtenerAulas(datosClassrooms)


        $(function() {
                $("#logs").append('<table class="table">');
                var isDraggable = false;
                var isResizable = false;
                var $sc = $("#schedule").timeSchedule({
                    startTime: "08:00:00", // schedule start time(HH:ii)
                    endTime: "23:00:00", // schedule end time(HH:ii)
                    widthTime: 60 * 20, // cell timestamp example 10 minutes
                    timeLineY: 50, // height(px)
                    verticalScrollbar: 20, // scrollbar (px)
                    timeLineBorder: 2, // border(top and bottom)
                    bundleMoveWidth: 6, // width to move all schedules to the right of the clicked time line cell
                    draggable: isDraggable,
                    resizable: isResizable,
                    resizableLeft: true,
                    rows: {

                    },
                    onAppendRow: function(node, aulas) {
                        addLog('onAppendRow', aulas);
                    },
                });
                $sc.timeSchedule('setRows', objGantt); //Pasa los datos del objeto al calendario
            }

        )
    }
});


//Funcion que se ejectua en el window 
//Cada un intervalo de tiempo escrito en milisegundos la pagina se refresca
// window.setInterval(e => {
//     location.reload()
// }, 60000)