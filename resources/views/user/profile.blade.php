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
                    {{-- <div class="card-header"></div> --}}
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label ">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" disabled type="text" class="form-control" name="name" value="{{auth()->user()->name}} {{auth()->user()->surname}}" >
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personal_token" class="col-md-3 col-form-label ">Token personal</label>
                            <div class="col-md-6">
                                <input id="personal_token" disabled type="text" class="form-control" name="personal_token" value="{{auth()->user()->personal_token}}" >
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
                    {{-- <div class="card-header"></div> --}}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('users.changePassword')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="old_password" class="col-md-3 col-form-label ">Contraseña actual</label>
                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="new_password" class="col-md-3 col-form-label ">Nueva contraseña</label>
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="new_password_confirmation" class="col-md-3 col-form-label ">Confirmar contraseña</label>
                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                                </div>
                            </div>
                            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" >
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
        
{{-- Validator create--}}
<script src="{{ asset('js/assignments/validationAssignmentCreate.js') }}" defer></script>
{{-- Validator update--}}
<script src="{{ asset('js/assignments/validationAssignmentUpdate.js') }}" defer></script>
{{-- Sweet alert --}}
<script src="{{ asset('js/assignments/sweetAlert.js') }}" defer></script>
{{-- Deshabilitar materia --}}
<script src="{{ asset('js/assignments/disableAssignment.js') }}" defer></script>
{{-- Select2 --}}
<script src="{{ asset('js/assignments/select2.js') }}" defer></script>

@endsection