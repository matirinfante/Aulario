<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ver Usuario</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h3 class="text-center m-4">Detalles del Usuario</h3>
          <div class="card m-auto mt-3">
              <div class="card-body text-center">
                  <div class="card-body" id="modal_body_user_see">
                      <h5 class="card-title">Usuario: ${user['name']} </h5>
                      <ul class="list-group list-group-flush">
                          <li class="list-group-item">Apellido: ${user['surname']} </li>
                          <li class="list-group-item">Dni: ${user['dni']} </li>
                          <li class="list-group-item">Email: ${user['email']}</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">

      </div>
  </div>
</div>

    
