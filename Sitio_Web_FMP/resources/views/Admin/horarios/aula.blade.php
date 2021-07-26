@extends('layouts.admin')

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
                                <label for="exampleInputCodigo">Código</label>
                                <input type="text" class="form-control" name="codigo" placeholder="Digite el código">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre_aula"  placeholder="Digite el nombre de la Aula">
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion_aula" placeholder="Digite la Ubicación">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Capacidad</label>
                                <input type="text" class="form-control" name="capacidad" placeholder="Digite la Capacidad">
                            </div>
                        </div>
                    </div>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#empleadoForm','#notificacion')">Guardar</button>
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
            <table  class="table table-sm" id="table-aulas">
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
        $('#table-aulas').DataTable({
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
