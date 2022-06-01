@extends('layouts.app')

@section('content')
<h3 class="text-center m-4">Bienvenido a la página principal de Materias</h3>
<ul>
    @foreach($assignments as $assignment)
        <li><a href="{{route('assignments.show',$assignment)}}">{{$assignment->assignment_name}}</a></li>
    @endforeach
</ul>
<div class="alert alert-warning text-center fw-bold" role="alert">
    &#128679; Under construction...! &#128679;
</div>
@endsection