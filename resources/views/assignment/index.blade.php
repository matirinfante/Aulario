@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <h3 class="text-center m-4">Listado de Materias</h3>
    <div class="card m-auto mt-3" style="width: 1000px;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="assignments">
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre de la materia</td>
                        <td>Profesor/a</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->assignment_name }} </td>
                            <td>{{ $assignment->teacher_name }} {{ $assignment->teacher_surname }}</td>
                            <!-- El nombre del usuario (referencia con clave foránea) -->
                            <td>
                                <a href="{{ route('assignments.show', $assignment->assignment_id) }}"
                                    class="link-primary">Ver</a>&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('assignments.edit', $assignment->assignment_id, $assignment->assignment_name) }}"
                                    class="link-success">Editar</a>&nbsp;&nbsp;&nbsp;
                                {{-- <button type="button" class="btn btn-link link-danger deleteAssignment" value="{{ $assignment->assignment_id }}">Borrar</button> --}}
                                <a href="#" data-value="{{ $assignment->assignment_id }}"
                                    class="link-danger deleteAssignment">Borrar</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3" class="text-center text-secondary">No hay registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- modal de eliminación --}}
    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form_assignment_delete" name="form_assignment_delete" method="POST"
                    action="#">
                    {{-- action="{{ route('assignments.destroy') }}"> --}}
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminación de materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="assignment_id" id="assignmentId">
                        <p>¿Está seguro de que desea eliminar la materia?</p>
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
            $('#assignments').DataTable();
        });
        $(document).ready(function() {
            $(document).on('click', '.deleteAssignment', function(e) {
                e.preventDefault();
                var id = $(this).data('value');
                $('#assignmentId').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
    <script></script>
@endsection
