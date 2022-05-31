<h1>Bienvenido a la pagina principal de Asignaturas</h1>
<ul>
    @foreach($assignments as $assignment)
        <li><a href="{{route('assignments.show',$assignment)}}">{{$assignment->assignment_name}}</a></li>
    @endforeach
</ul>
