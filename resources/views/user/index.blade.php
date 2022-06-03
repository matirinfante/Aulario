@extends('layouts.app')

@section('content')
        
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<div class="card" style="width: 1000px; margin: auto;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="users">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Dni</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td> {{$user['name']}} </td>
                    <td>{{$user['surname']}}</td>
                    <td>{{$user['dni']}}</td>
                    <td>{{$user['email']}}</td>
                </tr>
                @empty
                    <td> No hay registros </td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#users').DataTable();
            });
        </script>
@endsection


