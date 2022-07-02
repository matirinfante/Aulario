<div class="modal fade" id="createModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <!-- Trae variable usuario basado en la sesion -->

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Cabezera del modal -->
                <h3 class="modal-title" id="exampleModalLabel">Crear Petición</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div id="container">
                    <form id="create_petition" name="create_petition" method="POST"
                          action="{{route('petitions.store')}}">
                        <!-- Token y metodo -->
                        @csrf @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{{$user->name}} {{$user->surname}}" disabled>
                            <p class="alerta d-none" id="errorNameCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <!-- Usuario ID -->
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$user->id}}">
                        </div>
                        <div class="mb-3">
                            <!-- Select Materias -->
                            <label for="assignment_id" class="form-label">Materia</label>
                            <select name="assignment_id" class="form-select select2-user" aria-label="Materia"
                                    style="width: 100%" required>
                                <option value="-1" disabled></option>
                                @foreach (auth()->user()->assignments as $assignment)
                                    <option value="{{ $assignment->id }}">
                                        {{ $assignment->assignment_name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="alerta d-none" id="errorAssignmentIDCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="estimated_people" class="form-label" required>Cantidad alumnos</label>
                            <input type="text" class="form-control" name="estimated_people" id="estimated_people">
                        </div>
                        <div class="mb-3">
                            <!-- Select Aulas -->
                            <label for="classroom_type" class="form-label">Tipo Aula</label>
                            <select name="classroom_type" id="classroom_type" class="form-select select2-user"
                                    aria-label="Materia" style="width: 100%" required>
                                <option value="Aula Común" selected>Aula Común</option>
                                <option value="Laboratorio">Laboratorio</option>
                            </select>
                            <p class="alerta d-none" id="errorClassroomTypeCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required>
                            <p class="alerta d-none" id="errorStartDateCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="finish_date" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" name="finish_date" id="finish_date" required>
                            <p class="alerta d-none" id="errorFinishDateCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" name="start_time" id="start_time" required>
                            <p class="alerta d-none" id="errorStartTimeCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="finish_time" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" name="finish_time" id="finish_time" required>
                            <p class="alerta d-none" id="errorFinishTimeCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <!-- Select Dias -->
                            <label for="days" class="form-label">Día</label>
                            <select name="days" id="days" class="form-select select2-user" aria-label="days"
                                    style="width: 100%" required>
                                <option value="Lunes" selected>Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                            <p class="alerta d-none" id="errorDaysCreate">Error</p>
                        </div>
                        <div class="mb-3">
                            <!-- El mensaje obligatorio de justificacion para un rechazo -->
                            <label for="message" class="form-label">Mensaje</label>
                            <input type="text" class="form-control" name="message" id="message">
                            <p class="alerta d-none" id="errorMessageCreate">Error</p>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 