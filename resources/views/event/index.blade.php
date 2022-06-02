@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center m-4">Bienvenido a la página principal de Eventos</h3>
        {{-- <table class='table align-middle'>
            <thead class='table-dark'>
                <tr class='align-middle'>
                    <th scope='col' class='text-center'>Nombre</th>
                    <th scope='col' class='text-center'>Locacion</th>
                    <th scope='col' class='text-center'>Capacidad</th>
                    <th scope='col' class='text-center'>Tipo de Aula</th>
                    <th scope='col' class='text-center'></th>
                    <th scope='col' class='text-center'></th>
                </tr>
            </thead>
            <tbody>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">
                    <button class='btn btn-warning btn-sm' type='submit' role='button'><i
                            class='bi bi-pencil-square'></i>&nbsp;Editar</button>
                </td>
                <td class="text-center">
                    <button class='btn btn-danger btn-sm' type='submit' role='button'><i
                            class='bi bi-trash'></i>&nbsp;Eliminar</button>
                </td>
            </tbody>
        </table> --}}
        <div class="card m-auto mt-3" style="width: 1000px;">
            <div class="card-body">
                <table class="table table-striped table-hover" id="assignments">
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Locacion</th>
                            <th scope='col' class='text-center'>Capacidad</th>
                            <th scope='col' class='text-center'>Tipo de Aula</th>
                            <th scope='col' class='text-center'></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse () --}}
                            <tr>
                                <td class="text-center">

                                </td>
                                <td class="text-center">

                                </td>
                                <td class="text-center">

                                </td>
                                <td class="text-center">

                                </td>
                                <td>
                                    <a href="#" class="link-primary">Ver</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#" class="link-success">Editar</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#" class="link-danger">Borrar</a>
                                </td>
                            </tr>
                        {{-- @empty
                            <td colspan="3" class="text-center text-secondary">No hay registros</td>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#assignments').DataTable();
            });
        </script>
    </div>
@endsection
