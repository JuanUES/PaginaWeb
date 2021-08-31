@extends('layouts.admin')

@section('content')

<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="lead"> <i class="fa fa-info-circle"></i> Detalle Jornada </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-12 col-sm-12">
                <table class="table" id="tableView">
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administración de Jornada</h4>
        </div>
    </div>
</div>

<div class="card-box">
    <div class="row">
        <div class="col-9">
            <h3>Jornadas Registradas</h3>
        </div>
        <div class="col-3" style="text-align:right">
            <button class="btn btn btn-success" title="Generar Reporte" > <i class="dripicons-document-new" aria-hidden="true"></i> </button>
            <button class="btn btn btn-primary" title="Agregar nuevo registro" data-toggle="modal" data-target="#modalRegistro" id="btnNuevoRegistro"> <i class=" dripicons-plus" aria-hidden="true"></i> </button>
            {{--  <a href="{{ route('admin.jornada.create')}}" class="btn btn-primary" title="Agregar nuevo registro">
                <i class=" dripicons-plus" aria-hidden="true"></i>
            </a>  --}}
        </div>
    </div>
    <br/>


            {{--  @if(@Auth::user()->hasRole('Recurso-Humano') )
                <form method="POST" action="{{ route('admin.jornada.select', $depto[0]) }}" class="frmSelect" accept-charset="UTF-8" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento</label>
                        <select class="custom-select" id="id_depto" name="id_depto">
                            <option value="0">Seleccione</option>
                            @foreach ($depto as $dep)
                            <option for="{{ $dep->id }}" value="{{ $dep->id }}">{!!$dep->nombre_departamento!!}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            @endif  --}}

    <br/>
    <br/>
    <table  class="table table-sm" id="table-jornada">
        <thead>
        @if(@Auth::user()->hasRole('super-admin')  )
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="3">Periodo</th>
                <th data-priority="3">Estado</th>
                <th data-priority="1">Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($jornada as $item)
            <tr>
                <th>{{$item -> id}}</th>
                <td>{{$item -> periodo}}</td>
                <td>{{$item -> estado}}</td>
                <td>
                    <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-primary btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                    <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        @endif

        @if( @Auth::user()->hasRole('Recurso-Humano') )
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="3">Nombre</th>
                <th data-priority="3">Apellido</th>
                <th data-priority="1">Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($empJefe as $item)
            <tr>
                <th>{{$item -> id}}</th>
                <td>{{$item -> nombre}}</td>
                <td>{{$item -> apellido}}</td>
                <td>
                    <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-primary btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                    <a href="" title="Editar Jornada">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<!-- inicio Modal de registro -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalRegistro" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><i class=" mdi mdi-account-badge-horizontal mdi-24px" aria-hidden="true" ></i> Jornada</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="registroForm"  action="{{ route('admin.jornada.store') }}" method="POST">
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

                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label for="empleado" class="control-label">{{ 'Empleado' }} <span class="text-danger">*</span> </label>
                                {{--  <input id="id_emp" class="form-control" name="id_emp" readonly="readonly" value="1"></input>  --}}
                                <select class="custom-select" name="id_emp" id="id_emp">
                                    <option value="">Seleccione un Empleado</option>
                                    @foreach ($empleados as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <label for="periodo" class="control-label">{{ 'Periodo' }} <span class="text-danger">*</span> </label>
                                {{--  <input type="hidden" id="id_periodo" name="id_periodo" readonly="readonly"></input>
                                <input id="detalle" class="form-control" name="detalle" readonly="readonly"></input>  --}}
                                <select class="custom-select" name="id_periodo" id="id_periodo">
                                    @foreach ($periodos as $item)
                                        <option value="{{ $item->id }}">{{ $item->titulo }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="thoras" class="control-label">{{ 'Horas' }} <span class="text-danger"></span></label>
                                <input type="text" id="_horas" class="form-control total-horas" for="_horas" readonly="readonly" value="40"></input>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="thoras" class="control-label">{{ 'Actual' }} <span class="text-danger"></span></label>
                                <input type="text" id="auxJornada" class="form-control total-horas" for="_horas" readonly="readonly" value="40">
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-3">Detalle de la Jornada
                        <span class="float-right">
                            <button type="button" class="btn btn-sm btn-primary" name="btnNewRow" id="btnNewRow"> <i class="fa fa-plus"></i> </button>
                        </span>
                    </h5>
                    {{--  <hr>  --}}
                    <div id="days-table"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-ban"  aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-save"></li> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('plugins-js')
<link rel="stylesheet" href="{{ asset('vendor/tabulator/dist/css/tabulator_simple.css') }}">
<script src="{{ asset('vendor/tabulator/dist/js/tabulator.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/scripts/jornadas.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-jornada').DataTable({
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

    $(".openModal").click(function (e) {
        e.preventDefault();
        $('#modalView').modal('show');
        let key = $(this).data('key');
        $.get( "{{ url('admin/jornada/detalle/') }}/"+key+"/", function(data) {
            const horario = data.map(function(datas){return datas.detalle;});
            const dia = data.map(function(datas){return datas.dia;});
            let contenido = `
                <tr>
                    <th>Días</th>
                    <th>Horario</th>
                </tr>
                <tr>
                    <td>${dia.join('<br>')}</td>
                    <td>${horario.join('<br>')}</td>
                </tr>`;
            $("#tableView").html(contenido);
        });
    });

    $("#id_emp").on('change', function () {
        let id = $(this).val();
        if(id!==''){
            let data = getData('GET', `{{ url('admin/jornada/jornadaEmpleado/') }}/`+id,'#notificacion');
            data.then(function(response){
                $(".total-horas").val(response.horas_semanales);
                let updatehours = updateJornada();
                $("#_horas").val('' + updatehours);
            });
        }
    });


</script>
@endsection
