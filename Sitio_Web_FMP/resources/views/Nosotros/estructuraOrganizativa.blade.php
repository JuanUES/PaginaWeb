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

        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h4 class="my-2">Organigrama</h4>
                    <embed src="document/Brochure.pdf" type="application/pdf" width="100%" height="500px" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h4 class="my-2">Miembros de la junta directiva de la facultad
                         multidisciplinaria paracentral</h4>
                    <p>Periodo 2019-2023</p>
                         <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="tex-left">  
                                            Nombre                                          
                                        </th>
                                        <th class="text-left">
                                            Sector que Representa
                                        </th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>                                        
                                        <td>Ing. Roberto Antonio Díaz Flores
                                            <!--<input type="text" class="my-1 form-control" name="" id=""  value="Ing. Roberto Antonio Díaz Flores">
                                            <a class="btn btn-info text-white">Guardar</a>-->
                                        </td>
                                        <th class="text-nowrap" scope="row">Decano</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. MSc. Luis Alberto Mejía Orellana</td>
                                        <th class="text-nowrap" scope="row">Vice-Decano</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Agr. MSc. Wilber Samuel Escoto Umaña</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Personal Académico</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. Manuel de Jesús Medina Amaya</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Personal Académico</th>
                                    </tr>
                                    <tr>
                                        <td>Licda. MSc.  Mercedes Guadalupe Catalán Granadino</td>
                                        <th class="text-nowrap" scope="row">Miembro Suplente del Personal Académico</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. MSc. Jossué Humberto Henríquez García</td>
                                        <th class="text-nowrap" scope="row">Miembro Suplente del Personal Académico</th>
                                    </tr>
                                    <tr>
                                        <td>Br. Arístides Yancarlos García Gutiérrez</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Sector Estudiantil</th>
                                    </tr>
                                    <tr>
                                        <td>Br. Oscar Javier Cruz Centeno</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Sector Estudiantil</th>
                                    </tr>
                                    <tr>
                                        <td>Br. Zuleyma Lisseth Erazo Pineda</td>
                                        <th class="text-nowrap" scope="row">Miembro Suplente del Sector Estudiantil</th>
                                    </tr>
                                    <tr>
                                        <td>Br. Meybelin Catalina Portillo Alvarado</td>
                                        <th class="text-nowrap" scope="row">Miembro Suplente del Sector Estudiantil</th>
                                    </tr>
                                    <tr>
                                        <td>Prof. Geovanny Antonio Quintanilla Panameño</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Sector Profesional No Docente</th>
                                    </tr>
                                    <tr>
                                        <td>Prof. José Francisco Aguilar</td>
                                        <th class="text-nowrap" scope="row">Miembro Propietario del Sector Profesional No Docente</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h4 class="my-2">Jefaturas académicas y administrativas de la
                         facultad multidisciplinaria paracentral</h4>
                    <p>Periodo 2019-2023</p>
                         <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="tex-left">  
                                            Nombre                                          
                                        </th>
                                        <th class="text-left">
                                            Departamento / Unidad
                                        </th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>                                        
                                        <td>
                                            <input type="text" class="my-1 form-control" name="" id=""  value="">
                                            <a class="btn btn-info text-white">Guardar</a>
                                        </td>
                                        <th class="text-nowrap" scope="row">Jefa del Departamento de Ciencias Económicas</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Virna Yasmina Urquilla Cuéllar</td>
                                        <th class="text-nowrap" scope="row">Jefa del Departamento de Informática</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Agr. MSc. José Fredy Cruz Centeno</td>
                                        <th class="text-nowrap" scope="row">Jefe del Departamento de Ciencias Agronómicas</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. MSc. Glenn Roosel Muñoz Santillana</td>
                                        <th class="text-nowrap" scope="row">Jefe del Departamento de Ciencias de la Educación</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Agr. MSc. René Francisco Vásquez</td>
                                        <th class="text-nowrap" scope="row">Jefe de la Unidad de Postgrado</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. MSc. Edwin Arnoldo Cerón Chávez</td>
                                        <th class="text-nowrap" scope="row">Jefe de la Unidad de Proyección Social</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Agr. Edgard Felipe Rodríguez</td>
                                        <th class="text-nowrap" scope="row">Coordinador de la Unidad de Investigación</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Herbert Orlando Monge Barrios</td>
                                        <th class="text-nowrap" scope="row">Coordinador de la Unidad de Planificación y Gestor de Proyectos</th>
                                    </tr>
                                    <tr>
                                        <td>Ing. Isidro Velázquez Corvera</td>
                                        <th class="text-nowrap" scope="row">Coordinador del Área de Desarrollo Físico de la Facultad</th>
                                    </tr>
                                    <tr>
                                        <td>Licda. MSc. Celia Querubina Cañas Menjívar</td>
                                        <th class="text-nowrap" scope="row">Coordinadora de la carrera de Licenciatura de la Educación para la profesionalización de<br> Educación Básica para los Ciclos Primero y Segundo</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. Jonathan Adrian Aguilar Garcia</td>
                                        <th class="text-nowrap" scope="row">Coordinadora de la carrera de la Licenciatura en Educación Plan Complementario</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. MSc. José Martín Montoya Polío</td>
                                        <th class="text-nowrap" scope="row">Administrador Académico</th>
                                    </tr>
                                    <tr>
                                        <td>Licda. María Isaura Esperanza Guardado</td>
                                        <th class="text-nowrap" scope="row">Administradora Financiera</th>
                                    </tr>
                                    <tr>
                                        <td>Lic. Inés Alberto Osorio Palacios</td>
                                        <th class="text-nowrap" scope="row">Coordinador de la Unidad de Recursos Humanos</th>
                                    </tr>
                                    <tr>
                                        <td>Licda. MSc.  Esmeralda del Carmen Quintanilla Segovia</td>
                                        <th class="text-nowrap" scope="row">Jefa de la Unidad de Biblioteca</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> 
@endsection