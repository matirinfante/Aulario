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
        datosAll=JSON.parse(data);  //datosAll tiene tanto las aulas, como las reservas al final
        datosLg=(datosAll.length)-1;  
        datos=datosAll[datosLg];    //Datos de las reservas que se encuentran al final de datosAll
        let datosGantt= "{";    //Aca arranca el string que luego pasa como JSON al schedule
        let flag=false; //Para que no me concatene la "," la primera vez
        
        var classFound=[];  //Aulas encontradas en total
        var contIndex=0;    //Lo necesito para darle un index a las aulas vacias
        var contFlag=false; //Chequeo si existe aunque sea una reserva cargada dentro de todas las aulas
        datos.forEach(element => {
            if(!(element=="")){
                contFlag=true;
            }   
        });
        if(contFlag){
            datos.find((object,index) =>{
                contIndex++;    //No se si esta bien aca, pero por ahora funciona. Check
                if (object.length!=0){  //Para evitar objetos vacios. Donde las aulas no tenian reservas
                    if (flag){
                        datosGantt+=","
                    }
                    flag=true;
                    var singleObj=object[Object.keys(object)[0]];
                    var classId=singleObj.classroom_id; //Almacena el id del aula visto desde la reserva
                    var nameFlag=false;
                    var i=0;
                    var className="";   //Para pasar como parametro en la funcion formato
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
        }
        

        //
        //Aca me ocupo de las aulas sin reservas
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
                if (contFlag){
                    datosGantt+=","
                }
                contFlag=true;
                datosGantt+=formato(null,contIndex,element)
                contIndex++;
            });
        }
        //
        //Listo con las aulas sin reservas
        //

    
        //Cierro el string con los datos para el schedule y genero un JSON
        datosGantt+="}";
        objGantt=JSON.parse(datosGantt);
        

        //Esta funcion recibe como parametro un objeto (elem), que a su vez tiene otros objetos (uno o mas), que son las reservas en una misma aula (por eso otro foreach adentro).
        // Dentro se arma un string con el contenido que necesita rows en el calendario
        //Si elem es null (caso de las aulas sin reservas) dejara el schedule vacio.
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

        //Aca arranca el calendario
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
//Funcion que se ejectua en el window 
//Cada un intervalo de tiempo escrito en milisegundos la pagina se refresca
window.setInterval(e=>{
    location.reload();
},300000)