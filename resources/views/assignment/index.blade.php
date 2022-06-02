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
                            <td>{{ $assignment['assignment_name'] }} </td>
                            <td>{{ $assignment['user_id'] }}</td>
                            <!-- El nombre del usuario (referencia con clave foránea) -->
                            <td>
                                <a href="{{ url('assignments/' . $assignment->id) }}" class="link-primary">Ver</a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="link-success">Editar</a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="link-danger">Borrar</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3" class="text-center text-secondary">No hay registros</td>
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
        $(document).ready(function() {
            $('#assignments').DataTable();
        });
    </script>
@endsection
