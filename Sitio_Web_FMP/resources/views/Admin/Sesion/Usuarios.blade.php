@extends('layouts.admin')

@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" 
role="dialog" aria-labelledby="myLargeModalLabel" 
id="modalRegistro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-account-badge-horizontal mdi-24px" aria-hidden="true" ></i> Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('guardarUser') }}" method="POST">
            @csrf
            <div class="modal-body">
                    <input type="hidden" id="idUser" name="idUser" value=""/>
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
                                <label for="exampleInputCodigo">Usuario <code>*</code></label>
                                <input type="text" class="form-control" id='usuario' name="usuario"  autocomplete="off" placeholder="Digite el nombre">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputUbicacion">Correo <code>*</code></label>
                                <input type="email" class="form-control" id="correo" name="correo"  autocomplete="off" placeholder="Digite el correo">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="">Roles <code>*</code></label>
                                <select class="form-control select2-multiple" data-toggle="select2" id="roles"
                                     multiple="multiple" aria-placeholder="Seleccione" style="width: 100%;" name="roles[]">
                                    <optgroup  label="General">
                                        <option value="{{base64_encode('super-admin')}}">Super Administrador</option>
                                        <option value="{{base64_encode('Jefe-Academico')}}">Jefe Academico</option>
                                        <option value="{{base64_encode('Pagina')}}">Pagina</option>
                                    </optgroup>
                                    <optgroup label="Transparencia">
                                        <option value="{{base64_encode('Transparencia-Presupuestario')}}">Presupuestario</option>
                                        <option value="{{base64_encode('Transparencia-Secretario')}}">Secretario</option>
                                        <option value="{{base64_encode('Transparencia-Decano')}}">Decano</option>
                                    </optgroup>                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="exampleInputNombre">Empleado <code>*</code></label>
                                <select class="form-control selectpicker" data-live-search="true" data-style="btn-white"
                                 style="width: 100%;" name="empleado" id="empleado">
                                    <option value="">Seleccione</option>
                                    @foreach ($empleados as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputNombre">Contraseña <code>*</code></label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña"  autocomplete="off"  placeholder="Digite la contraseña">

                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="exampleInputNombre">Repetir Contraseña <code>*</code></label>
                                <input type="password" class="form-control" name="repetir_contraseña" id="repetir_contraseña"  autocomplete="off"  placeholder="Digite la contraseña">
                            </div>
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

<!--modal para dar alta-->
<div id="modalAlta" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                        <div class="col-lg-10 text-black">
                            <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se dara de alta este departamento, ¿Desea continuar?</h4>
                        </div>
                        <input type="hidden" name="activarId" id="activarId">
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
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
            <h4 class="page-title">&nbsp;</h4>
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
                        Usuarios
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Usuario"
                    class="btn btn-primary dripicons-plus"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>                
            </div>
            <table  class="table table-sm table-bordered" id="table-depto">
                <thead>
                <tr>
                    <th data-priority="1" class="col-sm-1">N°</th>
                    <th data-priority="3">Usuario</th>
                    <th data-priority="3">Correo</th>
                    <th data-priority="3" class="col-sm-1 text-center">Estado</th>
                    <th data-priority="3" class="col-sm-1 text-center">Roles</th>
                    <th data-priority="1" class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $roles = Spatie\Permission\Models\Role::all();
                    $i=0;
                @endphp
               
                @foreach ($usuarios as $item)
                <tr>
                    @php
                        $i++;
                    @endphp
                    <th class="align-middle ">{!!$i!!}</th>
                    <td class="align-middle ">{!!$item->name!!}</td>
                    <td class="align-middle ">{!!$item->email!!}</td>
                    <td class="align-middle font-16">{!! !$item->estado?'<span class="badge badge-danger">Desactivado</span> ' : '<span class="badge badge-success">Activado</span> ' !!}</td>
                    <td class="align-middle font-16">
                        @if ($item->hasAllRoles($roles))
                        <span class="badge badge-success">Todos los roles</span>
                        @else
                            @if ($item->hasRole('super-admin'))
                            <span class="badge badge-primary">Super Admin</span>
                            @endif                            
                            @if ($item->hasRole('Pagina'))
                            <span class="badge badge-primary">Pagina</span>
                            @endif                            
                            @if ($item->hasRole('Jefe-Academico'))
                            <span class="badge badge-primary">Jefe Academico</span>
                            @endif                            
                            @if ($item->hasRole('Transparencia-Decanato'))
                            <span class="badge badge-primary"> Transparencia Decanato</span>
                            @endif                            
                            @if ($item->hasRole('Transparencia-Secretario'))
                            <span class="badge badge-primary">Transparencia Secretario</span>
                            @endif                           
                            @if ($item->hasRole('Transparencia-Presupuestario'))
                            <span class="badge badge-primary">Transparencia Presupuestario</span>
                            @endif
                            @if ($item->hasRole('Transparencia-Decano'))
                            <span class="badge badge-primary">Transparencia Decano</span>
                            @endif                            
                        @endif
                    </td>
                    <td class="align-middle ">
                        <div class="row">
                            <div class="col text-center">
                                <div class="btn-group" role="group">
                                    <button title="Editar" class="btn btn-outline-primary btn-sm rounded" onclick="editar('{{ route('usuarios') }}',{!!$item->id!!})">
                                        <i class="fa fa-edit font-16" aria-hidden="true"></i>
                                    </button>
                                    <button title="{!! !$item->estado?'Activar' : 'Desactivar' !!}" class="btn btn-outline-primary btn-sm mx-1 rounded {!! $item->estado?'btn-outline-danger' : 'btn-outline-success' !!}" data-toggle="modal" data-target="#modalAlta">
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
<!-- end row -->
@endsection

@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/switchery/switchery.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
@endsection

@section('plugins-js')
    <script src="{{ asset('js/scripts/usuariosRoles.js') }}"></script>
    <script src="{{ asset('js/scripts/http.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Bootstrap Select -->
    <script src="{{ asset('/template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/select2/select2.min.js') }}"></script>

    <!-- Init js--> 
    <script src="{{ asset('/template-admin/dist/assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
       
    </script>
@endsection
