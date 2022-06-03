@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <h3 class="text-center m-4">Listado de Aulas</h3>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="classroom">
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Locación</td>
                        <td>Capacidad</td>
                        <td>Tipo de aula</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classroom as $class)
                        <tr>
                            <td> {{ $class->classroom_name }} </td>
                            <td>{{ $class->location }}</td>
                            <td>{{ $class->capacity }}</td>
                            <td>{{ $class->type }}</td>
                            <td>
                                <a class="link-primary" href="{{ route('classrooms.show', $class->id) }}">Ver</a>
                                <a class="link-success" href=" {{ route('classrooms.edit', $class->id) }}">Editar</a>
                                <a class="link-danger buttonDelete" href="">Borrar</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form_classroom_delete" name="form_classroom_delete" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminación de Aula</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="classroom_id" id="classroomId">
                        <p>¿Está seguro de que desea eliminar el aula?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#classroom').DataTable();
            $(document).on('click', '.buttonDelete', function(e) {
                e.preventDefault();
                var id = $(this).data('value');
                $('#classroomId').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
