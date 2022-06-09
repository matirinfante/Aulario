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
                        <select name="building" id="building" class="form-select" style="width: 100%">
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
                        <select name="type" id="type" class="form-select" style="width: 100%">
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <p class="alerta d-none" id="errorType">Error</p>
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
