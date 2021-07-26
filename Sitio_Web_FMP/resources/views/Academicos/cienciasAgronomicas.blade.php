@extends('Pagina/baseOnlyHtml')

@section('header')
@auth    
    <!-- Este css se carga nada mas cuando esta logeado un usuario-->
    <link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />
@endauth    
@endsection

@section('footer')
    @auth
    <script src=" {{ asset('js/dropzone.min.js') }} "></script>   
    <script src=" {{ asset('js/scripts/dropzonePdf.js') }} "></script>
    <script src=" {{ asset('js/scripts/pdf.js') }} "></script>
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
                <div class="col-xl-12">
                    <h2 class="header-title py-2">Departamento de ciencias agronómicas</h2>
                    <p class="sub-header">
                        Actualmente el Departamento administra dos carreras de grado presenciales (Ingeniería Agronómica e Ingeniería Agroindustrial)
                    </p>                    

                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#agronomica" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Ingeniería Agronómica
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#industrial" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Ingeniería Agroindustrial
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="agronomica" >
                            <div class="row">
                                <div class="col-xl-8 order-first ">

                                    <p class="mb-1 font-weight-bold ">Código:</p>
                                    <p class="text-muted font-15 text-justify">I70304 </p>
            
                                    <p class="mb-1 font-weight-bold py-2">Descripción de las áreas curriculares o de formación:</p>
                                    <p class="text-muted font-15 text-justify">
                                        La Carrera de Ingeniería Agronómica tiene como fin contribuir al desarrollo sostenible de El Salvador, atendiendo las demandas de los diferentes sectores poblacionales preferentemente en beneficio de las mayorías; desarrollar las Ciencias Agronómicas, con un enfoque holístico y sistemático con un conocimiento científico de los procesos y fenómenos de la naturaleza y la sociedad; desarrollar tecnologías apropiadas para mejorar los sistemas de producción agropecuarios, la conservación y el aprovechamiento racional de los recursos naturales renovables y, contribuir con un modelo curricular de contenidos ajustados a la realidad del desarrollo agropecuario en El Salvador.
                                    </p> 
                                    <p class="text-muted font-15 text-justify">La estructura de la Carrera de Ingeniería Agronómica comprende tres ejes:</p>
                                    <ul>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                Teórico, de Investigación y de Proyección Social, los cuales presentan una modalidad integradora de una forma progresiva en el desarrollo del Pensum, de manera que en los primeros años habrá cursos integradores relacionados a la realidad agropecuaria nacional en donde se involucran conocimientos básicos y aspectos socioeconómicos del sector agropecuario, hasta lograr la integración en los últimos años de la Carrera. El Pensum se ha dividido en tres áreas: Un área básica donde conocerán los fundamentos físicos, químicos, matemáticos, biológicos y sociales.
                                            </p> 
                                        </li>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                Un área Tecnológica en donde conocerán los factores productivos del campo agropecuario enfocando principalmente el uso, conservación y manejo de los recursos naturales y el área de Integración en donde se estudiarán los diferentes sistemas de producción agropecuaria en los cuales estarán involucrados los factores que intervienen en la productividad.
                                            </p> 
                                        </li>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                En el desarrollo de las tres áreas van involucrados los ejes de Investigación, y Proyección Social los cuales se desarrollarán en los diferentes ciclos del Pensum mediante la realización de actividades que tengan que ver con los problemas reales del sector agropecuario, así como del conocimiento del estado, uso, manejo y conservación de los recursos naturales.
                                            </p> 
                                        </li>
                                    </ul>
                                                     
            
                                    <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                                    <p class="text-muted font-15">
                                        5 años.
                                    </p>
            
                                    <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                                    <p class="text-muted font-15">
                                        Ingeniero(a) Agrónomo.
                                    </p>
                                    
                                    <p class="mb-1 font-weight-bold">Pensum:</p>
                                    <a href="{{$pdfs->where('file','ingAgro.pdf')->first()==null 
                                        ? '#':asset('files/pdfs/'.$pdfs[0]->localizacion.'/ingAgro.pdf')}}"
                                         type="submit" class="btn btn-outline-danger" id="ingAgro" target="_blank">
                                         <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div>
                                    </a>
                                    @auth
                                    <a href="#" class="btn  btn-outline-info my-2" 
                                    data-toggle="modal" data-target=".bs-example-modal-center" onclick="pdf('ingAgro')">
                                        <i class="mdi mdi-cloud-upload mdi-24px ml-2 align-center"></i> Subir Archivo
                                    </a>
                                    @endauth 
                                </div>
                                
                            </div>
                            
    
                        </div>
                        <div class="tab-pane" id="industrial">
                            <div class="row">
                                <div class="col-xl-8">
                                    <p class="mb-0 font-weight-bold ">Código</p> 
                                    <p class="text-muted font-15 text-justify">
                                        I70305
                                    </p>                   
            
                                    <p class="mb-1 font-weight-bold">Objetivo:</p>
                                    <p class="text-muted font-15 text-justify">
                                        Tiene como objetivo fundamental formar profesionales integrales, para que desempeñen profesionalmente y con pertinencia mediante sus capacidades humanas, científicas-técnicas y contribuyan al desarrollo sostenible de la agroindustria nacional.
                                    </p>                   
            
                                    <p class="mb-1 font-weight-bold">Perfil profesional:</p>
                                    <p class="text-muted font-15 text-justify">
                                        El desempeño del Ingeniero o Ingeniera Agroindustrial en un determinado tipo de empresa productiva o de servicio, está basado en las habilidades, conocimientos y destrezas adquiridas durante su formación y que lo hacen competente para desempeñarse en cualquier situación. Por lo tanto, el siguiente perfil considera las necesidades objetivas de la sociedad y la práctica profesional necesaria para la transformación y el desarrollo del entorno cultural, socioeconómico y político del país y la región.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Formación en ciencias básicas y aplicadas que lo capacitan para comprender, modelar, analizar procesos productivos que enfrentará en su ejercicio profesional.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Instrucción en ciencias de la producción de alimentos y materias primas para la agroindustria, mediante el desarrollo de prácticas y actividades educativas.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Preparación en procesos de pre cosecha, cosecha, empaque, almacenamiento y transporte de productos agropecuarios, permitiéndole actuar con tecnología de vanguardia, sobre los procesos de la agroindustria y utilizar en forma óptima los recursos.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Conocimiento en el área de economía, administración, mercadeo, formulación, evaluación, análisis y gestión de proyectos productivos y de procesamientos agroindustriales, que complementan su formación profesional y que lo capacitan para dirigir procesos y actuar en la forma de decisiones en las instituciones y empresas.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Adiestramiento en la implementación de buenas prácticas agrícolas, pecuarias y de manufactura, así como de normas y estándares de calidad e inocuidad de alimentos para la certificación de procesos y productos.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Actitud empresarial que le permita acceder a mejores oportunidades de desarrollo social y económico.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Competencia para desarrollar investigación científica e innovación tecnológica.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Conocimientos de informática que faciliten hacer uso efectivo de los recursos tecnológicos modernos, para el análisis y resolución de las diversas situaciones que presentan los procesos productivos agro-alimentarios.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Adiestramiento sobre el manejo de los recursos naturales en los procesos productivos con enfoque de sostenibilidad.
                                    </p>
                                    <p class="text-muted font-15 text-justify">
                                        Formación académica en el ámbito social, económico y ambiental que le permita trabajar en equipo, comunicarse efectivamente y con creatividad e iniciativa en el desempeño de sus actividades.
                                    </p>

                                    <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                                    <p class="text-muted font-15">
                                        5 años.
                                    </p>
            
                                    <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                                    <p class="text-muted font-15">
                                        Ingeniero(a) Agroindustrial
                                    </p>
                                    <p class="mb-1 font-weight-bold">Pensum:</p>
                                    <a href="{{$pdfs->where('file','ingIndus.pdf')->first()==null 
                                        ? '#':asset('files/pdfs/'.$pdfs[0]->localizacion.'/ingIndus.pdf')}}"
                                         type="submit" class="btn btn-outline-danger" id="ingIndus" target="_blank">
                                         <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div>
                                    </a>
                                    @auth
                                    <a href="#" class="btn  btn-outline-info my-2" 
                                    data-toggle="modal" data-target=".bs-example-modal-center" onclick="pdf('ingIndus')">
                                        <i class="mdi mdi-cloud-upload mdi-24px ml-2 align-center"></i> Subir Archivo
                                    </a>
                                    @endauth 
                                </div>
                            </div>                            
    
                        </div>
                        @auth
                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;" id="dropZonePdf">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imágenes</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <form action="{{ route('PDF', ['localizacion'=>'ccAgro']) }}" method="post"
                                            class="dropzone" id="my-awesome-dropzone">
                                            @csrf                                 
                                            <input type="hidden" name='pdf' id="pdf">
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
                </div>              

            </div>
            <!-- end row -->

        </div> <!-- end card-box -->

    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection