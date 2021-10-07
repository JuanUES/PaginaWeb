@extends('layouts.admin')

@section('content')
<!-- inicio Modal de registro -->
<div class="modal fade bs-example-modal-lg" 
    role="dialog" aria-labelledby="myLargeModalLabel" 
    id="modalRegistro">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id=" exampleModalLongTitle"><i class=" mdi mdi-account-badge-horizontal mdi-36px"></i> Licencia G.S.</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="registroForm"  action="" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="idMR" name="_id"/>
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
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="id_jornada">Jornada<code>*</code></label>
                            <select class="form-control select2" style="width: 100%" data-live-search="true" 
                                data-style="btn-white" name="jornada" id="id_jornada">
                                <option value="" selected>Seleccione</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">                        
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="exampleInputUbicacion">Horas Anuales <code>*</code></label>
                            <input type="number" class="form-control" min="0" max="120"  id="hrsA" name="horas_anuales"  autocomplete="off" placeholder="Digite el correo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="exampleInputCodigo">Horas Mensuales <code>*</code></label>
                            <input type="number" min="0" max="40" class="form-control" id='hrsM' name="horas_mensuales"  autocomplete="off" placeholder="Digite el nombre">
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

<!-- start page title -->
<div class="row">
    <div class="col-xl-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Horas de Licencias</li>
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
                        Horas de Licencias por Jornada
                    </h3>
                </div>
                <div class="col-lg-1 order-last">
                    <!-- Button trigger modal -->
                 <button type="button" title="Agregar Usuario"
                    class="btn btn-primary dripicons-plus"
                    data-toggle="modal" data-target="#modalRegistro"></button>
                </div>                
            </div>
            <table  class="table table-bordered table-responsive" style="width: 100%">
                <thead>
                <tr>
                    <th class="col-sm-1" style="width: 5%;">N°</th>
                    <th>Jornada</th>
                    <th class="col-xs-1">Horas Anuales</th>
                    <th class="col-xs-1">Horas Mensuales</th>
                    <th class="col-sm-1 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <!--<tr>
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

    <script src="{{ asset('js/scripts/http.min.js') }}"></script>
    
    <script src="{{ asset('js/scripts/data-table.js') }}" ></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2(
                {    
                    tags: "true",
                    placeholder: "Seleccione una opciÃ³n",
                    allowClear: true,
                    width: "100%",
                    allowHtml: true,
                    dropdownParent: $('#modalRegistro')
                }
            ).select2();
        });
    </script>
@endsection
