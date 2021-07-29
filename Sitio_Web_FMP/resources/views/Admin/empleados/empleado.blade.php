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
          <h5 class="modal-title" id=" exampleModalLongTitle">Agregar empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="empleadoForm" action="{{ route('Empleado.empleado') }}" method="POST">
            <div class="modal-body">
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacion">                                               
                    </div>
                    <div class="form-group">
                        <label for="Departamento">Departamento</label>
                       <select class="custom-select" id="departamento" name="departamento">

                       </select>
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

                    <div class="form-group">
                        <label for="exampleInputPassword1">Jefe</label>
                        
                            @if (count($empleadoJefe))
                            <select class="custom-select" name="jefe">
                                @foreach ($empleadoJefe as $item)
                                <option value="{!!$item->id!!}">{!!$item->nombre.' '.$item->apellido!!}</option>
                                @endforeach
                            @else
                            <select class="custom-select" name="jefe" disabled>
                                <option value="">Sin datos</option>
                            @endif          
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
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>
            </div>
            <h4 class="page-title">Empleados</h4>
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
                        Empleados
                    </h3>      
                </div>
                <div class="col-3">   
                    <button class="btn btn-info" style="float: right">Subir excel</button>  
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Agregar empleado
  </button>
                </div>
            </div>

 
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table table-borderless  btn-table table-sm table-responsive-md" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Apellido</th>
                                <th data-priority="1">Nombre</th>
                                <th data-priority="3">D.U.I.</th>
                                <th data-priority="1">N.I.T.</th>
                                <th data-priority="3">Teléfono</th>
                                <th data-priority="3">Estado</th>
                                <th data-priority="6">Foto</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($todosLosEmpleados as $empleado)
                            <tr>
                                
                                <td>{!!$empleado->apellido!!}</td>
                                <td>{!!$empleado->nombre!!}</td>
                                <td>{!!$empleado->dui!!}</td>
                                <td>{!!$empleado->nit!!}</td>
                                <td>{!!$empleado->telefono!!}</td>
                                <td>{!!$empleado->estado!!}</td>
                           
                            </tr>
                            @endforeach
                            
                            
                            
                            
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