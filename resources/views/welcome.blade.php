    @extends('layouts.app')
    @section('content')
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4">
                    <img src="{{asset('assets/img/aulario.png')}}" class="img-fluid" alt="Aulario">
                </div>
                <div class="col-md-4">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_vo3itchj.json"  background="transparent"  speed="1"  style="width: 450px; height: 450px;"  loop  autoplay></lottie-player>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @endsection
    
