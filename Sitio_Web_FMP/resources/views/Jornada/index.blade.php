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
                <div class="col-12 col-sm-2 col-md-2">
                    <button class="btn btn btn-outline-info btn-block" title="Filtrar Contenido" type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                </div>
                <div class="col-12 col-sm-5 col-md-5">
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
                    <div class="col-12 col-sm-5 col-md-5">
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
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-success btn-sm" onclick="fnDetalleJornada(this);"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></button>
                            @hasexactroles('Empleado');
                                @if($item->procedimiento=='guardado' || $item->procedimiento=='la jefatura lo ha regresado por problemas')
                                    {{--  <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">  --}}
                                        <button class="btn btn-outline-primary btn-sm" onclick="fnEditJornada(this);" data-id="{{ $item->id }}"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                    {{--  </a>  --}}
                                @endif
                            @endhasexactroles
                            @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento')
                                {{--  <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">  --}}
                                    <button class="btn btn-outline-primary btn-sm" onclick="fnEditJornada(this);" data-id="{{ $item->id }}"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                                {{--  </a>  --}}
                            @endrole
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

    function fnDetalleJornada(element) {
        $('#modalView').modal('show');
        let key = $(element).data('key');
        $.get( "{{ url('admin/jornada/') }}/"+key, function(data) {
            var fecha = new Date(data.jornada.created_at);
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

            $('#fechaRegistroDetalle').html(fecha.toLocaleDateString("es-ES", options));

            let contenido = '';
            $.each(data.items, function (indexInArray, valueOfElement) {
                contenido +=`<tr>
                                <td>${valueOfElement.dia}</td>
                                <td>${valueOfElement.hora_inicio}</td>
                                <td>${valueOfElement.hora_fin}</td>
                                <td>${valueOfElement.jornada}</td>
                            </tr>`;
            });
            $("#bodyView").html(contenido);

            contenido = '';
            $.each(data.seguimiento, function (indexInArray, valueOfElement) {
                let options = { year: 'numeric', month: 'long', day: 'numeric' };
                contenido +=`<tr>
                                <td>${ new Date(valueOfElement.created_at).toLocaleDateString("es-ES", options) }</td>
                                <td class="text-dark">${valueOfElement.proceso}</td>
                                <td>${valueOfElement.observaciones}</td>
                            </tr>`;
            });
            $("#bodySeguimiento").html(contenido);
        });
    }

    $("#btnNewJornada").click(function () {
        $("#_id").val('');
        $("#modalNewJonarda").modal('show');
        $("#id_periodo").val(null).trigger('change');
        $('#id_periodo').selectpicker('refresh');

        $("#id_emp").val(null).trigger('change');
        $('#id_emp').empty();
        $('#id_emp').selectpicker('refresh');
    });

    $("#id_emp").on('change', function () {//para cargar el total de horas por empleados
        let id = $(this).val();
        $("#jornada-div").show('slow');
        $("#btnSaveJornada").show('slow');
        $(".alert-error").remove();

        if(id!=='' && id!==null){
            $("#jornada-div :input").prop("disabled", false);
            let data = getData('GET', `{{ url('admin/jornada/jornadaEmpleado/') }}/`+id,'#notificacion_jornada');
            data.then(function(response){
                $(".total-horas").val(response.empleado.horas_semanales);
                updateChangeTable();

                if(!response.permiso){
                    $("#jornada-div").hide('slow');
                    $("#btnSaveJornada").hide('slow');
                    let alert = `<div class="alert alert-danger alert-error" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Usted no cuenta con los permisos suficientes para poder realizar este proceso.
                            </div>
                        </div>`;
                    $("#jornada-div").before(alert);
                }


            });
        }else{
            $("#jornada-div :input").prop("disabled", true);
        }
    });


    $("#id_periodo").on('change', function () {//para cargar los empleados dependiendo del periodo
        let id = $(this).val();
        if(id!==''){
            $("#jornada-div :input").prop("disabled", false);
            fnUpdatePeriodoSelect(id);
        }else{
            $("#jornada-div :input").prop("disabled", true);
        }
    });

    function fnUpdatePeriodoSelect(id, updateEmpleado = false, empleado = null, setPeriodo = false, periodo = null){
        let data = getData('GET', `{{ url('admin/jornada/periodoEmpleados/') }}/`+id+'?updateEmpleado='+updateEmpleado,'#notificacion_jornada');
        data.then(function(response){
            $("#id_emp").val(null).trigger('change');
            $('#id_emp').empty();
            $('#id_emp').append('<option selected value="">Seleccione un Empleado</option>');
            $(response).each(function (index, element) {
                $("#id_emp").append('<option value="'+element.id+'">'+element.apellido+', '+element.nombre+'</option>');
            });

            if(setPeriodo && periodo!==null){
                $("#id_periodo").val(periodo);
                $('#id_periodo').selectpicker('refresh');
            }
            if(updateEmpleado && empleado!==null){//para uctualizar el dato del empleado
                $("#id_emp").val(empleado).trigger('change');
            }

            $('#id_emp').selectpicker('refresh');
        });
    }


    function fnProcedimiento(componet){
        let jornada = $(componet).data('key');
        $("#registroForm #jornada_id").val(jornada);
    }

    //Para editar la jornada
    function fnEditJornada(element) {
        $("#modalNewJonarda").modal('show');
        let id = $(element).data('id');
        let data = getData('GET', `{{ url('admin/jornada') }}/`+id,'#notificacion_jornada');
        data.then(function(response){
            $("#_id").val(id);
            fnUpdatePeriodoSelect(response.jornada.id_periodo, true, response.jornada.id_emp, true, response.jornada.id_periodo);
            table.replaceData(response.items);
        });
    }

</script>
@endsection
