@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('image')
    <div style="background-image: url({{ asset('assets/img/403.jpg') }}); background-size: cover;"
        class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
@section('message', __($exception->getMessage() ?: 'Usted no tiene autorización para acceder a este apartado.'))


@section('quote', 'Thank You for Your Cooperation, Good Night!')
