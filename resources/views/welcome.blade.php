    @extends('layouts.app')
    @section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.min.css')}}"/>
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
            <div style="padding: 0 0 40px;">
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
@endsection
