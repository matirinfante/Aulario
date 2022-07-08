@extends('layouts.app')

@section('styles')
    <style>
        /* estilo para boton de descarga (pdf) */
        button.btn.btn-secondary.buttons-pdf.buttons-html5 {
            margin-left: 16px;
            max-width: 70px;
            padding: 0.25rem 0.5rem;
            font-size: 0.7875rem;
            border-radius: 0.2rem;
            background-color: #fff;
            color: #6c757d;
            border-color: #6c757d;
        }

        button.btn.btn-secondary.buttons-pdf.buttons-html5:hover {
            background-color: #6c757d;
            color: #fff;
            border-color: #fff;
        }

        /* estilo para boton de descarga (csv) */
        button.btn.btn-secondary.buttons-csv.buttons-html5 {
            margin-left: 10px;
            max-width: 70px;
            padding: 0.25rem 0.5rem;
            font-size: 0.7875rem;
            border-radius: 0.2rem;
            background-color: #fff;
            color: #6c757d;
            border-color: #6c757d;
        }

        button.btn.btn-secondary.buttons-csv.buttons-html5:hover {
            background-color: #6c757d;
            color: #fff;
            border-color: #fff;
        }

        /* estilos para botones firma, editar, token*/
        .btn-outline-secondary {
            border: none;
        }
    </style>
@endsection

@section('content')
    <h3 class="text-center m-4">Historial - Libro de entrada</h3>

    <div class="card mt-3 w-50 m-auto">
        <div class="card-body text-center">
            <label for="date">Seleccione una fecha</label><br>
            <input type="date" name="date" id="date">
        </div>
    </div>

    <div class="card mt-3 m-auto d-none" style="width: 1000px;">
        <div class="card-body text-center" id="tablaHistorial">


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#date').on('change', function() {

            $('#tablaHistorial').empty();
            var fecha = $(this).val();
            $.ajax({
                type: "POST",
                url: `/logbooks/getlogbook`,
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    date: fecha
                },
                success: function(array) {
                    $('.card').removeClass('d-none');
                    var tabla = `<table class="table table-striped table-hover" id="logbooksHistory">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Aula</th>
                                <th>Usuario</th>
                                <th>Hora ingreso</th>
                                <th>Hora salida</th>
                                <th>Observación</th>
                                </tr>
                        </thead>
                    <tbody>`;

                    if (array.length > 0) {
                        // si existen datos, recorrerlos y armar los td de la tabla
                        array.forEach(logbook => {
                            var arrayDate = logbook['date'].split('-');
                            var anio = arrayDate[0];
                            var mes = arrayDate[1];
                            var dia = arrayDate[2];
                            fecha = dia + '/' + mes + '/' + anio;

                            tabla += `<tr>`;

                            tabla += `<td style="word-wrap: break-word; word-break: break-all; white-space: normal;">
                                ${logbook['name']}</td>`; // nombre

                            tabla += `<td>${fecha}</td>`; // fecha

                            if(logbook['classroom_name'] != null){
                                tabla += `<td>${logbook['classroom_name']}</td>`; // aula
                            }else{
                                tabla += `<td class="text-secondary">No disp</td>`;
                            }

                            if(logbook['user_name'] != null){
                                tabla += `<td>${logbook['user_name']}</td>`; // usuario(nombre)
                            }else{
                                tabla += `<td class="text-secondary">No disp</td>`;
                            }

                            if (logbook['check_in'] != null) {
                                tabla += `<td>${logbook['check_in']}</td>`; // hora ingreso
                            } else {
                                tabla += `<td>No disp</td>`;
                            }

                            if (logbook['check_out'] != null) {
                                tabla += `<td>${logbook['check_out']}</td>`; // hora salida
                            } else {
                                tabla += `<td>No disp</td>`;
                            }

                            if (logbook['commentary'] != null) {
                                tabla += `<td>${logbook['commentary']}</td>`; // observaciones
                            } else {
                                tabla += `<td>No disp</td>`;
                            }
                            tabla += `</tr>`;
                        });
                    } else {
                        // si no existen datos, mostrar un td con mensaje 'no hay registros'
                        tabla +=
                            `<td colspan="7" class="text-center text-secondary">No hay registros</td>`;
                    }
                    tabla += `</tbody></table>`;
                    $('#tablaHistorial').append(tabla);
                    historialLogbook();
                }
            });
        })
    </script>
@endsection
