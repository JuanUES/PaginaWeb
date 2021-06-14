@extends('Pagina/baseOnlyHtml')

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

        <div class="card-box"> 
            <div class="row">
                <div class="col-xl-8 px-3">
                    <div class="tab-content pt-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-social2" role="tabpanel" aria-labelledby="v-pills-social-tab2">
                            <h3 class="py-2">Centro de estudio de Información Publica (CEOP)</h3>
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
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab2">                           
                        </div>                        
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4">
                    <h4>Unidad de investigación</h4>
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#v-pills-social2" role="tab" aria-controls="v-pills-social2"
                            aria-selected="true">Centro de estudio de Información Publica (CEOP)</a>
                        <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">Centro de Investigación Ambiental</a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
    </div> <!-- end container -->
</div> 
@endsection