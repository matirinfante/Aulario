@extends('layouts.app')

@section('content')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

<div id="flashMessage" class="text-center d-none">
    @include('flash::message')
</div>
<h3 class="text-center m-4">Listado de Materias</h3>
<p class="text-center">Estados: <br><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08"
        class="bi bi-check-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path
            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
    </svg>
    = Habilitado&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808"
        class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
    </svg>
    = Deshabilitado</p>
<div class="card m-auto mt-3" style="width: 1000px;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="assignments">
            <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre de la materia</td>
                    <td>Profesor/a</td>
                    <td>Estado</td>
                    <td class="text-center">Acción</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->assignment_name }} </td>
                        <td>
                            @foreach ($assignment->users as $teacher)
                                <span class="label label-info bg-warning p-1 rounded">{{ $teacher->name }}
                                    {{ $teacher->surname }}</span>
                            @endforeach
                        </td>
                        <td class="text-secondary">
                            @if ($assignment->active == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08"
                                    class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('assignments.show', $assignment->id) }}"
                                class="link-secondary">Ver</a>&nbsp;&nbsp;&nbsp;
                            <a href="{{ route('assignments.edit', $assignment->id, $assignment->assignment_name) }}"
                                class="link-secondary">Editar</a>&nbsp;&nbsp;&nbsp;

                            <form method="POST" class="form-delete d-inline"
                                action="{{ route('assignments.destroy', $assignment->id) }}">
                                @method('DELETE')
                                @csrf
                                <button data-assignment="{{ $assignment->assignment_name }}" type="submit"
                                    class="btn btn-link link-secondary">Cambiar estado</button>
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

<script>
    $(document).ready(function() {
        $('#assignments').DataTable();
    });
</script>


<script>
    $('.form-delete').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de que desea cambiar el estado de la materia ' + $(this).children(
                ':nth-child(3)').data('assignment') + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0a58ca',
            cancelButtonColor: '#b02a37',
            confirmButtonText: 'Cambiar',
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
                        html: 'Estado de materia cambiado con éxito.',
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
                        html: 'Error al cambiar estado de materia.',
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
