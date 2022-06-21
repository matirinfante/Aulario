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
        datos=JSON.parse(data);
        let datosGantt= "{";
        let flag=false; //Para que no me concatene la "," la primera vez
        datos.find((object,index) =>{
            if (flag){
                datosGantt+=","
            }
            flag=true;
            if(Array.isArray(object)==false){
                datosGantt+=formato(object, index)
            }
            
        })
        datosGantt+="}"
        objGantt=JSON.parse(datosGantt);
        function formato(elem, index){
            let rta = `"${index}": { 
                "title":"aula de prueba",
                "schedule": [`
            Object.values(elem).forEach(val => {
                rta+=`{    
                            "start": "${val.start_time}",
                            "end": "${val.finish_time}",
                            "text": "${val.description}",
                            "data": {}
                        }
                        `
            });
            rta+=`]}`
            return rta;
        }        
        $(function () {
            $("#logs").append('<table class="table">');
            var isDraggable = false;
            var isResizable = false;
            console.log(datosGantt);
            var $sc = $("#schedule").timeSchedule({
            
                startTime: "08:00:00", // schedule start time(HH:ii)
                endTime: "23:00:00",   // schedule end time(HH:ii)
                widthTime: 60 * 20,  // cell timestamp example 10 minutes
                timeLineY: 50,       // height(px)
                verticalScrollbar: 20,   // scrollbar (px)
                timeLineBorder: 2,   // border(top and bottom)
                bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
                draggable: isDraggable,
                resizable: isResizable,
                resizableLeft: true,
                rows: {}
            });
            $sc.timeSchedule('setRows', objGantt); //Pasa los datos del objeto al calendario
            
        }
        
    )}
});