@extends('layouts.app')

@section('content')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

<div id="flashMessage" class="text-center d-none">
    @include('flash::message')
</div>
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

                            <form method="POST" class="form-delete d-inline"
                                action="{{ route('assignments.destroy', $assignment->assignment_id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link link-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="3" class="text-center text-secondary">No hay registros</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#assignments').DataTable();
    });
</script>


<script>
    $('.form-delete').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de que desea eliminar la materia?',
            text: "Esta acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#b02a37',
            cancelButtonColor: '#0a58ca',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });


    $(document).ready(function() {
        var flash = $('#flashMessage');
        if (flash.find('.alert.alert-success').length > 0) {
            var contentFlash = $("#flashMessage:first").text().trim();
            switch (contentFlash) {
                // CREACION DE MATERIA
                case 'La materia se ha cargado exitosamente':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#a5dc86',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Materia creada con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                    break;
                // MODIFICACION DE MATERIA
                case 'Materia modificada con éxito':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#a5dc86',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Materia modificada con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                    break;
                // ELIMINACION DE MATERIA
                case 'Materia eliminada con éxito':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#a5dc86',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Materia eliminada con éxito.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                break;
                // ERROR CREACION DE MATERIA
                case 'Ha ocurrido un error al añadir la materia':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#f27474',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Error al crear materia.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                break;
                // ERROR MODIFICACION DE MATERIA
                case 'Ha ocurrido un error al actualizar la materia':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#f27474',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Error al modificar materia.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                break;
                // ERROR MODIFICACION DE MATERIA
                case 'Ha ocurrido un error al eliminar la materia':
                    var timerInterval
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        background: '#f27474',
                        color: '#000',
                        showConfirmButton: false,
                        html: 'Error al eliminar materia.',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                break;
            }
        }
    });
</script>
@endsection
