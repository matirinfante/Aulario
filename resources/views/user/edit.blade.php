
<div class="modal fade updateModal" id="updateModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_update" method="post"
                    action="{{ route('users.update', $user->id) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value=" {{$user['name']}} " required>

                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="surname"  value="{{$user['surname']}}" required>

                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="number" class="form-control" name="dni"  min="1000000" max="99999999"
                            value="{{$user['dni']}}" required>

                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"  value="{{$user['email']}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="select" class="form-label">Seleccione Rol</label>
                        <select class="form-select" name="role" required>
                            @if ($user->roles->first()->name == 'teacher')
                                <option value="teacher" selected> Profesor </option>
                                <option value="bedel"> Bedel </option>
                                <option value="user"> Usuario </option>
                            @elseif ($user->roles->first()->name == 'bedel')
                                <option value="teacher"> Profesor </option>
                                <option value="bedel" selected> Bedel </option>
                                <option value="user"> Usuario </option>
                            @else
                                <option value="teacher"> Profesor </option>
                                <option value="bedel"> Bedel </option>
                                <option value="user" selected> Usuario </option>
                            @endif
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
</div>
