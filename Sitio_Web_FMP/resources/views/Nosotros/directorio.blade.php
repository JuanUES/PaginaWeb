@extends('Pagina/baseOnlyHtml')

@section('container')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-alt-bg color-top"></div>
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div> 
        <div class="my-3"></div>
        <!-- end page title -->       
        
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title py-2">Directorio</h4>                   

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-lefth">
                                        <p>Contacto</p>
                                    </th>                               
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-nowrap" scope="row">Decano</th>
                                    <td>Tel. 2393-1992</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Administración Académica</th>
                                    <td>Tel. 2393-1993 <br>Correo: academica.paracentral@ues.edu.sv</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Administración Financiera</th>
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Unidad de RRHH </th>
                                    <td colspan="5">Correo: recursos.humanos@ues.edu.sv</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Unidad de Tecnologia de la Información</th>
                                    <td colspan="5">Correo: soporte.utifmp@ues.edu.sv</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->       
        
    </div> <!-- end container -->
</div> 
@endsection