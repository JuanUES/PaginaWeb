@extends('layouts.admin')

@section('content')
<!-- Modal -->
<div class="modal fade" id="carga" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-bank-minus mdi-24px"></i> Carga Administrativa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="cargaForm" action="{{route('carga.create')}}" method="POST">
            <div class="modal-body">
                <input type="hidden" id="_id" name="_id"/>
                    @csrf
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" 
                        role="alert" style="display:none" id="notificacionCarga">                                               
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre_carga" id="nombre_carga"  placeholder="Digite el nombre de la carga">
                            
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputCategoria">Categoria</label>
                                <select class="custom-select" name="categoria" id="categoria">
                                    <option value="">Seleccione</option>
                                    <option value="ad">Carga Administrativa</option>
                                    <option value="ps">Proyección Social</option>
                                    <option value="tg">Trabajo de Grado</option>
                                </select>
                            </div>
                        </div>
                    </div>

            <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                        <label for="Departamento">Jefe </label>
                        <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            id="jefe" name="jefe">
                            <option value="" selected>Seleccione</option>
                            @foreach ($empleados as $i)
                                <option value="{!!$i->id!!}">{!!$i->nombre.' '.$i->apellido!!}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                   
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="submitForm('#cargaForm','#notificacionCarga')"><li class="fa fa-save"></li>Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- start page title -->

<!--modal para dar alta-->
<div id="modalAlta" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="mdi mdi-arrow-up-bold  mdi-24px" style="margin: none; padding: none;"></i>
                    <i class="mdi-arrow-down-bold mdi mdi-24px" style="margin: 0px;"></i> Dar Baja/Alta</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('estadoCarga') }}" method="POST" id="altaBajaForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion1">
                    </div>
                    <input type="hidden" name="_id" id="activarId">
                    <div class="row py-3">
                        <div class="col-xl-2 fa fa-exclamation-triangle text-warning fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h4 class="font-17 text-justify font-weight-bold">
                                Advertencia: Se dara de alta/baja este usuario, ¿Desea continuar?
                            </h4>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 p-1">
                            <button  type="button" onclick="submitForm('#altaBajaForm','#notificacion1')"
                                class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                                <i class="mdi mdi-check mdi-16px"></i>
                                Si
                            </button>
                        </div>
                        <div class="col-xl-6 p-1">
                            <button type="reset" 
                                class="btn btn-light p-1 waves-light waves-effect btn-block font-24" 
                                data-dismiss="modal" >
                                <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
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
            <div class="row py-2">
                <div class="col order-first">
                    <h3>
                        Carga Administrativa Registrada
                    </h3>      
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Carga Administrativa"
                 class="btn btn-primary dripicons-plus"
                  data-toggle="modal" data-target="#carga"></button>
                </div>
            </div>
            <table  class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th data-priority="1">N°</th>
                    <th data-priority="1">Carga Administrativa</th>
                    <th data-priority="1">Jefe</th>
                    <th data-priority="1">Estado</th>
                    <th data-priority="1">Acciones</th>
                  
                </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($carga as $item)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td>{!!$i!!}</td>
                        <th><span class="co-name">{!!$item->nombre_carga!!}</span></th>
                        <th>{!!$item->nombre!!}</th>
                        <td class="align-middle font-16">{!! !$item->estado?'<span class="badge badge-danger">Desactivado</span> ' :
                            '<span class="badge badge-success">Activado</span> ' !!}</td>
                        <td class="align-middle ">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="btn-group" role="group">
                                        <button title="Editar Carga" class="btn btn-outline-primary btn-sm rounded"  onclick="editarCarga({!!$item->id!!})"
                                        data-toggle="modal" data-target="#carga"><i class="fa fa-edit font-16" aria-hidden="true"></i>
                                        </button>
                                        <button title="{!! !$item->estado?'Activar' : 'Desactivar' !!}" 
                                            class="btn btn-outline-primary btn-sm mx-1 rounded 
                                                {!! $item->estado?'btn-outline-danger' : 'btn-outline-success' !!}" 
                                            data-toggle="modal" data-target="#modalAlta" 
                                            onclick="$('#activarId').val({!!$item->id!!});">
                                            {!! !$item->estado?'<i class="mdi mdi-arrow-up-bold font-18"></i>':
                                                               '<i class="mdi mdi-arrow-down-bold font-18"></i>'!!}
                                        </button>   
                                    </div>
                                </div>
                            </div>
                        </td>
                   
                    </tr>
                        
                    @endforeach
   
                </tbody>
            </table>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->   
@endsection
@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>

@endsection

@section('plugins-js')
<script src="{{ asset('/template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/scripts/http.min.js') }}"></script>
<script src="{{ asset('js/horariosJs/carga.js') }}"></script>
<script>
    function editarCarga(id){
        $json = {!!json_encode($carga)!!}.find(x => x.id==id);
        editar($json);
        }
</script>

<script src="{{ asset('js/scripts/data-table.js') }}" defer></script>
@endsection
