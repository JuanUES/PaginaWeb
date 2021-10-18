@extends('layouts.admin')

@section('content')
@if (!is_null(auth()->user()->empleado))
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class="icon-notebook mdi-36px"></i> Licencia</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="{{ route('lic/create') }}" method="POST">
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
                            <label for="exampleInputCodigo">Nombre <code>*</code></label>
                            <input type="text" class="form-control" value="{{$empleado->nombre}}"  autocomplete="off" placeholder="Digite el nombre" readonly>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputUbicacion">Apellido <code>*</code></label>
                            <input type="text" class="form-control" value="{{$empleado->apellido}}" autocomplete="off" placeholder="Digite el correo" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Tipo de permiso <code>*</code></label>
                            <select name="tipo_de_permiso" class="form-control select2" style="width: 100%" data-live-search="true" 
                                data-style="btn-white"   id="tipo_permiso">
                                <option value="tipo[]">Seleccione</option>
                                <option id='LC_GS' name='LC_GS' value="LC_GS">L.C./G.S.</option>
                                <option value="LS_GS">L.S./G.S.</option>
                                <option value="INCAP">INCAP</option>
                                <option value="L_OFICIAL">L.OFICIAL</option>
                                <option value="T_COMP">T.COMP.</option>
                                <option value="CITA MEDICA">CITA MEDICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Representantes </label>
                            <select name="representante" class="form-control select2" style="width: 100%"
                                data-style="btn-white"  id="tipo_representante">
                                <option value="">Seleccione</option>
                                <option value="C.S.U">C.S.U</option>
                                <option value="AGU">AGU</option>
                                <option value="J.D">J.D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_uso">Fecha de Uso <code>*</code></label>
                            <input type="date" name="fecha_de_uso" class="form-control"
                                tyle="width: 100%"  id="fecha_de_uso">
                        </div>                            
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="fecha_de_presentacion">Fecha de Presentación <code>*</code></label>
                            <input type="text" name="fecha_de_presentación" id="fecha_de_presentacion" class="form-control"  
                                value="{{Carbon\Carbon::now('UTC')->format('d-M-Y')}}" 
                                style="width: 100%"  id="fecha_de_presentacion" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="hora_inicio">Hora Inicio <code>*</code></label>
                            <input type="time" name="hora_inicio" class="form-control timepicker" style="width: 100%"  id="hora_inicio">
                        </div> 
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="hora_final">Hora Final <code>*</code></label>
                            <input type="time" name="hora_final" class="form-control" style="width: 100%"  id="hora_final">
                        </div> 
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="hora_final">Horas Disponible <code>*</code></label>
                            <input type="text" value="Ilimitado" name="hora_disponible" 
                            class="form-control" style="width: 100%"  id="hora_disponible" readonly>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Justificación <code>*</code></label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="justificación" id="justificación" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputNombre">Observaciones </label>
                            <textarea value=" " class="form-control summernote-config" 
                                name="observaciones" id="observaciones" rows="6"></textarea>
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

<!--modal para dar alta-->
<div id="modalAlta" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myCenterModalLabel">
                    <i class="mdi mdi-arrow-up-bold  mdi-24px" style="margin: none; padding: none;"></i>
                    <i class="mdi-arrow-down-bold mdi mdi-24px" style="margin: 0px;"></i> Cancelar</h3>
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
                                Advertencia: Se cancelara esta licencia, ¿Desea continuar?
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
                        Mis Licencias
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Licencia"
                    class="btn btn-primary dripicons-plus"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>                
            </div>
            <table  class="table table-responsive " style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-2">Presentación</th>
                    <th class="col-sm-2">Uso</th>
                    <th class="col-sm-1">Tipo</th>
                    <th class="col-xs-1">Hora Inicio</th>
                    <th class="col-xs-1">Hora Final</th>
                    <th class="col-sm-1 text-center" >Horas</th>
                    <th class="col-sm-2">Estado</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($permisos as $item)
                        <tr>
                            <th class="align-middle ">{{Carbon\Carbon::parse($item->fecha_presentacion)->format('d/M/Y')}}</th>
                            <td class="align-middle ">{{Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y')}}</td>
                            <td class="align-middle ">{{$item->tipo_permiso}}</td>
                            <td class="align-middle ">{{date('H:i', strtotime($item->hora_inicio))}}</td>
                            <td class="align-middle " >{{date('H:i', strtotime($item->hora_final))}}</td>
                            <td class="align-middle text-center">
                                {{
                                    Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_inicio)
                                        ->diffInHours(Carbon\Carbon::parse($item->fecha_uso.'T'.$item->hora_final))
                                }}
                            </td>
                            <td class="align-middle ">
                                <span class="badge badge-primary font-14">{{$item->estado}}</span>
                            </td>
                            <td class="align-middle ">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="btn-group" role="group">
                                            <button title="Editar" class="btn btn-outline-primary btn-sm rounded" onclick="editar('{{ route('usuarios') }}',{!!$item->id!!},this)">
                                                <i class="fa fa-edit font-16 my-1" aria-hidden="true"></i>
                                            </button>
                                            <button title="Cancelar" 
                                                class="btn btn-outline-primary btn-sm mx-1 rounded btn-outline-danger" 
                                                data-toggle="modal" data-target="#modalAlta" 
                                                onclick="$('#activarId').val({!!$item->id!!});">
                                                <i class="fa fa-ban font-16 my-1"></i>
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

@else
    <div class="row m-3">
        <div class="col-xl-12">
            <div class="card-box p-2 border">
                <p> <i class="fa fa-info-circle"></i> No es posible cargar la información perteneciente a <strong> {{auth()->user()->name}} </strong>.</p>
                <label> A continuación se detallan las posibles causas: </label>
                <ul>
                    <li>El Usuario no se encuentra vinculado con ningun <strong>Empleado</strong> registrado en el sistema.</li>
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
                        // [groupName, [list of button]]
                        ['view', ['fullscreen']],           
                    ]
                });
            }
        
        );
        $('#tipo_permiso').on('select2:select',function() {
            console.log($('#tipo_permiso').val());            
        });
        $('#hora_inicio').change(function() {
            
        });
        $('#hora_final').change(function() {
            
        });

        //$('#guardar_registro')

        function calculoHora() {
            $.get('/',function () {
                
            });
        }
    </script>
@endsection
