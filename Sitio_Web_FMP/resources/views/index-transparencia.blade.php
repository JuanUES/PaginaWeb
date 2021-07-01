@extends('Pagina/base-transparencia')

@section('container')
<div class="card-box margin-start">
    {{-- <h1 class="text-center text-danger font-weight-bold">TITULO</h1>
    <hr> --}}
    <div class="form-group row mb-0">
        <div class="col-12 col-sm-3 mb-3">
            <select class="custom-select">
                <option selected>Categoria</option>
                <option value="1">Marco Normativo</option>
                <option value="2">Marco de Gestion</option>
                <option value="3">Marco Presupuestario</option>
                <option value="3">Estadisticas</option>
                <option value="3">Documentos Junta Directiva</option>
            </select>
        </div>
        <div class="col-12 col-sm-9 mb-3">
            <div class="form-group row mb-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar informacion" aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-danger waves-effect waves-light" type="submit"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="input-daterange input-group" data-provide="datepicker">
            <input type="text" class="form-control" name="start"  />
            <input type="text" class="form-control" name="end" />
        </div>

    </div>
</div>
<div class="card-box text-center">
        <h3>Bienvenido a la Unidad de Acceso a la Información Pública </h3>
        <h4>Seleccione una de las siguientes categorias</h4>
        <hr>
        <div class="row button-list">
            <div class="col-12 col-sm-4">
                <div class="card border border-primary">
                    <div class="card-body">
                        <blockquote class="card-bodyquote mb-0">
                            <i class="fa fa-pencil-ruler fa-5x color-fa-main"></i> <br>
                            <a href="{{ url('transparencia/marco-normativo') }}" class=" btn btn-link">
                                <h3 >Marco Normativo</h3>
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card border border-primary">
                    <div class="card-body">
                        <blockquote class="card-bodyquote mb-0">
                            <i class="fa fa-tools fa-5x color-fa-main"></i> <br>
                            <a href="{{ url('transparencia/marco-gestion') }}" class=" btn btn-link">
                                <h3>Marco de Gestion</h3>
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card border border-primary">
                    <div class="card-body">
                        <blockquote class="card-bodyquote mb-0">
                            <i class="fa fa-file-invoice-dollar fa-5x color-fa-main"></i> <br>
                            <a href="{{ url('transparencia/marco-presupuestario') }}" class=" btn btn-link">
                                <h3>Marco Presupuestario</h3>
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card border border-primary">
                    <div class="card-body">
                        <blockquote class="card-bodyquote mb-0">
                            <i class="fa fa-chart-pie fa-5x color-fa-main"></i> <br>
                            <a href="{{ url('transparencia/estadistica') }}" class=" btn btn-link">
                                <h3>Estadisticas</h3>
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card border border-primary">
                    <div class="card-body">
                        <blockquote class="card-bodyquote mb-0">
                            <i class="fa fa-file-pdf fa-5x color-fa-main"></i> <br>
                            <a href="{{ url('transparencia/junta-DR') }}" class=" btn btn-link">
                                <h3>Documentos de Junta Directiva</h3>
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
