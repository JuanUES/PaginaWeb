@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Const. Olvido de Marcaje</li>
                </ol>
            </div>
            <h4 class="page-title">&nbsp;</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row py-2">
                <div class="col order-first">
                    <h3>
                        Constancia Olvido de Marcaje
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Licencia"
                    class="btn btn-success dripicons-document-remove"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>      
            </div>
            <form action="{{ route('admin.jornada.index') }}" method="get" id="frmFiltrar">
                <div class="row">
                    {{--  <div class="col-12 col-sm-2 col-md-2">
                        <button class="btn btn btn-outline-info btn-block" title="Filtrar Contenido" type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                    </div>  --}}
                    <div class="col-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="justificacion">Fecha de inicio</label>
                            <div class="input-group-append" style="width: 100%;">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                <input type="date" name="inicio" class="form-control"
                                    style="width: 100%;"  id="inicio" >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="justificacion">Fecha de fin</label>
                            <div class="input-group-append" style="width: 100%;">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                <input type="date" name="fin" class="form-control"
                                    style="width: 100%;"  id="fin" >
                            </div>
                        </div>
                    </div>
                   
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="justificacion">Seleccione el Departamento</label>
                                <select class="form-control select2" style="width: 100%" data-live-search="true" 
                                data-style="btn-white"   id="marcaje" name="marcaje">
                                 <option value="all" selected> Todos los Departamentos </option>
                                   @foreach ($deptos as $item)
                                        <option value="{{ $item->id }}">{!!$item->nombre_departamento!!}</option>
                                    @endforeach-->
                                </select>
                            </div>
                        </div>
                 
                </div>
            </form>
            <br/>
            <table  class="table" style="width: 100%" id='permisos-table'>
                <thead>
                <tr>
                    <th class="col-sm-2">Nombre</th>
                    <th class="col-sm-2">Tipo</th>
                    <th class="col-xs-1">Fecha Presentación</th>
                    <th class="col-xs-1">Fecha Aceptación</th>
                    <th class="col-xs-1">Hora Incio</th>
                    <th class="col-xs-1">Hora Final</th>
                    <th class="col-xs-2">Tiempo Utilizar</th>
                    <th class="col-xs-2">Justificación</th>
                </tr>
                </thead>
                <tbody>
                 
                </tbody>
            </table>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->



@endsection
@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
@endsection
@section('plugins-js')
<!-- Bootstrap Select -->
<script src="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" ></script>
<script src="{{ asset('template-admin/dist/assets/libs/select2/select2.min.js') }}" ></script>
<script>
    $(
    function () {
        $('.select2').select2();            

      
    });

</script>

@endsection
