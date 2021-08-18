@extends('layouts.admin')

@section('content')
<!-- Modal para registrar aulas y modificar -->
<div class="modal fade" id="aula-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle"><i class="mdi mdi-home-group mdi-24px"></i>Aulas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="AulaForm" action="{{route('aulas.store')}}" method="POST">
            <div class="modal-body">
                <input type="hidden" id="_id" name="_id"/>
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacionAula">                                               
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputCodigo">Código</label>
                                <input type="text" class="form-control" name="codigo_aula" id="codigo_aula" autocomplete="off" placeholder="Digite el código">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre_aula" id="nombre_aula" autocomplete="off"  placeholder="Digite el nombre de la Aula">
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion_aula" id="ubicacion_aula" autocomplete="off" placeholder="Digite la Ubicación">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Capacidad</label>
                                <input type="numeric" min="1" class="form-control" name="capacidad_aula" id="capacidad_aula" autocomplete="off" placeholder="Digite la Capacidad">
                            </div>
                        </div>
                    </div>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#AulaForm','#notificacionAula')"><li class="fa fa-save"></li>Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!--fin modal de agregar aulas-->
<!--inicio modal para eliminar-->
<div id="modalEliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('estadoAula') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de baja está aula, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="E_Aula" id="E_Aula">
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
            <form action="{{ route('estadoA_aula') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de alta está aula, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="A_Activar" id="A_Activar">
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
                 <button type="button" title="Agregar Aula" style="margin-left: 450px;" class="btn btn-primary dripicons-plus" data-toggle="modal" data-target="#aula-modal"></button>
                </div>
            </div>
            <table  class="table table-sm" id="table-aulas">
                <thead>
                <tr>
                    <th data-priority="1">Código</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="1">Ubicación</th>
                    <th data-priority="3">Capacidad</th>
                    <th data-priority="3">Estado</th>
                    <th data-priority="3">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                    @foreach ($aulas as $item)
                    <tr>
                        <td><span class="co-name">{!!$item->codigo_aula!!}</span></td>
                        <th><span class="co-name">{!!$item->nombre_aula!!}</span></th>
                        <td><span class="co-name">{!!$item->ubicacion_aula!!}</span></td>
                        <td><span class="co-name">{!!$item->capacidad_aula!!}</span></td>
                        {!!$item->estado?' <th><span class="co-name">Activo</span></th>':'<th><span class="co-name">Inactivo</span></th>'!!}
                        @if ($item->estado==true)
                       
                        <td>
                        <button title="Editar Aula" class="btn btn-outline-primary btn-sm"   onclick="editarAula({!!$item->id!!})" data-toggle="modal" data-target="#aula-modal"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button>
                        <button title="Desactivar Aula" class="btn btn-outline-primary btn-sm" onclick="eliminarAula('{!!$item->id!!}')" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button>
                        </td>
                        @endif
                        @if ($item->estado==false)
                        <td>
                        <button title="Editar Aula" class="btn btn-outline-primary btn-sm"   onclick="editarAula({!!$item->id!!})" data-toggle="modal" data-target="#aula-modal"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                        </button>
                        <button title="Activar Aula" class="btn btn-outline-primary btn-sm" onclick="ActivarAula('{!!$item->id!!}')" data-toggle="modal" data-target="#modalAlta"><i class="fa fa-arrow-up" aria-hidden="true"></i>
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
<script src="{{ asset('js/horariosJS/aulas.js') }}"></script>
<script>
    function editarAula(id){
        $json = {!!json_encode($aulas)!!}.find(x => x.id==id);
        editar($json);
        }
</script>
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
