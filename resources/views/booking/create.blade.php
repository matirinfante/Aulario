@extends('layouts.app')

@section('styles')
    <style>
        select{
            min-width:200px;
        }
    </style>
@endsection

@section('content')

{{-- {{$booking_type}} --}}
<br>
    <form method="POST" id="form-store" action="{{route('bookings.store')}}" style="margin:auto; width:500px; background-color:antiquewhite">
        @csrf
        <div class="mb-3">
            <label for="classroom_id">Aulas</label>
            <select class="js-example-basic-multiple" multiple='multiple' id="classroom_id" name="classroom_id[]" id="classroom_id">
                @foreach ($classrooms as $classroom)
                    <option cap="{{$classroom->capacity}}" value="{{$classroom->id}}" ide="{{$classroom->id}}">{{$classroom->classroom_name}} : {{$classroom->capacity}}</option>                
                @endforeach
            </select>
        </div>
        {{-- Capacidad total de aulas --}}
        <label for="capacidad">Capacidad</label>
        <input type="text" id="capacidad">
        
        {{-- @if (!empty($assignments))
            <div class="mb-3">
                <select class="js-example-basic-single" name="assignment_id" id="nombre">
                    @foreach ($assignments as $assignment)
                        <option>{{$assignment->assignment_name}}</option>                
                    @endforeach
                </select>
            </div>
        @endif --}}

        @if (!empty($events))
            <div class="mb-3" id="event_id">
                <label for="event_id">Eventos</label>
                <select class="js-example-basic-single" name="event_id" id="event_id">
                    @foreach ($events as $event)
                        <option value="{{$event->id}}" part="{{$event->participants}}">{{$event->event_name}}</option>                
                    @endforeach
                </select>
            </div>
            {{-- Cantidad de participantes --}}
            <label for="cantidad">Participantes</label>
            <input type="text" id="cantidad"> 
        @endif
        
        {{-- Resultado de la cuenta matematica --}}
        <div id="cuenta">
        </div>

        <div class="mb-3">
            <select class="js-example-basic-simple" name="week_day" id="week_day">
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miercoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
                <option>Sabado</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="description" id="description" placeholder="descripcion">
            <input type="date" name="booking_date" id="booking_date">
        </div>
        <div class="mb-3">
            <input type="time" name="start_time" id="start_time">
            <input type="time" name="finish_time" id="finish_time">
        </div>
        {{-- Disponibilidad de aulas --}}
        <div class="mb-3">
            <label>Chequear Disponibilidad de aulas</label>
            <button class="btn btn-success" type="button" id="roomCheck">Check</button>
        </div>

        <input type="submit" value="enviar">
    </form>
    
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        var $partyTotal=0;  //Total de participantes del evento
        var $capTotal=0;    //Capacidad total de aulas en conjunto
        $("#event_id").change(function(){
            $( "#event_id option:selected" ).each(function() {
                $participants=$(this)[0].part.value;
                $partyTotal=$participants;
                $("#cantidad").attr('value',$partyTotal);
            });
            math($capTotal,$partyTotal);
        });
        $("#classroom_id").change(function(){
            $capTotal=0;
            var $largo=($( "#classroom_id option:selected" )).length;
            $( "#classroom_id option:selected" ).each(function() {
                $capacity=$(this)[0].attributes.cap.value;
                $capTotal+=parseInt($capacity);
                $("#capacidad").attr('value',$capTotal);
            });
            math($capTotal,$partyTotal);
            if ($largo>1){
                //Cambiar la ruta del action. Que vaya a bookings.multiStore
            }else{
                //Cambiar la ruta del action. Que vaya a bookings.store
            }
        });

        //Funcion math: evalua la diferencia entre los parametros y genera un mensaje en un div
        function math($cap,$party){
            if ($cap>=$party){
                $("#cuenta").html('Hay espacio para los nenes');
                $("#cuenta").css('color','green');
            }else{
                $("#cuenta").html('Hay pibes que miran desde la ventana');
                $("#cuenta").css('color','red');
            }
        }

        //La idea de esto es que meta en un arreglo todos los parametros necesarios para verificar que cada aula de las usadas este libre en el horario elegido. No se como poronga mandar los parametros a una funcion del Controller desde acá
        $('#roomCheck').click(function(){
        //Odio JQuery
            $classrooms=$('#classroom_id option:selected');
            console.log($classrooms);
            $cant=$classrooms.length;
            var $arreglo=[];
            var $day= $('#week_day')[0].value;
            var $date= $('#booking_date')[0].value;
            var $start= $('#start_time')[0].value;
            var $finish= $('#finish_time')[0].value;
            for (var i = 0; i < $cant; i++){
                $id=$classrooms[i].attributes.ide.value;
                $arreglo[i]={id:$id,week_day:$day,booking_date:$date,start_time:$start,finish_time:$finish};
            }

            //NO ANDA ESTA PORONGA
            // var $url={{route('bookings.store')}};
            // $.ajax({
            //     type: "POST",
            //     url: $url,
            //     data: $arreglo,
            //     success: function (data){
            //         console.log('exito');
            //     }
            // });
        });

    </script>
@endsection