@extends('layouts.admin')
@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-account-badge-horizontal mdi-36px"></i> Empleado</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('guardarUser') }}" method="POST">
            @csrf
            <div class="modal-body">
                    <input type="hidden" id="_id" name="_id" value=""/>
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion">
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Nota: <code>* Campos Obligatorio</code></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputCodigo">Nombre <code>*</code></label>
                                <input type="text" class="form-control" id='nombre' name="usuario"  autocomplete="off" placeholder="Digite el nombre">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">Apellido <code>*</code></label>
                                <input type="text" class="form-control" id="apellido" name="correo"  autocomplete="off" placeholder="Digite el apellido">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">D.U.I. <code>*</code></label>
                                <input type="text" class="form-control" name="dui" placeholder="Digite el número de D.U.I.">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">N.I.T. <code>*</code></label>
                                <input type="text" class="form-control" name="nit" placeholder="Digite el número de N.I.T.">
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">Teléfono <code>*</code></label>
                                <input type="tel" class="form-control" name="telefono" placeholder="Digite el número de teléfono">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="">Tipo empleado <code>*</code></label>
                                <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                style="width: 100%;" name="tipo_jefe">
                                    <option value="1">Decano</option>
                                    <option value="2">Vice-decano</option>
                                    <option value="3">Administrativo</option>
                                    <option value="4">Académico</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="Departamento">Tipo Contrato <code>*</code></label>
                               <select  class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                    style="width: 100%;" id="id_tipo_contrato" name="id_tipo_contrato">
                                @foreach ($tcontrato as $contrato)
                                    <option value="{!!$contrato->id!!}">{!!$contrato->tipo!!}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="Departamento">Tipo Jornada <code>*</code></label>
                               <select  class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                                    style="width: 100%;" id="id_tipo_jornada" name="id_tipo_jornada">
                                    @foreach ($tjornada as $jornada)
                                        <option value="{!!$jornada->id!!}">{!!$jornada->tipo!!} - {!!$jornada->horas_semanales!!} horas</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="Departamento">Departamento <code>*</code></label>
                            <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            style="width: 100%;"  id="id_depto" name="id_depto">
                                @foreach ($departamentos as $depto)
                                    <option value="{!!$depto->id!!}">{!!$depto->nombre_departamento!!}</option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="col-xl-6">
                            <label for="Departamento">Jefes <code>*</code></label>
                            <select class="form-group selectpicker" data-live-search="true" data-style="btn-white"
                            style="width: 100%;"  id="jefes" name="jefes">
                                @foreach ($departamentos as $depto)
                                    <option value="{!!$depto->id!!}">{!!$depto->nombre_departamento!!}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fa fa-ban"
                    aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary"
                    onClick="submitForm('#registroForm','#notificacion')">
                    <li class="fa fa-save"></li> Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!--fin modal de registro-->

<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>
            </div>
            <h4 class="page-title">&nbsp;</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row py-2">
                <div class="col order-first">
                    <h3>
                        Empleados
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Usuario"
                    class="btn btn-primary dripicons-plus"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>                
            </div>
            <table  class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th data-priority="1" class="col-sm-1">N°</th>
                    <th data-priority="3">Nombre</th>
                    <th data-priority="3">Correo</th>
                    <th data-priority="3" class="col-sm-1 text-center">Estado</th>
                    <th data-priority="1" class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
               
                @foreach ($empleados as $item)
                <tr>
                    @php
                        $i++;
                    @endphp
                    <th class="align-middle ">{!!$i!!}</th>
                    <td class="align-middle ">{!!$item->apellido.','.$item->nombre!!}</td>
                    <td class="align-middle ">{!!$item->nit!!}</td>
                    <td class="align-middle font-16">{!! !$item->estado?'<span class="badge badge-danger">Desactivado</span> ' : '<span class="badge badge-success">Activado</span> ' !!}</td>
                    <td class="align-middle ">
                        <div class="row">
                            <div class="col text-center">
                                <div class="btn-group" role="group">
                                    <button title="Editar" class="btn btn-outline-primary btn-sm rounded" onclick="">
                                        <i class="fa fa-edit font-16" aria-hidden="true"></i>
                                    </button>
                                    <button title="{!! !$item->estado?'Activar' : 'Desactivar' !!}" 
                                        class="btn btn-outline-primary btn-sm mx-1 rounded {!! $item->estado?'btn-outline-danger' : 'btn-outline-success' !!}" 
                                        data-toggle="modal" data-target="#modalAlta" onclick="">
                                        {!! !$item->estado?'<i class="mdi mdi  mdi mdi-arrow-up-bold font-18"></i>':'<i class="mdi  mdi mdi-arrow-down-bold font-18"></i>'!!}
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

@endsection

@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
@endsection

@section('plugins-js')

<!-- Bootstrap Select -->
<script src="{{ asset('/template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" defer></script>

<script src="{{ asset('js/scripts/http.min.js') }} " defer></script>
<script src="{{ asset('js/scripts/data-table.js') }}" defer></script>

<script>
    
</script>
@endsection