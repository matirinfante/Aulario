@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('image')
    <div style="background-image: url({{ asset('assets/img/503.jpg') }}); background-size: cover;"
        class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
@section('message', __($exception->getMessage()))


@section('quote', 'La página está bajo mantenimiento. Will be back.')
