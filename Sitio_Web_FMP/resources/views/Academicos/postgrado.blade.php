@extends('Pagina/baseOnlyHtml')

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
                        <div class="tab-pane fade active show" id="v-pills-index3" role="tabpanel" aria-labelledby="v-pills-index-tab3">
                            <h3 class="my-1">Postgrado</h3>                            
                            <div class="row py-1">
                                <div class="col order-first ">
                                    <h4>Aviso de Convocatoria de Ingresos</h4>
                                </div>
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
                                                <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imágenes</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form action="#" method="post"
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
                            </div>
                            <div class="row">                        
                                <!--@if (count($imgCarrusel) == '0')
                                    <p class="text-center"> No hay imagenes para mostrar.</p>
                                @else-->
                                <div id="carouselExampleCaptions" class="carousel slide rounded col-xl-12" data-ride="carousel">
                                    <ol class="carousel-indicators">  
                                       <!-- @for ($i = 0; $i < count($imgCarrusel); $i++)
                                            @if ($i == 0 )
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active"></li>
                                            @else                                        
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" ></li>
                                            @endif
                                        @endfor-->                          
                                    </ol>
                                    <div class="carousel-inner">
                                        <!--@for ($i = 0; $i < count($imgCarrusel); $i++)            
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
                                        @endfor -->
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
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                Licenciado (a) en trabajo social.
                            </p>
                            <p class="mb-1 font-weight-bold">Pénsum:</p>
                            <a href="#" type="submit" class="btn btn-outline-danger"> <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div></a>
                        </div>
                        <div class="tab-pane fade" id="v-pills-social2" role="tabpanel" aria-labelledby="v-pills-social-tab2">
                            <a class="btn-outline-danger btn btn-lg my-2" href="{{ route('postgrado') }}"><i class="mdi mdi-arrow-left-thick"></i> Volver</a>
                            <h2 class="header-title py-2">Licenciatura en Trabajo Social</h2>                            
                            <p class="mb-1 font-weight-bold ">Código:</p>
                            <p class="text-muted font-15 text-justify">L10439</p>
                            <p class="mb-1 font-weight-bold">Descripción:</p>
                            <p class="text-muted font-15 text-justify">
                                La Licenciatura en Trabajo Social en la UES nace a iniciativa del personal docente de la Escuela de Trabajo Social y se concretiza por medio de un Convenio entre el Gobierno de la República de El Salvador a través del Ministerio de Educación y la Universidad de El Salvador, firmado el 20 de mayo de 1999.
                            </p>  
                            <p class="mb-1 font-weight-bold">Objetivo:</p>
                            <p class="text-muted font-15 text-justify">
                                Formar profesionales en Trabajo Social, con fundamentación humanista, teórica-técnica-metodológica con un marco axiológico sólido que contribuya al desarrollo de las potencialidades e iniciativas de las personas, grupos y sectores poblacionales que posibiliten la construcción de opciones y alternativas tendientes a la promoción y transformación de la realidad.
                            </p>                                             
    
                            <p class="mb-1 font-weight-bold">Tiempo de duración de la carrera:</p>
                            <p class="text-muted font-15">
                                5 años (10 ciclos).
                            </p>
    
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                Licenciado (a) en trabajo social.
                            </p>
                            <p class="mb-1 font-weight-bold">Pénsum:</p>
                            <a href="#" type="submit" class="btn btn-outline-danger"> <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div></a>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab2">
                            <h2 class="header-title py-2">Profesorado en Educación Básica para Primero y Segundo Ciclos</h2>                            
                            <p class="mb-1 font-weight-bold ">Código:</p>
                            <p class="text-muted font-15 text-justify">P70402</p>
                            <p class="mb-1 font-weight-bold">Descripción:</p>
                            <p class="text-muted font-15 text-justify">
                                El Profesorado en Educación Básica para Primero y Segundo Ciclos está diseñado para formar maestros/as con capacidad científica, técnica, pedagógica y ética, para el ejercicio profesional de la docencia en el nivel de educación básica para primero y segundo ciclos, los cuales trabajarían con niños y niñas entre 7 y 12 años.
                            </p> 
                            <p class="text-muted font-15 text-justify">
                                Esta especialidad se ofrece en seis ciclos, con una duración mínima de tres años, con un total de 23 asignaturas, en cuyo desarrollo gradual se contemplan tres componentes que se articulan simultáneamente desde el inicio hasta el final del plan de estudios.
                            </p>
                            <p class="text-muted font-15 text-justify">
                                El primero de ellos tiene como propósito la formación general, común a todos los profesorados y se tratará en 9 cursos; un segundo componente está referido a la formación especializada, que centra su interés en el dominio de los contenidos curriculares y los conocimientos específicos de estrategias didácticas, necesario para su desempeño docente; este componente se desarrolla en 9 cursos; y un tercer componente que corresponde a la práctica docente, en la que se observará y reflexionará las situaciones reales de enseñanza-aprendizaje del nivel de educación básica para primero y segundo ciclo.
                            </p>
                                            
                            <p class="mb-1 font-weight-bold">Tiempo de duración de la carrera:

                            </p>
                            <p class="text-muted font-15">
                                3 años.
                            </p>
    
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                Profesor (a) en educación básica para primero y segundo ciclo.
                            </p>
                            <p class="mb-1 font-weight-bold">Pénsum:</p>
                            <a href="#" type="submit" class="btn btn-outline-danger"> <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div></a>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4 ">
                    <h4>Maestrias</h4>
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#v-pills-social2" role="tab" aria-controls="v-pills-social2"
                            aria-selected="false">
                            Licenciatura en Trabajo Social</a>
                        <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">
                            Administracion de Maestrias</a>
                        </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->

    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection