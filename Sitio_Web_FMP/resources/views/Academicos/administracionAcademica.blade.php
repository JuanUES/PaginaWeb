@extends('Pagina/base')

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
                                @if (0 == '0')
                                    <p class="p-2 mx-2 border text-center btn-block"> No hay imagenes para mostrar.</p>
                                @else
                                <div id="carouselExampleCaptions" class="carousel slide rounded col-xl-12" data-ride="carousel">
                                    <ol class="carousel-indicators">  
                                        @for ($i = 0; $i < 0; $i++)
                                            @if ($i == 0 )
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active"></li>
                                            @else                                        
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" ></li>
                                            @endif
                                        @endfor                               
                                    </ol>
                                    <div class="carousel-inner">
                                        @for ($i = 0; $i < 0; $i++)            
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
                                                    <img src="images/carrusel/" class="img-fluid" width="100%" alt="">                      
                                                </div>
                                            @else                                        
                                                <div class="carousel-item">
                                                    @auth
                                                    <form method="POST" 
                                                    action="" id="">
                                                        @csrf
                                                        <button type="submit" class="btn text-white btn-danger btn-block">
                                                            <div class=" mdi mdi-delete mdi-16px text-center">Eliminar</div>
                                                        </button>
                                                    </form>
                                                    @endauth  
                                                    <img src="images/carrusel/" class="img-fluid" width="100%" alt="">                                
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
                </div>

            </div>
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                                <a class="nav-link  mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#LicenciaturaenAdministracionEscolar" role="tab" aria-controls="v-pills-social2"
                                    aria-selected="true">Licenciatura en Administración Escolar</a>
                                <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#LicenciaturaenLenguajeyLiteratura" role="tab" aria-controls="v-pills-profile2"
                                    aria-selected="false">Licenciatura en Lenguaje y Literatura</a>
                                <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#LicenciaturaenMatematicas" role="tab" aria-controls="v-pills-profile2"
                                    aria-selected="false">Licenciatura en Matemáticas</a>
                                <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#LicenciaturaenPrimeroySegundoCiclo" role="tab" aria-controls="v-pills-profile2"
                                    aria-selected="false">Licenciatura en Primero y Segundo Ciclo</a>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-xl-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-xl-12"><h3>Siguenos en Facebook</h3></div>
                                <div class="col-xl-12 text-center" style="overflow: auto;">
                                    <div class="fb-page" data-href="https://www.facebook.com/academicaparacentralues/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/academicaparacentralues/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/academicaparacentralues/">Académica Paracentral - UES</a></blockquote></div> 
                                </div>                                                                                                                
                            </div>                                                         
                        </div>
                    </div><!-- end col-->
                         
                </div>
            </div>
        </div>

    </div> <!-- end container -->
</div>   


<!-- end wrapper -->
@endsection

@section('footerjs')

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="4Ddk6ohO"></script>
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