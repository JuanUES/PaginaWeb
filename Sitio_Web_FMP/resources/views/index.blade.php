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
        </br>
        <!-- end page title -->               

        <div class="row">
            <div class="col-xl-8">
                <div class="card-box">
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide rounded" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <img src="images/fmp1.jpeg" alt="Chicago" style="width:100%;">
                                <div class="carousel-caption d-none d-md-block">
                                  <h5>First slide label</h5>
                                  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                </div>
                              </div>
                              <div class="carousel-item">
                                 <img src="images/chicago.jpg" alt="Chicago" style="width:100%;">
                                <div class="carousel-caption d-none d-md-block">
                                  <h5>Second slide label</h5>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                        </div>    
                        <!-- end col -->
                    </div> <!-- end row-->
                </div>  <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-xl-4 ">                        
                <div class="card-box "> 
                    <h4 class="header-title mb-3 text-center">Canales Digitales</h4>                           
                    <a href="" class="btn btn-danger btn-block mt-3 text-left">Campus Virtual</a> 
                    <a href="" class="btn btn-danger btn-block mt-3 text-left">Expediente en linea</a>  
                    <a href="" class="btn btn-danger  btn-block mt-3 text-left">Correo institucional</a>                           
                    <a href="https://www.facebook.com/DistanciaFMP" class="btn btn-danger  btn-block mt-3 text-left">Universidad en linea / Cede Paracentral</a> 
                    <a href="https://www.facebook.com/celeues" class="btn btn-danger btn-block mt-3 text-left">CELEUES</a>
                                                
                </div> <!-- end card-box-->                        
            </div> <!-- end col-->

        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box"> 
                    <h4 class="header-title mb-3">Noticias</h4>                           
                    <div class="media">
                        <img class="mr-3 rounded bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                    <div class="media">
                        <img class="mr-3 rounded-circle bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80" width="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                    <div class="border rounded p-2 media">
                        <img class="mr-3 rounded bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                    <div class="border rounded p-2 media">
                        <img class="mr-3 rounded-circle bx-shadow-lg" src="images/ues_noticia.jpg" alt="Generic placeholder image" height="80" width="80">
                        <div class="media-body">
                            <h5 class="mt-0">UES exige traspaso al MINED</h5>
                            Facultad Multidisciplinaria Paracentral urge legalizar a su nombre un terreno donado por exministro de educación.
                        </div>
                        <a href="Noticia.html" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box"> 
                    <p class="header-title mb-3 mdi mdi-access-point mdi-36px">Eventos</p>                           
                    <div class="media p-2 border rounded media">
                        <img class="mr-3 rounded bx-shadow-lg" src="images/users/avatar-4.jpg" alt="Generic placeholder image" height="80">
                        <div class="media-body">
                            <h5 class="mt-0">Louis P. Wheeler</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, at, tempus viverra turpis.
                        </div>
                        <a href="" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                    <div class="media p-2 border rounded">
                        <img class="mr-3 rounded-circle bx-shadow-lg" src="images/users/avatar-4.jpg" alt="Generic placeholder image" height="80">
                        <div class="media-body">
                            <h5 class="mt-0">Louis P. Wheeler</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, at, tempus viverra turpis.
                        </div>
                        <a href="" class="btn btn-light mt-3">Leer mas...</a>
                    </div>
                    </br>
                    
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box"> 
                    <p class="header-title mb-3 ">Sitios de interes</p>                         
                    
                    <div class="row">
                        <div class="col order-first">
                            <h4 class="header-title">Facultades</h4>                                   
                            <div class="p-1"><a href="#">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="#">Facultad Multidisciplinaria de Oriente</a></div>
                            <div class="p-1"><a href="#">Facultad de Ingeniería y Arquitectura</a></div>
                            <div class="p-1"><a href="#">Facultad de Agronomía</a></div>
                            <div class="p-1"><a href="#">Facultad de Odontología</a></div>
                            <div class="p-1"><a href="#">Facultad de Medicina</a></div>
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="#">Facultad de Jurisprudencia y Ciencias Sociales</a></div>
                            <div class="p-1"><a href="#">Facultad de Química y Farmacia</a></div>
                            <div class="p-1"><a href="#">Facultad de Ciencias Naturales y Matemática</a></div>
                            <div class="p-1"><a href="#">Facultad Multidisciplinaria de Occidente</a></div>
                            <div class="p-1"><a href="#">Facultad de Ciencias Económicas</a></div>
                        </div>
                        <div class="col">
                            <h4 class="header-title">Secretarias</h4>     
                            <div class="p-1"><a href="#">Secretaría General</a></div>
                            <div class="p-1"><a href="#">Secretaría de Proyección Social</a></div>
                            <div class="p-1"><a href="#">Secretaría de Comunicaciones</a></div>
                            <div class="p-1"><a href="#">Secretaría de Arte y Cultura</a></div>
                            <div class="p-1"><a href="#">Secretaría de Bienestar Universitario</a></div>
                            <div class="p-1"><a href="#">Secretaría de Relaciones</a></div>
                            <div class="p-1"><a href="#">Secretaría de Planificación</a></div>
                            <div class="p-1"><a href="#">Secretaría de Investigaciones Científicas</a></div>
                            <div class="p-1"><a href="#">Secretaría de Asuntos Académicos</a></div>
                        </div>
                        <div class="col order-last">
                            <h4 class="header-title">Instituciones</h4>
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
<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }}"></script>
@endsection