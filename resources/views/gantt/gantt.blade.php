 @extends('layouts.app') 

@section('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Reloj  --}}
        <div id="clockdate">
            <div class="clockdate-wrapper">
              <div id="clock"></div>
              <div id="date"></div>
            </div>
          </div>
          {{-- Diagrama de Gantt --}}
        <div>
            <div id="schedule"></div>
        </div>
    </div>
 
@endsection

@section('scripts')
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript"
        language="javascript"></script>
    <script type="text/javascript" src="{{asset('js/jq.schedule.js')}}"></script>
    <script src="{{asset('js/diagramGantt/gantt.js')}}"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

{{-- Script del reloj --}}
    <script>
        document.addEventListener( 'DOMContentLoaded' , function(){
           startTime()
      })
      function startTime() {
      var today = new Date();
      var hr = today.getHours();
      var min = today.getMinutes();
      var sec = today.getSeconds();
      hr = (hr == 0) ? 00 : hr;
      //  hr = (hr > 12) ? hr - 12 : hr;
      //Add a zero in front of numbers<10
      hr = checkTime(hr);
      min = checkTime(min);
      sec = checkTime(sec);
      document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec;

      var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      var days = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
      var curWeekDay = days[today.getDay()];
      var curDay = today.getDate();
      var curMonth = months[today.getMonth()];
      var curYear = today.getFullYear();
      var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
      document.getElementById("date").innerHTML = date;

      var time = setTimeout(function(){ startTime() }, 500);
      }
      function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
      }
    </script>
@endsection
