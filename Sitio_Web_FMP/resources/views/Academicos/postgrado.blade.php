@extends('Pagina/baseOnlyHtml')

@section('header')
@auth
    <!-- Summernote css -->
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
@endauth    
@endsection

@section('footer')
@auth
    <!--Summernote js-->
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/summernote.config.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
    <script src="{{ asset('js/http.min.js') }}"></script>
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
                                    <h4>Aviso de Convocatoria de Ingresos</h4>
                                </div>

                                @auth
                                <div class="col-lg-3 order-last">
                                    <!-- Button trigger modal noticia-->
                                    <button type="button" class="btn btn-block btn-primary waves-effect waves-light" 
                                        data-toggle="modal" data-target="#myModalMaestrias">
                                        <i class="mdi mdi-upload mdi-16px text-center"></i> Agregar Imagen
                                    </button>
                                </div>  
                                @endauth
                            </div>         
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                Licenciado (a) en trabajo social.
                            </p>
                        </div>
                        @foreach ($maestrias as $m)
                        <div class="tab-pane fade" id="{!!str_replace (' ','',$m->nombre)!!}" role="tabpanel">
                            <a class="btn-outline-danger btn btn-lg " href="{{ route('postgrado') }}"><i class="mdi mdi-arrow-left-thick"></i> Volver</a>
                            <h2 class="header-title py-2">{!!$m->nombre!!}</h2>                            
                            {!!$m->contenido!!}
                            <a><div class="mdi mdi-file-pdf mdi-24px align-top btn-outline-danger btn btn-lg my-2">Descargar</div></a>
                        </div>
                        @endforeach
                        
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4 ">
                    <h4>Maestrias</h4>
                        @auth
                           <a class="btn btn-info btn-block text-white text-left  mb-2" data-toggle="modal" data-target="#myModalMaestria"><i class="dripicons-document"></i> Nueva Maestria</a>
                           <div id="myModalMaestria" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Registro Nuevo</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">                                        
                                        <div class="tab-content">
                                        <form method="POST" 
                                            action="{{ route('Postgrado.registro') }}" 
                                            class="parsley-examples"
                                            enctype="multipart/form-data"
                                            id="formMaestrias"
                                        >
                                            @csrf
                                            
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nombre <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Nombre (Obligatorio)"
                                                                name="nombre"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="">Título que otorga <code>*</code></label>
                                                    <input type="text" class="form-control"
                                                                placeholder="Título que otorga (Obligatorio)"
                                                                name="titulo"/>
                                                </div>
                                            </div>      

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Modalidad <code>*</code></label>
                                                        <input type="text" class="form-control"
                                                                placeholder="Modalidad (Obligatorio)"
                                                                name="modalidad"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="">Duración <code>*</code></label>
                                                    <input type="text" class="form-control"
                                                                placeholder="Duración (Obligatorio)"
                                                                name="duracion"/>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Número de asignaturas <code>*</code></label>
                                                        <input type="number" class="form-control" min="1"
                                                                placeholder="0"
                                                                name="asignaturas"/>
                                                    </div> 
                                                </div>
                                                <div class="col-xl-4">
                                                    <label for="">Unidades valorativas <code>*</code></label>
                                                    <input type="number" class="form-control" min="1"
                                                                placeholder="0"
                                                                name="unidades"/>
                                                </div>
                                                <div class="col-xl-4">
                                                    <label for="">Precio ($)<code>*</code></label>
                                                    <input type="number" class="form-control" min="1" step="any"
                                                                placeholder="0.00"
                                                                name="precio"/>
                                                </div>
                                            </div>  

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label>Contenido <code>*</code></label>
                                                        <textarea value="" class="form-control summernote-config" name="contenido" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-primary text-white" 
                                                role="alert" style="display:none" id="notificacionMaestrias">                                               
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="button" 
                                                            class="btn btn-primary waves-effect waves-light mr-1"
                                                            onclick="submitForm('#formMaestrias','#notificacionMaestrias')">
                                                        <li class="fa fa-save"></li>
                                                        Guardar
                                                    </button>
                                                    <button type="reset" class="btn btn-light waves-effect">
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
                        @foreach ($maestrias as $m)
                        <a class="nav-link mb-2 btn-outline-danger  border" data-toggle="pill" href="#{!!str_replace (' ','',$m->nombre)!!}" role="tab" 
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