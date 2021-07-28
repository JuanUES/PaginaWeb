@extends('layouts.admin')

@section('content')
<!-- Modal -->
<div class="modal fade" id="modalPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle">Agregar Periodo</h5>
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
                                <label for="FechaI">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fechaIni" >
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="FechaF">Fecha Fin</label>
                                <input type="date" class="form-control" id="fechafin"  >
                            
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="select">
                                    <option value="0" selected>Seleccion</option>
                                    <option value="1" >Administrativo</option>
                                    <option value="2">Docente</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="estado" >
                                <label class="form-check-label" for="estado">Activo</label>
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
            <!--<div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Aulas</li>
                </ol>
            </div>-->
            <h4 class="page-title"><i class="fa fa-list"></i> Administacion de Periodos</h4>
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
                        Periodos Registradas
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Periodo" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#modalPeriodo"></button>
                </div>
            </div>
            <table  class="table table-sm" id="table-periodo">
                <thead>
                <tr>
                    <th data-priority="1">Id</th>
                    <th data-priority="3">Tipo</th>
                    <th data-priority="3">Fecha Inicio</th>
                    <th data-priority="1">Fecha Fin</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="3">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <td>---</td>
                    <td>597.74</td>
                    <td>12:12PM</td>
                    <td>14.81 (2.54%)</td>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
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
<!-- Dashboard Init JS -->
<script src="{{ asset('template-admin/dist/assets/js/pages/dashboard.init.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-periodo').DataTable({
          "language": {
              "decimal":        ".",
              "emptyTable":     "No hay datos para mostrar",
              "info":           "Del _START_ al _END_ (_TOTAL_ total)",
              "infoEmpty":      "Del 0 al 0 (0 total)",
              "infoFiltered":   "(Filtrado de todas las _MAX_ entradas)",
              "infoPostFix":    "",
              "thousands":      "'",
              "lengthMenu":     "Mostrar _MENU_ entradas",
              "loadingRecords": "Cargando...",
              "processing":     "Procesando...",
              "search":         "Buscar:",
              "zeroRecords":    "No hay resultados",
              "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
              },
              "aria": {
                "sortAscending":  ": Ordenar de manera Ascendente",
                "sortDescending": ": Ordenar de manera Descendente ",
              }
            },
              "pagingType": "full_numbers",
              "lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		        	"iDisplayLength":	5,
        });  
      });
</script>
@endsection
