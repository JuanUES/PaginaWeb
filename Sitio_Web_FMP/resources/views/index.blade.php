@extends('pagina/base')

@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <h1 class="header-title mb-3">Facultad Multidisciplinaria Paracentral</h1>
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide rounded" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner text-center">
                              <div class="carousel-item active">
                                 <img src="images/carrusel/image-1.jpeg" class="img-fluid">
                                 
                              </div>
                              <div class="carousel-item">
                                <img src="images/carrusel/image-2.jpeg" class="img-fluid" width="1145">
                                
                              </div>  
                              <div class="carousel-item">
                                <img src="images/carrusel/image-3.jpeg"  class="img-fluid" width="1145" >
                                
                              </div>  
                              <div class="carousel-item">
                                <img src="images/carrusel/image-4.jpeg" class="img-fluid" width="1145" height="800">
                                
                              </div>                                                     
                              <div class="carousel-item">
                                <img src="images/carrusel/image-5.jpeg" class="img-fluid" width="1145" height="800">
                                
                              </div>  
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
                        <!-- end col -->
                    </div> <!-- end row-->
                </div>  <!-- end card-box-->
            </div> <!-- end col -->               
            
            <div class="col-xl-4">
                <div class="card-box">
                    <div class="fb-page" data-href="https://es-la.facebook.com/academicaparacentralues" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://es-la.facebook.com/academicaparacentralues" class="fb-xfbml-parse-ignore"><a href="https://es-la.facebook.com/academicaparacentralues">Académica Paracentral - UES</a>
                    </blockquote>
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card-box"> 
                    <h1 class="header-title mb-3">Noticias</h1>      
                    
                    <div class="border rounded p-2 my-3 media">
                        <img class="mr-3 rounded bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    <div class="border rounded p-2 my-3 media">
                        <img class="mr-3 rounded-circle bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80" width="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
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
@endsection