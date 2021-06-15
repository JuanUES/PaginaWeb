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
                            <h3 class="py-2">Administración académica</h3>
                            <h4>Instructivo de procesos académicos</h4>
                            <div class="row button-list">
                                <div class="col-md-4">
                                    <button class="btn btn-primary waves-effect waves-light width-md btn-lg">
                                        <i class="fa fa-graduation-cap fa-x2"></i>
                                        <br>
                                        Orientaciones a graduandos
                                    </button>
                                </div>
                              
                                <div class="col-md-4">
                                    <button class="btn btn-danger waves-effect waves-light width-md btn-lg">
                                        <i class="fa fa-pause" aria-hidden="true"></i>
                                        <br>
                                        Inidicaciones para el retiro oficial de ciclo
                                    </button>
                                </div>

                                <div class="col-md-4 ">
                                    <button class="btn btn-info waves-effect waves-light width-md btn-lg">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                        <br>

                                        Pasos para tramitar certificación de notas
                                    </button>
                                </div>
                            </div>
                                      
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab2">                           
                            <h3 class="py-2">Administración académica</h3>
                            <h3>Calendario de actividades académico-administrativas</h3>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="table table-responsive">
                                    <div class="alert alert-info">
                                        <h5>Ciclo I / 2021</h5>
                                    </div>
                                    <table class="table table-hover">
                                        <th>No.</th>
                                        <th>Actividades</th>
                                        <th>Inicio</th>
                                        <th>Final</th>
                                        <th>Duración (semanas)</th>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Activación por retiro</td>
                                                <td>03/07/21</td>
                                                <td>02/12/21</td>
                                                <td>9</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table table-responsive">
                                    <div class="alert alert-info">
                                        <h5>Ciclo II / 2021</h5>
                                    </div>
                                    <table class="table table-hover">
                                        <th>No.</th>
                                        <th>Actividades</th>
                                        <th>Inicio</th>
                                        <th>Final</th>
                                        <th>Duración (semanas)</th>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Activación por retiro</td>
                                                <td>03/07/21</td>
                                                <td>02/12/21</td>
                                                <td>9</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>    
                            </div>
                        </div>  
                        
                        <div class="tab-pane fade" id="v-pills-profile3" role="tabpanel" aria-labelledby="v-pills-profile-tab2"> 
                            <h3 class="py-2">Administración académica</h3>
                            <h4>Oferta académica</h4>
                            <div class="table table-responsive">
                                <table class="table table-hover none-border">
                                    <th>Carrera</th>
                                    <th>Pénsum</th>
                                    <tbody>
                                        <tr>
                                            <td>Ingeniería de Sistemas Informáticos</td>
                                            <td>
                                                <button class="btn btn-danger">Descargar <i class="fa fa-download" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4">
                    <h4>Procesos académicos</h4>
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#v-pills-social2" role="tab" aria-controls="v-pills-social2"
                            aria-selected="true">Instructivo de procesos académicos</a>
                        <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">Calendario de actividades academíco-administrativas</a>
                            <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile3" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">Oferta académica</a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
    </div> <!-- end container -->
</div> 
@endsection