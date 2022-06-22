 @extends('layouts.app') 

@section('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
@endsection

@section('content')
    <div class="container-fluid">
        <div style="">
            <div id="schedule" style=""></div>
        </div>
    </div>
    <script>
        // window.setTimeout(() => {  
        //     let gantt = document.querySelector('.sc_data')
        //     let gantt1 = document.querySelector('.sc_wrapper')
        //     let gantt2 = document.querySelector('.sc_main_box')
        //     console.log(gantt)
        //     gantt.setAttribute('style' , 'height: 900px;');
        //     gantt1.setAttribute('style' , 'height: 900px;');
        //     gantt2.setAttribute('style' , 'height: 900px;');
        // }, 2000);


            let pantalla = window.outerWidth
            console.log(pantalla)
        window.scrollTo({

        })    



    </script>
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
