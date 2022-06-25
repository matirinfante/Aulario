@extends('layouts.app')

@section('content')
    <h1>{{$logbook->booking->assignment->assignment_name}}</h1>
    <h2>Profesor: {{$user->name}} {{$user->surname}}</h2>
@endsection

@section('scripts')
@endsection
