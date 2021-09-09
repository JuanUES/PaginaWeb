@extends('layouts.admin')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle"><i class="mdi mdi-briefcase-edit-outline mdi-24px"></i> Asignar Carga Administrativa</h5>
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
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputCarga">Asignar</label>
                                <select class="custom-select" name="A_carga" id="A_carga"/>
                                    <option value="">Seleccione</option>
                                    <option value="Carga Administrativa">Carga Administrativa</option>
                                    <option value="Investigacion">Investigación</option>
                                    <option value="Proyeccion Social">Proyección Social</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputDocente">Docente</label>
                                <select class="custom-select" name="id_empleado">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputDocente">Carga Administrativa</label>
                                <select class="custom-select" name="id_carga">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputDias">Día</label>
                                <select class="custom-select" name="dias">
                                    <option value="">Seleccione</option>
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                              <label for="exampleInputCantidad">Cantidad</label>
                              <input type="number" min="1" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese la cantidad">
                              </div>
                        </div>

                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#empleadoForm','#notificacion')"><li class="fa fa-save"></li>Guardar</button>
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
                    <li class="breadcrumb-item active">Carga Administrativa</li>
                </ol>
            </div>
            <h4 class="page-title">Asignación de Carga Administrativa</h4>
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
                    Carga Administrativa Asignada
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Carga Asignar Administrativa" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#exampleModalCenter"></button>
                </div>
            </div>
            <table  class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th data-priority="1">Personal</th>
                    <th data-priority="3">Carga Administrativa</th>
                    <th data-priority="3">Días</th>
                    <th data-priority="1">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>

                    <th>
                    @for ($i = 1; $i <=10; $i++)
                    GOOooooodfosdf
                        <br>
                        @endfor
                    </th>
                  
                    <th>Lunes</th>
                    <td><a href="" title="Editar Asignación">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Asignación">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
               
                </tr>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <th>GOOG</th>
                    <th>Lunes Martes</th>
                    <td><a href="" title="Editar Asignación">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Asignación">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <th>GOOG</th>
                    <th>Miercoles</th>
                    <td><a href="" title="Editar Asignación">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Asignación">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <th>GOOG</th>
                    <th>Lunes</th>
                    <td><a href="" title="Editar Asignación">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Asignación">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button></a>
                    </td>
                  
                </tr>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <th>GOOG</th>
                    <th>Lunes</th>
                    <td><a href="" title="Editar Asignación">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Asignación">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <th>GOOG</th>
                    <th>Lunes</th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                    </td>
                </tr>
                
                
                
                </tbody>
            </table>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->   
@endsection

@section('plugins-js')

<script src="{{ asset('js/scripts/data-table.js') }}" defer></script>
@endsection
