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
{{--PARA MOSTRAR LA ALERTA DE LAS FECHAS VACIAS --}}
<div id="modalAlerta" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="mdi dripicons-information  mdi-24px" style="margin: 0px;"></i> Aviso</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="" method="POST" id="enviarForm">
                @csrf
                <div class="modal-body">
                    <div class="row py-3 align-center">
                        <div class="col-xl-2 dripicons-information text-info fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h4 class="font-17 text-justify font-weight-bold">
                                Aviso: Fecha de inicio y fin son obligatorias,
                            </h4>
                            <h4 class="font-17 text-justify font-weight-bold">
                                !Verificar información!
                            </h4>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-3 p-1"></div>
                        <div class="col-xl-6 p-1">
                            <button type="reset" 
                                class="btn btn-light p-1 waves-light waves-effect btn-block font-24" 
                                data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                Ok
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{{--FIN DE MOSTRAR LA ALERTAS DE LAS FECHAS VACIAS--}}

{{--MODAL PARA GENERAR EL PDF--}}
<div id="modalPDF" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="mdi mdi-pdf-box   mdi-20px" style="margin: 0px;"></i> Aviso</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('Reporte/cosntancias') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacionEnviar">
                    </div>
                    <input type="hidden" name="deptoR_R" id="deptoR_R">
                    <input type="hidden" name="inicioR" id="inicioR" >
                    <input type="hidden" name="finR" id="finR" >
                    <div class="row py-3 align-center">
                        <div class="col-xl-2 dripicons-information text-info fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h4 class="font-17 text-justify font-weight-bold">
                                Desea generar el PDF,
                            </h4>
                            <h4 class="font-17 text-justify font-weight-bold">
                                ¿Desea continuar?
                            </h4>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 p-1">
                            <button  type="submit" id="si" class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                                <i class="mdi mdi-check mdi-16px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6 p-1">
                            <button type="reset" 
                                class="btn btn-light p-1 waves-light waves-effect btn-block font-24" 
                                data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

{{--FIN PARA MODAL GENERAR EL PDF--}}

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row py-2">
                <div class="col order-first">
                    <h3>
                       Reporte Mensual de Licencia
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Descargar PDF"
                    class="btn btn-success dripicons-document-remove" id="descargarLicencias"></button>
                </div>      
            </div>
       
                <div class="row">
                    {{--  <div class="col-12 col-sm-2 col-md-2">
                        <button class="btn btn btn-outline-info btn-block" title="Filtrar Contenido" type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                    </div>  --}}
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="mes">Mes</label>
                            <select id="rrhh_mes" class="form-control select2" style="width: 100%" required>
                                <option value="todos">Todos</option>
                               <option value="1">Enero</option>
                               <option value="2">Febrero</option>
                               <option value="3">Marzo</option>
                               <option value="4">Abril</option>
                               <option value="5">Mayo</option>
                               <option value="6">Junio</option>
                               <option value="7">Julio</option>
                               <option value="8">Agosto</option>
                               <option value="9">Septiembre</option>
                               <option value="10">Octubre</option>
                               <option value="11">Noviembre</option>
                               <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="anio">Año</label>
                            <select id="rrhh_anio" class="form-control select2" style="width: 100%" required>
                                <option value="todos">Todos</option>
                                @foreach ($años as $item)
                                    <option value="{{$item->año}}">{{$item->año}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
     </div>
      
            <br/>
            <table  class="table" style="width: 100%" id='Mensuales_table'>
                <thead>
                <tr>
                    <th class="col-xs-2">Nombre</th>
                    <th class="col-xs-1">Tipo</th>
                    <th class="col-xs-1">Fecha uso</th>
                    <th class="col-xs-1">Horas a utilizar</th>
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
<script src="{{ asset('js/licencias/http.js')}}"></script>
<script src="{{ asset('js/scripts/configuracion.js')}}"></script>
<script src="{{ asset('js/ReportesJs/tablaMensual.js')}}"></script>
<script>
    $(
    function () {
        $('.select2').select2();            
    });

</script>

@endsection
