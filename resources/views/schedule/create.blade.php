<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_schedule_create" method="POST" action="{{route('schedules.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Aulas</label>
                        <select class="form-select" name="classroom_id">
                            @forelse ($classrooms as $classroom)
                                <option value="{{$classroom['id']}}"> {{$classroom['classroom_name']}} </option>
                                {{-- <option value="{{$classroom['id']}}"> {{$classroom['classroom_name']}} </option> --}}
                            @empty
                                <option value=""> No hay registro</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Dia</label>
                            <select class="form-select" name="day">
                                <option value="Lunes" selected> Lunes</option>
                                <option value="Martes"> Martes</option>
                                <option value="Miercoles"> Miercoles</option>
                                <option value="Jueves"> Jueves</option>
                                <option value="Viernes"> Viernes</option>
                                <option value="Sábado"> Sábado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Hora Inicio:</label>
                            <input class="form-control" type="time" name="start_time" id="start_time">
                            <p class="alerta d-none" id="errorStart">Error</p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Hora Final:</label>
                            <input class="form-control" type="time" name="finish_time" id="finish_time">
                            <p class="alerta d-none" id="errorFinish">Error</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="create_schedule_submit" type="submit" class="btn btn-primary disabled">Crear Horario</button>
                </form>
            </div>
        </div>
    </div>
</div>
