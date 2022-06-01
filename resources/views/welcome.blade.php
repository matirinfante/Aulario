    @extends('layouts.app')
    @section('content')
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-7">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_vo3itchj.json"  background="transparent"  speed="1"  style="width: 450px; height: 450px;"  loop  autoplay></lottie-player>
                </div>
                <div class="col-4">
                    <img src="{{asset('assets/img/aulario.png')}}" class="img-fluid" alt="Aulario">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 mt-4 d-none">
                    <p>Aulario es una aplicación que le permite consultar el horario y disponibilidad de un aula determinada, para así poder realizar una reserva y organizar el evento que desee llevar a cabo.</p>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @endsection
    
