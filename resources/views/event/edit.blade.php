<div class="modal fade updateModal" id="updateModal{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_event" method="POST" action="{{ route('events.update', $event->id) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Nombre
                            Evento</label>
                        <input type="text" class="form-control" id="event_name" name="event_name"
                            value="{{ $event->event_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="participants" class="form-label">Participantes</label>
                        <input type="number" class="form-control" id="participants" name="participants"
                            value="{{ $event->participants }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="submit" type="submit" class="btn btn-primary">Actualizar
                    Evento</button>
                </form>
            </div>
        </div>
    </div>
</div>
