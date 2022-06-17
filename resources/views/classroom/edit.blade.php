<div class="modal fade updateModal" id="updateModal{{ $class->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_classroom_edit" name="form_classroom" method="POST"
                    action="{{ route('classrooms.update', $class->id) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="classroom_name" class="form-label">Nombre del
                            aula</label>
                        <input type="text" class="form-control" name="classroom_name" id="classroom_name_edit"
                            value="{{ $class->classroom_name }}">
                        <p class="alerta d-none" id="errorClassroomNameEdit">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Locación en
                            facultad</label>
                        <input type="text" class="form-control" name="location" id="location_edit"
                            value="{{ $class->location }}">
                        <p class="alerta d-none" id="errorLocationEdit">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="building" class="form-label">Edificio</label>
                        <select name="building" class="form-select select2-building" style="width: 100%;">
                            <option value="-1" disabled selected>Seleccione un edificio</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building }}">{{ $building }}</option>
                            @endforeach
                        </select>
                        <p class="alerta d-none" id="errorBuilding">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" name="capacity" id="capacity_edit" min="1" max="200"
                            value="{{ $class->capacity }}">
                        <p class="alerta d-none" id="errorCapacityEdit">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de aula</label>
                        <select name="type" class="form-select select2-type" style="width: 100%;">
                            <option value="-1" disabled selected>Seleccione un tipo de aula</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <p class="alerta d-none" id="errorType">Error</p>
                    </div>
                    <button id="submit_edit" type="submit" class="btn btn-primary">Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
