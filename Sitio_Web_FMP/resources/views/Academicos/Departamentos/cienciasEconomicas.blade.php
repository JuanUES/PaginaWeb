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
                <div class="col-xl-12">
                    <h2 class="header-title py-2">Departamento de ciencias económicas</h2>
                    <p class="sub-header">
                        Actualmente el Departamento administra dos carreras de grado presenciales (Licenciatura en contaduría pública y Licenciatura en administración de empresas)
                    </p>                    

                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#agronomica" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Licenciatura en Contaduría Pública
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#industrial" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Licenciatura en Administración de Empresas
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="agronomica" >
                            <div class="row">
                                <div class="col-xl-8 order-first ">

                                    <p class="mb-1 font-weight-bold ">Código:</p>
                                    <p class="text-muted font-15 text-justify">L70802 </p>
            
                                    <p class="mb-1 font-weight-bold py-2">Descripción:</p>
                                    <p class="text-muted font-15 text-justify">
                                        Los estudios de Contaduría Pública persiguen formar profesionales con amplio dominio de la técnica, sistemas contables y conocimientos legales que se utilizan modernamente, para examinar y dictaminar sobre los resultados reales de las operaciones de las empresas, y además dotarlos de conocimientos suficientes, para analizar y presentar las bases que permitan orientar eficientemente las políticas financieras de la Empresa y así encaminar su ejercicio profesional al mejor desarrollo de nuestro pueblo, procurando tener un conocimiento científico y objetivo de la realidad.
                                    </p> 
                                    <p class="text-muted font-15 text-justify">PRE-ESPECIALIDADES: La Escuela de Contaduría no tiene especializaciones; pero en el campo profesional se puede especializar en las siguientes áreas:</p>
                                    <ul>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                	Auditoría
                                            </p> 
                                        </li>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                	Costos
                                            </p> 
                                        </li>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                	Financiera
                                            </p> 
                                        </li>
                                        <li>
                                            <p class="text-muted font-15 text-justify">
                                                	Legal
                                            </p> 
                                        </li>
                                    </ul>
                                                     
            
                                    <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                                    <p class="text-muted font-15">
                                        5 años.
                                    </p>
            
                                    <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                                    <p class="text-muted font-15">
                                        LICENCIADO (A) EN CONTADURÍA PÚBLICA.
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="industrial">
                            <div class="row">
                                <div class="col-xl-8">
                                    <p class="mb-0 font-weight-bold ">Código</p> 
                            <p class="text-muted font-15 text-justify">
                                L70803
                            </p>                   
                            <p class="mb-1 font-weight-bold py-2">Descripción:</p>
                            <p class="text-muted font-15 text-justify">
                                El estudio de la Administración se enmarca en el contexto de la economía globalizada y su misión es formar recurso humano capacitado en la teoría económica, la investigación científica y el manejo de la tecnología apropiada, necesaria para el desarrollo económico-social sustentable.
                            </p> 
                            

                            <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                            <p class="text-muted font-15">
                                5 años.
                            </p>
    
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                LICENCIADO (A) EN ADMINISTRACIÓN DE EMPRESAS
                            </p>
                                </div>
                            </div>                            
    
                        </div>
                    </div>
                </div>              

            </div>
            <!-- end row -->

        </div> <!-- end card-box -->

    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection