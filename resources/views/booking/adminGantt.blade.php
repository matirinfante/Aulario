@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
@endsection
@section('content')
    <div class="container-fluid">
        {{-- <div class="data-container">
            <div class="data">
                <img id="img" src="{{asset('assets/img/aulario.png')}}"alt="Aulario">
            </div>
            <div class="data">
                <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_vo3itchj.json"  background="transparent"  speed="1"  style="width: 450px; height: 450px;"  loop  autoplay></lottie-player>
            </div>
        </div> --}} 
       
        <div class="card" style="padding:25px; width: 500px; margin: 25px auto">
               <h4 class="text-center m-2">Seleccione fecha para visualizar las reservas de un dia</h4>
              <div> 
            <input type="date" id="inputDate" style="width: 90%;"> 
            <button type="button"
            class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top"
            title="Seleccione una fecha."><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="#d99949" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
            </svg>
        </button>
              </div>
        </div>
        <div style="padding: 0 0 40px; ">
            
            <div id="schedule"></div>
        </div>
    </div>
   

@endsection
@section('scripts')
<script type="text/javascript">
    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript"
        language="javascript"></script>
<script type="text/javascript" src="{{asset('js/jq.schedule.js')}}"></script>


<script>
$('#inputDate').on('change',function(){
  $.ajax({

    headers: {
        "X-CSRF-TOKEN": window.CSRF_TOKEN,
    },
    type: "POST",
    url: `/bookings/gantt`,
    cache: false,
    data:{
      'booking_date':document.getElementById('inputDate').value
    },
    
    success: function (data) {

       let $sc=$("#schedule");
       $sc.empty();
        let objGantt="";
        let rta="";
      
        //obtenemos en data un arreglo que contiene classroom y un arreglo de bookings desde el controlador
        datosAll=JSON.parse(data);
        rta =`{`
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
        console.log(objGantt);
        console.log(rta);
        $(function () {
            $("#logs").append('<table class="table">');
            var isDraggable = false;
            var isResizable = false;
             $sc.timeSchedule({
            
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
});
</script>
@endsection
