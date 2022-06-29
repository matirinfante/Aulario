<div class="modal fade createModal" id="createModal" position="relative" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_classroom_create" name="classroom_form" method="POST" action="{{ route('classrooms.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="classroom_name" class="form-label">Nombre del aula</label>
                        <input type="text" class="form-control" name="classroom_name" id="classroom_name_create" placeholder="I7">
                        <p class="alerta d-none" id="errorClassroomNameCreate">Error</p>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="location" class="form-label">Locación en facultad</label>
                        <input type="text" class="form-control" name="location" id="location_create" placeholder="Planta Alta">
                        <p class="alerta d-none" id="errorLocationCreate">Error</p>
                    </div> -->
                    <div class="mb-3">
                        <label for="building" class="form-label">Edificio</label>
                        <select name="building" class="form-select select2-building" style="width: 100%;">
                            @foreach ($buildings as $building)
                            @if ($building == 'Informatica')
                            <option value="{{ $building }}" selected>{{ $building }}</option>
                            @else
                            <option value="{{ $building }}">{{ $building }}</option>
                            @endif
                            @endforeach
                        </select>
                        <p class="alerta d-none" id="errorBuilding">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" name="capacity" id="capacity_create" min="1" max="200" placeholder="30">
                        <p class="alerta d-none" id="errorCapacityCreate">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de aula</label>
                        <select name="type" class="form-select select2-type" style="width: 100%;">
                            @foreach ($types as $type)
                            @if ($type == 'Aula Común')
                            <option value="{{ $type }}">{{ $type }}</option>
                            @else
                            <option value="{{ $type }}" selected>{{ $type }}</option>
                            @endif
                            @endforeach
                        </select>
                        <p class="alerta d-none" id="errorType">Error</p>
                    </div>
                    <div>
                        <label for="location" class="form-label">Locación (ingrese una foto o imagen del croqui)</label>
                        <br>
                        <input type="file" name="location" id="location" class="form-control">
                        <p class="alerta d-none" id="errorLocationCreate">Error</p>
                    </div>
                    <br>
                    <button id="submit_create" type="submit" class="btn btn-primary disabled">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>