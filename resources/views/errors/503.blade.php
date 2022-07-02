@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('image') 
<img src="{{asset('assets/img/503.svg')}}" style="height: 100vh;">
@endsection
@section('message', 'La página está bajo mantenimiento. Will be back')
