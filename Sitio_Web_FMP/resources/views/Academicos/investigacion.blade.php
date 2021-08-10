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
        <!-- Plugins js -->
        <script src=" {{ asset('js/dropzone.min.js') }} "></script>   
        <script src=" {{ asset('js/scripts/dropzoneImagenes.js') }} "></script>
        <!--Summernote js-->
        <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/summernote.config.min.js') }}"></script>
        <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
        <script src="{{ asset('js/scripts/http.min.js') }}"></script>
        <script>
            // para recargar pagina luego de subir o no imagenes
            $('.bs-example-modal-center').on('hidden.bs.modal', function() { location.reload(); });
        </script>
    @endauth    
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v11.0" nonce="FxW143mb"></script>
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
                        <div class="tab-pane fade active show" id="index" role="tabpanel" >
                            
                            
                            <div class="row py-1">
                                <div class="col order-first">
                                    <h3 >Unidad de Investigación</h3>
                                </div>
                                @auth
                                <div class="col-lg-3 order-last">
                                    <a href="" class="btn btn-block btn-info tex-left" 
                                    data-toggle="modal" data-target=".bs-example-modal-center">
                                        <div class="mdi mdi-upload mdi-16px text-center"> Agregar Imagen</div>
                                    </a>
                                </div>                            
                                    
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;" id="dropZoneCarrusel">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imágenes</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form action="{{ route('ImagenCarrusel', ['tipo'=>3]) }}" method="post"
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
                                @if (count($investigacionCarrusel) == '0')
                                    <p class="p-2 mx-2 border text-center btn-block"> No hay imagenes para mostrar.</p>
                                @else
                                <div id="carouselExampleCaptions" class="carousel slide rounded col-xl-12" data-ride="carousel">
                                    <ol class="carousel-indicators">  
                                        @for ($i = 0; $i < count($investigacionCarrusel); $i++)
                                            @if ($i == 0 )
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active"></li>
                                            @else                                        
                                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" ></li>
                                            @endif
                                        @endfor                               
                                    </ol>
                                    <div class="carousel-inner">
                                        @for ($i = 0; $i < count($investigacionCarrusel); $i++)            
                                                                                
                                            <div class="carousel-item {!!$i == 0 ? 'active': null!!}">
                                                @auth                                                
                                                <button type="submit" class="btn text-white btn-danger btn-block">
                                                    <div class=" mdi mdi-delete mdi-16px text-center" data-toggle="modal" data-target="#modalCR" onclick="$('#imagenCR').val({!!$investigacionCarrusel[$i]->id!!})">Eliminar</div>
                                                </button>
                                                @endauth  
                                                <img src="images/carrusel/{{$investigacionCarrusel[$i]->imagen}}" class="img-fluid" width="100%" height="60%" alt="{!!$investigacionCarrusel[$i]->imagen!!}">                                
                                            </div>  
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

                                @auth
                                <div class="row py-3">
                                    <div class="col-xl-12">
                                        <form action="{{ route('contenido', ['localizacion'=>'investigacionIndex']) }}" method="POST"  
                                            class="parsley-examples"  id="indexContenido">
                                            @csrf
                                            <div class="alert alert-primary text-white py-1" 
                                                    role="alert" style="display:none" id="notificacion">                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">   
                                                    <div class="form-group">                       
                                                        <textarea value="" class="form-control summernote-config" name="contenido"  rows="10">
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
                                    </div>  
                                </div>    
                                @endauth       
                                @guest  
                                <div class="py-1">
                                    @if ($contenido!=null)
                                        {!!$contenido->contenido!!}
                                    @endif
                                </div>
                                @endguest 
                                @endif

                                <!-- end col -->
                            </div> <!-- end row-->

                        </div>
                        <div class="tab-pane fade " id="v-pills-social2" role="tabpanel" aria-labelledby="v-pills-social-tab2">
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                                onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                    <i class="mdi mdi-arrow-left-thick"></i> 
                                        Volver a Investigación
                            </a>
                            <h3 class="py-2">Centro de Estudio de Opinión Publica (CEOP)</h3>
                            <p class="mb-1 font-weight-bold py-2">Sobre el CEOP FMP:</p>
                            <p class="text-muted font-15 text-justify">
                                Considerando la importancia de contribuir a la comprensión de diferentes procesos sociales en la región paracentral y a nivel nacional, la Junta Directiva de la FMP ha aprobado según acuerdo Nº 24/2019-2021-V la creación del Centro de Estudios de Opinión Pública de la Facultad Multidisciplinaria Paracentral (CEOP FMP), que inició sus actividades en agosto de 2021.
                            </p>
                            <p class="mb-1 font-weight-bold py-2">Objetivo General:</p>
                            <p class="text-muted font-15 text-justify">
                                Investigar la opinión pública en las áreas educativa, económica, agrícola y política, con la finalidad de poner a disposición de la sociedad salvadoreña la información generada y contribuir a la toma de decisiones en estos ámbitos, en la región paracentral y a nivel nacional. 
                            </p>
                            <p class="mb-1 font-weight-bold py-2">Objetivos Específicos:</p>
                            <ul>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Diseñar e implementar procesos de investigación académica-científica en las áreas educativa, económica, agrícola y política, que fomenten la participación de la población salvadoreña.
                                    </p>                                    
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Promover la integración de actividades de investigación, docencia y proyección social en la producción de datos sobre la problemática social, como parte de la formación integral de la comunidad educativa de la FMP.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Establecer mecanismos de comunicación y coordinación con instancias de la región paracentral y a nivel nacional, que contribuyan a la generación de información, el análisis y la búsqueda de soluciones a las problemáticas identificadas. 
                                    </p>
                                </li>
                            </ul>
                            <div class="border m-1 rounded p-2">
                                <p class="mb-1 font-weight-bold py-2">Desarrollo del sondeo:</p>
                                <h4 class="font-weight-bold">Efectos de la implementación de la modalidad de educación a distancia en la FMP-UES, en el contexto de la pandemia por COVID-19</h4>      
                                <p class="text-muted font-15 text-justify">
                                    En el periodo comprendido de noviembre de 2020 a febrero de 2021 y cuya presentación pública se realizó ante los medios de comunicación el miércoles 10 de febrero de 2021 en la sala de reuniones del Consejo Superior Universitario.
                                </p>       
                                <img src="{{ asset('/files/image') }}/ceo1.png" 
                                alt="Imagen" class="text-center rounded bx-shadow-lg img-fluid" width="100%">
                            </div>   
                            <div class="border rounded m-1 p-2">
                                <p class="mb-1 font-weight-bold py-2">Desarrollo del sondeo:</p>
                                <h4 class="font-weight-bold">Cultura política y nuevas formas de gobernanza en El Salvador del siglo 21</h4>      
                                <p class="text-muted font-15 text-justify">
                                    En el periodo comprendido de noviembre de 2020 a febrero de 2021 y cuya presentación pública se realizó ante los medios de comunicación el miércoles 10 de febrero de 2021 en la sala de reuniones del Consejo Superior Universitario.
                                </p>       
                                <img src="{{ asset('/files/image') }}/ceo2.png" 
                                alt="Imagen" class="text-center rounded bx-shadow-lg img-fluid" width="100%">
                            </div> 
                            @if (count($sondeos)>0)
                                
                            @else
                                <p class="p-2 border text-center">No hay noticias para mostrar.</p>                                
                            @endif            
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab2">                           
                            <a class="nav-link btn btn-danger waves-effect width-md" href="#index"
                            onclick="$('.nav-link').removeClass('active')" data-toggle="pill">
                                <i class="mdi mdi-arrow-left-thick"></i> 
                                    Volver a Investigación
                            </a>
                        </div>                        
                    </div>
                </div> <!-- end col -->
                @auth
                <div id ="modalCR" class="modal fade bs-example-modal-center" tabindex="-1" 
                role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('imagenCAborrar', ['url'=> 'investigacion']) }}" method="POST">
                                    @csrf
                                    <div class="row py-3">
                                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                                        <div class="col-lg-10 text-black">
                                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se elimina este registro de manera permanente, ¿Desea continuar?</h4>
                                        </div>
                                        <input type="hidden" name="_id" id="imagenCR">
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
                @endauth
                <div class="col-xl-4">
                    <h4>Subunidades</h4>
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#v-pills-social2" role="tab" aria-controls="v-pills-social2"
                            aria-selected="true">Centro de Estudio de Opinión Publica (CEOP)</a>
                        <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">Centro de Investigación Ambiental</a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
    </div> <!-- end container -->
</div> 
@endsection