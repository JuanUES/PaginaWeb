@extends('layouts.admin')

@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-account-badge-horizontal mdi-36px"></i> Usuario</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('guardarUser') }}" method="POST">
            @csrf
            <div class="modal-body">
                    <input type="hidden" id="idUser" name="_id"/>
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
                                <select class="form-control select2-multiple" data-toggle="select2" id="roles" placeholder="sddf"
                                     multiple="multiple" aria-placeholder="Seleccione" style="width: 100%;" name="roles[]" id="roles">
                                    <optgroup  label="General">
                                        <option value="{{base64_encode('super-admin')}}">Super Administrador</option>
                                        <option value="{{base64_encode('Jefe-Academico')}}">Jefe Academico</option>
                                        <option value="{{base64_encode('Jefe-Administrativo')}}">Jefe Administrativo</option>
                                        <option value="{{base64_encode('Recurso-Humano')}}">Recurso Humano</option>
                                        <option value="{{base64_encode('Docente')}}">Docente</option>
                                        <option value="{{base64_encode('Jefe-Administrativo')}}">Jefe Administrativo</option>
                                    </optgroup>
                                    <optgroup label="Pagina">
                                        <option value="{{base64_encode('Pagina-Admin')}}">Administrador</option>
                                        <option value="{{base64_encode('Pagina-Inicio-Imagenes')}}">Inicio - Imagenes</option>
                                        <option value="{{base64_encode('Pagina-Inicio-Noticias')}}">Inicio - Noticias</option>
                                        <option value="{{base64_encode('Pagina-Directorio')}}">Directorio</option>
                                        <option value="{{base64_encode('Pagina-EstructuraOrganizativa')}}">Estructura Organizativa</option>
                                        <option value="{{base64_encode('Pagina-AdminAcademica')}}">Administración Académica</option>
                                        <option value="{{base64_encode('Pagina-Depto-CDE')}}">Departamento-Ciencias de la Educación</option>
                                        <option value="{{base64_encode('Pagina-Depto-CA')}}">Departamento-Ciencias Agronómicas</option>
                                        <option value="{{base64_encode('Pagina-Depto-CE')}}">Departamento-Ciencias Ecónomicas</option>
                                        <option value="{{base64_encode('Pagina-Depto-I')}}">Departamento-Informática</option>
                                        <option value="{{base64_encode('Pagina-Depto-PC')}}">Departamento-Plan Complementario</option>
                                        <option value="{{base64_encode('Pagina-Postgrado')}}">Postgrado</option>
                                        <option value="{{base64_encode('Pagina-UnidadInvestigacion')}}">Unidad de Investigación</option>
                                        <option value="{{base64_encode('Pagina-ProyeccionSocial')}}">Proyección Social</option>
                                        <option value="{{base64_encode('Pagina-AdminFinanciera-Informacion')}}">Administración Financiera-Información</option>
                                        <option value="{{base64_encode('Pagina-AdminFinanciera-Colecturia')}}">Administración Financiera-Colecturia</option>
                                        <option value="{{base64_encode('Pagina-Uti')}}">Unidad de Tecnología de la Información</option>
                                    </optgroup>   
                                    <optgroup label="Transparencia">
                                        <option value="{{base64_encode('Transparencia-Repositorio')}}">Repositorio</option>
                                        <option value="{{base64_encode('Transparencia-Presupuestario')}}">Presupuestario</option>
                                        <option value="{{base64_encode('Transparencia-Secretario')}}">Secretario</option>
                                        <option value="{{base64_encode('Transparencia-Decano')}}">Decano</option>
                                    </optgroup>                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-xl-12">
                            <div class="form-group" id="form-id">
                                <label for="exampleInputNombre">Empleado <code>*</code></label>
                                <select class="form-control selectpicker"  data-live-search="true" 
                                    data-style="btn-white" data-width="100%"  name="empleado" id="empleado">
                                    <option value="">Seleccione</option>
                                    
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
            <form action="{{ route('usuarioEstado') }}" method="POST" id="altaBajaForm">
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
                            <button  type="button" 
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
            <table  class="table table-bordered " style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-1" style="width: 5%;">N°</th>
                    <th>Usuario</th>
                    <th class="col-xs-1">Correo</th>
                    <th class="col-xs-1" style="width: 10%;">Estado</th>
                    <th>Roles</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                   <!-- <tr>
                        <th class="align-middle "></th>
                    </tr>-->
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
<style>

</style>
@endsection

@section('plugins-js')
    <!-- Bootstrap Select -->
    <script src="{{ asset('/template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" ></script>
    <script src="{{ asset('template-admin/dist/assets/libs/select2/select2.min.js') }}" ></script>

    <script src="{{ asset('js/scripts/data-table.js') }}" ></script>
@endsection
