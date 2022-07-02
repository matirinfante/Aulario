@extends('errors::layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('image')
<img src="{{asset('assets/img/403.png')}}" style="height: 100vh;">
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
