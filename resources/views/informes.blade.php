@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Informes vehículos</h3><br>
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
                <button class="btn btn-success float-right mb-2" id="reports_registro">
                    <i class="fa fa-plus"></i>
                    Registrar vehículo
                </button>
            </div>
        </div>
        <table id="reports" class="table table-striped table-bordered w-100">
            <thead class="thead-dark">
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Conductor</th>
                    <th>Propietario</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->plate }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->driver->first_name . ' ' . $vehicle->driver->second_name . ' ' . $vehicle->driver->last_name}}</td>
                    <td>{{ $vehicle->owner->first_name . ' ' . $vehicle->owner->second_name . ' ' . $vehicle->owner->last_name}}</td>
                    <td>
                        <button class="btn btn-info showReport" aria-hidden data-toggle="tooltip" data-placement="top" title="Editar vehículo" data-id="{{ $vehicle->id }}" data-owner="{{ $vehicle->owner->id }}" data-driver="{{ $vehicle->driver->id }}">
                            <i class="fa fa-edit small" data-id="{{ $vehicle->id }}"></i>
                        </button>
                        <a href="#" data-toggle="modal" data-target="#confirm-delete">
                            <button class="btn btn-danger deleteReport" aria-hidden data-toggle="tooltip" data-placement="top" title="Eliminar vehículo" data-id="{{ $vehicle->id }}" data-owner="{{ $vehicle->owner->id }}" data-driver="{{ $vehicle->driver->id }}">
                                <i class="fa fa-trash small" data-id="{{ $vehicle->id }}"></i>
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
                    <h5 class="modal-title">Informe del vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="report_form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="report_hidden" name="_method" value="POST">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Placa <span style="color: red;"> (*)</span></label><br>
                                    <input type="text" id="report_plate" name="plate" class="form-control w-100" required maxlength="10">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Marca <span style="color: red;"> (*)</span></label><br>
                                    <input type="text" id="report_brand" name="brand" class="form-control w-100" required maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Tipo de vehículo <span style="color: red;"> (*)</span></label><br>
                                    <select name="type" id="report_type" class="form-control" required>
                                        <option value="1">Particular</option>
                                        <option value="2">Público</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="plate">Color <span style="color: red;"> (*)</span></label><br>
                                    <input type="text" id="report_color" name="color" class="form-control w-100" required maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="plate">Conductor <span style="color: red;"> (*)</span></label>
                            <select class="form-control" id="report_drivers" name="owner_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="plate">Propietario <span style="color: red;"> (*)</span></label>
                            <select class="form-control" id="report_owners" name="driver_id" required>
                            </select>
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
                    ¿Desea eliminar el vehículo?
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
            $('#report_form_delete').attr('action', `/informes/${id}`)
            $('#report_delete').val(id);
        });

        $('#reports_registro').click(async () => {
            $('#report_form').attr('action', `/informes`);
            $('#report_hidden').val('POST');
            $('#report_plate').val('');
            $('#report_brand').val('');
            $('#report_type').val('');
            $('#report_color').val('');
            await workers(1);
            $('#show-report').modal('show')
        });

        $('.showReport').click(async (e) => {
            const id = $(e.target).attr('data-id');
            $('#report_form').attr('action', `/informes/${id}`);
            $('#report_hidden').val('PUT');
            var owner = $(e.target).attr('data-owner');
            var driver = $(e.target).attr('data-driver');

            $('#background_loader').removeClass('d-none');
            $('#spinning_loader').removeClass('d-none');
            $('#spinning_loader').addClass('d-flex');

            await $.ajax({
                    url: `/informes/${id}`,
                    method: 'GET'
                })
                .done(async (res) => {
                    $('#report_plate').val(res['plate']);
                    $('#report_brand').val(res['brand']);
                    $('#report_type').val(res['type']);
                    $('#report_color').val(res['color']);
                })

            await workers(2, {
                owner: owner,
                driver: driver
            });

            $('#background_loader').addClass('d-none');
            $('#spinning_loader').removeClass('d-flex');
            $('#spinning_loader').addClass('d-none');
            $('#show-report').modal('show')
        })

        async function workers(action, params = {}) {
            if ($('#report_drivers option').length && $('#report_drivers option').length) {
                return;
            }
            $('#background_loader').removeClass('d-none');
            $('#spinning_loader').removeClass('d-none');
            $('#spinning_loader').addClass('d-flex');

            await $.ajax({
                    url: `/workers`,
                    method: 'GET',
                    data: {
                        type: 2
                    }
                })
                .done(async (res) => {
                    $('#report_drivers').html('');
                    $('#report_owners').html('');

                    let html_owners = '';
                    let html_drivers = '';

                    if (action == 2) {
                        res.forEach((value) => {
                            html_owners += `<option value='${value['id']}' ${value['id'] == params.owner ? 'selected' : '' }>${value['first_name'] + ' ' + value['second_name'] + ' ' + value['last_name']}</option>`;
                            html_drivers += `<option value='${value['id']}' ${value['id'] == params.driver ? 'selected' : '' }>${value['first_name'] + ' ' + value['second_name'] + ' ' + value['last_name']}</option>`;
                        })
                    } else {
                        res.forEach((value) => {
                            html_owners += `<option value='${value['id']}'>${value['first_name'] + ' ' + value['second_name'] + ' ' + value['last_name']}</option>`;
                            html_drivers += `<option value='${value['id']}'>${value['first_name'] + ' ' + value['second_name'] + ' ' + value['last_name']}</option>`;
                        })
                    }

                    $('#report_drivers').html(html_drivers);
                    $('#report_owners').html(html_owners);
                })

            $('#background_loader').addClass('d-none');
            $('#spinning_loader').removeClass('d-flex');
            $('#spinning_loader').addClass('d-none');
            $('#show-report').modal('show')
        }
    });
</script>