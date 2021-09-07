@extends('layouts.admin')
@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-account-badge-horizontal mdi-36px"></i> Empleado</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('guardarUser') }}" method="POST">
            @csrf
            <div class="modal-body">
                    <input type="hidden" id="_id" name="_id" value=""/>
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
                                <input type="text" class="form-control" id='nombre' name="usuario"  autocomplete="off" placeholder="Digite el nombre">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">Apellido <code>*</code></label>
                                <input type="text" class="form-control" id="apellido" name="correo"  autocomplete="off" placeholder="Digite el apellido">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">D.U.I. <code>*</code></label>
                                <input type="text" class="form-control" name="dui" placeholder="Digite el número de D.U.I.">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">N.I.T. <code>*</code></label>
                                <input type="text" class="form-control" name="nit" placeholder="Digite el número de N.I.T.">
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">Teléfono <code>*</code></label>
                                <input type="tel" class="form-control" name="telefono" placeholder="Digite el número de teléfono">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">Tipo empleado <code>*</code></label>
                                <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                style="width: 100%;" name="tipo_jefe">
                                    <option value="1">Decano</option>
                                    <option value="2">Vice-decano</option>
                                    <option value="3">Administrativo</option>
                                    <option value="4">Académico</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="Departamento">Tipo Contrato <code>*</code></label>
                               <select  class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                    style="width: 100%;" id="id_tipo_contrato" name="id_tipo_contrato">
                                @foreach ($tcontrato as $contrato)
                                    <option value="{!!$contrato->id!!}">{!!$contrato->tipo!!}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="Departamento">Tipo Jornada <code>*</code></label>
                               <select  class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                    style="width: 100%;" id="id_tipo_jornada" name="id_tipo_jornada">
                                    @foreach ($tjornada as $jornada)
                                        <option value="{!!$jornada->id!!}">{!!$jornada->tipo!!} - {!!$jornada->horas_semanales!!} horas</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="Departamento">Departamento <code>*</code></label>
                            <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            style="width: 100%;"  id="id_depto" name="id_depto">
                                @foreach ($departamentos as $depto)
                                    <option value="{!!$depto->id!!}">{!!$depto->nombre_departamento!!}</option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="col-xl-6">
                            <label for="Departamento">Jefes <code>*</code></label>
                            <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            style="width: 100%;"  id="jefes" name="jefes">
                                @foreach ($departamentos as $depto)
                                    <option value="{!!$depto->id!!}">{!!$depto->nombre_departamento!!}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fa fa-ban"
                    aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary"
                    onClick="guardarCategoria('#registroForm','#notificacion','{{ route('empleadoCat') }}')">
                    <li class="fa fa-save"></li> Guardar
                </button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalCategoria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class="dripicons-briefcase  mdi-36px"></i> Empleado Categoria</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('empleadoCatReg') }}" id="empleadoCatReg" 
                    method="POST" class="px-3">
                    @csrf
                    <input type="hidden" id="_idCat" name="_id" value=""/>
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacionCat">
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Nota: <code>* Campos Obligatorio</code></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="form-group">
                                <label for="">Categoria <code>*</code></label>
                                <input type="text" class="form-control" name="categoria" placeholder="Digite la categoria">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" class="btn btn-primary form-control"
                                    onClick="submitForm('#empleadoCatReg','#notificacionCat')">
                                    <li class="fa fa-save"></li> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row p-3">
                    <div class="col-xl-12">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-sm-1 text-center">#</th>
                                    <th>Categoria</th>
                                    <th class="col-sm-1 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="catbody">
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($categorias as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{!!$item->categoria!!}</td>
                                        <td>Acciones</td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fa fa-ban"
                    aria-hidden="true"></i> Cerrar</button>
            </div>
      </div>
    </div>
</div>
<!--fin modal de registro-->

<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>
            </div>
            <h4 class="page-title">&nbsp;</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row py-2">
                <div class="col-lg-10 order-first">
                    <h3>
                        Empleados
                    </h3>
                </div>
                <div class="col-lg-2 order-last text-right">
                    <!-- Button trigger modal -->
                    <div class="btn-group" role="group">
                        <button type="button" title="Agregar Categoria"
                            class="btn dripicons-briefcase btn-success mr-1 rounded font-18"
                            data-toggle="modal" data-target="#modalCategoria">
                        </button>
                        <button type="button" title="Agregar Empleado"
                            class="btn btn-primary dripicons-plus rounded"
                            data-toggle="modal" data-target="#modalRegistro">
                        </button>
                        
                    </div>
                </div>                
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th data-priority="1" class="col-sm-1">#</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="3">Correo</th>
                    <th data-priority="3" class="col-sm-1 text-center">Estado</th>
                    <th data-priority="1" class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
               
                @foreach ($empleados as $item)
                <tr>
                    @php
                        $i++;
                    @endphp
                    <th class="align-middle " style="width: 10%">{!!$i!!}</th>
                    <td class="align-middle ">{!!$item->apellido.','.$item->nombre!!}</td>
                    <td class="align-middle ">{!!$item->nit!!}</td>
                    <td class="align-middle font-16">{!! !$item->estado?'<span class="badge badge-danger">Desactivado</span> ' : '<span class="badge badge-success">Activado</span> ' !!}</td>
                    <td class="align-middle ">
                        <div class="row">
                            <div class="col text-center">
                                <div class="btn-group" role="group">
                                    <button title="Editar" class="btn btn-outline-primary btn-sm rounded" onclick="">
                                        <i class="fa fa-edit font-16" aria-hidden="true"></i>
                                    </button>
                                    <button title="{!! !$item->estado ? 'Activar' : 'Desactivar' !!}" 
                                        class="btn btn-outline-primary btn-sm mx-1 rounded {!! $item->estado?'btn-outline-danger' : 'btn-outline-success' !!}" 
                                        data-toggle="modal" data-target="#modalAlta">
                                        {!! !$item->estado ? '<i class="mdi  mdi mdi-arrow-up-bold   font-18"></i>'
                                                            :'<i class="mdi  mdi mdi-arrow-down-bold font-18"></i>'!!}
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

@endsection

@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
@endsection

@section('plugins-js')

<!-- Bootstrap Select -->
<script src="{{ asset('/template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" defer></script>

<script src="{{ asset('js/scripts/http.min.js') }} " defer></script>
<script src="{{ asset('js/scripts/data-table.js') }}" defer></script>

<script>
    function cargarCategoria(url){
        $('#catbody').html();
        $.get(url,function(json){
            json=JSON.parse(json); 
            $html = '';
            for(var i in json){
                $html = <td></td>json[i].categoria;
            }
            
            $('#roles').trigger('change');
        });
    }
    
    function guardarCategoria(formulario,notificacion,url){
        $.ajax({
            type: $(formulario).attr('method'),
            url: $(formulario).attr('action'),
            dataType: "html",
            data: new FormData(document.getElementById(formulario.replace('#',''))),
            processData: false,
            contentType: false,
            error : function(jqXHR, textStatus){
                if (jqXHR.status === 0) {

                    errorServer(notificacion,'No conectar: ​​Verifique la red.');

                } else if (jqXHR.status == 404) {

                    errorServer(notificacion,'No se encontró la página solicitada [404]');

                } else if (jqXHR.status == 500) {

                    errorServer(notificacion,'Error interno del servidor [500].');

                } else if (textStatus === 'parsererror') {

                    errorServer(notificacion,'Error al analizar JSON solicitado.');

                } else if (textStatus === 'timeout') {

                    errorServer(notificacion,'Error de tiempo de espera.');

                } else if (textStatus === 'abort') {

                    errorServer(notificacion,'Solicitud de Ajax cancelada.');

                } else {

                    errorServer(notificacion,'Error no detectado: ' + jqXHR.responseText);
                }
                $('.modal').scrollTop($('.modal').height());
            },beforeSend:function(jqXHR, textStatus){
                $(notificacion).removeClass().addClass('alert alert-info bg-info text-white border-0').html(''
                        +'<div class="row">'
                        +'    <div class="col-lg-1 px-2">'
                        +'        <div class="spinner-border text-white m-2" role="status"></div>'
                        +'    </div>'
                        +'    <div class="col-lg-11 align-self-center" >'
                        +'      <h3 class="col-xl text-white">Cargando...</h3>'
                        +'    </div>'
                        +'</div>'
                    ).show();
                    $('.modal').scrollTop(0);
                    disableform(formulario);
            },
        }).then(function(data) {

            data = JSON.parse(data);
            if(data.error!=null){

                $(notificacion).removeClass().addClass('alert alert-danger bg-danger text-white border-0');
                $errores = '';
                for (let index = 0; index < data.error.length; index++) {
                    $error = '<li>'+data.error[index]+'</li>';
                    $errores +=$error;
                }

                $(notificacion).html('<h4 Class = "text-white">Completar Campos:</h4>'
                    +'<div class="row">'
                    +'<div class="col-lg-9 order-firts">'
                    +'<ul>'+$errores+'</ul>'
                    +'</div>'
                    +'<div class="col-lg-3 order-last text-center">'
                    +'<li class="fa fa-exclamation-triangle fa-5x"></li>'
                    +'</div>'
                    +'</div>'
                ).show();
                enableform(formulario);

            }else{
                if(data.mensaje!=null && data.error==null){
                    $(notificacion).removeClass().addClass('alert alert-success bg-success text-white ').html(''
                        +'<div class="row">'
                            +'<div class="col-xl-11 order-last">'
                                +' <h3 class="col-xl text-white">'+data.mensaje+'</h3>'
                            +'</div>'
                            +'<div class="col-xl-1 order-firts">'
                                +'<i class="fa fa-check  fa-3x"></i>'
                            +'</div>'
                        +'</div>'
                    ).show();
                    $(formulario)[0].reset();
                    cargarCategoria(url);
                }
            }
            $('.modal').scrollTop(0);
        });
    }
</script>
@endsection