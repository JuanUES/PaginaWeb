@extends('Pagina/base-transparencia')

@section('container')
<div class="card-box">
    <h1 class="text-center text-danger font-weight-bold">TITULO</h1>
    <hr>
    <div class="form-group row mb-0">
        <div class="col-12 col-sm-3 mb-0">
            <select class="custom-select">
                <option selected>Categoria</option>
                <option value="1">Marco Normativo</option>
                <option value="2">Marco de Gestion</option>
                <option value="3">Marco Presupuestario</option>
                <option value="3">Estadisticas</option>
                <option value="3">Documentos Junta Directiva</option>
            </select>
        </div>
        <div class="col-12 col-sm-9 mb-0">
            <div class="form-group row mb-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar informacion" aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-danger waves-effect waves-light" type="submit"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
