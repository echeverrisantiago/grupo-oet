@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Empleados</h3><br>
        @if(Session::has('message'))
        <div class="alert alert-{{session('message')['type']}} alert-dismissible fade show" role="alert">
            {{ session('message')['text'] }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div><br>
        @endif
        <div class="row">
            <div class="col p-0">
                <button class="btn btn-success float-right mb-2" id="workers_registro">
                    <i class="fa fa-plus"></i>
                    Registrar empleado
                </button>
            </div>
        </div>
        <table id="reports" class="table table-striped table-bordered w-100">
            <thead class="thead-dark">
                <tr>
                    <th>Identificación</th>
                    <th>Primer nombre</th>
                    <th>Segundo nombre</th>
                    <th>Apellidos</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workers as $worker)
                <tr>
                    <td>{{ $worker->identification }}</td>
                    <td>{{ $worker->first_name }}</td>
                    <td>{{ $worker->second_name }}</td>
                    <td>{{ $worker->last_name}}</td>
                    <td>
                        <button class="btn btn-info showWorker" aria-hidden data-toggle="tooltip" data-placement="top" title="Editar empleado" data-id="{{ $worker->id }}">
                            <i class="fa fa-edit small" data-id="{{ $worker->id }}"></i>
                        </button>
                        <a href="#" data-toggle="modal" data-target="#confirm-delete">
                            <button class="btn btn-danger deleteReport" aria-hidden data-toggle="tooltip" data-placement="top" title="Eliminar empleado" data-id="{{ $worker->id }}">
                                <i class="fa fa-trash small" data-id="{{ $worker->id }}"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="show-report" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="workers_form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="workers_hidden" name="_method" value="POST">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Identificación <span style="color: red;"> (*)</span></label><br>
                                    <input type="number" id="workers_identification" name="identification" class="form-control w-100" max="9999999999" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Primer nombre <span style="color: red;"> (*)</span></label><br>
                                    <input type="text" id="workers_first_name" name="first_name" class="form-control w-100" required maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Segundo nombre</label><br>
                                    <input type="text" id="workers_second_name" name="second_name" class="form-control w-100" maxlength="45">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Apellidos <span style="color: red;"> (*)</span></label><br>
                                    <input type="text" id="workers_last_name" name="last_name" class="form-control w-100" required maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="plate">Dirección <span style="color: red;"> (*)</span></label>
                            <input type="text" class="form-control" id="workers_address" name="address" required maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="plate">Teléfono <span style="color: red;"> (*)</span></label>
                            <input type="number" class="form-control" id="workers_telephone" name="telephone" required max="99999999999">
                        </div>
                        <div class="form-group">
                            <label for="plate">Ciudad <span style="color: red;"> (*)</span></label>
                            <input type="text" class="form-control" id="workers_city" name="city" required maxlength="45">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="report_save">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>Confirmar</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el empleado?
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="report_form_delete">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="" id="report_delete">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger text-white" type="submit">Si, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function(event) {
        $('#reports').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        $('.deleteReport').click( (e) => {
            const id = $(e.target).attr('data-id');
            $('#report_form_delete').attr('action', `/workers/${id}`)
            $('#report_delete').val(id);
        });

        $('#workers_registro').click(async () => {
            $('#workers_identification').val('');
            $('#workers_form').attr('action', `/workers`);
            $('#workers_hidden').val('POST');
            $('#workers_first_name').val('');
            $('#workers_second_name').val('');
            $('#workers_last_name').val('');
            $('#workers_address').val('');
            $('#workers_telephone').val('');
            $('#workers_city').val('');
            $('#show-report').modal('show')
        });

        $('.showWorker').click(async (e) => {
            const id = $(e.target).attr('data-id');
            $('#workers_form').attr('action', `/workers/${id}`);
            $('#workers_hidden').val('PUT');

            $('#background_loader').removeClass('d-none');
            $('#spinning_loader').removeClass('d-none');
            $('#spinning_loader').addClass('d-flex');

            await $.ajax({
                    url: `/workers/${id}`,
                    method: 'GET'
                })
                .done(async (res) => {
                    $('#workers_identification').val(res['identification']);
                    $('#workers_first_name').val(res['first_name']);
                    $('#workers_second_name').val(res['second_name']);
                    $('#workers_last_name').val(res['last_name']);
                    $('#workers_address').val(res['address']);
                    $('#workers_telephone').val(res['telephone']);
                    $('#workers_city').val(res['city']);
                })

            $('#background_loader').addClass('d-none');
            $('#spinning_loader').removeClass('d-flex');
            $('#spinning_loader').addClass('d-none');
            $('#show-report').modal('show')
        })
    });
</script>