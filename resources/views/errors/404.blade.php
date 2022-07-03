@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('image')
    <div style="background-image: url({{ asset('assets/img/404.png') }}); background-size: cover;"
        class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
@section('message', __($exception->getMessage() ?: 'Página no encontrada.'))


@section('quote', 'Debe haber algunos Saiyajin allá afuera, solo tenemos que ir a buscarlos')

