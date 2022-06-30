@extends('layouts.app')

@section('content')
    {{-- Mensaje del controlador al realizar acción --}}
    <div id="flashMessage" class="text-center d-none">
        @include('flash::message')
    </div>
    @if ($errors->any())
        <div class="d-none" id="errorsMsj" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
 
    <div class="container">
        <div class="row justify-content-center">
            <h5>Perfil personal</h5>
            <div class="col-md-4 pt-4 ">Información de datos personales</div>
            <div class="col-md-8 ">
                <div class="card col-md-10">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label ">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" disabled type="text" class="form-control" name="name" value="{{auth()->user()->name}} {{auth()->user()->surname}}" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="personal_token" class="col-md-3 col-form-label ">Token personal</label>
                            <div class="col-md-6 position-relative">
                                <input id="personal_token" disabled type="password" class="form-control" name="personal_token" value="{{auth()->user()->personal_token}}" >
                                <div class="position-absolute top-0 end-0 me-4 mt-1"  onclick="showPassword('personal_token')">
                                    <svg id="show_personal_token" class="bi bi-eye-fill position-absolute mt-1" style="visibility:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>
                                    <svg id="hidden_personal_token"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-4 pt-4 ">Actualización de contraseña</div>
            <div class="col-md-8 ">
                <div class="card col-md-10">
                    <div class="card-body">
                        <form method="POST" action="{{route('users.changePassword')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="old_password" class="col-md-3 col-form-label ">Contraseña actual</label>
                                <div class="col-md-6 position-relative">
                                    <input id="old_password" type="password" class="form-control" name="old_password">
                                    <div class="position-absolute top-0 end-0 me-4 mt-1"  onclick="showPassword('old_password')">
                                        <svg id="show_old_password" class="bi bi-eye-fill position-absolute mt-1" style="visibility:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>
                                        <svg id="hidden_old_password"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="new_password" class="col-md-3 col-form-label ">Nueva contraseña</label>
                                <div class="col-md-6 position-relative">
                                    <input id="new_password" type="password" class="form-control" name="new_password">
                                    <div class="position-absolute top-0 end-0 me-4 mt-1"  onclick="showPassword('new_password')">
                                        <svg id="show_new_password" style="visibility:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill position-absolute mt-1" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>
                                        <svg id="hidden_new_password"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="new_password_confirmation" class="col-md-3 col-form-label ">Confirmar contraseña</label>
                                <div class="col-md-6 position-relative">
                                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                                    <div class="position-absolute top-0 end-0 me-4 mt-1"  onclick="showPassword('new_password_confirmation')">
                                        <svg id="show_new_password_confirmation" style="visibility:hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill position-absolute mt-1" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>
                                        <svg id="hidden_new_password_confirmation"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-10">
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- userProfile --}}
<script src="{{ asset('js/users/userProfile.js') }}" defer></script>
{{-- Sweet alert --}}
<script src="{{ asset('js/users/sweetAlert.js') }}" defer></script>
@endsection