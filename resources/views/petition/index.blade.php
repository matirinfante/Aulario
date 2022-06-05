@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<h3 class="text-center m-4">Listado de Peticiones</h3>
<div class="card" style="width: 1000px; margin: auto;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="users">
            <thead class="bg-secondary text-light">
            <tr>
                <td>Id</td>
                <td>Id_Usuario</td>
                <td>Id_Materia</td>
                <td>Personas Estimadas</td>
                <td>Tipo Aula</td>
                <td>Estado</td>
                <td>Accion</td>
            </tr>
            </thead>
            <tbody>
            @forelse ($petitions as $petition)
                <tr>
                    <td> {{$petition['id']}} </td>
                    <td>{{$petition['user_id']}}</td>
                    <td>{{$petition['assignment_id']}}</td>
                    <td>{{$petition['estimated_people']}}</td>
                    <td> {{$petition['classroom_type']}} </td>
                    <td> 
                       @if ($petition['status'] == 'unsolved')
                           <span class="badge bg-warning"> {{$petition['status']}} </span>
                       @elseif ($petition['status'] == 'rejected')
                           <span class="badge bg-danger"> {{$petition['status']}} </span>
                       @else
                            <span class="badge bg-success"> {{$petition['status']}} </span>
                       @endif 
                    </td>
                    <td>
                        <a class="link-primary"
                           href="{{route('petitions.show', $petition['id'])}}"
                        >Ver Completo</a>
                        <a class="link-success"
                           href=" {{route('petitions.edit', $petition['id'])}}"
                        >Editar</a>
                        <a class="link-danger buttonDelete" href="">Borrar</a>
                    </td>
                </tr>
            @empty
                <td>No hay registros</td>
                <td>No hay registros</td>
                <td>No hay registros</td>
                <td>No hay registros</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection