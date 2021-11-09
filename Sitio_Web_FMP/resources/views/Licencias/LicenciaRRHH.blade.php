@extends('layouts.admin')

@section('content')
@if (!is_null(auth()->user()->empleado) and @Auth::user()->hasRole('Recurso-Humano'))

<!--modal para dar alta-->
<div id="modalAceptar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-check mdi-24px" style="margin: 0px;"></i> Aceptar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('rrhh/aceptar') }}" method="POST" id="cancelarModal">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert" style="display:none" id="notificacion1">
                    </div>
                    <input type="hidden" name="_id" id="aceptar_id">
                    <div class="row py-3">
                        <div class="col-xl-2 fa fa-check text-success fa-4x mr-1"></div>
                        <div class="col-xl-9 text-black"> 
                            <h3 class="font-17 text-justify font-weight-bold">
                                Nota: Se aceptara esta licencia, 
                                ¿Desea continuar?
                            </h3>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 p-1">
                            <button  type="submit" 
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
</div><!-- /.modal-->
<!--Modal para dar alta fin-->

<!--MODAL ACEPTAR CONSTANCIA-->
<div id="modalAceptarConst" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="myCenterModalLabel">
                <i class="fa fa-check mdi-24px" style="margin: 0px;"></i> Aceptar
            </h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <form action="{{ route('rrhh/aceptar') }}" method="POST" id="cancelarModal">
            @csrf
            <div class="modal-body">
                <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                    role="alert" style="display:none" id="notificacion1">
                </div>
                <input type="hidden" name="_id" id="aceptarr_id">
                <div class="row py-3">
                    <div class="col-xl-2 fa fa-check text-success fa-4x mr-1"></div>
                    <div class="col-xl-9 text-black">
                        <h3 class="font-17 text-justify font-weight-bold">
                            Nota: Se aceptara esta Constancia olvido de Marcaje,
                            ¿Desea continuar?
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 p-1">
                        <button type="submit"
                            class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                            <i class="mdi mdi-check mdi-16px"></i>
                            Si
                        </button>
                    </div>
                    <div class="col-xl-6 p-1">
                        <button type="reset"
                            class="btn btn-light p-1 waves-light waves-effect btn-block font-24"
                            data-dismiss="modal">
                            <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                            No
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal-->
<!--FIN DE MODAL ACEPTAR CONSTANCIA-->

<div id="modalObservaciones" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="fa fa-eye mdi-36px" style="margin: 0px;"></i> Observaciones</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>           
            <div class="modal-body">                
                <div class="container-fluid py-2">
                    <table style="width: 100%" class="table" id="obs-table"> 
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Procedimiento</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class="icon-notebook mdi-36px"></i> Licencia</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('rrhh/observacion') }}" method="POST">
            @csrf
            
            <div class="modal-body">
                <input type="hidden" id="idPermiso" name="_id"/>
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
                            <label for="">Nombre </label>
                            <input type="text" class="form-control"  
                            autocomplete="off" placeholder="Digite el nombre" id="nombre" readonly>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Apellido </label>
                            <input type="text" class="form-control" value=""
                             autocomplete="off" placeholder="Digite el correo" id="apellido" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tipo_permiso">Tipo de permiso </label>
                            <select name="tipo_de_permiso" class="form-control select2" style="width: 100%" data-live-search="true" 
                                data-style="btn-white"   id="tipo_permiso" name="tipo_permiso" readonly>
                                <option value="">Seleccione</option>
                                <option value="LC/GS">L.C./G.S.</option>
                                <option value="LS/GS">L.S./G.S.</option>
                                <option value="INCAP">INCAP</option>
                                <option value="L OFICIAL">L.OFICIAL</option>
                                <option value="T COMP">T.COMP.</option>
                                <option value="CITA MEDICA">CITA MEDICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tipo_representante">Representantes </label>
                            <select name="representante" class="form-control select2" style="width: 100%"
                                data-style="btn-white"  id="tipo_representante" readonly>
                                <option value="">Seleccione</option>
                                <option value="C.S.U">C.S.U</option>
                                <option value="AGU">AGU</option>
                                <option value="J.D">J.D</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_anual">Horas Disponible Año</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 100%;">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="mdi mdi-clock-outline"></i>
                                    </span>
                                    <input type="text" name="" value="Ilimitado" 
                                    class="form-control" style="width: 100%"  id="hora_anual" readonly>
                                </div>                                
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_disponible">Horas Disponible Mes</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 100%;">
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    <input type="text" value="Ilimitado" name="hora_disponible" 
                                         class="form-control " style="width: 100%"  id="hora_mensual" readonly>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_uso">Fecha de Uso </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                                <input type="date" name="fecha_de_uso" class="form-control"
                                    tyle="width: 100%;"  id="fecha_de_uso" readonly >
                            </div>
                        </div>                            
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_presentacion">Fecha de Presentación </label> 
                            <div class="input-group">
                                <div class="input-group-append" style="width: 100%;">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <input type="text" name="fecha_de_presentación" class="form-control"  readonly 
                                        style="width: 100%;"  id="fecha_de_presentacion" >
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_inicio">Hora Inicio </label>
                            <div class="input-group">                             
                                <div class="input-group-append" style="width: 100%;">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-clock-outline"></i></span>
                                    <input type="time" name="hora_inicio" class="form-control" style="width: 100%"  id="hora_inicio" readonly>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="hora_final">Hora Final </label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 100%;">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-clock-outline"></i></span>
                                    <input type="time" name="hora_final" class="form-control" style="width: 100%"  id="hora_final" readonly>
                                </div>                                
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="hora_actuales">Horas Utilizar</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 100%;">
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    <input type="text" value="Ilimitado" name="hora_actuales" 
                                        class="form-control" style="width: 100%"  id="hora_actuales" readonly>
                                </div>
                            </div>                            
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="justificacion">Justificación </label>
                            <textarea value=" "  class="form-control summernote-config" 
                                name="justificación" id="justificacion" rows="4" readonly></textarea>
                        </div> 
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="observaciones">Observaciones </label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="observaciones" id="observaciones" rows="4" readonly></textarea>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="observaciones">Observaciones Recursos Humanos <code>*</code></label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="observaciones_recursos_humanos" rows="4"></textarea>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fa fa-ban"
                    aria-hidden="true"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id='guardar_registro'
                    onClick="submitForm('#registroForm','#notificacion')">
                    <li class="fa fa-save"></li> Guardar</button>
            </div>            
        </form>
      </div>
    </div>
</div>
<!--fin modal de registro-->

<!--MODAL CONSTANCIA DE OLVIDO DE MARCAJE-->
        <!-- inicio Modal de registro -->
        <div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" id="modalConstancia"
            tabindex="-1">
            <div class="modal-dialog modal-lg-8" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id=" exampleModalLongTitle"><i class="icon-notebook mdi-36px"></i> Const.
                            Olvido de Marcaje</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="registroForm" action="{{ route('rrhh/observacion') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <input type="hidden" id="idPermisoC" name="_id" />
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
                                        <label for="">Nombre <code>*</code></label>
                                        <input type="text" class="form-control" value="" autocomplete="off"
                                            placeholder="Digite el nombre" id="nombreC" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Apellido <code>*</code></label>
                                        <input type="text" class="form-control" value="" autocomplete="off"
                                            placeholder="Digite el apellido" id="apellidoC"  readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!--para el campo fecha-->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="fecha_de_uso">Fecha<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" tyle="width: 100%;"
                                                id="fecha" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!--fin del campo fecha-->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="exampleInputNombre">Marcaje de:<code>*</code></label>
                                        <select class="form-control select2" style="width: 100%" data-live-search="true"
                                            data-style="btn-white" id="marcaje">
                                            <option value="">Seleccione</option>
                                            <option value="Entrada">Entrada</option>
                                            <option value="Salida">Salida</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="fecha_de_presentacion">Hora <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-append" style="width: 100%;">
                                                <span class="input-group-text"><i
                                                        class=" mdi mdi-account-clock "></i></span>
                                                <input type="time" class="form-control" style="width: 100%;"
                                                    id="hora" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="exampleInputNombre">Justificación<code>*</code></label>
                                        <textarea value=" " class="form-control summernote-config"
                                            id="justificacionConst" rows="6" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="observacionesConst">Observaciones </label>
                                    <textarea value=" " class="form-control summernote-config"  name="observaciones_recursos_humanos"
                                     rows="4"></textarea>
                                </div>

                               </div>
                           </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"
                                    aria-hidden="true"></i> Cerrar</button>
                            <button type="button" class="btn btn-primary" id='guardar_registro'
                                onClick="submitForm('#registroForm','#notificacion')">
                                <li class="fa fa-save"></li> Guardar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--fin modal de registro-->
        <!--FIN DE MODAL CONSTANCIA DE OLVIDO DE MARCAJE-->

<!-- start page title -->
<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Jefe</li>
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
                        Licencias Recursos Humanos
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                </div>                
            </div>
            <table  class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-2">Fecha de Uso</th>
                    <th class="col-xs-2">Empleado</th>
                    <th class="col-sm-1">Tipo</th>
                    <th class="col-sm-1">Hora Inicio</th>
                    <th class="col-sm-1">Hora final</th>
                    <th class="col-sm-2">Horas</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($permisos as $item)
                        <tr>
                            <th class="align-middle ">{{Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y')}}</th>
                            <td class="align-middle ">{{$item->nombre.' '.$item->apellido}}</td>
                            <td class="align-middle "><span class="badge badge-primary">{{$item->tipo_permiso}}</span></td>
                            @if ($item->olvido == 'Entrada')
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_inicio)) }}</td>
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_final)) }}</td>
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_final)) }}</td>
                                         <!--PARA LOS BOTONES-->
                                         <td class="align-middle ">
                                            <div class="row">
                                                <div class="col text-center">

                                                    <div class="btn-group" role="group">
                                                        <button title="Ver Datos" class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="observaciones(this)">
                                                            <i class="fa fa-eye font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Agregar Observacion"
                                                            class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="verDatosConst(this)">
                                                            <i class="fa fa-file-alt font-16 my-1 mx-0"
                                                                aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Aceptar Const. olvido"
                                                            class="btn btn-outline-success btn-sm"
                                                            value="{{ $item->permiso }}" onclick="aceptarConst(this)">
                                                            <i class="fa fa-check font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!--FIN DE PARA LOS BOTONES-->
                                    @elseif ($item->olvido =='Salida')
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_final)) }}</td>
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_inicio)) }}</td>
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_final)) }}</td>
                                        <!--PARA LOS BOTONES-->
                                        <td class="align-middle ">
                                            <div class="row">
                                                <div class="col text-center">

                                                    <div class="btn-group" role="group">
                                                        <button title="Ver Datos" class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="observaciones(this)">
                                                            <i class="fa fa-eye font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Agregar Observacion"
                                                            class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="verDatosConst(this)">
                                                            <i class="fa fa-file-alt font-16 my-1 mx-0"
                                                                aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Aceptar Const. olvido"
                                                            class="btn btn-outline-success btn-sm"
                                                            value="{{ $item->permiso }}" onclick="aceptarConst(this)">
                                                            <i class="fa fa-check font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!--FIN DE PARA LOS BOTONES-->

                                    @else
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_inicio)) }}</td>
                                        <td class="align-middle ">{{ date('H:i', strtotime($item->hora_final)) }}</td>
                                        <td class="align-middle ">
                                            {{                                             Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_inicio)->diffAsCarbonInterval(Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_final)) }}
                                        </td>
                                        <td class="align-middle ">
                                            <div class="row">
                                                <div class="col text-center">

                                                    <div class="btn-group" role="group">
                                                        <button title="Ver Datos" class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="observaciones(this)">
                                                            <i class="fa fa-eye font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Agregar Observacion"
                                                            class="btn btn-outline-primary btn-sm"
                                                            value="{{ $item->permiso }}" onclick="verDatos(this)">
                                                            <i class="fa fa-file-alt font-16 my-1 mx-0"
                                                                aria-hidden="true"></i>
                                                        </button>

                                                        <button title="Aceptar Licencia"
                                                            class="btn btn-outline-success btn-sm"
                                                            value="{{ $item->permiso }}" onclick="aceptar(this)">
                                                            <i class="fa fa-check font-16 my-1" aria-hidden="true"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
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

@else
    <div class="row m-3">
        <div class="col-xl-12">
            <div class="card-box p-2 border">
                <p> <i class="fa fa-info-circle"></i> No es posible cargar la información perteneciente a <strong> {{auth()->user()->name}} </strong>.</p>
                <label> A continuación se detallan las posibles causas: </label>
                <ul>
                    <li>El Usuario no se encuentra vinculado con ningun <strong>Empleado</strong> registrado en el sistema.</li>
                    <li>El Usuario no es <strong>Jefe</strong>.</li>
                </ul>
            </div>
        </div>
    </div>
@endif
@endsection

@section('plugins')
<link href="{{ asset('template-admin/dist/assets/libs/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"/>
<style>

</style>
@endsection

@section('plugins-js')
    <!-- Bootstrap Select -->
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-select/bootstrap-select.min.js') }}" ></script>
    <script src="{{ asset('template-admin/dist/assets/libs/select2/select2.min.js') }}" ></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}" ></script>
    <script src="{{ asset('js/scripts/data-table.js') }}" ></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
    <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>       
        $(
            function () {
                $('.select2').select2();            

                $(".summernote-config").summernote({
                    lang: 'es-ES',
                    height: 100,
                    toolbar: [
                        ['view', ['fullscreen']],           
                    ]
                });
                $('#justificacion').summernote('disable');
                $('#observaciones').summernote('disable');
                $("#tipo_representante").prop("disabled", true);
                $("#tipo_permiso").prop("disabled", true);
                 //para la constancia de olvido de marcaje
                 $('#justificacionConst').summernote('disable');
                $("#marcaje").prop("disabled", true);
            }

        );

        let mensuales, anuales, hrs_m, hrs_a, min_m, min_a, min_t_a, min_t_m;
mensuales = anuales = hrs_m = hrs_a = min_m = min_a = min_t_a = min_t_m = 0;


    function obtenerHora() {
        if($('#tipo_permiso').val() ==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
                var permiso = $('#idPermiso').val().trim()==''?'nuevo':$('#idPermiso').val();
                $.ajax({
                    type: "GET",
                    url: '/admin/mislicencias/horas-mensual/'+$('#fecha_de_uso').val()+'/'+permiso,
                    beforeSend: function() {
                        $('#hora_mensual').val('Cargando...');
                        $('#hora_anual').val('Cargando...');
                    },
                    success: function(json) {
                        var json = JSON.parse(json);
                        mensuales = json.mensuales;
                        hrs_m = json.horas_acumuladas;
                        min_m = json.minutos_acumulados;
                    },
                });
                
                $.ajax({
                    type: "GET",
                    url: '/admin/mislicencias/horas-anual/'+$('#fecha_de_uso').val()+'/'+permiso,
                    success: function(json) {
                        var json  =  JSON.parse(json);
                        anuales = json.anuales;
                        hrs_a = json.horas_acumuladas;
                        min_a = json.minutos_acumulados;
                    },
                    complete: function(json) {  
                        min_t_m = (parseInt(mensuales)*60)-(parseInt(min_m) + parseInt(hrs_m)*60);
                        min_t_a = (parseInt(anuales)*60)-(parseInt(min_a) + parseInt(hrs_a)*60);

                        var horas = parseInt(Math.trunc(min_t_a/ 60));
                        var minutos = parseInt((min_t_a % 60));
                        
                        $('#hora_anual').val(horas+' hrs, '+minutos+' min');

                        var horas = parseInt(Math.trunc(min_t_m/ 60));
                        var minutos = parseInt((min_t_m % 60));

                        $('#hora_mensual').val(horas+' hrs, '+minutos+' min');               

                        if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                            $('#hora_inicio').click();
                            $('#hora_final').click();
                        }
                    }
                });
        }else{
            $('#hora_anual').val('Ilimitado');
            $('#hora_mensual').val('Ilimitado');
        }
    }

    function calcularHora() {
        var hora_inicio = $('#hora_inicio').val();
        var hora_final = $('#hora_final').val();
        
        // ExpresiÃ³n regular para comprobar formato
        var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
        
        // Si algÃºn valor no tiene formato correcto sale
        if (!(hora_inicio.match(formatohora)
                && hora_final.match(formatohora))){
            return;
        }
        // Calcula los minutos de cada hora
        var minutos_inicio = hora_inicio.split(':')
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
        var minutos_final = hora_final.split(':')
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
        // Si la hora final es anterior a la hora inicial sale
        if (minutos_final < minutos_inicio) return;
        
        // Diferencia de minutos
        var diferencia = minutos_final - minutos_inicio;

        // CÃ¡lculo de horas y minutos de la diferencia
        var horas = parseInt(Math.trunc(diferencia / 60));
        var minutos = parseInt((diferencia % 60));        

        $('#hora_actuales').val(horas+' hrs, '+minutos+' min');

        var horas = parseInt(Math.trunc((min_t_a-diferencia)/ 60));
        var minutos = parseInt(((min_t_a-diferencia) % 60));
        
        $('#hora_anual').val(horas+' hrs, '+minutos+' min');

        var horas = parseInt(Math.trunc((min_t_m-diferencia)/ 60));
        var minutos = parseInt(((min_t_m-diferencia) % 60));

        $('#hora_mensual').val(horas+' hrs, '+minutos+' min');
    }

    $('#tipo_permiso').on('select2:select',obtenerHora);
    $('#fecha_de_uso').change(obtenerHora).click(obtenerHora);
    $('#hora_inicio').change(calcularHora).click(calcularHora);
    $('#hora_final').change(calcularHora).click(calcularHora);

         //FUNCION PARA ACEPTAR CONSTANCIA
         function aceptarConst(boton){
            $('#aceptarr_id').val($(boton).val());
            $('#modalAceptarConst').modal();
        }
        //FIN DE FUNCION PARA ACEPTAR CONSTANCIA
            
        function aceptar(boton){
            $('#aceptar_id').val($(boton).val());
            $('#modalAceptar').modal();
        }
        function observaciones(boton){
            if($(boton).val()!=null){
                    $.ajax({
                        type: "GET",
                        url: '/admin/mislicencias/procesos/'+$(boton).val(),
                        beforeSend: function() {
                            $(boton).prop('disabled', true).html(''
                                +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                            );
                            $(boton).prop('disabled', true).html(''
                                +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                            );
                        },
                        success: function(json) {   
                            var json = JSON.parse(json);   
                            var tabla = $('#obs-table').DataTable();
                            tabla.clear().draw(false);
                            for (var i in json) {     
                                var html= '<tr>'
                                +'<td class="col-sm-3">'+json[i].fecha+'</td>'
                                +'<td class="col-sm-3"><span class="badge badge-primary font-13">'+json[i].proceso+'</span></td>'
                                +'<td class="col-xs-6">'+(json[i].observaciones==null?'Ninguna':json[i].observaciones)+'</td>'
                                +'</tr>';    
                                tabla.row.add($.parseHTML(html)[0]).draw(false);
                            }   
                            $("#modalObservaciones").modal();
                        },
                        complete: function(json) {
                            $(boton).prop('disabled', false).html(''
                                +'<i class="fa fa-eye font-16 py-1" aria-hidden="true"></i>'
                            );
                        }
                    });                
            }
        };

        $('.modal').on('hidden.bs.modal',function(){
            $("form").trigger("reset");
        });

        //FUNCION PARA VER LOS DATOS DE CONSTANCIA DE OLVIDO
        function verDatosConst(boton) {
            if ($(boton).val() != null) {
                $.ajax({
                    type: "GET",
                    url: '/admin/licencias/jefaturaRRHH/' + $(boton).val(),
                    beforeSend: function() {
                        $(boton).prop('disabled', true).html('' +
                            '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                        );
                    },
                    success: function(json) {

                        var json = JSON.parse(json);
                        console.log(json);
                        $('#idPermisoC').val(json.permiso);
                        $('#nombreC').val(json.nombre);
                        $('#apellidoC').val(json.apellido);
                        $('#justificacionConst').summernote("code", json.justificacion);
                     
                        $('#marcaje').val(json.olvido).trigger("change");
                        $('#fecha').val(json.fecha_uso).change();
                        $('#hora').val(json.hora_inicio);
                        $('#observacionesConst').summernote("code", json.observaciones);
                        
                        $('#modalConstancia').modal();
                    },
                    complete: function(json) {
                        $(boton).prop('disabled', false).html('' +
                            '<i class="fa fa-file-alt font-16 py-1" aria-hidden="true"></i>'
                        );
                    }
                });
            }
        }
        //FIN DE VER DATOS DE CONSTANCIA DE OLVIDO

        function verDatos(boton) {
            if($(boton).val()!=null){
                $.ajax({
                    type: "GET",
                    url: '/admin/licencias/jefaturaRRHH/'+$(boton).val(),
                    beforeSend: function() {
                        $(boton).prop('disabled', true).html(''
                            +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                        );
                    },
                    success: function(json) {  
                      //  alert($(boton).val());

                        var json = JSON.parse(json);  

                        $('#idPermiso').val(json.permiso);  
                        $('#nombre').val(json.nombre);                 
                        $('#apellido').val(json.apellido);                 
                        $('#justificacion').summernote("code",json.justificacion);
                        $('#observaciones').summernote("code",json.observaciones);
                        $('#tipo_representante').val(json.tipo_representante).trigger("change");
                        $('#tipo_permiso').val(json.tipo_permiso).trigger("change");
                        $('#fecha_de_presentacion').val(json.fecha_presentacion);
                        $('#fecha_de_uso').val(json.fecha_uso).change();                                   
                        $('#hora_inicio').val(json.hora_inicio);
                        $('#hora_final').val(json.hora_final);
                        $('#modalRegistro').modal();
                    },
                    complete: function(json) {
                        $(boton).prop('disabled', false).html(''
                            +'<i class="fa fa-file-alt font-16 py-1" aria-hidden="true"></i>'
                        );
                    }
                });                
            }
        }
    </script>
@endsection
