@extends('layouts.admin')

@section('content')
@if (!is_null(auth()->user()->empleado))

<!--modal para dar alta-->
<div id="modalAceptar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-check mdi-24px" style="margin: 0px;"></i> Aceptar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('jf/aceptar') }}" method="POST" id="cancelarModal">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion1">
                    </div>
                    <input type="hidden" name="_id" id="aceptar_id">
                    <div class="row py-3">
                        <div class="col-xl-2 fa fa-check text-success fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h3 class="font-17 text-justify font-weight-bold">
                                Nota: Se aceptara esta licencia, 
                                ¿Desea continuar?
                            </h3>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 p-1">
                            <button  type="submit" 
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
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
</div><!-- /.modal-->
<!--Modal para dar alta fin-->

<div id="modalObservaciones" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-eye mdi-36px" style="margin: 0px;"></i> Observaciones</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>           
            <div class="modal-body">
                <div class="container-fluid ">
                    <table style="width: 100%" class="table" id="obs-table"> 
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Procedimiento</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="container-fluid my-1">
                    <form action="">
                        
                        <div class="form-group">
                            <label for="Observaciones">Nueva Observación </label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="observaciones" id="observaciones" rows="6"></textarea>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fa fa-ban"
                    aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id='guardar_registro'
                    onClick="submitForm('#registroForm','#notificacion')">
                    <li class="fa fa-save"></li> Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- start page title -->
<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Jefe</li>
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
                        Licencias de Empleados para Jefe
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                </div>                
            </div>
            <table  class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-2">Fecha de Uso</th>
                    <th class="col-xs-2">Empleado</th>
                    <th class="col-sm-1">Tipo</th>
                    <th class="col-sm-1">Hora Inicio</th>
                    <th class="col-sm-1">Hora final</th>
                    <th class="col-sm-2">Horas</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($permisos as $item)
                        <tr>
                            <th class="align-middle ">{{Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y')}}</th>
                            <td class="align-middle ">{{$item->nombre.' '.$item->apellido}}</td>
                            <td class="align-middle "><span class="badge badge-primary">{{$item->tipo_permiso}}</span></td>
                            <td class="align-middle ">{{date('H:i', strtotime($item->hora_inicio))}}</td>
                            <td class="align-middle ">{{date('H:i', strtotime($item->hora_final))}}</td>
                            <td class="align-middle ">
                                {{
                                    Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_inicio)
                                        ->diffAsCarbonInterval(Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_final))
                                }}
                            </td>                           
                            <td class="align-middle ">
                                <div class="row">
                                    <div class="col text-center">
                                        
                                        <div class="btn-group" role="group">
                                            <button title="Ver Datos" class="btn btn-outline-primary btn-sm" 
                                                value="{{$item->permiso}}"
                                                 onclick="ver(this)">                                                
                                                <i class="fa fa-eye font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                            
                                            <button title="Agregar Observacion" class="btn btn-outline-primary btn-sm" 
                                                value="{{$item->permiso}}"
                                                 onclick="observaciones(this)">                                                
                                                <i class="fa fa-edit font-16 my-1" aria-hidden="true"></i>
                                            </button>

                                            <button title="Aceptar Licencia" class="btn btn-outline-success btn-sm rounded-left" 
                                              value="{{$item->permiso}}" 
                                              onclick="aceptar(this)">
                                                <i class="fa fa-check font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                                                           
                                        </div>
                                    </div>
                                </div>
                            </td>  
                        </tr>
                    @endforeach                   
                </tbody>
            </table>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->

@else
    <div class="row m-3">
        <div class="col-xl-12">
            <div class="card-box p-2 border">
                <p> <i class="fa fa-info-circle"></i> No es posible cargar la información perteneciente a <strong> {{auth()->user()->name}} </strong>.</p>
                <label> A continuación se detallan las posibles causas: </label>
                <ul>
                    <li>El Usuario no se encuentra vinculado con ningun <strong>Empleado</strong> registrado en el sistema.</li>
                </ul>
            </div>
        </div>
    </div>
@endif
@endsection

@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"/>
<style>

</style>
@endsection

@section('plugins-js')
    <!-- Bootstrap Select -->
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" ></script>
    <script src="{{ asset('template-admin/dist/assets/libs/select2/select2.min.js') }}" ></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}" ></script>
    <script src="{{ asset('js/scripts/data-table.js') }}" ></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>       
        
        function aceptar(boton){
            $('#aceptar_id').val($(boton).val());
            $('#modalAceptar').modal();
        }
        function observaciones(boton){
            if($(boton).val()!=null){
                    $.ajax({
                        type: "GET",
                        url: '/admin/mislicencias/procesos/'+$(boton).val(),
                        beforeSend: function() {
                            $(boton).prop('disabled', true).html(''
                                +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                            );
                            $(boton).prop('disabled', true).html(''
                                +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                            );
                        },
                        success: function(json) {   
                            var json = JSON.parse(json);   
                            var tabla = $('#obs-table').DataTable();
                            tabla.clear().draw(false);
                            for (var i in json) {     
                                var html= '<tr>'
                                +'<td class="col-xs-2">'+json[i].fecha+'</td>'
                                +'<td class="col-xs-6"><span class="badge badge-primary">'+json[i].proceso+'</span></td>'
                                +'<td class="col-xs-6">'+(json[i].observaciones==null?'Ninguna':json[i].observaciones)+'</td>'
                                +'</tr>';    
                                tabla.row.add($.parseHTML(html)[0]).draw(false);
                            }   
                            $("#modalObservaciones").modal();
                        },
                        complete: function(json) {
                            $(boton).prop('disabled', false).html(''
                                +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                            );
                        }
                    });                
            }
        };

        $('.modal').on('hidden.bs.modal',function(){
            //$(".alert").hide();
            $("form").trigger("reset");
        });
    </script>
@endsection
