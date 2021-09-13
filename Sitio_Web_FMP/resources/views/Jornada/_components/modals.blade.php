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

                <span class="float-right">
                    <p class="lead" style="font-size: 13px;">Fecha de Registro: <span class="badge badge-dark" id="fechaRegistroDetalle"></span></p>
                </span>
                <br>

                {{--  <div class="card-box">
                    <h4 class="header-title mb-4">Información y Seguimiento</h4>  --}}

                    <ul class="nav nav-pills navtab-bg nav-justified mt-3">
                        <li class="nav-item">
                            <a href="#detalle" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="fa fa-info-circle"></i> Detalle
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#seguimiento" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="fa fa-list-alt"></i> Seguimiento
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="detalle">
                            <table class="table table-hover table-sm" id="tableView">
                                <thead>
                                    <th>Dia</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Total</th>
                                </thead>
                                <tbody id="bodyView">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane show" id="seguimiento">

                        </div>
                    </div>
                {{--  </div>  --}}



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


