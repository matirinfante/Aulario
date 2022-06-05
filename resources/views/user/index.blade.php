@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <h3 class="text-center m-4">Listado de Usuarios</h3>
    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            
            <table class="table table-striped table-hover" id="users">
                <button type="submit" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#createModal" id="buttonCreate">Crear Usuario</button>
                <thead class="bg-secondary text-light">
                <tr>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Dni</td>
                    <td>Email</td>
                    <td>Accion</td>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user['name']}} </td>
                        <td>{{$user['surname']}}</td>
                        <td>{{$user['dni']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>
                            <a class="link-primary" href="{{route('users.show', $user['id'])}}">Ver</a>
                            <a class="link-success" href=" {{route('users.edit', $user['id'])}}">Editar</a>
                            <form method="POST" class="form-delete d-inline">
                                  {{-- action="{{ route('users.destroy', $user->id) }}"> --}}
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link link-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                    <td>No hay registros</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="buttonModalCreate" ></button>
  
  <!-- Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form" class="" method="POST" action="{{route('users.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Robert">
                    <p class="alerta d-none" id="errorName">Error</p>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Kiyosaki">
                    <p class="alerta d-none" id="errorSurname">Error</p>
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">Dni</label>
                    <input type="number" class="form-control" name="dni" id="dni" min="1000000" max="99999999"
                           placeholder="39504700">
                    <p class="alerta d-none" id="errorDni">Error</p>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="robert@kiyosaki.com">
                    <p class="alerta d-none" id="errorEmail">Error</p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <p class="alerta d-none" id="errorPassword">Error</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-primary disabled">Crear</button>
            </form>
        </div>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/validator@latest/validator.min.js"></script>
    <script src="{{ asset('js/validationUserCreate.js') }}" defer></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });

        $('.form-delete').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Está seguro de que desea eliminar la materia?',
                text: "Esta acción es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b02a37',
                cancelButtonColor: '#0a58ca',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });



        $(document).ready(function () {
            var flash = $('#flashMessage');
            if (flash.find('.alert.alert-success').length > 0) {
                var contentFlash = $("#flashMessage:first").text().trim();
                switch (contentFlash) {
                    // CREACION DE MATERIA
                    case 'La materia se ha cargado exitosamente':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia creada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // MODIFICACION DE MATERIA
                    case 'Materia modificada con éxito':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia modificada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ELIMINACION DE MATERIA
                    case 'Materia eliminada con éxito':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#a5dc86',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Materia eliminada con éxito.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR CREACION DE MATERIA
                    case 'Ha ocurrido un error al añadir la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al crear materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR MODIFICACION DE MATERIA
                    case 'Ha ocurrido un error al actualizar la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al modificar materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                    // ERROR MODIFICACION DE MATERIA
                    case 'Ha ocurrido un error al eliminar la materia':
                        var timerInterval
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            background: '#f27474',
                            color: '#000',
                            showConfirmButton: false,
                            html: 'Error al eliminar materia.',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                        break;
                }
            }
        });
    



    </script>
@endsection


