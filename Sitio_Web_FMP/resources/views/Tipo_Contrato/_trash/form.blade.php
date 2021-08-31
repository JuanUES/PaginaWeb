<div class="row">

    <div class="col-12 col-sm-12 mb-3">
        <div class="form-group">
            <label for="FechaI">Tipo <span class="text-danger">*</span> </label>
            <input type="text" class="form-control {{ $errors->has('tipo') ? 'is-invalid' : ''}}" name="tipo" id="tipo" aria-describedby="tipo" placeholder="Ingrese Tipo Contrato" value="{{  (old('tipo')) ? old('tipo') :  (isset($tcontrato) ? $tcontrato->tipo : '') }}" >
            {!! $errors->first('tipo', '<p class="invalid-feedback">:message</p>') !!}

        </div>
    </div>
</div>


<br><br>
<hr>

<div class="text-right">
    <a href="{{ route('admin.tcontrato.index') }}" title="Listado de documentos"><button type="button" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retroceder</button></a>
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

