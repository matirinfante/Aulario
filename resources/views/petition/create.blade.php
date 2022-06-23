<div class="modal fade" id="createModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @php
    $assignments = $user->assignments()->get();
    @endphp
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Crear Petición</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="container">
                    <form id="create_petition" name="create_petition" method="POST" action="{{route('petitions.store')}}">
                        @csrf @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}} {{$user->surname}}" disabled>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{$user->id}}">
                        </div>
                        <div class="mb-3">
                            <label for="assignment_id" class="form-label">Materia</label>
                            <select name="assignment_id" class="form-select select2-user" aria-label="Materia" style="width: 100%">
                                <option value="-1" disabled></option>
                                @foreach ($assignments as $assignment)
                                <option value="{{ $assignment->id }}">
                                    {{ $assignment->assignment_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estimated_people" class="form-label">Cantidad alumnos</label>
                            <input type="text" class="form-control" name="estimated_people" id="estimated_people">
                        </div>
                        <div class="mb-3">
                            <label for="classroom_type" class="form-label">Tipo Aula</label>
                            <select name="classroom_type" id="classroom_type" class="form-select select2-user" aria-label="Materia" style="width: 100%">
                                <option value="Aula Común">Aula Común</option>
                                <option value="Laboratorio">Laboratorio</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="finish_date" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" name="finish_date" id="finish_date">
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" name="start_time" id="start_time">
                        </div>
                        <div class="mb-3">
                            <label for="finish_time" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" name="finish_time" id="finish_time">
                        </div>
                        <div class="mb-3">
                            <label for="days" class="form-label">Día</label>
                            <select name="days" id="days" class="form-select select2-user" aria-label="days" style="width: 100%">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <input type="text" class="form-control" name="message" id="message">
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<!-- Obtener la fecha actual para limitar la seleccion en el calendario -->
<Script>
    //Obtiene la fecha actual y luego le da formato 'YYYY-MM-DD'
    //Estos metodos no agregan cero a numero menores a 10, como por ejemplo '5'(mayo), y no 05
    const fullDate = new Date();
    const year = fullDate.getFullYear();
    let month = fullDate.getMonth();
    let day = fullDate.getDate();

    month += 1; //La fecha el metodo .getMonth la trae de 0 a 11, se debe sumar 1;

    if (month < 10){month = '0'+month};
    if (day < 10){day = '0'+day};

    //Concatenamos la fecha en el formato correcto
    const date = year +'-'+month+'-'+day;


    document.getElementById("start_date").setAttribute('min', date);
    document.getElementById("finish_date").setAttribute('min', date);
</Script>




<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/validator@latest/validator.min.js"></script>
<script src="{{ asset('js/petitions/checkDay.js') }}" defer></script>
@endsection