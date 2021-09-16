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
        <form id="registroForm"  action="{{ route('EmpleadoReg') }}" method="POST">
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
                            <label for="fileE">Foto <code>*</code></label>
                            <label for="fileE">
                                <img  class="border rounded img-fluid" id="fotoE" >
                            </label>
                            <label for="fileE" class="centrado"><i class="mdi mdi-mouse font-20"></i> Click para subir foto</label>
                            <input type="file" id="fileE" accept="image/*">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="nombreE">Nombre <code>*</code></label>
                            <input type="text" class="form-control" id='nombreE' name="nombre"  autocomplete="off" placeholder="Digite el nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellidoE">Apellido <code>*</code></label>
                            <input type="text" class="form-control" id="apellidoE" name="apellido"  autocomplete="off" placeholder="Digite el apellido">
                        </div>
                        <div class="form-group">
                            <label for="duiE">DUI <code>*</code></label>
                            <input type="text" class="form-control" name="dui" id="duiE" placeholder="00000000-0" 
                                data-mask="00000000-0">
                        </div>
                        <div class="form-group">
                            <label for="nitE">NIT <code>*</code></label>
                            <input type="text" class="form-control" name="nit" id="nitE" data-mask="0000-000000-000-0"
                            placeholder="0000-000000-000-0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Teléfono <code>*</code></label>
                            <input type="tel" class="form-control" id="telE" name="telefono" data-mask="0000-0000"
                            placeholder="0000-0000">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Categoria <code>*</code></label>
                            <select class="selectpicker" id="categoriaE"
                                data-live-search="true" data-style="btn-white" name="categoria">
                                <option value="" selected>Seleccione</option>
                                @foreach ($categorias as $item)
                                <option value="{!!$item->id!!}">{!!$item->categoria!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="Departamento">Tipo Contrato <code>*</code></label>
                            <select  class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                    id="tipo_contratoE" name="tipo_contrato">
                            <option value="" selected>Seleccione</option>
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
                                id="tipo_jornadaE" name="tipo_jornada">
                                <option value="" selected>Seleccione</option>
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
                            id="deptoE" name="departamento">
                            <option value="" selected>Seleccione</option>
                            @foreach ($departamentos as $depto)
                                <option value="{!!$depto->id!!}">{!!$depto->nombre_departamento!!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6">
                        <label for="Departamento">Tipo Empleado <code>*</code></label>
                        <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            id="tipo_empleadoE" name="tipo_empleado">
                            <option name="" selected>Seleccione</option>
                           <option value="Administrativo">Administrativo</option>
                           <option value="Académico">Académico</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <label for="Departamento">Jefes y Empleados </label>
                        <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            id="jefe_empleadoE" name="jefe">
                            <option name="" selected>Seleccione</option>
                            @foreach ($empleados as $item)
                                <option name="{!!$item->id!!}">{!!$item->nombre.' '.$item->apellido!!}</option>
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
                    onClick="submitForm('#registroForm','#notificacion')">
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
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class="dripicons-briefcase  mdi-36px"></i> Categoria</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <div class="alert alert-primary alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacionCat">
                </div>
                <div class="alert  alert-primary alert-dismissible bg-danger  border-0 fade show"
                    role="alert" id="notificacionEliminar" style="display:none" >
                    <div class="row">
                        <div class="col-lg-10 order-firts">
                            <h4 class="text-white">El elemento de eliminara de nuestros registros, ¿continuar?.</h4>
                            <form action="{{ route('empleadoCatDest') }}" method="POST" id="eliminarCatForm">
                                @csrf
                                <input type="hidden" name="_id" id="idCat">
                                <div class="row">
                                    <div class="col-xl-6 p-1">
                                        <button  type="button" onclick="$('.alert').hide();
                                        httpCategoria('#eliminarCatForm','#notificacionCat');"
                                            class="btn my-1 mr-1 btn-danger border rounded waves-effect waves-light btn-block font-24">
                                            <i class="mdi mdi-check mdi-16px"></i>
                                            Si
                                        </button>
                                    </div>
                                    <div class="col-xl-6 p-1">
                                        <button type="button" onclick="$('.alert').hide();"
                                            class="btn my-1 btn-danger p-1 border rounded waves-light waves-effect btn-block font-24">
                                            <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                            No
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 order-last text-center text-white">
                            <li class="fa fa-exclamation-triangle fa-6x"></li>
                        </div>
                    </div>
                </div>
                <form action="{{ route('empleadoCatReg') }}" id="empleadoCatReg"
                    method="POST" class="px-3">
                    @csrf
                    <input type="hidden" id="_idCat" name="_id"/>

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
                                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Digite la categoria">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" class="btn btn-primary form-control"
                                    onClick="httpCategoria('#empleadoCatReg','#notificacionCat')">
                                    <li class="fa fa-save"></li> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row p-3">
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%" id="categoriaTb">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1" style="width: 5%;">#</th>
                                        <th class="col-xs-1" style="width: 90%;">Categoria</th>
                                        <th class="col-sm-1" style="width: 5%;">Acciones</th>
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
                                            <td>
                                                <div class="btn-group text-center" role="group">
                                                    <button onclick="editarCat({!!$item->id!!});"
                                                     title="Editar" class="btn btn-outline-primary mr-1 btn-sm rounded" onclick="">
                                                        <i class="fa fa-edit font-15" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Eliminar" class="btn btn-outline-danger btn-sm rounded"
                                                        onclick="eliminarCat({!!$item->id!!});">
                                                        <i class=" mdi mdi-trash-can-outline font-18" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
            <table class="table table-bordered" style="width: 100%;">
                <thead>
                <tr>
                    <th data-priority="1" class="col-sm-1">#</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="3" class="col-sm-1 text-center">Categoria</th>
                    <th data-priority="3" class="col-sm-1 text-center">Contrato</th>
                    <th data-priority="3" class="col-sm-1 text-center">Jornada</th>
                    <th data-priority="3" class="col-sm-1 text-center">Departamento</th>
                    <th data-priority="3" class="col-sm-1 text-center">Estado</th>
                    <th data-priority="1" class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
               @php
                   $i=0;
               @endphp
                @foreach ($empleados as $item)
                <tr>
                    @php
                        $i++;
                    @endphp
                    <th class="align-middle " style="width: 10%">{!!$i!!}</th>
                    <td class="align-middle ">{!!$item->nombre.' '.$item->apellido!!}</td>
                    <td class="align-middle ">{!!$item->categoria!!}</td>
                    <td class="align-middle ">{!!$item->contrato!!}</td>
                    <td class="align-middle ">{!!$item->jornada!!}</td>
                    <td class="align-middle ">{!!$item->departamento!!}</td>
                    <td class="align-middle font-16">{!! !$item->estado?'<span class="badge badge-danger">Desactivado</span> ' : '<span class="badge badge-success">Activado</span> ' !!}</td>
                    <td class="align-middle ">
                        <div class="row">
                            <div class="col text-center">
                                <div class="btn-group" role="group">
                                    <button title="Editar" class="btn btn-outline-primary btn-sm rounded" onclick="editar({{$item->id}})">
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
<style>
#fileE{
  display: none;
}
.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
.centrado{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
@endsection

@section('plugins-js')
<!-- Bootstrap Select -->
<script src="{{ asset('js/scripts/data-table.js') }}" ></script>
<script src="{{ asset('js/jquery.mask.js') }}" ></script>

<script>
    function editarCat(id){
        $.get('Empleado/categoriaGetObjeto/'+id,function(json){
            json=JSON.parse(json);
            $('#_idCat').val(json.id);
            $('#categoria').val(json.categoria);
        });
    }
    function eliminarCat(id){
        $('#idCat').val(id);
        $('#notificacionEliminar').show();
    }
    function cargarCategoria(){
        $.get('Empleado/Categoria',function(json){
            json=JSON.parse(json);
            var categoria = $('#categoriaTb').DataTable();
            categoria.clear();
            var id=1;
            for (var i in json) {
                var html = '';
                html += '<div class="btn-group text-center" role="group">';
                html += '<button onclick="editarCat('+json[i].id+');"';
                html += '    title="Editar" class="btn btn-outline-primary mr-1 btn-sm rounded">';
                html += '   <i class="fa fa-edit font-15" aria-hidden="true"></i>';
                html += '</button>';
                html += '<button title="Eliminar" class="btn btn-outline-danger btn-sm rounded" ';
                html += '    onclick="eliminarCat('+json[i].id+');">';
                html += '    <i class=" mdi mdi-trash-can-outline font-18" aria-hidden="true"></i>';
                html += '</button>';
                html += '</div>';
                categoria.row.add([id,json[i].categoria,html]).draw(false);
                id++;
            }
        });
    }
    function httpCategoria(formulario,notificacion){
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
                    enableform(formulario);
                    cargarCategoria();
                }
            }
            $('.modal').scrollTop(0);
        });
    }
    function editar(id){
        $.get('Empleado/'+id,
            function(json){
                $('#nombreE').val();
                $('#apellidoE').val();
                $('#duiE').val();
                $('#nitE').val();
                $('#telE').val();
                $('#categoriaE').val();
                $('#tipo_contratoE').val();
                $('#tipo_jornadaE').val();
                $('#deptoE').val();
                $('#tipo_empleadoE').val();
                $('#jefe_empleadoE').val();
            }
        );
    }
</script>

<script>
    // Obtener referencia al input y a la imagen
    const $fileE = document.querySelector("#fileE"),
    $fotoE = document.querySelector("#fotoE");
    const ancho = 370;
    const alto = 285;
    $('#fotoE').width(ancho); 
    $('#fotoE').height(alto);
    // Escuchar cuando cambie
    $fileE.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $fileE.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $fotoE.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $('#fotoE').width(ancho); // Unidades que se asumen en pixeles
        $('#fotoE').height(alto);
        $fotoE.src = objectURL;
    });
</script>

@endsection
