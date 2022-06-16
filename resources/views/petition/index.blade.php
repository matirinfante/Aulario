<!-- 
    [](Usa los permisos, mas facil que crear una vista)  Crear vista de reservas segun el usuario que reservo, sus propias reservas.
    []Aceptar reserva, modificar el controlador.
    []Vista 'crear' falta arreglar, pero esta arreglada y el modal implementado.
    []Si el admin no puede crear reserva, entonces que el id de usuario y nombre que las crea, sea predefinido en el sistema, y evitar cambios. 
-->

@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<h3 class="text-center m-4">Listado de Peticiones</h3>
<div>
    <div class="row" align=center>
        <div class="col-12 pb-3">
            <!-- Traemos el usuario al cual le vamos a sacar la inf. Es un obj. -->
            @php
            $user = auth()->user();
            @endphp
            <button type='button' class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#createModal{{ $user }}">Crear nueva peticion</button>
            @include('petition.create', [$user])
        </div>
    </div>
</div>
<div class="card" style="width: 1000px; margin: auto;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="petitions_tab">
            <thead class="bg-secondary text-light">
                <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Usuario</th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Materia</th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Personas Estimadas</th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Tipo Aula</th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Estado</th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="petitions_tab" aria-label="Name: activate to sort column ascending" aria-sort="descending">Accion</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($petitions as $petition)
                <tr>
                    <td> {{$petition->user->name}} {{$petition->user->surname}}</td>
                    <td> {{$petition->assignment->assignment_name}}</td>
                    <td> {{$petition['estimated_people']}}</td>
                    <td> {{$petition['classroom_type']}} </td>
                    <td>
                        @if ($petition['status'] == 'unsolved')
                        <span class="badge bg-warning"> Sin resolver </span>
                        @elseif ($petition['status'] == 'rejected')
                        <span class="badge bg-danger"> Rechazada </span>
                        @else
                        <span class="badge bg-success"> Aceptada </span>
                        @endif
                    </td>
                    <td>
                        <!-- Boton Modal Detalles -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $petition['id'] }}">Detalles</button>
                        @include('petition.show', ['petition' => $petition])

                        {{-- <a href="{{ route('petitions.changeStatus', "$petition->id") }}">a</a> --}}
                    </td>
                    <td>
                        @if ($petition['status'] == 'unsolved')
                        <!-- Boton Aceptar Peticion -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-target="{{ $petition['id'] }}">Aceptar</button>
                        <span class="vr"></span>

                        <!-- Boton Rechazar Peticion -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedModal{{ $petition['id'] }}">Rechazar</button>
                        <!-- Modal Rechazar Detalles -->
                        @include('petition.edit', ['petition' => $petition])
                        @endif
                    </td>
                </tr>
                @empty
                <td>No hay registros</td>
                <td>No hay registros</td>
                <td>No hay registros</td>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

{{-- <script>
        $('.changeState').click(function(e) {
            var id = $(this).data('id');
            var status = $(this).val();
            console.log(id);
            console.log(status);
            // var url = "{{ route('petitions.changeStatus') }}";

$.ajax({
type: 'post',
url: "url",
data: 'data',
success: function(response) {
console.log(response);
}
});
});
</script> --}}

<script>
    $(document).ready(function() {
        $('#petitions_tab').DataTable();
    });
</script>

@endsection