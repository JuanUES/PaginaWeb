@extends('layouts.admin')

@section('plugins')
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
@endsection
@section('plugins-js')
   <!--Librerias js para datatable
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/index/index.datatable.js') }}"></script>-->
    <script src="{{ asset('template-admin/dist/assets/js/licencia/httpLicencia.min.js') }}"></script>
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle">Agregar Aulas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="empleadoForm" action="" method="POST">
            <div class="modal-body">
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacion">                                               
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Digite el nombre">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Apellido</label>
                                <input type="text" class="form-control" name="apellido"  placeholder="Digite el apellido">
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">D.U.I.</label>
                                <input type="text" class="form-control" name="dui" placeholder="Digite el número de D.U.I.">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">N.I.T.</label>
                                <input type="text" class="form-control" name="nit" placeholder="Digite el número de N.I.T.">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono" placeholder="Digite el número de teléfono">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Tipo empleado</label>
                    <select class="custom-select" name="tipo_jefe">
                        <option value="1">Decano</option>
                        <option value="2">Vice-decano</option>
                        <option value="3">Administrativo</option>
                        <option value="4">Académico</option>
                    </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#empleadoForm','#notificacion')">Guardar empleado</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Aulas</li>
                </ol>
            </div>
            <h4 class="page-title">Creación de Aulas</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Aulas Registradas
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#exampleModalCenter"></button>
                </div>
            </div>
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table table-borderless  btn-table table-sm table-responsive-md" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">Código</th>
                                <th data-priority="3">Nombre</th>
                                <th data-priority="1">Ubicación</th>
                                <th data-priority="3">Capacidad</th>
                                <th data-priority="3">Acciones</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>GOOG <span class="co-name">Google Inc.</span></th>
                                <td>597.74</td>
                                <td>12:12PM</td>
                                <td>14.81 (2.54%)</td>
                                <td>582.93</td>
                           
                            </tr>
                            <tr>
                                <th>AAPL <span class="co-name">Apple Inc.</span></th>
                                <td>378.94</td>
                                <td>12:22PM</td>
                                <td>5.74 (1.54%)</td>
                                <td>373.20</td>
                             
                            </tr>
                            <tr>
                                <th>AMZN <span class="co-name">Amazon.com Inc.</span></th>
                                <td>191.55</td>
                                <td>12:23PM</td>
                                <td>3.16 (1.68%)</td>
                                <td>188.39</td>
                             
                            </tr>
                            <tr>
                                <th>ORCL <span class="co-name">Oracle Corporation</span></th>
                                <td>31.15</td>
                                <td>12:44PM</td>
                                <td>1.41 (4.72%)</td>
                                <td>29.74</td>
                              
                            </tr>
                            <tr>
                                <th>MSFT <span class="co-name">Microsoft Corporation</span></th>
                                <td>25.50</td>
                                <td>12:27PM</td>
                                <td>0.66 (2.67%)</td>
                                <td>24.84</td>
                            </tr>
                            
                            <tr>
                                <th>YHOO <span class="co-name">Yahoo! Inc.</span></th>
                                <td>15.81</td>
                                <td>12:25PM</td>
                                <td>0.11 (0.67%)</td>
                                <td>15.70</td>
                            </tr>
                            
                            
                            
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- table-rep-plugin-->
            </div>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->   
@endsection