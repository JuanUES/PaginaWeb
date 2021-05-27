@extends('pagina/base')

@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    carousel-inner > .item > img {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
    }
</style>
@endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-alt-bg color-top"></div>
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div>         
        <div class="my-4"></div>
        <!-- end page title -->               

        <div class="row">
            <div class="col-xl-8">
                <div class="card-box">
                    <div class="row py-1">
                        <div class="col order-first "><h1 class="header-title mb-3">Facultad Multidisciplinaria Paracentral</h1></div>
                        @auth
                        <div class="col-lg-3 order-last">
                            <a href="" class="btn btn-block btn-info tex-left" 
                            data-toggle="modal" data-target=".bs-example-modal-center">
                                <div class="mdi mdi-upload mdi-16px text-center"> Agregar Imagen</div>
                            </a>
                        </div>                            
                        @endauth

                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imagenes</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <form action="{{ route('ImagenFacultad.subir') }}" method="post"
                                         class="dropzone" id="dropzone">
                                            @csrf                                 
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                <h3>Suelta los archivos aquí o haz clic para subir.</h3>
                                            </div>
                                            <div class="dropzone-previews"></div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    <div class="row">                        
                        @if (count($imgCarrusel) == '0')
                            <p class="text-center"> Carrusel vacío, por favor ingrese imagenes o fotos</p>
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
            
            <div class="col-xl-4">
                <div class="card-box">
                    <div class="fb-page" data-href="https://www.facebook.com/Facultad-Multidisciplinaria-Paracentral-Decanato-104296228519520/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/Facultad-Multidisciplinaria-Paracentral-Decanato-104296228519520/" class="fb-xfbml-parse-ignore"><a href="https://es-la.facebook.com/academicaparacentralues">Académica Paracentral - UES</a>
                    </blockquote>
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card-box"> 
                    <div class="row">
                    <div class="col-xl order-first"><h1 class="header-title mb-3">Noticias</h1></div>                     
                    @auth
                        <div class="col-lg-3 order-last">
                            <!-- Button trigger modal noticia-->
                            <button type="button" class="btn btn-block btn-primary waves-effect waves-light" 
                            data-toggle="modal" data-target="#myModalNoticia">
                            <div class=" mdi mdi-bulletin-board mdi-16px"> Nueva Noticia</div>
                        </button>
                        </div>  
                        <!-- noticia modal content -->
                        <div id="myModalNoticia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <ul class="nav nav-tabs nav-bordered">
                                            <li class="nav-item">
                                                <a href="#agronomica" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    Nueva Noticia de FMP
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#industrial" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                    Nueva Noticia Externa
                                                </a>
                                            </li>
                                        </ul>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="agronomica" >
                                                <form method="POST" 
                                        action="{{ route('NoticiaFacultad.nueva') }}" 
                                        class="parsley-examples"
                                        enctype="multipart/form-data">
                                            @csrf
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
                                                        <label>Sub-Titulo</label>
                                                        <input type="text" class="form-control" required
                                                                placeholder="Sub-Titulo Noticia (Obligatorio)"
                                                                name="subtitulo" id="subtitulo"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Fuente</label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Fuente Noticia (Opcional)"
                                                                name="fuente" id="fuente"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Url de la fuente</label>
                                                        <div>
                                                            <input parsley-type="url" type="url" class="form-control"
                                                                     placeholder="URL Fuente (Opcional)"
                                                                     name="urlfuente" id="urlfuente"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label>Imagen o Foto </label>
                                                        <input type="file"  accept="image/*" class="form-control" name="img" id="img"/>
                                                    </div>
                                                </div>
                                            </div>       
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label>Contenido</label>
                                                        <div>
                                                            <textarea required class="form-control" name="contenido"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>         
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Crear Noticia
                                                    </button>
                                                    <button type="reset" class="btn btn-light waves-effect">
                                                        Cancelar
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
                                            @csrf
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
                                                        <label>Sub-Titulo</label>
                                                        <input type="text" class="form-control" required
                                                                placeholder="Sub-Titulo Noticia (Obligatorio)"
                                                                name="subtitulo" id="subtitulo"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Imagen o Foto </label>
                                                        <input type="file"  accept="image/*" class="form-control" name="img" id="img"/>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Url de la fuente</label>
                                                        <div>
                                                            <input parsley-type="url" type="url" class="form-control"
                                                                     placeholder="URL Fuente (Opcional)"
                                                                     name="urlfuente" id="urlfuente"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>             
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Crear Noticia
                                                    </button>
                                                    <button type="reset" class="btn btn-light waves-effect">
                                                        Cancelar
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
                    @foreach ($noticias as $n)
                    <div class="border my-1 py-1 rounded p-1 my-1 media">
                        <img class="mr-3 rounded bx-shadow-lg" src="images/noticias/{{$n->imagen}}"
                         alt="Generic placeholder image" height="80" width="110">
                        <div class="media-body">
                            <h5 class="mt-0">{{$n->titulo}}</h5>
                            {!!$n->subtitulo!!}
                           <!-- {!! $n->contenido !!}-->
                        </div>
                        @auth
                            <a href="#" class="btn btn-light mt-3">Editar</a>
                        @endauth
                        @if ($n->tipo)
                            <a href="{{ asset('/noticias') }}/{!!base64_encode($n->id)!!}/{!!base64_encode($n->titulo)!!}"
                               class="btn btn-light mt-3 mx-1">Leer más</a>
                        @else
                            <a href="{!!$n->urlfuente!!}"
                                class="btn btn-light mt-3 mx-1">Leer más</a>
                        @endif
                        
                    </div>  
                    @endforeach
                    
                </div> <!-- end card-box -->
            </div><!-- end col -->

            <div class="col-xl-4" >                        
                <div class="card-box container-fluid "> 
                    <h1 class="header-title mb-3">Canales Digitales</h1>                    
                    <a href="https://campus.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left">Campus Virtual</a>
                    <a href="https://eel.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left">Expediente en linea</a>                      
                    <a href="https://correo.ues.edu.sv/" class="btn btn-danger  btn-block mt-3 text-left">Correo institucional</a>                           
                    <a href="https://www.facebook.com/DistanciaFMP" class="btn btn-danger  btn-block mt-3 text-left">Universidad en linea / Cede Paracentral</a> 
                    <a href="https://www.facebook.com/celeues" class="btn btn-danger btn-block mt-3 text-left">CELEUES</a>
                </div> <!-- end card-box-->                        
            </div> <!-- end col-->
            
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card-box"> 
                    <h1 class="header-title mb-3 ">Sitios de interes</h1>                         
                    
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
                            <p class="header-title">Instituciones</p>
                            <div class="p-1"><a href="#">Consejo Superior Universitario</a></div>
                            <div class="p-1"><a href="#">Asamblea General Universitaria</a></div>
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
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v10.0" nonce="sQ6sREaG"></script>
<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }}"></script>
<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>

<script>
   Dropzone.options.dropzone = {
       
       success: function(response){
           console.log(response);
       }
   }
</script>
@endsection