<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" class="" method="POST" action="{{ route('events.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Nombre Evento</label>
                        <input type="text" class="form-control" id="event_name" name="event_name"
                            placeholder="Parcial PWA">
                    </div>
                    <div class="mb-3">
                        <label for="participants" class="form-label">Participantes</label>
                        <input type="number" class="form-control" id="participants" name="participants"
                            placeholder="50">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

