@extends('layouts.admin')

@section('content')
@if (!is_null(auth()->user()->empleado))
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class="icon-notebook mdi-36px"></i> Licencia</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('lic/create') }}" method="POST">
            @csrf
            
            <div class="modal-body">
                <input type="hidden" id="idUser" name="_id"/>
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
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputCodigo">Nombre <code>*</code></label>
                            <input type="text" class="form-control" value="{{$empleado->nombre}}"  autocomplete="off" placeholder="Digite el nombre" readonly>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputUbicacion">Apellido <code>*</code></label>
                            <input type="text" class="form-control" value="{{$empleado->apellido}}" autocomplete="off" placeholder="Digite el correo" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Tipo de permiso <code>*</code></label>
                            <select name="tipo_de_permiso" class="form-control select2" style="width: 100%" data-live-search="true" 
                                data-style="btn-white"   id="tipo_permiso" name="tipo_permiso">
                                <option value="">Seleccione</option>
                                <option value="LC/GS">L.C./G.S.</option>
                                <option value="LS/GS">L.S./G.S.</option>
                                <option value="INCAP">INCAP</option>
                                <option value="L OFICIAL">L.OFICIAL</option>
                                <option value="T COMP">T.COMP.</option>
                                <option value="CITA MEDICA">CITA MEDICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Representantes </label>
                            <select name="representante" class="form-control select2" style="width: 100%"
                                data-style="btn-white"  id="tipo_representante">
                                <option value="">Seleccione</option>
                                <option value="C.S.U">C.S.U</option>
                                <option value="AGU">AGU</option>
                                <option value="J.D">J.D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_uso">Fecha de Uso <code>*</code></label>
                            <input type="date" name="fecha_de_uso" class="form-control"
                                tyle="width: 100%"  id="fecha_de_uso">
                        </div>                            
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_presentacion">Fecha de Presentación <code>*</code></label>
                            <input type="text" name="fecha_de_presentación" id="fecha_de_presentacion" class="form-control"  
                                value="{{Carbon\Carbon::now('UTC')->format('d-M-Y')}}" 
                                style="width: 100%"  id="fecha_de_presentacion" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_inicio">Hora Inicio <code>*</code></label>
                            <input type="time" name="hora_inicio" class="form-control timepicker" style="width: 100%"  id="hora_inicio">
                        </div> 
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_final">Hora Final <code>*</code></label>
                            <input type="time" name="hora_final" class="form-control" style="width: 100%"  id="hora_final">
                        </div> 
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="hora_final">Horas Total<code>*</code></label>
                            <input type="text" value="Ilimitado" name="hora_disponible" 
                            class="form-control" style="width: 100%"  id="hora_disponible" readonly>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Justificación <code>*</code></label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="justificación" id="justificacion" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Observaciones </label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="observaciones" id="observaciones" rows="6"></textarea>
                        </div> 
                    </div>
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
            
        </form>
      </div>
    </div>
</div>
<!--fin modal de registro-->

<!--modal para dar alta-->
<div id="modalCancelar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-ban mdi-24px" style="margin: 0px;"></i> Cancelar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('lic/cancelar') }}" method="POST" id="cancelarModal">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion1">
                    </div>
                    <input type="hidden" name="_id" id="cancelar_id">
                    <div class="row py-3">
                        <div class="col-xl-2 fa fa-exclamation-triangle text-warning fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h4 class="font-17 text-justify font-weight-bold">
                                Advertencia: Se cancelara esta licencia, ¿Desea continuar?
                            </h4>
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

<div id="modalEnviar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="dripicons-information  mdi-24px" style="margin: 0px;"></i> Cancelar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('lic/enviar') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion1">
                    </div>
                    <input type="hidden" name="_id" id="enviar_id">
                    <div class="row py-3 align-center">
                        <div class="col-xl-2 dripicons-information text-info fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h4 class="font-17 text-justify font-weight-bold">
                                Advertencia: Se enviara esta licencia,
                            </h4>
                            <h4 class="font-17 text-justify font-weight-bold">
                                ¿Desea continuar?
                            </h4>
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
</div>

<div id="modalObservaciones" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-eye font-16 my-1" style="margin: 0px;"></i> Observaciones</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>           
            <div class="modal-body">
                <table style="width: 100%" id="obs-table"> 
                    <thead>
                        <tr>
                            <th class="col-sm-1">Procedimiento</th>
                            <th class="col-xs-2">Observaciones</th>
                        </tr>
                    </thead>
                </table>
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
                    <li class="breadcrumb-item active">Usuarios</li>
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
                        Mis Licencias
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Licencia"
                    class="btn btn-primary dripicons-plus"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>                
            </div>
            <table  class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-2">Presentación</th>
                    <th class="col-sm-2">Uso</th>
                    <th class="col-sm-1">Tipo</th>
                    <th class="col-xs-1">Hora Inicio</th>
                    <th class="col-xs-1">Hora Final</th>
                    <th class="col-sm-2">Horas</th>
                    <th class="col-sm-1 text-center">Estado</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($permisos as $item)
                        <tr>
                            <th class="align-middle ">{{Carbon\Carbon::parse($item->fecha_presentacion)->format('d/M/Y')}}</th>
                            <td class="align-middle ">{{Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y')}}</td>
                            <td class="align-middle "><span class="badge badge-primary">{{$item->tipo_permiso}}</span></td>
                            <td class="align-middle ">{{date('H:i', strtotime($item->hora_inicio))}}</td>
                            <td class="align-middle ">{{date('H:i', strtotime($item->hora_final))}}</td>
                            <td class="align-middle ">
                                {{
                                    Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_inicio)
                                        ->diffAsCarbonInterval(Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_final))
                                }}
                            </td>
                            <td class="align-middle text-center">
                                @if($item->estado =='GUARDADO') 
                                    <span class="badge badge-primary">{{$item->estado}}</span>
                                @endif
                                @if($item->estado =='CANCELADO') 
                                    <span class="badge badge-danger">{{$item->estado}}</span>
                                @endif
                                @if ($item->estado =='ENVIADO A JEFATURA')
                                    <span class="badge badge-warning">{{$item->estado}}</span>
                                @endif
                            </td>
                            <td class="align-middle ">
                                <div class="row">
                                    <div class="col text-center">
                                        @php
                                            $todos_btn = $item->estado =='GUARDADO' or 
                                                        !$item->estado=='ENVIADO A JEFATURA';
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <button title="Observaciones" class="btn btn-outline-primary btn-sm rounded-left" 
                                              value="{{$item->permiso}}" 
                                              onclick="observaciones(this)">
                                                <i class="fa fa-eye font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                            <button title="Enviar" class="btn btn-outline-primary btn-sm" 
                                            @if($todos_btn)
                                                value="{{$item->permiso}}"
                                                 onclick="enviar(this)"
                                                 @else disabled
                                                 @endif>                                                
                                                <i class="fa fa-arrow-circle-up font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                            <button title="Editar" 
                                            class="btn btn-outline-primary btn-sm border-letf-0"  
                                            @if($todos_btn)
                                                 value="{{$item->permiso}}"
                                                onclick="editar(this)"
                                                @else
                                                disabled
                                                @endif>
                                                <i class="fa fa-edit font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                            <button title="Cancelar" 
                                                class="btn btn-outline-primary btn-sm border-left-0 btn-outline-danger rounded-right"
                                                @if($todos_btn)
                                                 onclick="cancelar(this)"
                                                 value="{{$item->permiso}}"
                                                @else
                                                disabled
                                                @endif>
                                                <i class="fa fa-ban font-16 my-1"></i>
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
        $(
            function () {
                $('.select2').select2();            

                $(".summernote-config").summernote({
                    lang: 'es-ES',
                    height: 100,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['view', ['fullscreen']],           
                    ]
                });
            }
        
        );

        var hrs_usados=0;
        var min_usados=0;
        var hrs_disponible=0;

        function obtenerHora() {
            if($('#tipo_permiso').val()==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
                    $.ajax({
                        type: "GET",
                        url: 'mislicencias/horas/'+$('#fecha_de_uso').val(),
                        beforeSend: function() {
                            $('#hora_disponible').val('Cargando...');
                        },
                        success: function(json) {
                            var json = JSON.parse(json);
                            hrs_usados = json.horas_acumuladas;
                            min_usados = (json.minutos_acumulados < 10 ? '0' : '')+json.minutos_acumulados;
                            hrs_disponible = (json.minutos_acumulados > 0 ? parseInt(json.mensuales)-1:json.mensuales);
                        },
                        complete: function() {
                            $('#hora_disponible').val('Usado: '+hrs_usados+' hrs, '+min_usados+' min'
                            +'   Disponibles: '+hrs_disponible+' hrs,'+(json.minutos_acumulados > 0 ? 60 - parseInt(json.minutos_acumulados):0));
                        }
                    });
                
            }else{
                $('#hora_disponible').val('Ilimitado');
            }
        }

        function calcularHora() {
            
            var hora_inicio = $('#hora_inicio').val();
            var hora_final = $('#hora_final').val();
            
            // Expresión regular para comprobar formato
            var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
            
            // Si algún valor no tiene formato correcto sale
            if (!(hora_inicio.match(formatohora)
                    && hora_final.match(formatohora))){
                return;
            }
            // Calcula los minutos de cada hora
            var minutos_inicio = hora_inicio.split(':')
                .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
            var minutos_final = hora_final.split(':')
                .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
            var hrs_disp = parseInt(parseInt(hrs_disponible)+parseInt(hrs_usados)) * 60;
            // Si la hora final es anterior a la hora inicial sale
            if (minutos_final < minutos_inicio) return;
            
            // Diferencia de minutos
            var diferencia = minutos_final - minutos_inicio;
            diferencia = parseInt(diferencia)+parseInt(min_usados);

            // Cálculo de horas y minutos de la diferencia
            var horas = parseInt(Math.floor(diferencia / 60))+parseInt(hrs_usados);
            var minutos = parseInt((diferencia % 60));
            var hora_disponible = parseInt(parseInt(hrs_disponible)-parseInt(Math.floor(diferencia / 60)));

            $('#hora_disponible').val('Usado: '+horas+' hrs, '+(minutos < 10 ? '0' : '') 
            + minutos+' min'+'  Disponibles: '+(minutos>0 ? parseInt(horas_disponibles):hora_disponible)+' hrs');      
        }

        $('#tipo_permiso').on('select2:select',obtenerHora);
        $('#fecha_de_uso').change(obtenerHora).click(obtenerHora);
        $('#hora_inicio').change(calcularHora).click(calcularHora);
        $('#hora_final').change(calcularHora).click(calcularHora);

        //
       // observaciones,editar,enviar,cancelar enviar_id enviar_permiso
       function cancelar(btn) {
            $('#cancelar_id').val($(btn).val());
            $('#modalCancelar').modal();
       }
       function enviar(boton){
            $('#enviar_id').val($(boton).val());
            $('#modalEnviar').modal();
       }
       function editar(boton) {
           if($(boton).val()!=null){
                $.ajax({
                    type: "GET",
                    url: 'mislicencias/permiso/'+$(boton).val(),
                    beforeSend: function() {
                        $(boton).prop('disabled', true).html(''
                            +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                        );
                    },
                    success: function(json) {   
                        json = JSON.parse(json);                     
                        $('#justificacion').summernote("code",json.justificacion);
                        $('#observaciones').summernote("code",json.observaciones);
                        $('#tipo_representante').val(json.tipo_representante).trigger("change");
                        $('#tipo_permiso').val(json.tipo_permiso).trigger("change");
                        $('#fecha_de_presentacion').val(json.fecha_presentacion);
                        $('#fecha_de_uso').val(json.fecha_uso).change();                                   
                        $('#hora_inicio').val(json.hora_inicio).change();
                        $('#hora_final').val(json.hora_final).change();
                        $("#modalRegistro").modal();
                    },
                    complete: function() {
                        $(boton).prop('disabled', false).html(''
                            +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                        );
                    }
                });                
           }
       }

       function observaciones(boton){
        if($(boton).val()!=null){
                $.ajax({
                    type: "GET",
                    url: 'mislicencias/permiso/'+$(boton).val(),
                    beforeSend: function() {
                        $(boton).prop('disabled', true).html(''
                            +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                        );
                    },
                    success: function(json) {   
                        json = JSON.parse(json);                     
                        
                        $("#modalEnviar").modal();
                    },
                    complete: function() {
                        $(boton).prop('disabled', false).html(''
                            +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                        );
                    }
                });                
           }
       };
    </script>

@endsection
