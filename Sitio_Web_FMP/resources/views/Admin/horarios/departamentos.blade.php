@extends('layouts.admin')

@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade" id="form-depto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-book-open-page-variant mdi-24px" aria-hidden="true" ></i> Departamento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deptoForm" action="{{route('depto.store')}}" method="POST">
            <div class="modal-body">
                <input type="hidden" id="_id" name="_id"/>
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacion">                                               
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <label>Nota: <code>* Campos Obligatorio</code></label>
                            <div class="form-group">
                                <label for="exampleInputNombre">Nombre Departamento<code>*</code></label>
                                <input type="text" class="form-control" name="nombre_departamento" id="nombre_departamento" placeholder="Digite el nombre del departamento">
                            
                            </div>
                        </div>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#deptoForm','#notificacion')"><li class="fa fa-save"></li>Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!--fin modal de registro-->

<!--inicio modal para eliminar-->
<div id="modalEliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('estadoDept') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de baja este departamento, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="E_depto" id="E_depto">
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
            <form action="{{ route('estadoADept') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de alta este departamento, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="E_Activar" id="E_Activar">
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
                    <li class="breadcrumb-item active">Departamentos</li>
                </ol>
            </div>
            <h4 class="page-title">Creación de Departamentos</h4>
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
                        Departamentos Registrados
                    </h3>      
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Departamentos" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#form-depto"></button>
                </div>
            </div>
            <table  class="table table-sm" id="table-depto">
                <thead>
                <tr>
                    <th data-priority="1">N°</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="1">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                    @foreach ($deptos as $item)
                <tr>
                    <td>{!!$item->id!!}</td>
                    <th><span class="co-name">{!!$item->nombre_departamento!!}</span></th>
                    @if ($item->estado==true)
                    <th><span class="co-name">Activo</span></th>
                    <td>
                    <button title="Editar Departamento" class="btn btn-outline-primary btn-sm"   onclick="editarDepto({!!$item->id!!})" data-toggle="modal" data-target="#form-depto"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                    </button>
                    <button title="Desactivar Departamento" class="btn btn-outline-primary btn-sm" onclick="eliminarDepto('{!!$item->id!!}')" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                    </button>
                    </td>
                    @endif
                    @if ($item->estado==false)
                    <th><span class="co-name">Inactivo</span></th>
                    <td>
                    <button title="Editar Departamento" class="btn btn-outline-primary btn-sm"   onclick="editarDepto({!!$item->id!!})" data-toggle="modal" data-target="#form-depto"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                    </button>
                    <button title="Activar Departamento" class="btn btn-outline-primary btn-sm" onclick="ActivarDepto('{!!$item->id!!}')" data-toggle="modal" data-target="#modalAlta"><i class="fa fa-arrow-up" aria-hidden="true"></i>
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
<script src="{{ asset('js/horariosJs/depto.js') }}"></script>
<!-- Dashboard Init JS -->
<script src="{{ asset('template-admin/dist/assets/js/pages/dashboard.init.js') }}"></script>

<script>
    function editarDepto(id){
        $json = {!!json_encode($deptos)!!}.find(x => x.id==id);
        editar($json);
        }
</script>
<script>
    $(document).ready(function () {
        $('#table-depto').DataTable({
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
