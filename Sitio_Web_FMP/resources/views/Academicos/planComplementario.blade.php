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
<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>
<script src=" {{ asset('js/scripts/dropzoneImagenes.js') }} "></script>
<!--Summernote js-->
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/summernote.config.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
<script src="{{ asset('js/scripts/http.min.js') }}"></script>
@endauth  



<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v11.0" nonce="3YGowOpk"></script>    
@endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div> 
        <div class="my-4"></div>
        <!-- end page title -->           

        <div class="card-box"> 
            <div class="row">
                <div class="col-xl-8 px-3">
                    <div class="tab-content pt-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="index" role="tabpanel">
                            @auth
                                    <form action="{{ route('contenido', ['localizacion'=>'complementarioIndex']) }}" method="POST"  
                                        class="parsley-examples"  id="indexContenido">
                                        @csrf
                                        <div class="alert alert-primary text-white" 
                                                role="alert" style="display:none" id="notificacion">                                               
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-xl-12">   
                                                <div class="form-group">                       
                                                    <textarea value="" class="form-control summernote-config" name="contenido"  rows="15">
                                                        @if ($contenido!=null)
                                                            {{$contenido->contenido}}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light btn-block" 
                                                        onclick="submitForm('#indexContenido','#notificacion')">
                                                        <i class="fa fa-save fa-5 ml-3"></i> Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>      
                                    @endauth 
                                    
                                    <div class="py-1">
                                        @guest
                                            @if ($contenido!=null)
                                                {!!$contenido->contenido!!}
                                            @endif
                                        @endguest  
                                    </div>
                        </div>
                        <div class="tab-pane fade" id="LicenciaturaenAdministracionEscolar" role="tabpanel" >
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                                    onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Plan Complementario
                            </a>
                            <h3 class="py-2">Licenciatura en Administración Escolar</h3>
                            <div class="table-responsive py-2 ">
                                <table class="table mb-0 table-bordered ">
                                    <tbody>
                                    <tr>
                                        <td><h5>Titulo a Obtener:</h5><p>Licenciado/a en Administración Escolar</p></td>
                                        <td><h5>Modalidad:</h5><p>Semipresencial </p></td>
                                        <td><h5>Duración:</h5><p>2 Años</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5>Dirigido a:</h5><p>Egresados de Profesorado y Profesores Graduados</p></td>
                                        <td>
                                            <h5>No. De Asignaturas:</h5><p>12</p>
                                            <h5>Unidades Valorativas:</h5><p>161</p>
                                        </td>
                                        <td><h5>Inversión:</h5>
                                            <p>Nuevo Ingreso: $11.43 <br>
                                            Reingreso: $5.71 <br>
                                            Matricula:  $30.00 <br>
                                            Mensualidad: $30.00</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>    
                            <h4>Formatos</h4> 
                            <a href="{{ asset('/Plan/AdministracionEscolar/Descripcionyobjetivos.pdf') }}" type="submit" class="btn px-1 btn-outline-danger" id="ingSistemas" target="_blank">
                                    <div class="mdi mdi-file-pdf mdi-24px align-top">Descripción y objetivos</div>
                            </a>
                            <a href="{{ asset('/Plan/AdministracionEscolar/PlandeestudioadministracionEscolar.pdf') }}" type="submit" class="px-1 btn btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Plan de Estudio</div></a>
                        </div>
                        <div class="tab-pane fade" id="LicenciaturaenLenguajeyLiteratura" role="tabpanel">
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                                    onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Plan Complementario
                            </a>
                            <h3 class="py-2">Licenciatura en Lenguaje y Literatura</h3>
                            <div class="table-responsive py-2 ">
                                <table class="table mb-0 table-bordered ">
                                    <tbody>
                                    <tr>
                                        <td><h5>Titulo a Obtener:</h5><p>Licenciado/a en Lenguaje y Literatura</p></td>
                                        <td><h5>Modalidad:</h5><p>Semipresencial </p></td>
                                        <td><h5>Duración:</h5><p>2 Años</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5>Dirigido a:</h5><p>Egresados de Profesorado y Profesores Graduados</p></td>
                                        <td>
                                            <h5>No. De Asignaturas:</h5><p>12</p>
                                            <h5>Unidades Valorativas:</h5><p>162</p>
                                        </td>
                                        <td><h5>Inversión:</h5>
                                            <p>Nuevo Ingreso: $11.43 <br>
                                            Reingreso: $5.71<br>
                                            Matricula:  $30.00<br>
                                            Mensualidad: $30.00</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>     
                            <h4>Formatos</h4>
                            <a href="{{ asset('/Plan/LenguajeyLiteratura/Descripcionyobjetivos.pdf') }}" type="submit" class="btn px-1  btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Descripción y objetivos</div>
                            </a>
                        </div>       
                        <div class="tab-pane fade" id="LicenciaturaenMatematicas" role="tabpanel">
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                                    onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Plan Complementario
                            </a>
                            <h3 class="py-2">Licenciatura en Matemáticas</h3>
                            <div class="table-responsive py-2 ">
                                <table class="table mb-0 table-bordered ">
                                    <tbody>
                                    <tr>
                                        <td><h5>Titulo a Obtener:</h5><p>Licenciado/a en Lenguaje y Literatura</p></td>
                                        <td><h5>Modalidad:</h5><p>Semipresencial </p></td>
                                        <td><h5>Duración:</h5><p>2 Años</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5>Dirigido a:</h5><p>Egresados de Profesorado y Profesores Graduados</p></td>
                                        <td>
                                            <h5>No. De Asignaturas:</h5><p>12</p>
                                            <h5>Unidades Valorativas:</h5><p>160</p>
                                        </td>
                                        <td><h5>Inversión:</h5>
                                            <p>Nuevo Ingreso: $11.43 <br>
                                            Reingreso: $5.71<br>
                                            Matricula:  $30.00<br>
                                            Mensualidad: $30.00</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>      
                            <h4>Formatos</h4>
                            <a href="{{ asset('/Plan/AdministracionEscolar/Descripcionyobjetivos.pdf') }}" type="submit" class="btn px-1 btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Descripción y objetivos</div>
                            </a>
                            <a href="{{ asset('/Plan/AdministracionEscolar/PlandeestudioadministracionEscolar.pdf') }}" type="submit" class="px-1 btn btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Plan de Estudio</div></a>
                        </div>     
                        <div class="tab-pane fade" id="LicenciaturaenPrimeroySegundoCiclo" role="tabpanel">
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                                    onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Plan Complementario
                            </a>
                            <h3 class="py-2">Licenciatura en Primero y Segundo Ciclo</h3>
                            <div class="table-responsive py-2 ">
                                <table class="table mb-0 table-bordered ">
                                    <tbody>
                                    <tr>
                                        <td><h5>Titulo a Obtener:</h5><p>Licenciado/a en Primero y segundo ciclo</p></td>
                                        <td><h5>Modalidad:</h5><p>Semipresencial </p></td>
                                        <td><h5>Duración:</h5><p>2 Años</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5>Dirigido a:</h5><p>Egresados de Profesorado y Profesores Graduados</p></td>
                                        <td>
                                            <h5>No. De Asignaturas:</h5><p>12</p>
                                            <h5>Unidades Valorativas:</h5><p>161</p>
                                        </td>
                                        <td><h5>Inversión:</h5>
                                            <p>Nuevo Ingreso: $11.43 <br>
                                            Reingreso: $5.71<br>
                                            Matricula:  $30.00<br>
                                            Mensualidad: $30.00</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>      
                            <h4>Formatos</h4>
                            <a href="{{ asset('/Plan/AdministracionEscolar/Descripcionyobjetivos.pdf') }}" type="submit" class="btn px-1 btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Descripción y objetivos</div>
                            </a>
                            <a href="{{ asset('/Plan/AdministracionEscolar/PlandeestudioadministracionEscolar.pdf') }}" type="submit" class="px-1 btn btn-outline-danger" id="ingSistemas" target="_blank">
                                <div class="mdi mdi-file-pdf mdi-24px align-top">Plan de Estudio</div></a>
                            </div>       
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4">
                    <h4>Siguenos en Facebook</h4>
                    <div class="fb-page" data-href="https://www.facebook.com/Licenciatura-en-Educaci%C3%B3n-Plan-complementario-UES-FMP-102012865071802" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Licenciatura-en-Educaci%C3%B3n-Plan-complementario-UES-FMP-102012865071802" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Licenciatura-en-Educaci%C3%B3n-Plan-complementario-UES-FMP-102012865071802">Licenciatura en Educación, Plan complementario;  UES - FMP</a></blockquote></div>
                    <h4>Licenciaturas</h4>
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
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
    </div> <!-- end container -->
</div> 
@endsection