@extends('layouts.admin')

@section('content')

<!-- Modal -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="lead"> <i class="fa fa-info-circle"></i> Detalle Jornada </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="col-12 col-sm-12">
                
                <table class="table" id="tableView">

                </table>
            </div>
            
        </div>
    </div>
</div>

<!--end Modal-->
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fa fa-list"></i> Administracion de Jornada</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12 col-sm-4">
                <a href="{{ route('admin.jornada.create')  }}" class="btn btn-success" title="Agregar">
                        <i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Registro
                    </a>
                </div>
            </div>
            <br>


            @if(@Auth::user()->hasRole('super-admin') || @Auth::user()->hasRole('Recurso-Humano') )
                <form method="POST" action="{{ route('admin.jornada.select', $depto[0]) }}" class="frmSelect" accept-charset="UTF-8" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento</label>
                    <select class="custom-select" id="id_depto" name="id_depto">
                        <option value="0">Seleccione</option>
                        @foreach ($depto as $dep)
                        <option for="{{ $dep->id }}" value="{{ $dep->id }}">{!!$dep->nombre_departamento!!}</option>
                        @endforeach
                    </select>
                </div>
                </form>
                
             @endif
            
            <br/>
            <br/>
            <table  class="table table-sm" id="table-jornada">
                <thead>
                @if(@Auth::user()->hasRole('super-admin')  )
                    <tr>
                        <th data-priority="1">Id</th>
                        <th data-priority="3">Periodo</th>
                        <th data-priority="3">Estado</th>
                        <th data-priority="1">Acciones</th>                  
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($jornada as $item)
                    <tr>
                        <th>{{$item -> id}}</th>
                        <td>{{$item -> periodo}}</td>
                        <td>{{$item -> estado}}</td>  
                        <td>
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-primary btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                            <a href="{{ route('admin.jornada.edit', $item->id) }}" title="Editar Jornada">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif

                @if( @Auth::user()->hasRole('Recurso-Humano') )
                    <tr>
                        <th data-priority="1">Id</th>
                        <th data-priority="3">Nombre</th>
                        <th data-priority="3">Apellido</th>
                        <th data-priority="1">Acciones</th>                  
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($empJefe as $item)
                    <tr>
                        <th>{{$item -> id}}</th>
                        <td>{{$item -> nombre}}</td>
                        <td>{{$item -> apellido}}</td>  
                        <td>
                            <button data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-outline-primary btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                            <a href="" title="Editar Jornada">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
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

    $(".openModal").click(function (e) {
        e.preventDefault();
        $('#modalView').modal('show');
        let key = $(this).data('key');
        $.get( "{{ url('admin/jornada/detalle/') }}/"+key+"/", function(data) {
            const horario = data.map(function(datas){return datas.detalle;});
            const dia = data.map(function(datas){return datas.dia;});

           // console.log(obj.join('\n'));
            let contenido = `
                <tr>
                    <th>Días</th>
                    <th>Horario</th>
                </tr>
                <tr>
                    <td>${dia.join('<br>')}</td>
                    <td>${horario.join('<br>')}</td>
                </tr>`;
            $("#tableView").html(contenido);
        });
    });


</script>
@endsection