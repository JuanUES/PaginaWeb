{{--  Modal para mostrar el detalle de la Jornada  --}}
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

{{--  Modal para darle seguimiento a la Jornada  --}}
<div class="modal fade" id="modalProcedimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="lead"> <i class="fa fa-check-circle"></i> Procedimiento de Validación </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registroForm" action="{{ url('admin/jornada-procedimiento') }}" method="POST">
                {{--  @csrf  --}}
                <input type="hidden" name="jornada_id" id="jornada_id">
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert" style="display:none" id="notificacion">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nota: <code>* Campos Obligatorio</code></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tip">Proceso <span class="text-danger">*</span> </label>
                                <select class="custom-select" name="proceso" >
                                    <option value="" selected> Seleccione una opción </option>

                                    <option value="enviado a jefatura">Enviar a Jefatura</option>

                                    @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano')
                                        <option value="enviado a recursos humanos">Enviar a Recursos Humanos</option>
                                    @endhasanyrole

                                    @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento')
                                        <option value="la jefatura lo ha regresado por problemas">Retornar al empleado</option>
                                    @endhasanyrole

                                    @hasanyrole('super-admin|Recurso-Humano')
                                        <option value="aceptado">Aceptar</option>
                                        <option value="invalidado">Invalidar</option>
                                    @endhasanyrole
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="FechaI">Observaciones</label>
                                <textarea type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Ingrese las observaciones necesarias" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-ban"  aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary btn-sm" onClick="submitForm('#registroForm','#notificacion')"><li class="fa fa-save"></li> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--  Modal para exportar a Excel las Jornadas  --}}
@hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano')
    <div id="modalExport" class="modal fade bs-example-modal-center" tabindex="-1"  role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myCenterModalLabel"><i class="fa fa-file-excel mdi-24px"></i> Exportar</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="frmExport" action="{{ route('admin.jornada.export') }}" method="POST">
                        @csrf
                        <div class="row py-3 text-center">
                            <div class="col-lg-2 fa fa-file-export text-success fa-4x"></div>
                            <div class="col-lg-10 text-black">
                                <h4 class="font-17 text-justify font-weight-bold">Información: Se exportaran todas las jornadas de los emplead@s docentes</h4>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="periodo">Seleccione un Periodo <span class="text-danger">*</span> </label>
                                    <select class="custom-select" name="periodo">
                                        @foreach ($periodos as $item)
                                            <option value="{{ $item->id }}">{{ $item->ciclo_rf->nombre }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <button type="submit" class="btn p-1 btn-light waves-effect waves-light btn-block font-24 btn-block"> <i class="mdi mdi-check mdi-16px"></i>Exportar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endhasanyrole

<!-- inicio Modal de registro -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalRegistro" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><i class=" mdi mdi-account-badge-horizontal mdi-24px" aria-hidden="true" ></i> Jornada</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="frmJornada"  action="{{ route('admin.jornada.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_id" id="_id">
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert" style="display:none" id="notificacion_jornada"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Nota: <code>* Campos Obligatorio</code></label>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label for="periodo" class="control-label">{{ 'Periodo' }} <span class="text-danger">*</span> </label>
                                <select class="custom-select" name="id_periodo" id="id_periodo">
                                    @foreach ($periodos as $item)
                                        <option value="{{ $item->id }}">{{ $item->ciclo_rf->nombre }} / {{ date('d-m-Y', strtotime($item->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($item->fecha_fin)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-8">
                            <div class="form-group">

                                <label for="empleado" class="control-label">{{ 'Empleado' }} <span class="text-danger">*</span> </label>
                                {{-- @if( @Auth::user()->hasRole('Docente')  ) --}}
                                    {{-- <select class="custom-select" name="id_emp" id="id_emp">
                                        <option value="">Seleccione un Empleado</option> --}}
                                        {{-- @foreach ($docente as $item)
                                            <option value="{{ $item->id }}" selected>{{  $item->apellido }}, {{ $item->nombre }}</option>
                                        @endforeach --}}
                                    {{-- </select> --}}
                                {{-- @endif --}}

                                {{-- @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano') --}}
                                    {{-- <select class="custom-select" name="id_emp" id="id_emp">
                                        <option value="">Seleccione un Empleado</option>
                                        @foreach ($empleados as $item)
                                            <option value="{{ $item->id }}">{{ $item->apellido }}, {{ $item->nombre }}</option>
                                        @endforeach
                                    </select> --}}
                                {{-- @endhasanyrole --}}


                                {{-- @hasanyrole('super-admin|Jefe-Academico|Jefe-Departamento|Recurso-Humano') --}}
                                    <select class="custom-select" name="id_emp" id="id_emp">
                                        <option value="">Seleccione un Empleado</option>
                                        @foreach ($empleados as $item)
                                            <option value="{{ $item->id }}">{{ $item->apellido }}, {{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                {{-- @endhasanyrole --}}

                            </div>

                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="thoras" class="control-label">{{ 'Horas' }} <span class="text-danger"></span></label>
                                <input type="text" id="auxJornada" class="form-control total-horas" for="auxJornada" readonly="readonly" value="0">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="thoras" class="control-label">{{ 'Disponibles' }} <span class="text-danger"></span></label>
                                <input type="text" id="_horas" class="form-control" for="_horas" readonly="readonly" value="0"></input>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="jornada-div">
                        <div class="col-12">
                            <h5 class="mb-3">Detalle de la Jornada
                                <span class="float-right">
                                    <button type="button" class="btn btn-sm btn-primary" name="btnNewRow" id="btnNewRow"> <i class="fa fa-plus"></i> </button>
                                </span>
                            </h5>
                            <div id="days-table"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-ban"  aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-save"></li> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
