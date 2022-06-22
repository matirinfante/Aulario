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
        datosAll=JSON.parse(data);
        console.log(datosAll)
        datosLg=(datosAll.length)-1;
        datos=datosAll[datosLg];    //Datos de las reservas
        console.log(datos)
        let datosGantt= "{";
        let flag=false; //Para que no me concatene la "," la primera vez
        
        var classFound=[];
        var contIndex=0;
        datos.find((object,index) =>{
            contIndex++;    //No se si esta bien aca. Pero por ahora funciona. Check
            if (object.length!=0){  //Para evitar objetos (aulas) vacios
                if (flag){
                    datosGantt+=","
                }
                flag=true;
                var singleObj=object[Object.keys(object)[0]];
                var classId=singleObj.classroom_id; //Almacena el id de la clase de cada aula
                var nameFlag=false;
                var i=0;
                var className="";
                //While recorre las aulas y cuando coincide el id con classId almacena el nombre
                while (i < datosLg || nameFlag==false) {
                    if((datosAll[i].id)==classId){
                        nameFlag=true;
                        className=datosAll[i].classroom_name;
                        classFound.push(datosAll[i].id);
                    }
                    i ++;
                }
                datosGantt+=formato(object, index, className)
            }
        })
        

        //
        //Aca me ocupo de las aulas vacias
        //
        i=0;
        var emptyClass=[];  //Se almacenan nombres de aulas sin reservas
        var emptyFlag=false;
        while (i < datosLg) {
            className = datosAll[i].classroom_name;
            emptyFlag=false;
            classFound.forEach(element => {
                if ((datosAll[i].id)==element){
                    emptyFlag=true;
                }
            });
            if (!emptyFlag){
                emptyClass.push(datosAll[i].classroom_name);
            }
            i ++;
        }
        //Una vez que tengo los nombres almacenados, se los agrego al string de datosGantt, usando la funcion formato
        if (emptyClass.length>0){
            emptyClass.forEach(element => {
                datosGantt+=","
                datosGantt+=formato(null,contIndex,element)
                contIndex++;
            });
        }
        //
        //Listo con las aulas vacias
        //

    
        //Cierro el string con los datos para el schedule y genero un JSON
        datosGantt+="}";
        objGantt=JSON.parse(datosGantt);

        function formato(elem, index, className){
            let rta = `"${index}": { 
                "title":"${className}",
                "schedule": [`
            let flag2=false; //Para que no me concatene la "," la primera vez  
            if(!(elem==null)) {  //Este if esta a prueba
                Object.values(elem).forEach(val => {
                    if (flag2){
                        rta+=","
                    }
                    flag2=true;
                    rta+=`{    
                                "start": "${val.start_time}",
                                "end": "${val.finish_time}",
                                "text": "${val.description}",
                                "data": {}
                            }
                            `
                });
            }
            rta+=`]}`
            return rta;
        }        

        //Aca arranca el schedule
        $(function () {
            $("#logs").append('<table class="table">');
            var isDraggable = false;
            var isResizable = false;
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
window.setInterval(e=>{
    location.reload();
},300000)