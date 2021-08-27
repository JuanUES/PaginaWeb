@extends('layouts.admin')

@section('content')

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


<div class="card-box">
    <div class="row">
        <div class="col-9">
            <h3>Tipo Contrato Registrados</h3>
        </div>
        <div class="col-3" style="text-align:right">
            <a href="{{ route('admin.periodo.create')}}" class="btn btn-primary" title="Agregar nuevo registro">
                <i class=" dripicons-plus" aria-hidden="true"></i>
            </a>
        </div>

    </div>
            
            <br/>
            <br/>
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
                @foreach($periodo as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->tipo }}</td>
                    <td>{{ date('d-m-Y', strtotime( $item->fecha_inicio)) }}</td>
                    <td>{{ date('d-m-Y', strtotime( $item->fecha_fin)) }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>
                    <a href="{{ route('admin.periodo.edit', $item->id) }}" title="Modificar contenido"><button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>
                    </td>
               
                </tr>
                @endforeach
                </tbody>
            </table>

</div> <!-- end card-box -->
 
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
