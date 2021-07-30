@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administracion de Jonada</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12 col-sm-4">
                <a href="{{ url('/admin/jornada/create') }}" class="btn btn-success" title="Agregar">
                        <i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Registro
                    </a>
                </div>
            </div>
            
            <br/>
            <br/>
            <table  class="table table-sm" id="table-jornada">
                <thead>
                <tr>
                    <th data-priority="1">Id</th>
                    <th data-priority="3">Periodo</th>
                    <th data-priority="3">Detalle</th>
                    <th data-priority="3">Estado</th>                  
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>GOOG <span class="co-name">Google Inc.</span></th>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>   
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
        $('#table-jornada').DataTable({
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