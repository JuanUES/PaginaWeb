@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administación de Tipos de Jornadas</h4>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="row">
        <div class="col-9">
            <h3>Tipos de Jornadas Registradas</h3>
        </div>
        <div class="col-3" style="text-align:right">
            <a href="{{ route('admin.tjornada.create')}}" class="btn btn-primary" title="Agregar nuevo registro">
                <i class=" dripicons-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
            <br/>
            <br/>
            <table  class="table table-sm" id="table-tjornada">
                <thead>
                <tr>
                    <th data-priority="1">Id</th>
                    <th data-priority="3">Tipo</th>
                    <th data-priority="3">Horas Semanlaes</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="3">Acciones</th>

                </tr>
                </thead>
                <tbody>
                @foreach($tjornada as $item)
                <tr>
                    <th>{{ $item->id }}</span></th>
                    <td>{{ $item->tipo }}</td>
                    <td>{{ $item->horas_semanales }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>
                    <a href="{{ route('admin.tjornada.edit', $item->id) }}" title="Modificar contenido"><button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>
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
        $('#table-tjornada').DataTable({
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
