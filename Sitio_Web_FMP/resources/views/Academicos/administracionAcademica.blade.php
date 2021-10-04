@extends('Pagina/base')

@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">
@if(@Auth::check()?@Auth::user()->hasRole('Pagina-AdminAcademica|Pagina-Admin|super-admin'):@Auth::check())
<!-- Este css se carga nada mas cuando esta logeado un usuario-->
<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />

<!-- Summernote css -->
<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
@endif

<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />


<!--Libreria data table para paginacion de noticias-->
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    iframe{
        width: 100%;
        height: 350px;
    }
</style>
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
            <div class="col-xl-12">
                <div class="card-box"> 
                    <h3>Sitios de Interes</h3>                        
                    <div class="row">
                        <div class="col order-first">
                            <p class="header-title">Facultades</p>                                   
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/" target="_blank">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="http://www.fmoues.edu.sv/"target="_blank">Facultad Multidisciplinaria de Oriente</a></div>
                            <div class="p-1"><a href="http://www.fia.ues.edu.sv/"target="_blank">Facultad de Ingeniería y Arquitectura</a></div>
                            <div class="p-1"><a href="https://www.agronomia.ues.edu.sv/"target="_blank">Facultad de Agronomía</a></div>
                            <div class="p-1"><a href="http://www.odontologia.ues.edu.sv/"target="_blank">Facultad de Odontología</a></div>
                            <div class="p-1"><a href="http://www.medicina.ues.edu.sv/"target="_blank">Facultad de Medicina</a></div>
                            <div class="p-1"><a href="http://jurisprudencia.ues.edu.sv/sitio/"target="_blank">Facultad de Jurisprudencia y Ciencias Sociales</a></div>
                            <div class="p-1"><a href="https://www.quimicayfarmacia.ues.edu.sv/"target="_blank">Facultad de Química y Farmacia</a></div>
                            <div class="p-1"><a href="https://www.cimat.ues.edu.sv/"target="_blank">Facultad de Ciencias Naturales y Matemática</a></div>
                            <div class="p-1"><a href="http://www.occ.ues.edu.sv/"target="_blank">Facultad Multidisciplinaria de Occidente</a></div>
                            <div class="p-1"><a href="http://www.fce.ues.edu.sv/"target="_blank">Facultad de Ciencias Económicas</a></div>
                        </div>
                        <div class="col">
                            <p class="header-title">Secretarias</p>     
                            <div class="p-1"><a href="http://secretariageneral.ues.edu.sv/" target="_blank">Secretaría General</a></div>
                            <div class="p-1"><a href="http://proyeccionsocial.ues.edu.sv/" target="_blank">Secretaría de Proyección Social</a></div>
                            <div class="p-1"><a href="http://www.eluniversitario.ues.edu.sv/" target="_blank">Secretaría de Comunicaciones</a></div>
                            <div class="p-1"><a href="https://es-es.facebook.com/ArteyCulturaUES/" target="_blank">Secretaría de Arte y Cultura</a></div>
                            <div class="p-1"><a href="http://www.bienestar.ues.edu.sv/" target="_blank">Secretaría de Bienestar Universitario</a></div>
                            <div class="p-1"><a href="http://www.ues.edu.sv/secretaria-de-relaciones-nacionales-e-internacionales/" target="_blank">Secretaría de Relaciones</a></div>
                            <div class="p-1"><a href="https://secplan.ues.edu.sv/" target="_blank">Secretaría de Planificación</a></div>
                            <div class="p-1"><a href="https://sic.ues.edu.sv/" target="_blank">Secretaría de Investigaciones Científicas</a></div>
                            <div class="p-1"><a href="http://saa.ues.edu.sv/" target="_blank">Secretaría de Asuntos Académicos</a></div>
                        </div>
                        <div class="col order-last">
                            <p class="header-title">Institución</p>
                            <div class="p-1"><a href="https://www.ues.edu.sv/becas/" target="_blank">Consejo de Becas</a></div>                            
                            <div class="p-1"><a href="#">Consejo Superior Universitario</a></div>
                            <div class="p-1"><a href="#">Asamblea General Universitaria</a></div>
                            <div class="p-1"><a href="https://www.uese.ues.edu.sv/" target="_blank">Unidad de Estudio Socioeconómico </a></div>
                            <div class="p-1"><a href="https://www.facebook.com/defensoriaues/" target="_blank">Defensoría de los Derechos Universitarios</a></div>                            
                        </div>
                    </div>                            
                </div> <!-- end card-box -->
            </div><!-- end col -->          
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

@if(@Auth::check()?@Auth::user()->hasRole('Pagina-AdminAcademica|Pagina-Admin|super-admin'):@Auth::check())  
<script src="{{ asset('js/scripts/http.min.js') }}"></script>
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/summernote.config.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>  
<script src="{{ asset('js/scripts/http.min.js') }}"></script>

<!-- Plugins js -->
<script src="{{ asset('js/dropzone.min.js') }} "></script>
<script src="{{ asset('js/scripts/dropzoneimagenpdf.js') }}"></script>@endif
<script src="{{ asset('js/index/index.datatable.js') }}"></script>
@endsection