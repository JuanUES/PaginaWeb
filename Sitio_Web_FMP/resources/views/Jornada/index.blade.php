@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administración de Jornada</h4>
        </div>
    </div>
</div>

<div class="card-box">
    <div class="row">
        <div class="col-12 col-sm-5">
            <h3>Jornadas Registradas</h3>
        </div>
        @if($cargar)
            <div class="col-12 col-sm-7" style="text-align:right">
                @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano')
                    <button class="btn btn btn-success" title="Generar Reporte" data-toggle="modal" data-target="#modalExport"> <i class="fa fa-file-excel" aria-hidden="true"></i> </button>
                @endhasanyrole
                @if(is_null($emp) || $emp->tipo_empleado=='Académico')
                    <button class="btn btn btn-primary" title="Agregar Jornada" id="btnNewJornada"> <i class="dripicons-plus" aria-hidden="true"></i> </button>
                @endif
            </div>
        @endif
    </div>
        <hr>

        {{--  @dd($emp)  --}}

    @if($cargar)
        <form action="{{ route('admin.jornada.index') }}" method="get">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-1">
                    <button class="btn btn btn-outline-info btn-block" title="Filtrar Contenido" type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                </div>
                <div class="col-12 col-sm-5 col-md-3">
                    <div class="form-group">
                        <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"  name="periodo">
                            {{--  <option value="all" selected> Todos los periodos </option>  --}}
                            @foreach ($periodos as $item)
                                <option value="{{ $item->id }}" {{ strcmp($item->id, $periodo)==0 ? 'selected' : '' }}>{{ $item->ciclo_rf->nombre }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @hasanyrole('super-admin|Recurso-Humano')
                    <div class="col-12 col-sm-5 col-md-3">
                        <div class="form-group">
                            <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"  name="depto">
                                <option value="all" selected> Todos los Departamentos </option>
                                @foreach ($deptos as $item)
                                    <option value="{{ $item->id }}" {{ strcmp($item->id, $depto)==0 ? 'selected' : '' }}>{!!$item->nombre_departamento!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endhasanyrole
            </div>
        </form>
        <br/>
        <br/>
        <table  class="table table-sm dt-responsive nowrap" style="width:100%" id="table-jornada">
            <thead>
            {{--  @if(@Auth::user()->hasRole('admin') || @Auth::user()->hasRole('Recurso-Humano') || @Auth::user()->hasRole('Jefe-Departamento') )  --}}
                <tr>
                    <th>Registro</th>
                    {{--  <th data-priority="1">Id</th>  --}}
                    <th>Empleado</th>
                    <th>Periodo</th>
                    <th>Proceso</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                {{--  @if(@Auth::user()->hasRole('Jefe-Departamento') )  --}}
                    @foreach($jornadas as $item)
                    <tr>
                        <th  data-sort="{{ strtotime($item->created_at) }}">{{ date('d/m/Y H:m', strtotime($item -> created_at)) }}</th>
                        {{--  <th>{{$item -> idEmp}}</th>  --}}
                        <th>{{ $item -> empleado_rf->nombre }} {{ $item -> empleado_rf->apellido }}</th>
                        <td>{{$item -> periodo}}</td>
                        <td>
                            @php
                                $color = 'secondary';
                                if($item->procedimiento=='enviado a jefatura')
                                    $color = 'info';
                                else if($item->procedimiento=='enviado a recursos humanos')
                                    $color = 'primary';
                                else if($item->procedimiento=='la jefatura lo ha regresado por problemas')
                                    $color = 'warnign';
                                else if($item->procedimiento=='aceptado')
                                    $color = 'success';
                                else if($item->procedimiento=='invalidado')
                                    $color = 'danger';
                            @endphp
                            <span class="badge badge-{{ $color }}">{{ Str::ucfirst($item->procedimiento) }}</span>
                        </td>
                        <td class="text-center">
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalProcedimiento" class="btn btn-outline-info btn-sm" onclick="fnProcedimiento(this)"><i class="fa fa-check-circle fa-fw" aria-hidden="true"></i></button>
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-success btn-sm openModal"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></button>

                            @if($item->procedimiento=='guardado' || $item->procedimiento=='la jefatura lo ha regresado por problemas')
                                <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">
                                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                {{--  @elseif(@Auth::user()->hasRole('super-admin') || @Auth::user()->hasRole('Recurso-Humano'))
                    @foreach($jornada as $item)
                    <tr>
                        <th>{{ date('d/m/Y', strtotime($item -> created_at)) }}</th>
                        <th>{{$item -> idEmp}}</th>
                        <th>{{ $item -> empleado_rf->nombre }} {{ $item -> empleado_rf->apellido }}</th>
                        <td>{{$item -> periodo}}</td>
                        <td>
                            <span class="badge badge-{{ strcmp($item->estado, 'activo')==0 ? 'success' : 'secondary' }}">{{ Str::ucfirst($item->estado) }}</span>
                        </td>
                        <td class="text-center">
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-success btn-sm openModal"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></button>
                            <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif  --}}

            {{--  @endif  --}}

            {{--  @if( @Auth::user()->hasRole('Docente') )
                <tr>
                    <th data-priority="1">Registro</th>
                    <th data-priority="3">Empleado</th>
                    <th data-priority="3">Periodo</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="1" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($jornadaDocente as $item)
                <tr>
                    <th>{{ date('d/m/Y', strtotime($item -> created_at)) }}</th>
                    <th>{{ $item -> empleado_rf->nombre }} {{ $item -> empleado_rf->apellido }}</th>
                    <td>{{$item -> periodo}}</td>
                    <td>
                        <span class="badge badge-{{ strcmp($item->estado, 'activo')==0 ? 'success' : 'secondary' }}">{{ Str::ucfirst($item->estado) }}</span>
                    </td>
                    <td class="text-center">
                        <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-success btn-sm openModal"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></button>
                        <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">
                            <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                        </a>
                    </td>
                </tr>
                @endforeach
            @endif  --}}
            </tbody>
        </table>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card-box p-2 border">
                    <p> <i class="fa fa-info-circle"></i> No es posible cargar la información perteneciente a <strong> {{ @Auth::user()->name }} </strong>.</p>
                    <label> Posibles causas </label>
                    <ul>
                        <li>El Usuario no se encuentra vinculado con ningun Empleado registrado en el sistema</li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- inicio Modal de registro -->
@if(is_null($emp) || $emp->tipo_empleado=='Académico')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalNewJonarda" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title"><i class=" mdi mdi-account-badge-horizontal mdi-24px" aria-hidden="true" ></i> Jornada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="frmJornada"  action="{{ route('admin.jornada.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_id" id="_id">
                    <div class="modal-body">
                        <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert" style="display:none" id="notificacion_jornada"></div>
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
                                    <label for="periodo" class="control-label">{{ 'Periodo' }} <span class="text-danger">*</span> </label>
                                    <select class="form-group selectpicker" data-live-search="true" data-style="btn-white" name="id_periodo" id="id_periodo">
                                        <option value="">Seleccione un Periodo</option>
                                        @foreach ($periodos as $item)
                                            <option value="{{ $item->id }}">{{ $item->ciclo_rf->nombre }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-8">
                                <div class="form-group">

                                    <label for="empleado" class="control-label">{{ 'Empleado' }} <span class="text-danger">*</span> </label>
                                    {{-- @if( @Auth::user()->hasRole('Docente')  ) --}}
                                        {{-- <select class="custom-select" name="id_emp" id="id_emp">
                                            <option value="">Seleccione un Empleado</option> --}}
                                            {{-- @foreach ($docente as $item)
                                                <option value="{{ $item->id }}" selected>{{  $item->apellido }}, {{ $item->nombre }}</option>
                                            @endforeach --}}
                                        {{-- </select> --}}
                                    {{-- @endif --}}

                                    {{-- @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano') --}}
                                        {{-- <select class="custom-select" name="id_emp" id="id_emp">
                                            <option value="">Seleccione un Empleado</option>
                                            @foreach ($empleados as $item)
                                                <option value="{{ $item->id }}">{{ $item->apellido }}, {{ $item->nombre }}</option>
                                            @endforeach
                                        </select> --}}
                                    {{-- @endhasanyrole --}}


                                    {{-- @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano') --}}
                                        <select class="form-group selectpicker" data-live-search="true" data-style="btn-white" name="id_emp" id="id_emp">
                                            <option value="">Seleccione un Empleado</option>
                                            {{--  @foreach ($empleados as $item)
                                                <option value="{{ $item->id }}">{{ $item->apellido }}, {{ $item->nombre }}</option>
                                            @endforeach  --}}
                                        </select>
                                    {{-- @endhasanyrole --}}

                                </div>

                            </div>

                            <div class="col-12 col-sm-2">
                                <div class="form-group">
                                    <label for="thoras" class="control-label">{{ 'Horas' }} <span class="text-danger"></span></label>
                                    <input type="text" id="auxJornada" class="form-control total-horas" for="auxJornada" readonly="readonly" value="0">
                                </div>
                            </div>
                            <div class="col-12 col-sm-2">
                                <div class="form-group">
                                    <label for="thoras" class="control-label">{{ 'Disponibles' }} <span class="text-danger"></span></label>
                                    <input type="text" id="_horas" class="form-control" for="_horas" readonly="readonly" value="0"></input>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="jornada-div">
                            <div class="col-12">
                                <h5 class="mb-3">Detalle de la Jornada
                                    <span class="float-right">
                                        <button type="button" class="btn btn-sm btn-primary" name="btnNewRow" id="btnNewRow"> <i class="fa fa-plus"></i> </button>
                                    </span>
                                </h5>
                                <div id="days-table"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-ban"  aria-hidden="true"></i> Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-save"></li> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif


@include('Jornada._components.modals')

@endsection

@section('plugins-js')
<link rel="stylesheet" href="{{ asset('vendor/tabulator/dist/css/tabulator_simple.css') }}">
<script src="{{ asset('vendor/tabulator/dist/js/tabulator.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/scripts/jornadas.js') }}"></script>
<script>

    var periodo_registro = null;
    var empleado_registro = null;
    $(document).ready(function () {
        $("#jornada-div :input").prop("disabled", true);//para deshabilitar los botones cuando no este seleccionado ningun empleado


        $('#table-jornada').DataTable({
            'responsive': true,
            "order": [[ 0, "desc" ]],
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

    $("#btnNewJornada").click(function () {
        $("#modalNewJonarda").modal('show');
        $("#id_periodo").val(periodo_registro).trigger('change');
        $('#id_periodo').selectpicker('refresh');
        $("#id_emp").val(empleado_registro).trigger('change');
        $('#id_emp').selectpicker('refresh');
    });

    $("#id_emp").on('change', function () {//para cargar el total de horas por empleados
        let id = $(this).val();
        if(id!==''){
            // $("#jornada-div").show('slow');
            $("#jornada-div :input").prop("disabled", false);
            let data = getData('GET', `{{ url('admin/jornada/jornadaEmpleado/') }}/`+id,'#notificacion_jornada');
            data.then(function(response){
                $(".total-horas").val(response.horas_semanales);
                updateChangeTable();
                empleado_registro = $('#id_emp').val();

                console.log(response);



            });
        }else{
            $("#jornada-div :input").prop("disabled", true);
            // $("#jornada-div").hide('slow');
        }
    });


    $("#id_periodo").on('change', function () {//para cargar los empleados dependiendo del periodo
        let id = $(this).val();
        if(id!==''){
            // $("#jornada-div").show('slow');
            $("#jornada-div :input").prop("disabled", false);
            let data = getData('GET', `{{ url('admin/jornada/periodoEmpleados/') }}/`+id,'#notificacion_jornada');
            data.then(function(response){
                $("#id_emp").val(null).trigger('change');
                $('#id_emp').empty();
                $('#id_emp').append('<option selected value="">Seleccione un Empleado</option>');
                $(response).each(function (index, element) {
                    $("#id_emp").append('<option value="'+element.id+'">'+element.apellido+', '+element.nombre+'</option>');
                });
                $('#id_emp').selectpicker('refresh');
                $('#id_periodo').selectpicker('refresh');
                periodo_registro = $('#id_periodo').val();
            });
        }else{
            $("#jornada-div :input").prop("disabled", true);
        }
    });


    function fnProcedimiento(componet){
        let jornada = $(componet).data('key');
        $("#registroForm #jornada_id").val(jornada);
    }


</script>
@endsection
