@extends('errors::layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('image')
<img src="{{asset('assets/img/404.svg')}}" style="height: 100vh;">
@endsection
@section('message', __('Not Found'))
