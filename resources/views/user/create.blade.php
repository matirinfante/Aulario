@extends('layouts.app')

@section('content')
    <style>
        form{
            width: 40%; 
            margin: auto;
            background: #D9D9D9;
            padding: 25px;
            border-radius: 25px;
            text-align: center;
        }
    label{
        font-weight: 600;
    }
    </style>
    <form class="" style="" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Robert">
            <small id="errorName">Error</small>
          </div>
          <div class="mb-3">
            <label for="surname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="surname" placeholder="Kiyosaki">
            <small id="errorSurname">Error</small>
          </div>
        <div class="mb-3">
            <label for="dni" class="form-label">Dni</label>
            <input type="number" class="form-control" id="dni" min="1000000" max="99999999" placeholder="39504700">
            <small id="errorDni">Error</small>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="robert@kiyosaki.com">
            <small id="errorEmail">Error</small>
        </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password">
            <small id="errorPassword">Error</small>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection