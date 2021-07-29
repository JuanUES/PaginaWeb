@extends('layouts.admin')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle">Agregar Carga Administrativa</h5>
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
                                <label for="exampleInputNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre_carga"  placeholder="Digite el nombre de la carga">
                            
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
            <h4 class="page-title">Creación de Carga Administrativa</h4>
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
                        Carga Administrativa Registrada
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Carga Administrativa" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#exampleModalCenter"></button>
                </div>
            </div>
            <table  class="table table-sm" id="table-carga">
                <thead>
                <tr>
                    <th data-priority="1">N°</th>
                    <th data-priority="3">Carga Administrativa</th>
                    <th data-priority="1">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
               
                </tr>
                <tr>
                    <td>2</td>
                    <th>AAPL <span class="co-name">Apple Inc.</span></th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <th>AMZN <span class="co-name">Amazon.com Inc.</span></th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <th>ORCL <span class="co-name">Oracle Corporation</span></th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button></a>
                    </td>
                  
                </tr>
                <tr>
                    <td>5</td>
                    <th>MSFT <span class="co-name">Microsoft Corporation</span></th>
                    <td><a href="" title="Editar Aula">
                        <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button></a>
                        <a href="" title="Eliminar Aula">
                            <button class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button></a>
                    </td>
                </tr>
                
                <tr>
                    <td>6</td>
                    <th>YHOO <span class="co-name">Yahoo! Inc.</span></th>
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
<!-- Dashboard Init JS -->
<script src="{{ asset('template-admin/dist/assets/js/pages/dashboard.init.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-carga').DataTable({
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
