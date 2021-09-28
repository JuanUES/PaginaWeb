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
                @hasanyrole('super-admin|Jefe-Academico|Jefe-Administrativo|Recurso-Humano')
                    <button class="btn btn btn-success" title="Generar Reporte" data-toggle="modal" data-target="#modalExport"> <i class="fa fa-file-excel" aria-hidden="true"></i> </button>
                @endhasanyrole
                @if(is_null($emp) || $emp->tipo_empleado=='Académico')
                    <button class="btn btn btn-primary" title="Agregar Jornada" id="btnNewJornada"> <i class="dripicons-plus" aria-hidden="true"></i> </button>
                @endif
            </div>
        @endif
    </div>
        <hr>
    @if($cargar)
        <form action="{{ route('admin.jornada.index') }}" method="get" id="frmFiltrar">
            <div class="row">
                {{--  <div class="col-12 col-sm-2 col-md-2">
                    <button class="btn btn btn-outline-info btn-block" title="Filtrar Contenido" type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                </div>  --}}
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <select class="form-group selectpicker select-filter" data-live-search="true" data-style="btn-white"  name="periodo">
                            @if(isset($periodos))
                                @foreach ($periodos as $item)
                                    <option value="{{ $item->id }}" {{ strcmp($item->id, $periodo)==0 ? 'selected' : '' }}>{{ $item->ciclo_rf->nombre }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                                @endforeach
                            @else 
                                <script>window.location = "/admin/periodo";</script>
                            @endif
                        </select>
                    </div>
                </div>
                @hasanyrole('super-admin|Recurso-Humano')
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <select class="form-group selectpicker select-filter" data-live-search="true" data-style="btn-white"  name="depto">
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
                <tr>
                    <th>Registro</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Tipo</th>
                    <th>Periodo</th>
                    <th>Proceso</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jornadas as $item)
                    <tr {!! ($item->empleado_rf->id == Auth::user()->empleado_rf->id) ? 'style="background-color: rgba(21, 174, 234, 0.1);"' : '' !!} >
                        <th  data-sort="{{ strtotime($item->created_at) }}">{{ date('d/m/Y H:m', strtotime($item -> created_at)) }}</th>
                        <th>{{ $item -> empleado_rf->nombre }} {{ $item -> empleado_rf->apellido }}</th>
                        <td>{{ $item->empleado_rf->departamento_rf->nombre_departamento }}</td>
                        <td>{{ $item->empleado_rf->tipo_jornada_rf->tipo }}</td>
                        <td>{{ $item -> periodo }}</td>
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
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-success btn-sm" onclick="fnDetalleJornada(this);" title="Detalle"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></button>
                            @if(!($item->procedimiento=='aceptado'))
                                <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalProcedimiento" class="btn btn-outline-info btn-sm" onclick="fnProcedimiento(this)" title="Seguimiento"><i class="fa fa-check-circle fa-fw" aria-hidden="true"></i></button>
                            @endif    

                            @if(@Auth::user()->hasRole('Jefe-Academico') || @Auth::user()->hasRole('Jefe-Administrativo'))
                                @if($item->procedimiento=='enviado a recursos humanos' || $item->procedimiento=='aceptado')
                                @endif    
                            @elseif (@Auth::user()->hasRole('super-admin') || @Auth::user()->hasRole('Recurso-Humano'))
                                @if($item->procedimiento=='enviado a recursos humanos' || $item->procedimiento=='aceptado')
                                    <button class="btn btn-outline-primary btn-sm" onclick="fnEditJornada(this);" data-id="{{ $item->id }}" title="Editar">><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                @endif
                            @elseif(@Auth::user()->hasRole('Jefe-Academico') || @Auth::user()->hasRole('Jefe-Administrativo'))
                                @if($item->procedimiento=='enviado a jefatura' || $item->procedimiento=='recursos humanos lo ha regresado a jefatura')
                                    <button class="btn btn-outline-primary btn-sm" onclick="fnEditJornada(this);" data-id="{{ $item->id }}" title="Editar"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                @endif
                            @elseif(@Auth::user()->hasRole('Docente'))
                                @if($item->procedimiento=='guardado' || $item->procedimiento=='la jefatura lo ha regresado por problemas')
                                    <button class="btn btn-outline-primary btn-sm" onclick="fnEditJornada(this);" data-id="{{ $item->id }}" title="Editar"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card-box p-2 border">
                    <p> <i class="fa fa-info-circle"></i> No es posible cargar la información perteneciente a <strong> {{ @Auth::user()->name }} </strong>.</p>
                    <label> A continuación se detallan las posibles causas: </label>
                    <ul>
                        <li>El Usuario no se encuentra vinculado con ningun <strong>Empleado</strong> registrado en el sistema.</li>
                        <li>El Usuario no tiene los permisos necesarios.</li>
                        <li>El Usuario no es tipo <strong>Docente</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@include('Jornada._components.modals')
@endsection
@section('plugins-js')
<link rel="stylesheet" href="{{ asset('vendor/tabulator/dist/css/tabulator_simple.css') }}">
<script src="{{ asset('vendor/tabulator/dist/js/tabulator.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/scripts/jornadas.js') }}"></script>
<script>
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



</script>
@endsection
