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
                            <td> {{ $petition['id'] }} </td>
                            <td>{{ $petition['user_id'] }}</td>
                            <td>{{ $petition['assignment_name'] }}</td>
                            <td>{{ $petition['estimated_people'] }}</td>
                            <td> {{ $petition['classroom_type'] }} </td>
                            <td>
                                <form method="post" action="{{ route('petitions.reject', $petition->id) }}">
                                    @method('patch')
                                    @csrf
                                    <input id="test-input" type="text" value="peticion invalida" name="test-reason" hidden>
                                    <button type="submit">
                                        Reject
                                    </button>
                                </form>
                                @if ($petition['status'] == 'unsolved')
                                    <a href="" class="changeState" data-id="{{ $petition->id }}" value="2">
                                        <span class="badge bg-warning"> Sin resolver </span>
                                    </a>
                                @elseif ($petition['status'] == 'rejected')
                                    <a href="" class="changeState" data-id="{{ $petition->id }}" value="0">
                                        <span class="badge bg-danger"> Cancelado </span>
                                    </a>
                                @else
                                    <a href="" class="changeState" data-id="{{ $petition->id }}" value="1">
                                        <span class="badge bg-success"> Aceptada </span>
                                    </a>
                                @endif

                                {{-- <a href="{{ route('petitions.changeStatus', "$petition->id") }}">a</a> --}}
                            </td>
                            <td>
                                <a class="link-primary" href="{{ route('petitions.show', $petition['id']) }}">Ver
                                    Completo</a>
                                <a class="link-success"
                                    href=" {{ route('petitions.edit', $petition['id']) }}">Editar</a>
                                <a class="link-danger buttonDelete" href="">Borrar</a>
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
@endsection
