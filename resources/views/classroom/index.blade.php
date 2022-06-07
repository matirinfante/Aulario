@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <h3 class="text-center m-4">Listado de Aulas</h3>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="classroom">
                <button type="" class="btn btn-success m-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"
                    id="buttonCreate">Crear Aula</button>
                <thead class="bg-secondary text-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Locación</td>
                        <td>Edificio</td>
                        <td>Hora Inicio</td>
                        <td>Hora Fin</td>
                        <td>Estado</td>
                        <td>Acción</td>
                        <td>H/D</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classrooms as $class)
                        <tr>
                            <td> {{ $class->classroom_name }} </td>
                            <td>{{ $class->location }}</td>
                            <td>{{ $class->building }}</td>
                            <td>{{ $class->available_start }}</td>
                            <td>{{ $class->available_finish }}</td>
                            <td class="text-secondary" data-statusSvg="{{ $class->id }}">
                                @if (!isset($class->deleted_at))
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
                            <td>
                                {{-- view modal button --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $class->id }}">Ver</button>

                                {{-- view modal --}}
                                <div class="modal fade" id="viewModal{{ $class->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Datos del aula</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="card-title"><span
                                                        class="text-secondary">Nombre:<br><br></span>
                                                    {{ $class->classroom_name }}</h5>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Locación:</span>
                                                    {{ $class->location }}
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Edificio:</span>
                                                    {{ $class->building }}
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Capacidad:</span>
                                                    {{ $class->capacity }}
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Tipo de aula:</span>
                                                    {{ $class->type }}
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Hora de
                                                        inicio:</span>
                                                    @if (isset($class->available_start))
                                                        {{ date('h:i:s', strtotime($class->available_start)) }}
                                                    @else
                                                        No disponible
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Hora de fin:</span>
                                                    @if (isset($class->available_finish))
                                                        {{ date('h:i:s', strtotime($class->available_finish)) }}
                                                    @else
                                                        No disponible
                                                    @endif
                                                </p>
                                                <hr>
                                                {{-- <p class="card-text"><span class="text-secondary">Estado:
                                                    </span>
                                                    @if (!isset($assignment->deleted_at))
                                                        Habilitada
                                                    @else
                                                        Deshabilitada
                                                    @endif
                                                </p> --}}
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Creación:
                                                    </span>
                                                    @if (isset($class->created_at))
                                                        {{ date('d-m-Y | h:i:s', strtotime($class->created_at)) }}
                                                    @else
                                                        No disponible
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text"><span class="text-secondary">Última modificación:
                                                    </span>
                                                    @if (isset($class->updated_at))
                                                        {{ date('d-m-Y | h:i:s', strtotime($class->updated_at)) }}
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
                                    data-bs-target="#updateModal{{ $class->id }}">Editar</button>

                                {{-- update modal --}}
                                <div class="modal fade updateModal" id="updateModal{{ $class->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Actualizar aula</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form_classroom" name="form_classroom" method="POST"
                                                    action="{{ route('classrooms.store') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="classroom_name" class="form-label">Nombre del
                                                            aula</label>
                                                        <input type="text" class="form-control" name="classroom_name"
                                                            id="classroom_name" value="{{ $class->classroom_name }}">
                                                        <p class="alerta d-none" id="errorClassroomName">Error</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location" class="form-label">Locación en
                                                            facultad</label>
                                                        <input type="text" class="form-control" name="location"
                                                            id="location" value="{{ $class->location }}">
                                                        <p class="alerta d-none" id="errorLocation">Error</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="building" class="form-label">Edificio</label>
                                                        <select name="building_type" id="building_type"
                                                            class="form-select" style="width: 100%">
                                                            <option value="-1" disabled selected></option>
                                                            @foreach ($buildings as $building)
                                                                <option value="{{ $building }}">{{ $building }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="alerta d-none" id="errorBuilding">Error</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="capacity" class="form-label">Capacidad</label>
                                                        <input type="number" class="form-control" name="capacity"
                                                            id="capacity" min="5" max="200" value="{{ $class->capacity }}">
                                                        <p class="alerta d-none" id="errorCapacity">Error</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Tipo de aula</label>
                                                        <select name="classroom_type" id="classroom_type"
                                                            class="form-select" style="width: 100%">
                                                            <option value="-1" disabled selected></option>
                                                            @foreach ($types as $type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="alerta d-none" id="errorType">Error</p>
                                                    </div>
                                                    <div class="container mb-3">
                                                        <div class="row">
                                                            <label for="available_time" class="form-label">Horario
                                                                disponible</label>
                                                            <div class="col-6">
                                                                <label>Horario inicio</label>
                                                                <input type="time" class="form-control"
                                                                    name="available_start" id="available_start"
                                                                    style="width: 100%">
                                                            </div>
                                                            <div class="col-6">
                                                                <label>Horario fin</label>
                                                                <input type="time" class="form-control"
                                                                    name="available_finish" id="available_finish"
                                                                    style="width: 100%">
                                                            </div>
                                                            <p class="alerta d-none" id="errorAvailabilitySchedule">Error
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <button id="submit" type="submit"
                                                        class="btn btn-primary">Actualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <a class="link-danger buttonDelete" href="">Borrar</a> --}}
                            <td>
                                <div class="form-check form-switch">
                                    <input data-id="{{ $class->id }}" data-token="{{ csrf_token() }}"
                                        class="form-check-input activeSwitch" type="checkbox" role="switch"
                                        {{ !$class->trashed() ? 'checked' : '' }}>
                                </div>
                            </td>
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
    @if (isset($classrooms))
        <div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Aula</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_classroom" name="form_classroom" method="POST"
                            action="{{ route('classrooms.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="classroom_name" class="form-label">Nombre del aula</label>
                                <input type="text" class="form-control" name="classroom_name" id="classroom_name"
                                    placeholder="I7">
                                <p class="alerta d-none" id="errorClassroomName">Error</p>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Locación en facultad</label>
                                <input type="text" class="form-control" name="location" id="location"
                                    placeholder="Planta Alta">
                                <p class="alerta d-none" id="errorLocation">Error</p>
                            </div>
                            <div class="mb-3">
                                <label for="building" class="form-label">Edificio</label>
                                <select name="building_type" id="building_type" class="form-select" style="width: 100%">
                                    <option value="-1" disabled></option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building }}">{{ $building }}</option>
                                    @endforeach
                                </select>
                                <p class="alerta d-none" id="errorBuilding">Error</p>
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacidad</label>
                                <input type="number" class="form-control" name="capacity" id="capacity" min="5" max="200"
                                    placeholder="30">
                                <p class="alerta d-none" id="errorCapacity">Error</p>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo de aula</label>
                                <select name="classroom_type" id="classroom_type" class="form-select"
                                    style="width: 100%">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                <p class="alerta d-none" id="errorType">Error</p>
                            </div>
                            <div class="container mb-3">
                                <div class="row">
                                    <label for="available_time" class="form-label">Horario disponible</label>
                                    <div class="col-6">
                                        <label>Horario inicio</label>
                                        <input type="time" class="form-control" name="available_start"
                                            id="available_start" style="width: 100%">
                                    </div>
                                    <div class="col-6">
                                        <label>Horario fin</label>
                                        <input type="time" class="form-control" name="available_finish"
                                            id="available_finish" style="width: 100%">
                                    </div>
                                    <p class="alerta d-none" id="errorAvailabilitySchedule">Error</p>
                                </div>
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="modal" id="deleteModal" tabindex="-1">
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
    </div> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#classroom').DataTable();
            // $(document).on('click', '.buttonDelete', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('value');
            //     $('#classroomId').val(id);
            //     $('#deleteModal').modal('show');
            // });
        });

        $('.activeSwitch').change(function(e) {
            var $id = $(this).data('id');
            var status = $(this).prop('checked') == true ? 1 : 0;
            console.log($id);
            console.log(status);

            if (status == 0) { // deshabilitar aula
                var url = '{{ route('classrooms.destroy', ':id') }}';
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
                        var $elementSvg = $("td[data-statusSvg='" + $id + "']");
                        // console.log($elementSvg[0]);
                        $elementSvg.replaceWith('<td class="text-secondary" data-statussvg="' + $id +
                            '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9b0808" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" /></svg></td>'
                        );

                        $('#flashMessage').html(
                                '<div class="alert alert-success">deshabilitado</div>')
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
                                html: 'Aula deshabilitada con éxito.',
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
            }
        });
    </script>
@endsection
