<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('users.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="user_name" placeholder="Robert">
                        <p class="alerta d-none" id="errorName">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="surname" id="user_surname" placeholder="Kiyosaki">
                        <p class="alerta d-none" id="errorSurname">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="number" class="form-control" name="dni" id="user_dni" min="1000000" max="99999999" placeholder="39504700">
                        <p class="alerta d-none" id="errorDni">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="user_email" placeholder="robert@kiyosaki.com">
                        <p class="alerta d-none" id="errorEmail">Error</p>
                    </div>
                    <div class="mb-3">
                        <label for="select" class="form-label">Seleccione Rol</label>
                        <select class="form-select" name="role">
                            <option value="teacher"  selected> Profesor </option>
                            <option value="bedel"> Bedel </option>
                            <option value="user"> Usuario </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="user_password">
                        <p class="alerta d-none" id="errorPassword">Error</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="create_submit" type="submit" class="btn btn-primary disabled">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>