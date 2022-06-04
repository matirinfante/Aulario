@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <div class="card" style="width: 1000px; margin: auto;">
        <div class="card-body">
            <table class="table table-striped table-hover" id="users">
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
                            <a class="link-primary"
                               href="{{route('users.show', $user['id'])}}"
                            >Ver</a>
                            <a class="link-success"
                               href=" {{route('users.edit', $user['id'])}}"
                            >Editar</a>
                            <a class="link-danger buttonDelete" href="">Borrar</a>
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

    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form_user_delete" name="form_user_delete" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminación de Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="user_id" id="userId">
                        <p>¿Está seguro de que desea eliminar al usuario?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
            $(document).on('click', '.buttonDelete', function (e) {
                e.preventDefault();
                var id = $(this).data('value');
                $('#userId').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection


