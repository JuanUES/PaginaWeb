@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administación de Periodos</h4>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="row">
        <div class="col-9">
            <h3>Periodos Registrados</h3>
        </div>
        <div class="col-3" style="text-align:right">
            <button class="btn btn btn-primary" title="Agregar nuevo registro" data-toggle="modal" data-target="#modalRegistro" id="btnNuevoRegistro"> <i class=" dripicons-plus" aria-hidden="true"></i> </button>
        </div>
    </div>
            <br/>
            <br/>
            <table  class="table table-sm" id="table-periodo">
                <thead>
                <tr>
                    <th data-priority="1">Id</th>
                    <th data-priority="3">Tipo</th>
                    <th data-priority="3">Inicio</th>
                    <th data-priority="1">Fin</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($periodo as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->tipo }}</td>
                    <td>{{ date('d-m-Y', strtotime( $item->fecha_inicio)) }}</td>
                    <td>{{ date('d-m-Y', strtotime( $item->fecha_fin)) }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm" title="Modificar contenido" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalRegistro" onclick="btnEdit(this);"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

</div>


<!-- inicio Modal de registro -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalRegistro" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><i class=" mdi mdi-account-badge-horizontal mdi-24px" aria-hidden="true" ></i> Periodo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="registroForm"  action="{{ route('admin.periodo.store') }}" method="POST">
                <input type="hidden" name="_id" id="_id">
                <div class="modal-body">
                        <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                            role="alert" style="display:none" id="notificacion">
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label>Nota: <code>* Campos Obligatorio</code></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="FechaI">Fecha Inicio <span class="text-danger">*</span> </label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="FechaF">Fecha Fin <span class="text-danger">*</span> </label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="tipo">Tipo <span class="text-danger">*</span> </label>
                                    <select class="custom-select" name="tipo" id="tipo">
                                        <option value="Administrativo" >Administrativo</option>
                                        <option value="Docente">Docente</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"  aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onClick="submitForm('#registroForm','#notificacion')"><li class="fa fa-save"></li> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>









@endsection

@section('plugins-js')
<!-- Dashboard Init JS -->
{{--  <script src="{{ asset('template-admin/dist/assets/js/pages/dashboard.init.js') }}"></script>  --}}
<script>
    $(document).ready(function () {
        $('#table-periodo').DataTable({
            "language": {
                "decimal":        ".",
                "emptyTable":     "No hay datos para mostrar",
                "info":           "Del _START_ al _END_ (_TOTAL_ total)",
                "infoEmpty":      "Del 0 al 0 (0 total)",
                "infoFiltered":   "(Filtrado de todas las _MAX_ entradas)",
                "infoPostFix":    "",
                "thousands":      "'",
                "lengthMenu":     "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar:",
                "zeroRecords":    "No hay resultados",
                "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
                },
                "aria": {
                "sortAscending":  ": Ordenar de manera Ascendente",
                "sortDescending": ": Ordenar de manera Descendente ",
                }
            },
            "pagingType": "full_numbers",
            "lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		    "iDisplayLength":	5,
        });
    });


    function btnEdit(element){
        let id = $(element).data('id');
        let data = getData('GET', `{{ url('admin/periodo') }}/`+id,'#notificacion');
        data.then(function(response){
            $("#registroForm #_id").val(response.id);
            $("#registroForm #fecha_inicio").val(response.fecha_inicio);
            $("#registroForm #fecha_fin").val(response.fecha_fin);
            $("#registroForm #tipo").val(response.tipo).trigger('chance');
        });
    }
    </script>
@endsection
