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
            <div class="col-xl-8">
                
            </div>
            
            <div class="col-xl-4">
                <div class="row">
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
        
                    <div class="col-xl-12" >                        
                        <div class="card-box"> 
                            <h3>Canales Digitales</h3>    
                            <a href="https://www.facebook.com/celeues" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> CELEUES</a>
                            <a href="https://campus.ues.edu.sv/" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> Campus Virtual Central</a>
                            <a href="https://eel.ues.edu.sv/" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> Expediente en Linea</a>                      
                            <a href="https://correo.ues.edu.sv/" target="_blank" class="btn btn-danger  btn-block mt-3 text-left"><i class=" mdi mdi-email font-18"></i> Correo Institucional</a>                           
                            <a href="https://www.facebook.com/DistanciaFMP" target="_blank" class="btn btn-danger  btn-block mt-3 text-left"><i class="mdi mdi-facebook border rounded font-16"></i> Universidad en Linea / Sede Paracentral</a> 
                            <a href="http://biblio.fmp.ues.edu.sv/biblioteca/" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-book-open-variant font-18"></i> Biblioteca</a>
                            <!-- <a href="#" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-book-open-variant font-18"></i> Recurso LMS-FMP</a>-->
                            <!-- <a href="#" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-book-open-variant font-18"></i> Campus Virtual FMP</a>-->
                        </div> <!-- end card-box-->                        
                    </div> <!-- end col-->  
        
                    <div class="col-xl-12">
                        <div class="card-box">
                            <h3>Oferta Académica</h3>
                            <a href="{{ route('Departamento.CienciasEdu') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Ciencias de la Educación</a>                                        
                            <a href="{{ route('Departamento.CienciasAgr') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Ciencias Agronómicas</a>                        
                            <a href="{{ route('Departamento.CienciasEcon') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Ciencias Económicas</a>                        
                            <a href="{{ route('Departamento.Inform') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Informática</a>                        
                            <a href="{{ route('planComp') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Plan Complementario</a>
                            <a href="{{ route('postgrado') }}" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-school font-18"></i> Postgrado</a>
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
        @if(@Auth::check()?@Auth::user()->hasRole('Pagina-AdminAcademica|Pagina-Admin|super-admin'):@Auth::check())
<div id="modalEliminarPDF" class="modal fade bs-example-modal-center" tabindex="-1" 
    role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border rounded">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body border rounded">
                <form action="{{ route('eliminarpdfmaestri') }}" method="POST">
                    @csrf
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se elimina este registro de manera permanente, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="_id" id="eliminar">                                                        
                        <input type="hidden" name="localizacion" id="localizacion">
                        <input type="hidden" name="vista" value="admonAcademica">
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <button type="submit" 
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                                <i class="mdi mdi-check mdi-16px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6">
                            <button type="reset" class="btn btn-light p-1 waves-light waves-effect btn-block font-24" data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                No
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
<div id="modalEliminarVideo" class="modal fade bs-example-modal-center" tabindex="-1" 
    role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border rounded">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body border rounded">
                <form action="{{ route('admonEliminarV') }}" method="POST">
                    @csrf
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se elimina este registro de manera permanente, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="_id" id="eliminarV">             
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <button type="submit" 
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                                <i class="mdi mdi-check mdi-16px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6">
                            <button type="reset" class="btn btn-light p-1 waves-light waves-effect btn-block font-24" data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                No
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
@endif
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