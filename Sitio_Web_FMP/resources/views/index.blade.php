@extends('Pagina/base')
@extends('MensajesToast/notificacionesErrores')

@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">
@auth
<!-- Este css se carga nada mas cuando esta logeado un usuario-->
<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />

<!-- Summernote css -->
<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
@endauth

<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v11.0" nonce="qj9mH20N"></script>

<!--Libreria data table para paginacion de noticias-->
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box color-boton py-2 rounded">
            <a class="page-title text-white h2" href="{{ route('index') }}">Facultad Multidisciplinaria Paracentral</a>
        </div>         
        <div class="my-4"></div>
        <!-- end page title -->               

        <div class="row">
            <div class="col-xl-8">
                <div class="row">                    
                    <div class="col-xl-12">
                        <div class="card-box">
                            <div class="row py-1">
                                <div class="col order-first "><h3>Facultad Multidisciplinaria Paracentral</h3></div>
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
                                                
                                                <form action="{{ route('ImagenFacultad.subir', ['tipo'=>1]) }}" method="post"
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
                                @if (count($imgCarrusel) == '0')
                                    <p class="p-2 mx-2 border text-center btn-block"> No hay imagenes para mostrar.</p>
                                @else
                                <div id="carouselExampleCaptions" class="carousel slide rounded col-xl-12" data-ride="carousel">
                                    <ol class="carousel-indicators">  
                                        @for ($i = 0; $i < count($imgCarrusel); $i++)
                                            @if ($i == 0 )
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active"></li>
                                            @else                                        
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" ></li>
                                            @endif
                                        @endfor                               
                                    </ol>
                                    <div class="carousel-inner">
                                        @for ($i = 0; $i < count($imgCarrusel); $i++)            
                                            @if ($i == 0 )
                                                <div class="carousel-item active">
                                                    @auth
                                                        <form method="POST" action="{{ asset('/borrar') }}/{{$imgCarrusel[$i]->id}}/{{$imgCarrusel[$i]->imagen}}" id="{{$imgCarrusel[$i]->imagen}}">
                                                            @csrf                                                   
                                                            <button type="submit" class="btn text-white btn-danger btn-block">
                                                                <div class=" mdi mdi-delete mdi-16px text-center">Eliminar</div>
                                                            </button>
                                                        </form>
                                                    @endauth                                              
                                                    <img src="images/carrusel/{{$imgCarrusel[$i]->imagen}}" class="img-fluid" width="100%" alt="{!!$imgCarrusel[$i]->imagen!!}">                      
                                                </div>
                                            @else                                        
                                                <div class="carousel-item">
                                                    @auth
                                                    <form method="POST" 
                                                    action="{{ asset('/borrar') }}/{{$imgCarrusel[$i]->id}}/{{$imgCarrusel[$i]->imagen}}" id="{{$imgCarrusel[$i]->imagen}}">
                                                        @csrf
                                                        <button type="submit" class="btn text-white btn-danger btn-block">
                                                            <div class=" mdi mdi-delete mdi-16px text-center">Eliminar</div>
                                                        </button>
                                                    </form>
                                                    @endauth  
                                                    <img src="images/carrusel/{{$imgCarrusel[$i]->imagen}}" class="img-fluid" width="100%" alt="{!!$imgCarrusel[$i]->imagen!!}">                                
                                                </div> 
                                            @endif        
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
                        </div>  <!-- end card-box-->
                    </div> <!-- end col -->
                    <div class="col-xl-12" id="noticias">
                        <div class="card-box"> 
                            <div class="row">
                            <div class="col-xl order-first">
                                <h3>Noticias</h3>
                            </div>                     
                            @auth
                                <div class="col-lg-3 order-last">
                                    <!-- Button trigger modal noticia-->
                                    <button type="button" class="btn btn-block btn-info waves-effect waves-light" 
                                    data-toggle="modal" data-target="#myModalNoticia">
                                        <i class="mdi mdi-bulletin-board mdi-16px"></i> Nueva Noticia
                                    </button>
                                </div>  
                                <!-- noticia modal content -->
                                <div id="myModalNoticia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                
                                                <h3 class="modal-title"> <i class="mdi mdi-bulletin-board mdi-24px" aria-hidden="true"></i> Noticia</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                                            </div>
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#agronomica" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                        Local
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#industrial" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                        Externa
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="modal-body">

                                                <div class="tab-content">
                                                    
                                                    <div class="tab-pane show active" id="agronomica" >
                                                        <form method="POST" 
                                                        action="{{ route('NoticiaFacultad.nueva') }}" 
                                                        class="parsley-examples"
                                                        enctype="multipart/form-data" id="noticiaForm">
                                                        <input type="hidden" id="_id_local" name="_id_local"/>
                                                        @csrf
                                                        
                                                        <div class="alert alert-primary text-white" 
                                                            role="alert" style="display:none" id="notificacionMaestrias">                                               
                                                        </div>
                                                        <div class="row">
                                                            
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label>Titulo</label>
                                                                    <input type="text" class="form-control" required
                                                                            placeholder="Titulo Noticia (Obligatorio)"
                                                                            name="titulo" id="titulo"/>
                                                                </div> 
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label>SubTitulo</label>
                                                                    <input type="text" class="form-control" required
                                                                            placeholder="Sub-Titulo Noticia (Obligatorio)"
                                                                            name="subtitulo" id="subtitulo"/>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label>Imagen</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" value=" " class="custom-file-input form-control" accept="image/*"  name="img" id="img"  lang="es">
                                                                        <label class="custom-file-label" for="customFile">Seleccionar imagen</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>       
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                
                                                                <div class="form-group">                                               
                                                                    <label for="contenido">Contenido <code>*</code></label>
                                                                    <textarea value=" " class="form-control summernote-config" name="contenido" id="contenido" rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>         
                                                        <div class="form-group mb-0">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                    <li class="fa fa-save"></li> Guardar
                                                                </button>
                                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">
                                                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>                    
                                                    </div>
                                                    <div class="tab-pane" id="industrial">
                                                        <form method="POST" 
                                                    action="{{ route('NoticiaFacultad.nuevaurl') }}" 
                                                    class="parsley-examples"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" id="_id_externa" name="_id_externa"/>
                                                    @csrf
                                                    
                                                    <div class="alert alert-primary text-white" 
                                                        role="alert" style="display:none" id="notificacionMaestrias">                                               
                                                    </div>
                                                    <div class="row">
                                                        
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Titulo</label>
                                                                <input type="text" class="form-control" required
                                                                        placeholder="Titulo Noticia (Obligatorio)"
                                                                        name="titulo" />
                                                            </div> 
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>SubTitulo</label>
                                                                <input type="text" class="form-control" required
                                                                        placeholder="Sub-Titulo Noticia (Obligatorio)"
                                                                        name="subtitulo" />
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Imagen</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="img" id="customFileLang" lang="es">
                                                                    <label class="custom-file-label" for="customFile">Seleccionar imagen</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Url de la fuente</label>
                                                                <div>
                                                                    <input parsley-type="url" type="url" class="form-control"
                                                                             placeholder="URL Fuente (Opcional)"
                                                                             name="urlfuente" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>             
                                                    <div class="form-group mb-0">
                                                        <div>
                                                            <button id="noticiaUrl" type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                <li class="fa fa-save"></li> Guardar
                                                            </button>
                                                            <button  type="button" class="btn btn-light waves-effect" data-dismiss="modal">
                                                                <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>                
                                                    </div>
                                                </div>
                                            </div>                                    
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->                          
                            @endauth     
                            </div>
                            @if (count($noticias))                                
                                <table id="dtNoticias" class="table table-borderless  btn-table table-sm table-responsive-md" cellspacing="0" width="100%">
                                    <thead id="dtNoticiasthead">
                                      <tr>
                                        <th>             
                                        </th>                   
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noticias as $n)
                                        <tr>
                                            <td>
                                                <div class="border p-1 rounded media">
                                                    <img class="mr-3 mt-1 rounded bx-shadow-lg" src="{{ asset('/') }}images/noticias/{{$n->imagen}}"
                                                    alt="Generic placeholder image" height="80" width="110">
                                                    <div class="media-body" style="width: 20em">
                                                        <h5 class="mt-0">{{$n->titulo}}</h5>
                                                        <h6>{!!$n->subtitulo!!}</h6>
                                                        <p>{!!mb_strwidth(strip_tags($n->contenido), 'UTF-8') <= 125?strip_tags($n->contenido):rtrim(mb_strimwidth(strip_tags($n->contenido), 0, 125, '', 'UTF-8')).'...'!!}</p>
                                                    </div>
                                                    <div class="btn-group-vertical" role="group">
                                                    @if ($n->tipo)
                                                        <a href="{{ asset('/noticias') }}/{!!base64_encode($n->id)!!}/{!!base64_encode($n->titulo)!!}"
                                                           
                                                        class="btn btn-light waves-effect width-md  @guest mt-5 @endguest">Leer más <i class="mdi mdi-send ml-2"></i></a>
                                                        @auth
                                                        <button type="button"  class="btn btn-light waves-effect width-md">
                                                         <i class="mdi mdi-file-document-edit mdi-16p"></i> Modificar
                                                        </button>
                                                        @endauth
                                                    @else
                                                        <a href="{!!$n->urlfuente!!}"
                                                            class="btn btn-light waves-effect width-md @guest mt-5 @endguest">Leer más <i class="mdi mdi-send ml-2"></i></a>
                                                        @auth
                                                        <span data-toggle="modal" data-target="#myModalNoticia">
                                                            <a href="javascrip" class="btn btn-light waves-effect width-md" >
                                                                <i class="mdi mdi-file-document-edit mdi-16p"></i> Modificar</a>
                                                        </span>
                                                        @endauth
                                                    @endif
                                                    
                                                    @auth 
                                                        <form action="{{ route('NoticiaFacultad.borrar',['id'=>base64_encode($n->id)]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-light waves-effect width-md btn-block"><i class="mdi mdi-delete"></i> Eliminar</button>
                                                        </form>                                  
                                                    @endauth      
                                                </div>                          
                                                </div>
                                            </td>                      
                                        </tr>   
                                        @endforeach                
                                    </tbody>
                                </table>      
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
                                @else
                                <p class="p-2 border text-center">No hay noticias para mostrar.</p>
                                 @endif   
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>

            </div>
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-xl-12"><h3>Siguenos en Facebook</h3></div>
                                <div class="col-xl-12" style="overflow: auto;">
                                    <div class="fb-page" data-href="https://www.facebook.com/Facultad-Multidisciplinaria-Paracentral-Decanato-104296228519520"  data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Facultad-Multidisciplinaria-Paracentral-Decanato-104296228519520/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Facultad-Multidisciplinaria-Paracentral-Decanato-104296228519520/">Facultad Multidisciplinaria Paracentral - Decanato</a></blockquote></div>
                                </div>                                                                                                                
                            </div>                                                         
                        </div>
                    </div><!-- end col-->
                    <div class="col-xl-12" >                        
                        <div class="card-box"> 
                            <h3>Canales Digitales</h3>                    
                            <a href="https://campus.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left">Campus Virtual</a>
                            <a href="https://eel.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left">Expediente en Linea</a>                      
                            <a href="https://correo.ues.edu.sv/" class="btn btn-danger  btn-block mt-3 text-left">Correo Institucional</a>                           
                            <a href="https://www.facebook.com/DistanciaFMP" class="btn btn-danger  btn-block mt-3 text-left">Universidad en Linea / Sede Paracentral</a> 
                            <a href="https://www.facebook.com/celeues" class="btn btn-danger btn-block mt-3 text-left">CELEUES</a>
                        </div> <!-- end card-box-->                        
                    </div> <!-- end col-->        
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card-box"> 
                    <h3>Sitios de Interes</h3>                         
                    
                    <div class="row">
                        <div class="col order-first">
                            <p class="header-title">Facultades</p>                                   
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="http://www.fmoues.edu.sv/">Facultad Multidisciplinaria de Oriente</a></div>
                            <div class="p-1"><a href="http://www.fia.ues.edu.sv/">Facultad de Ingeniería y Arquitectura</a></div>
                            <div class="p-1"><a href="https://www.agronomia.ues.edu.sv/">Facultad de Agronomía</a></div>
                            <div class="p-1"><a href="http://www.odontologia.ues.edu.sv/">Facultad de Odontología</a></div>
                            <div class="p-1"><a href="http://www.medicina.ues.edu.sv/">Facultad de Medicina</a></div>
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="http://jurisprudencia.ues.edu.sv/sitio/">Facultad de Jurisprudencia y Ciencias Sociales</a></div>
                            <div class="p-1"><a href="https://www.quimicayfarmacia.ues.edu.sv/">Facultad de Química y Farmacia</a></div>
                            <div class="p-1"><a href="https://www.cimat.ues.edu.sv/">Facultad de Ciencias Naturales y Matemática</a></div>
                            <div class="p-1"><a href="http://www.occ.ues.edu.sv/">Facultad Multidisciplinaria de Occidente</a></div>
                            <div class="p-1"><a href="http://www.fce.ues.edu.sv/">Facultad de Ciencias Económicas</a></div>
                        </div>
                        <div class="col">
                            <p class="header-title">Secretarias</p>     
                            <div class="p-1"><a href="http://secretariageneral.ues.edu.sv/">Secretaría General</a></div>
                            <div class="p-1"><a href="http://proyeccionsocial.ues.edu.sv/">Secretaría de Proyección Social</a></div>
                            <div class="p-1"><a href="http://www.eluniversitario.ues.edu.sv/">Secretaría de Comunicaciones</a></div>
                            <div class="p-1"><a href="https://es-es.facebook.com/ArteyCulturaUES/">Secretaría de Arte y Cultura</a></div>
                            <div class="p-1"><a href="http://www.bienestar.ues.edu.sv/">Secretaría de Bienestar Universitario</a></div>
                            <div class="p-1"><a href="http://www.ues.edu.sv/secretaria-de-relaciones-nacionales-e-internacionales/">Secretaría de Relaciones</a></div>
                            <div class="p-1"><a href="https://secplan.ues.edu.sv/">Secretaría de Planificación</a></div>
                            <div class="p-1"><a href="https://sic.ues.edu.sv/">Secretaría de Investigaciones Científicas</a></div>
                            <div class="p-1"><a href="http://saa.ues.edu.sv/portal/">Secretaría de Asuntos Académicos</a></div>
                        </div>
                        <div class="col order-last">
                            <p class="header-title">Institución</p>
                            <div class="p-1"><a href="https://www.ues.edu.sv/becas/">Consejo de Becas</a></div>                            
                            <div class="p-1"><a href="#">Consejo Superior Universitario</a></div>
                            <div class="p-1"><a href="#">Asamblea General Universitaria</a></div>
                            <div class="p-1"><a href="https://www.uese.ues.edu.sv/">Unidad de Estudio Socioeconómico </a></div>
                            <div class="p-1"><a href="https://www.facebook.com/defensoriaues/">Defensoría de los Derechos Universitarios</a></div>                            
                        </div>
                    </div>                            
                </div> <!-- end card-box -->
            </div><!-- end col -->

            
        </div>
        <!-- end row -->
    </div> <!-- end container -->
</div>   


<!-- end wrapper -->
@endsection

@section('footerjs')

<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }}"></script>

<!--Librerias js para datatable-->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@auth  
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/summernote.config.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>  
<script src="{{ asset('js/scripts/http.min.js') }}"></script>

<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>


<script src="{{ asset('js/index/index.datatable.js') }}"></script>


<script>
    
    /*$(document).ready(function () {    
        $("#noticia").onclick(function () {
            var value = document.getElementById("noticia").value;                      
        });
    });*/
    $(document).ready(function () {    
        $("#noticiaEditar").click(function () {          
            document.getElementById('myform').reset();
        });
        
        $("#noticiaUrlEditar").click(function () {          
            document.getElementById('myform').reset();
        });
    });
</script> 

<script>
    
    </script>

<script>
    /*Carga del model con los datos de la noticia actual */
    function modificarNoticia(titulo, subtitulo, fuente, urlfuente, contenido, img){
        document.getElementById("titulo").value = titulo;
        document.getElementById("subtitulo").value = subtitulo;
        document.getElementById("fuente").value = fuente;
        document.getElementById("urlfuente").value = urlfuente;
        document.getElementById("contenido").value = contenido.replace(new RegExp("<br/>","g") ,"\n");
    }
    /*Carga el model con las noticias de url con noticias externas*/
    function modificarNoticiaUrl(){

    }
</script>
@endauth

@endsection