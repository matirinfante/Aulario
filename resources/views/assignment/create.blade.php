<h1>Bienvenido a la pagina de creación de Asignaturas</h1>
<ul>
    @foreach ($users as $user)
        <li>{{$user->name}}</li>
    @endforeach
</ul>