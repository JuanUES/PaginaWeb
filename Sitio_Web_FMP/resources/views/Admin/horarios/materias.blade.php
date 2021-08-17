@extends('layouts.admin')

@section('content')
<!--Para registro y actualizar-->
<!-- Modal -->
<div class="modal fade" id="modal-materias" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-bag-personal mdi-24px"></i>Materias</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="materiasForm" action="{{route('materias/create')}}" method="POST">
            <div class="modal-body">
                <input type="hidden" id="_id" name="_id"/>
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacion">                                               
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputCodigo">Código</label>
                                <input type="text" class="form-control" name="codigo_materia" id="codigo_materia" placeholder="Digite el código">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre_materia" id="nombre_materia"  placeholder="Digite el nombre de la materia">
                            
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputCodigo">Carrera</label>
                                @if (count($carreers))
                                <select class="custom-select" name="id_carrera" id="id_carrera">
                                    <option value="">Seleccione</option>
                                    @foreach ($carreers as $item)
                                    <option value="{!!$item->id!!}">{!!$item->nombre_carrera!!}</option>
                                    @endforeach
                                @else
                                <select class="custom-select" name="id_carrera" id="id_carrera">
                                    <option>Sin datos</option>
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">UV</label>
                                <select class="custom-select" name="uv_materia" id="uv_materia">
                                    <option value="">Seleccione</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nivel</label>
                                <select class="custom-select" name="nivel" id="nivel">
                                    <option value="">Seleccione</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#materiasForm','#notificacion')"><li class="fa fa-save"></li>Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!--fin de para registro y actualizar-->
<!--inicio modal para eliminar "Dar de baja"-->
<div id="modalEliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('estadoMateria') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de baja está materia, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="B_materia" id="B_materia">
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <button type="submit" 
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-18">
                                <i class="mdi mdi-check mdi-24px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6">
                            <button type="reset" class="btn btn-light p-1 waves-effect btn-block font-18" data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16Spx  ml-auto" aria-hidden="true"></i>
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--fin modal para eliminar-->
<!--modal para dar alta-->
<div id="modalAlta" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('estadoActi') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de alta está materia, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="M_Activar" id="M_Activar">
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <button type="submit" 
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-18">
                                <i class="mdi mdi-check mdi-24px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6">
                            <button type="reset" class="btn btn-light p-1 waves-effect btn-block font-18" data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16Spx  ml-auto" aria-hidden="true"></i>
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal para dar alta fin-->
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Materias</li>
                </ol>
            </div>
            <h4 class="page-title">Creación de Materias</h4>
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
                        Materias Registradas
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Materias" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#modal-materias"></button>
                </div>
            </div>
            <table  class="table table-sm" id="table-materias">
                <thead>
                <tr>
                    <th data-priority="1">Código</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="1">UV</th>
                    <th data-priority="3">Nivel</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="3">Carrera</th>
                    <th data-priority="3">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $item)
                    <tr>
                        <td><span class="co-name">{!!$item->codigo_materia!!}</span></td>
                        <td><span class="co-name">{!!$item->nombre_materia!!}</span></td>
                        <td><span class="co-name">{!!$item->uv_materia!!}</span></td>
                        <td><span class="co-name">{!!$item->nivel!!}</span></td>
                        {!!$item->estado?' <th><span class="co-name">Activo</span></th>':'<th><span class="co-name">Inactivo</span></th>'!!}
                        <td><span class="co-name">{!!$item->nombre_carrera!!}</span></td>
                        @if ($item->estado==true)
                       
                        <td>
                        <button title="Editar Materia" class="btn btn-outline-primary btn-sm"   onclick="editarMateria({!!$item->id!!})" data-toggle="modal" data-target="#modal-materias"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button>
                        <button title="Desactivar Materia" class="btn btn-outline-primary btn-sm" onclick="eliminarMateria('{!!$item->id!!}')" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button>
                        </td>
                        @endif
                        @if ($item->estado==false)
                        <td>
                        <button title="Editar Materia" class="btn btn-outline-primary btn-sm"   onclick="editarMateria({!!$item->id!!})" data-toggle="modal" data-target="#modal-materias"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button>
                        <button title="Activar Materia" class="btn btn-outline-primary btn-sm" onclick="ActivarCarrer('{!!$item->id!!}')" data-toggle="modal" data-target="#modalAlta"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        </button>
                        </td>
                        @endif
                           
                        
                    </tr>
                    @endforeach          
                </tbody>
            </table>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->   
@endsection

@section('plugins-js')
<script src="{{ asset('js/scripts/http.min.js') }}"></script>
<script src="{{ asset('js/horariosJs/materias.js') }}"></script>
<!-- Dashboard Init JS -->
<script src="{{ asset('template-admin/dist/assets/js/pages/dashboard.init.js') }}"></script>
<script>
    function editarMateria(id){
        $json = {!!json_encode($subjects)!!}.find(x => x.id==id);
        editar($json);
        }
</script>
<script>
    $(document).ready(function () {
        $('#table-materias').DataTable({
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
