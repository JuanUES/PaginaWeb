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
                            <div class="row">
                                <div class="col order-first">
                                    <h3 class="my-2">Administración Académica</h3>
                                </div>
                                @auth                            
                                <div class="col-lg-3 order-last">
                                    @auth
                                        <button type="button" class="btn btn-info btn-block my-1 float-right"  
                                            data-toggle="modal" data-target=".bs-example-modal-center"> 
                                            <div class="dripicons-photo">&nbsp;Subir Imagen</div>
                                        </button>
                                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
                                            aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="myCenterModalLabel">Zona para subir</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  method="post" action="{{ route('academicaImagen', base64_encode('imagenAcademica')) }}"
                                                            class="dropzone" id="my-awesome-dropzone">
                                                            @csrf                                 
                                                            <div class="dz-message needsclick">
                                                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                                <h3>Suelta el archivo aquí o haz clic para subir.</h3>
                                                            </div>
                                                            <div class="dropzone-previews"></div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    @endauth
                                                                
                                </div>
                                @endauth
                            </div>
                            @if ($imagenAcademica!=null)
                                <img  width="100%" height="550px" src="{{ asset('/files/image') }}/{!!$imagenAcademica->file!!}" alt="{!!$imagenAcademica->file!!}">
                            @else
                                <p class="border p-2 text-center">No hay imagen.</p>
                            @endif
                        </div>
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box text-center">
                            <div class="row button-list">
                                <div class="col-xl-6 col-sm-5">
                                    <div type="button" class="card border border-danger" href="#">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <i class="mdi mdi-file-cabinet fa-4x text-danger"></i> <br>
                                                <h3>Procesos Académicos</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-5" data-toggle="modal" data-target="#modalMallas">
                                    <div type="button" class="card border border-danger">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0 ">
                                                <i class=" mdi mdi-file-pdf fa-4x text-danger"></i> <br>
                                                <h3>Mallas Curriculares</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>      
                                <!--  Modal content for the above example -->
                                <div id="modalMallas" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myLargeModalLabel"><i class="mdi mdi-file-pdf mdi-24px"></i> Mallas Curriculares</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">                                
                                                    <div class="col order-first">
                                                    </div>                               
                                                    @auth
                                                    <div class="col-lg-3 order-last">
                                                        <button class="btn btn-block btn-info tex-left" 
                                                            data-toggle="modal" data-target="#modalSubirMalla">
                                                            <div class="mdi mdi-upload mdi-16px text-center" > Subir PDF</div>
                                                        </button>
                                                    </div>  
                                                    <div id="modalSubirMalla" class="modal fade bs-example-modal-center" 
                                                        tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" 
                                                        aria-hidden="true" style="display: none;" >
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myCenterModalLabel">Zona para subir PDF</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    <form action="{{ route('Mpdf', ['localizacion'=>'academicaMallas']) }}" method="post"
                                                                        class="dropzone dropzonepdf" >
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
                                                    </div><!-- /.modal-->
                                                    @endauth
                                                </div> 
                                                <div class="row">
                                                    <?php
                                                        $pdfs = \App\Models\Pagina\PDF::where('localizacion','academicaMallas')->get();
                                                    ?>
                                                    
                                                    @if (count($pdfs)>0)
                                                    <div class="col-xl-12">
                                                        <div class="table-responsive text-left" id="listaPDF">
                                                            <table class="table  mb-0 @guest table-striped @endguest">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <h4>Malla Curricular</h4>
                                                                        </th>                           
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($pdfs as $item)
                                                                    <tr>
                                                                        <th class="align-middle">
                                                                            <div class="row">
                                                                                
                                                                                <div class="col order-first">
                                                                                    <p class="font-18">{!!$item->file!!}</p>
                                                                                </div>
                                                                                <div class="col-lg-2 order-last">
                                                                                    <div class="btn-group" role="group">
                                                                                        <a class="btn btn-danger waves-effect width-lg mx-1"  href="{{ route('index') }}{!!'/files/pdfs/academicaMallas/'.$item->file !!}" target="_blank"> 
                                                                                            <i class="mdi mdi-file-pdf font-18 mr-1"></i>Descargar
                                                                                        </a>
                                                                                        @auth
                                                                                        <button type="buttom"  class="btn btn-light waves-effect width-md mx-1" data-toggle="modal" data-target="#modalEliminarPDF"
                                                                                            onclick=""><i class="mdi mdi-delete font-18"></i>  Eliminar
                                                                                        </button>  
                                                                                        @endauth 
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                                                                    
                                                                        </th>
                                                                    </tr>  
                                                                    @endforeach                                                              
                                                                </tbody>
                                                            </table>
                                                        </div> <!-- end table-responsive-->  
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="col-xl-6 col-sm-5">
                                    <div type="button" class="card border border-danger">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <i class="mdi mdi-school fa-4x text-danger"></i> <br>
                                                <h3>Graduación</h3>                                                
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-5">
                                    <div type="button" class="card border border-danger">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <i class="mdi mdi-calendar-month fa-4x text-danger"></i> <br>
                                                <h3>Calendario</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-5">
                                    <div type="button" class="card border border-danger">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <i class="mdi mdi-file-table fa-4x text-danger"></i> <br>
                                                <h3>Formularios</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-sm-5">
                                    <div type="button" class="card border border-danger" data-toggle="modal" data-target="#modalAudioVisual">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <i class=" mdi mdi-video-vintage fa-4x  text-danger"></i> <br>
                                                <h3>AudioVisuales</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <!--  Modal content for the above example -->
                                <div id="modalAudioVisual" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myLargeModalLabel"><i class=" mdi mdi-video-vintage mdi-24px"></i> AudioVisuales</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">       
                                                <div class="card-box">
                                                    <form action="" id=""
                                                    method="POST" class="parsley-examples text-left">
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="avTitulo">Titulo</label>
                                                                    <input type="text" class="form-control" id="avTitulo">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <label for="">URL del video</label>
                                                                <input type="url" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <button type="button" class="btn btn-primary" 
                                                                style="margin-left: 0px;"><li class="fa fa-save"></li>
                                                                Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                                                  
                                                <button class="btn btn-danger waves-effect waves-light btn-block text-left fond-19" type="button" 
                                                data-toggle="collapse" data-target="#collapseExample1" 
                                                aria-expanded="false" aria-controls="collapseExample1" style="margin-left: 0px;">
                                                <i class=" mdi mdi-video-vintage mdi-24px"></i>  Titulo
                                                </button> 
                                                                                                                                               
                                                <div class="collapse show" id="collapseExample1">
                                                    <div class="card-box ">
                                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/HnQO0bQuYRE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                </div>             
                                                                                                   
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
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
                            <a href="https://campus.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> Campus Virtual</a>
                            <a href="https://eel.ues.edu.sv/" class="btn btn-danger btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> Expediente en Linea</a>                      
                            <a href="https://correo.ues.edu.sv/" class="btn btn-danger  btn-block mt-3 text-left"><i class=" mdi mdi-email font-18"></i> Correo Institucional</a>                           
                            <a href="https://www.facebook.com/DistanciaFMP" class="btn btn-danger  btn-block mt-3 text-left"><i class="mdi mdi-earth font-18"></i> Universidad en Linea / Sede Paracentral</a> 
                            <a href="https://www.facebook.com/celeues" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-facebook border rounded"></i> CELEUES</a>
                            <a href="http://biblio.fmp.ues.edu.sv/biblioteca/" target="_blank" class="btn btn-danger btn-block mt-3 text-left"><i class=" mdi mdi-book-open-variant font-18"></i> Biblioteca</a>
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
                            <div class="p-1"><a href="http://saa.ues.edu.sv/portal/" target="_blank">Secretaría de Asuntos Académicos</a></div>
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
        <!-- end row -->

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


@endauth

@endsection