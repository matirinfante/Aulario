<div class="modal fade" id="updateModal{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="event_form_update" method="POST" action="{{ route('events.update', $event->id) }}">
                <div class="modal-body">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Nombre Evento</label>
                        <input type="text" class="form-control" id="name_update" name="event_name"
                            value="{{ $event->event_name }}">
                        <p class="alerta d-none" id="errorName_update">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="participants" class="form-label">Participantes</label>
                        <input type="number" class="form-control" id="event_participants_update"
                            name="participants" value="{{ $event->participants }}">
                        <p class="alerta d-none" id="errorParticipants_update">Error</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="submit_button_update" type="submit" class="btn btn-primary">Actualizar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
