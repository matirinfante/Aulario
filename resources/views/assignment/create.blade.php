<div class="modal fade createModal" id="createModal" position="relative" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createAssignmentForm" name="form_assignment" method="POST"
                        action="{{ route('assignments.store') }}">
                        @csrf
                        {{-- nombre materia --}}
                        <div class="mb-3">
                            <label for="assignment_name" class="form-label">Nombre de materia</label>
                            <input type="text" class="form-control" name="assignment_name" id="createName"
                                placeholder="Programación Web Avanzada" required>
                            <small id="errorCreateAssignmentName"></small>
                        </div>

                        {{-- fecha inicio --}}
                        <div class="mb-3 col-md-4">
                            <label for="start_date" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" name="start_date" id="createStartDate" required>
                            <small id="errorCreateAssignmentStartDate"></small>
                        </div>

                        {{-- fecha fin --}}
                        <div class="mb-3 col-md-4">
                            <label for="finish_date" class="form-label">Fecha fin</label>
                            <input type="date" class="form-control" name="finish_date" id="createFinishDate" required>
                            <small id="errorCreateAssignmentFinishDate"></small>
                        </div>

                        {{-- profesores --}}
                        <div class="mb-3 col-md-6">
                            <label for="nameTeacher" class="form-label">Profesor/a asignado</label>
                            <select name="user_id[]" class="form-select select2-user" multiple="multiple"
                                aria-label="Profesor/a" style="width: 100%;">
                                <option value="-1" disabled></option>
                                @foreach ($users as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }},
                                        {{ $teacher->surname }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="errorCreateNameTeacher"></small>
                        </div>
                        <button id="createSubmit" type="submit" class="btn btn-primary disabled">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>