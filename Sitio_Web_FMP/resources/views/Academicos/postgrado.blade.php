@extends('Pagina/baseOnlyHtml')

@section('header')
@auth
    <!-- Summernote css -->
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
    
    <!-- Este css se carga nada mas cuando esta logeado un usuario-->
    <link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />

@endauth    
@endsection

@section('footer')
    @auth    
    <script src=" {{ asset('js/scripts/postgrado.js') }} "></script>

    <script>
        function editarMaestria(id){$json = {!!json_encode($maestrias)!!}.find(x => x.id==id);editar($json);}
    </script>

    <!-- Plugins js -->
    <script src=" {{ asset('js/dropzone.min.js') }} "></script>
   
    <!--Summernote js-->
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/summernote.config.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
    <script src="{{ asset('js/scripts/http.min.js') }}"></script>
    @endauth    
@endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div>         
        <div class="my-3"></div>
        <!-- end page title -->
        <div class="card-box"> 
            <div class="row">
                <div class="col-xl-8 px-3">
                    <div class="tab-content pt-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="indexPostgrado" role="tabpanel">
                            <div class="row py-1">
                                <div class="col order-first ">
                                    <h3 class="my-1">Postgrado</h3>
                                    <div class="row py-1">
                                        <div class="col order-first">
                                            <h4>Aviso de Convocatoria de Ingresos</h4>
                                        </div>
                                        @auth
                                        <div class="col-lg-3 order-last">
                                            <a href="" class="btn btn-block btn-info tex-left" 
                                            data-toggle="modal" data-target=".bs-example-modal-center">
                                                <div class="mdi mdi-upload mdi-16px text-center"> Agregar Imagen</div>
                                            </a>
                                        </div>                            
                                              
                                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imágenes</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <form action="{{ route('ConvocatoriaPostgrado', ['tipo'=>2]) }}" method="post"
                                                        class="dropzone" id="my-awesome-dropzone">
                                                            @csrf                                 
                                                            <div class="dz-message needsclick">
                                                                <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                                <h3>Suelta los archivos aquí o haz clic para subir.</h3>
                                                            </div>
                                                            <div class="dropzone-previews"></div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        @endauth  
                                    </div>
                                    
                                    <div class="row">                        
                                        @if (count($imagenConvocatoria) == '0')
                                            <p class="p-2 mx-2 border text-center btn-block"> No hay imagenes para mostrar.</p>
                                        @else
                                        <div id="carouselExampleCaptions" class="carousel slide rounded col-xl-12" data-ride="carousel">
                                            <ol class="carousel-indicators">  
                                                @for ($i = 0; $i < count($imagenConvocatoria); $i++)
                                                    @if ($i == 0 )
                                                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active"></li>
                                                    @else                                        
                                                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" ></li>
                                                    @endif
                                                @endfor                               
                                            </ol>
                                            <div class="carousel-inner">
                                                @for ($i = 0; $i < count($imagenConvocatoria); $i++)            
                                                                                        
                                                    <div class="carousel-item {!!$i == 0 ? 'active': null!!}">
                                                        @auth
                                                        <form method="POST" 
                                                        action="{{ asset('/borrar') }}/{{$imagenConvocatoria[$i]->id}}/{{$imagenConvocatoria[$i]->imagen}}" id="{{$imagenConvocatoria[$i]->imagen}}">
                                                            @csrf
                                                            <button type="submit" class="btn text-white btn-danger btn-block">
                                                                <div class=" mdi mdi-delete mdi-16px text-center">Eliminar</div>
                                                            </button>
                                                        </form>
                                                        @endauth  
                                                        <img src="images/carrusel/{{$imagenConvocatoria[$i]->imagen}}" class="img-fluid" width="100%" height="60%" alt="{!!$imagenConvocatoria[$i]->imagen!!}">                                
                                                    </div>  
                                            @endfor 
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Siguiente</span>
                                            </a>
                                        </div>    
                                        @endif
                                        <!-- end col -->
                                    </div> <!-- end row-->
                                </div>
                            </div>         
                        </div>
                        @foreach ($maestrias as $m)
                        <div class="tab-pane fade" id="{!!str_replace (' ','',$m->nombre)!!}" role="tabpanel">
                            <div class="btn-group" role="group">
                                <a class="nav-link btn btn-danger waves-effect width-md" href="#indexPostgrado"
                                    onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Postgrado
                                </a>
                                @auth                                 
                                    <button class="btn btn-light waves-effect width-md" data-toggle="modal" data-target="#myModalMaestria"
                                        onclick="editarMaestria({!!$m->id!!})">
                                        Modificar
                                    </button>
                                    <form action="{{ route('estadoMaestria') }}" method="POST" id="activarDesactivar"
                                     style="display: none;" class="parsley-examples" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name='_id' value="{!!base64_encode($m->id)!!}">
                                    </form>
                                    <button class="btn btn-light waves-effect width-md" onclick="submitActivarDesactivar(this,'#activarDesactivar')">
                                        {!!$m->estado?'Desactivar':'Activar'!!}
                                    </button>
                                    <button class="btn btn-light waves-effect width-md"  data-toggle="modal" data-target="#modalEliminar" onclick="eliminarMaestria('{!!base64_encode($m->id)!!}')">
                                        <i class="mdi mdi-delete mdi-16px"></i> Eliminar
                                    </button>
                                @endauth
                            </div>
                            <br>
                            <h3 class="py-3">{!!$m->nombre!!}</h3>     
                            <div class="table-responsive py-2 ">
                                <table class="table mb-0 table-bordered ">
                                    <tbody>
                                    <tr>
                                        <td><h5>Titulo a Obtener</h5><p>{!!$m->titulo!!}</p></td>
                                        <td><h5>Modalidad</h5><p>{!!$m->modalidad!!}</p></td>
                                        <td><h5>Duración</h5><p>{!!$m->duracion!!}</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5>No. de Asignaturas</h5><p>{!!$m->numero_asignatura!!} Asignaturas</p></td>
                                        <td><h5>Unidades Valorativas</h5><p>{!!$m->unidades_valorativas!!}</p></td>
                                        <td><h5>Precio</h5><p>{!!$m->precio!!}</p></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>                       
                            {!!$m->contenido!!}
                            <a><div class="mdi mdi-file-pdf mdi-24px align-top btn-outline-danger btn btn-lg my-2">Descargar</div></a>
                        </div>
                        @endforeach
                        <div id="modalEliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form action="{{ route('EliminarMaestria') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row py-3">
                                                <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                                                <div class="col-lg-10 text-black">
                                                    <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se elimina este registro de manera permanente, ¿Desea continuar?</h4>
                                                </div>
                                                <input type="hidden" name="maestria" id="maestria">
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <button type="submit" 
                                                        class="btn p-1 btn-light waves-effect waves-light btn-block font-18">
                                                        <i class="mdi mdi-check mdi-24px"></i>
                                                        Si
                                                    </button>
                                                </div>
                                                <div class="col-xl-6">
                                                    <button type="reset" class="btn btn-light p-1 waves-effect btn-block font-18" data-dismiss="modal" >
                                                        <i class="mdi mdi-block-helper mdi-16Spx  ml-auto" aria-hidden="true"></i>
                                                        No
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4 ">
                    @auth
                        <a class="btn btn-info btn-block text-white text-left  mb-2" data-toggle="modal" data-target="#myModalMaestria"><i class="dripicons-document"></i> Nueva Maestria</a>
                        <div id="myModalMaestria" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="myCenterModalLabel">
                                            <i class="fa fa-graduation-cap fa-5" aria-hidden="true"></i> Registro de Maestrias</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">                                        
                                        <div class="tab-content">
                                        <form method="POST" 
                                            action="{{ route('Postgrado.registro') }}" 
                                            class="parsley-examples"
                                            enctype="multipart/form-data"
                                            id="formMaestrias">
                                        
                                            <input type="hidden" id="_id" name="_id"/>
                                            @csrf
                                            
                                            <div class="alert alert-primary text-white" 
                                                role="alert" style="display:none" id="notificacionMaestrias">                                               
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-xl-12">
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input inputfile" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="nombre" >Nombre <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Nombre (Obligatorio)"
                                                                name="nombre" id="nombre"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="titulo">Título que otorga <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                    placeholder="Título que otorga (Obligatorio)"
                                                                name="titulo" id="titulo"/>
                                                    </div>
                                                </div>
                                            </div>      

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="modalidad">Modalidad <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Modalidad (Obligatorio)"
                                                                name="modalidad" id="modalidad"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="duracion">Duración <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Duración (Obligatorio)"
                                                                name="duracion" id="duracion"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="asignaturas">Número de asignaturas <code>*</code></label>
                                                        <input type="number" class="form-control" min="1"
                                                                placeholder="0"
                                                                name="asignaturas" id="asignaturas"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="unidades">Unidades valorativas <code>*</code></label>
                                                        <input type="number" class="form-control" min="1"
                                                                placeholder="0"
                                                                name="unidades" id="unidades"/>
                                                    </div>
                                                </div>
                                                
                                            </div>  

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="precio">Precio ($) <code>*</code></label>
                                                        <input type="text" class="form-control" placeholder="Precio (Obligatorio)"
                                                                name="precio" id="precio"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row py-1">
                                                <div class="col-xl-12">     
                                                    <div class="form-group">                                               
                                                        <label for="contenido">Contenido <code>*</code></label>
                                                        <textarea value="" class="form-control summernote-config" name="contenido" id="contenido"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="button" 
                                                            class="btn btn-primary waves-effect waves-light mr-1"
                                                            onclick="submitForm('#formMaestrias','#notificacionMaestrias')">
                                                        <li class="fa fa-save"></li>
                                                        Guardar
                                                    </button>
                                                    <button type="reset" class="btn btn-light waves-effect" data-dismiss="modal" >
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>       
                                        </div>
                                    </div>                                    
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal --> 
                    @endauth 
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        @if (count($maestrias)>0)
                        <h4>Maestrias</h4>
                        @endif                        
                        @foreach ($maestrias as $m)
                        <a class="nav-link mb-2 btn-outline-danger  border " data-toggle="pill" href="#{!!str_replace (' ','',$m->nombre)!!}" role="tab" 
                        aria-selected="false">
                                {!!$m->nombre!!}
                        </a>
                        @endforeach                                                
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection