@extends('layouts.app')

@section('content')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .createModal,
        .updateModal {
            z-index: 1051;
        }
    </style>
@endsection

{{-- Mensaje del controlador al realizar acción --}}
<div id="flashMessage" class="text-center d-none">
    @include('flash::message')
</div>

<h3 class="text-center m-4">Listado de Materias</h3>

<p class="text-center">Estados: <br>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08" class="bi bi-check-circle"
        viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path
            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
    </svg>
    = Habilitado(H)&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle"
        viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
    </svg>
    = Deshabilitado(D)
</p>

<div class="card m-auto mt-3" style="width: 1000px;">
    <div class="card-body">
        <table class="table table-striped table-hover" id="assignments">
            <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                id="buttonCreate">Crear Materia</button>
            <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre de la materia</td>
                    <td>Profesor/a</td>
                    <td>Cursada</td>
                    <td>Estado</td>
                    <td class="text-center">Acción</td>
                    <td>Cuatrimestre</td>
                    <td>D/H</td>
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
                        <td>
                            @if ($assignment->active == 1)
                                En curso
                            @else
                                Inactiva
                            @endif
                        </td>
                        <td class="text-secondary" data-statusSvg="{{ $assignment->id }}">
                            @if (!isset($assignment->deleted_at))
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
                            {{-- view modal button --}}
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $assignment->id }}">Ver</button>

                            {{-- view modal --}}
                            <div class="modal fade" id="viewModal{{ $assignment->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Datos de la materia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title"><span
                                                    class="text-secondary">Nombre:<br><br></span>
                                                {{ $assignment->assignment_name }}</h5>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Cursada:</span>
                                                @if ($assignment->active == 1)
                                                    En curso
                                                @else
                                                    Inactiva
                                                @endif
                                            </p>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Fecha de
                                                    inicio:</span>
                                                @if (isset($assignment->start_date))
                                                    {{ date('d-m-Y', strtotime($assignment->start_date)) }}
                                                @else
                                                    No disponible
                                                @endif
                                            </p>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Fecha de fin:</span>
                                                @if (isset($assignment->finish_date))
                                                    {{ date('d-m-Y', strtotime($assignment->finish_date)) }}
                                                @else
                                                    No disponible
                                                @endif
                                            </p>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Estado:
                                                </span>
                                                @if (!isset($assignment->deleted_at))
                                                    Habilitada
                                                @else
                                                    Deshabilitada
                                                @endif
                                            </p>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Creación:
                                                </span>
                                                @if (isset($assignment->created_at))
                                                    {{ date('d-m-Y | h:i:s', strtotime($assignment->created_at)) }}
                                                @else
                                                    No disponible
                                                @endif
                                            </p>
                                            <hr>
                                            <p class="card-text"><span class="text-secondary">Última modificación:
                                                </span>
                                                @if (isset($assignment->updated_at))
                                                    {{ date('d-m-Y | h:i:s', strtotime($assignment->updated_at)) }}
                                                @else
                                                    No disponible
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- update modal button --}}
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateModal{{ $assignment->id }}">Editar</button>

                            {{-- update modal --}}
                            <div class="modal fade updateModal" id="updateModal{{ $assignment->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar materia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="form_assignment" method="POST"
                                                action="{{ route('assignments.update', $assignment->id) }}">
                                                @csrf @method('PATCH')
                                                <div class="mb-3">
                                                    <label for="assignment_name" class="form-label">Nombre de
                                                        materia</label>
                                                    <input type="text" class="form-control" name="assignment_name"
                                                        value="{{ $assignment->assignment_name }}" required>
                                                    <small id="errorAssignmentName"></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nameTeacher" class="form-label">Profesor/a
                                                        asignado</label>
                                                    <select name="user_id" class="form-select select2-user"
                                                        multiple="multiple" aria-label="Profesor/a" style="width: 100%">
                                                        <option value="-1" disabled></option>
                                                        @foreach ($assignment->users as $teacher)
                                                            <option value="{{ $teacher->id }}">
                                                                {{ $teacher->name }}, {{ $teacher->surname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small id="errorNameTeacher"></small>
                                                </div>
                                                <button id="submit" type="submit"
                                                    class="btn btn-primary">Actualizar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                        <td>
                            {{-- Cambiar Cuatrimestre de materia --}}
                            <form method="POST" class="form-delete d-inline"
                                action="">
                                @method('PUT')
                                @csrf
                                <button data-assignment="{{ $assignment->id }}" type="submit"
                                    class="btn btn-outline-secondary btn-sm">Cambiar</button>

                            </form>
                        </td>
                        <td>
                            {{-- Habilitar/Deshabilitar materia (botón switch) --}}
                            <div class="form-check form-switch">
                                <input data-id="{{ $assignment->id }}" data-token="{{ csrf_token() }}"
                                    class="form-check-input activeSwitch" type="checkbox" role="switch"
                                    {{ !$assignment->trashed() ? 'checked' : '' }}>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="text-center text-secondary">No hay registros</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Crear-->
@if (isset($assignment))
    <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form_assignment" method="POST" action="{{ route('assignments.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="assignment_name" class="form-label">Nombre de materia</label>
                            <input type="text" class="form-control" name="assignment_name"
                                placeholder="Programación Web Avanzada" required>
                            <small id="errorAssignmentName"></small>
                        </div>
                        <div class="mb-3">
                            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
                            <select name="user_id" class="form-select select2-user" multiple="multiple"
                                aria-label="Profesor/a" style="width: 100%;">
                                <option value="-1" disabled></option>
                                @foreach ($users as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }},
                                        {{ $teacher->surname }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="errorNameTeacher"></small>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif



@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

{{-- DataTable SCRIPT --}}
<script>
    $(document).ready(function() {
        $('#assignments').DataTable();
    });
</script>


{{-- Habilitar/Deshabilitar una materia --}}
<script>
    $('.activeSwitch').change(function(e) {
        var $id = $(this).data('id');
        var status = $(this).prop('checked') == true ? 1 : 0;

        if (status == 0) { // deshabilitar materia
            var url = '{{ route('assignments.destroy', ':id') }}';
            url = url.replace(':id', $id);
            var token = $(this).data("token");
            $.ajax({
                type: 'post',
                url: url,
                cache: false,
                data: {
                    "id": $id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function(data) {
                    console.log('entra DELETE');
                    console.log(data);
                    var $elementSvg = $("td[data-statusSvg='" + $id + "']");
                    $elementSvg.replaceWith('<td class="text-secondary" data-statussvg="' + $id +
                        '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" /></svg></td>'
                    );

                    $('#flashMessage').html(
                            '<div class="alert alert-success">Materia eliminada con éxito</div>')
                        .delay(1000);
                    var flash = $('#flashMessage');
                    if (flash.find('.alert.alert-success').length > 0) {
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia deshabilitada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                    }
                }

            });
        } else {
            // habilitar materia...
            var url = '{{ route('assignments.activate', ':id') }}';
            url = url.replace(':id', $id);
            var token = $(this).data("token");
            $.ajax({
                type: 'POST',
                url: url,
                cache: false,
                data: {
                    "id": $id,
                    "_method": 'PUT',
                    "_token": token
                },
                success: function(data) {
                    // console.log('entra PUT');
                    // console.log(data);
                    var $elementSvg = $("td[data-statusSvg='" + $id + "']");
                    $elementSvg.replaceWith('<td class="text-secondary" data-statussvg="' + $id +
                        '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1f9b08" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" /></svg></td>'
                    );

                    $('#flashMessage').html(
                            '<div class="alert alert-success">Materia habilitada correctamente</div>')
                        .delay(1000);
                    var flash = $('#flashMessage');
                    if (flash.find('.alert.alert-success').length > 0) {
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia habilitada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                    }
                }

            });
        }
    });
</script>



{{-- script para utilizar select2 --}}
<script>
    $('.select2-user').select2({
        placeholder: {
            allowClear: true,
            text: 'Seleccione el profesor asignado'
        },
        language: {

            noResults: function() {

                return "No hay resultado";
            },
            searching: function() {

                return "Buscando..";
            }
        }
    });
</script>


<script>

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
                    // case 'Materia eliminada con éxito':
                    //     var timerInterval
                    //     Swal.fire({
                    //         toast: true,
                    //         position: 'bottom-end',
                    //         background: '#a5dc86',
                    //         color: '#000',
                    //         showConfirmButton: false,
                    //         html: 'Estado de materia cambiado con éxito.',
                    //         timer: 2000,
                    //         timerProgressBar: true,
                    //         willClose: () => {
                    //             clearInterval(timerInterval)
                    //         }
                    //     })
                    //     break;
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
