<div class="row">
    <div class="col-12 col-sm-12 mb-3">
        <div class="form-group">
            <label for="FechaI">Fecha Inicio <span class="text-danger">*</span> </label>
            <input type="date" class="form-control {{ $errors->has('fecha_inicio') ? 'is-invalid' : ''}}" name="fecha_inicio" id="fecha_inicio" value="{{  (old('fecha_inicio')) ? old('fecha_inicio') :  (isset($periodo) ? $periodo->fecha_inicio : '') }}" >
            {!! $errors->first('fecha_inicio', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 mb-3">
        <div class="form-group">
            <label for="FechaF">Fecha Fin <span class="text-danger">*</span> </label>
            <input type="date" class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : ''}}" name="fecha_fin" id="fecha_fin" value="{{  (old('fecha_fin')) ? old('fecha_fin') :  (isset($periodo) ? $periodo->fecha_fin : '') }}" >
            {!! $errors->first('fecha_fin', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 mb-3">
        <div class="form-group">
            <label for="tipo">Tipo <span class="text-danger">*</span> </label>
            <select class="custom-select {{ $errors->has('tipo') ? 'is-invalid' : ''}}" name="tipo" id="tipo">
                <option value="0" selected>Seleccion</option>
                <option value="Administrativo" >Administrativo</option>
                <option value="Docente">Docente</option>
            </select>
        </div>
    </div>
</div>


<br><br>
<hr>
<div class="text-right">
    <a href="{{ route('admin.periodo.index') }}" title="Listado de documentos"><button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retroceder</button></a>
    <button type="submit" class="btn btn-info btn-sm" title="Guardar Informacion">{!! $formMode === 'edit' ? '<i class="fa fa-edit"></i>' : '<i class="fa fa-save"></i>' !!} {{ $formMode === 'edit' ? 'Modificar' : 'Guardar' }}</button>
</div>

@section('plugins')
{{-- PLUGINS PARA SUBIR ARCHIVOS --}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>




<link rel="stylesheet" href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.css') }}">
<script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/piexif.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/locales/es.js') }}"></script>
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css') }}">
<script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js') }}"></script>
@endsection

