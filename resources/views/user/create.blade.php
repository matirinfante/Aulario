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
                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top" title="La contraseña debe contener al menos 5 caracteres">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#d99949" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"></path>
                            </svg>
                        </button>
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