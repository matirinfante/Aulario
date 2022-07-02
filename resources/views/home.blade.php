@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div> --}}

        {{-- <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif --}}

        {{-- {{ __('You are logged in!') }} --}}
        @role('teacher')
            {{ 'hola' }}
        @endrole




        @role('admin')
            <div class="row row-cols-3" id="cardindex">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img">
                            {{-- <img src="{{ asset('assets/img/pedco.png') }}" class="card-img-top" alt="..."> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" style="max-height: 100%
                                                                 fill="currentColor" class="bi bi-people"
                                                                viewBox="-4 0 25 20">
                                                                <path
                                                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                                            </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text">Accede para crear, modificar y elimiar usuarios del sistema</p>
                            <a target="_blank" href="https://pedco.uncoma.edu.ar/" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img">
                            {{-- <img src="{{ asset('assets/img/logo-faif.png') }}" class="card-img-top" alt="..."> --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" class="bi bi-book"
                            viewBox="-6 -2 28 20">
                            <path
                                d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                        </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Materias</h5>
                            <p class="card-text">Gestion de materias de la facultad, asignar profesores,
                                crear y modificar</p>

                            <a target="_blank" href="https://www.fi.uncoma.edu.ar/" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img ">
                            {{-- <img src="{{ asset('assets/img/siubanner.png') }}" class="card-img-top mt-3" alt="..."> --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" class="bi bi-mortarboard"
                            viewBox="-6 -2 28 20">
                            <path
                                d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                            <path
                                d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                        </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Aulas</h5>
                            <p class="card-text">Aulas asignadas a la facultad de informatica dentro de la universidad.</p>
                            <a target="_blank" href="https://siufai.uncoma.edu.ar/informatica/" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img">
                            {{-- <img src="{{ asset('assets/img/status.svg') }}" class="card-img-top" alt="..."
                                style="max-height: 100%"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="currentColor"
                                class="bi bi-check2-circle" viewBox="-6 -2 28 20">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Reservas</h5>
                            <p class="card-text">Crea reservas periodicas o eventos por dias</p>

                            <a target="_blank" href="{{ route('gantt') }}" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>

                    </div>
                </div>
                <div class="col mt-5">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img">
                            {{-- <img src="{{ asset('assets/img/status.svg') }}" class="card-img-top" alt="..."
                                style="max-height: 100%"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                 fill="currentColor"
                                class="bi bi-clock-history" viewBox="-10 -4 35 20">
                                <path
                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                <path
                                    d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                <path
                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Cronograma de reservas</h5>
                            <p class="card-text">Consulta las reservas para un dia en especifico</p>

                            <a target="_blank" href="{{ route('gantt') }}" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>

                    </div>
                </div>
                <div class="col mt-5">
                    <div class="card" style="width: 18rem;">
                        <div class="container-img">
                            {{-- <img src="{{ asset('assets/img/status.svg') }}" class="card-img-top" alt="..."
                                style="max-height: 100%"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="currentColor" class="bi bi-pen"
                                viewBox="-6 -2 28 20">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">Peticiones</h5>
                            <p class="card-text">Gestiona las solicitud de reservas de los profesores de la facultad</p>

                            <a target="_blank" href="{{ route('gantt') }}" class="btn text-light"
                                style="background-color:  #036">Entrar</a>
                        </div>

                    </div>
                </div>

            </div>
        @endrole




        @role('bedel')
            {{ 'hola' }}
        @endrole
        {{-- </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
