@extends('Pagina/base-transparencia')

@section('container')
<div class="card-box margin-start">
    <h4 class="text-center text-danger font-weight-bold"> <i class="fa fa-search"></i> Buscar informacion...</h4>
    <hr>
    <form method="GET" action="{{ url('/transparencia/resultado/a/b') }}" accept-charset="UTF-8"  role="search">
        <div class="row mb-0">
            <div class="col-12 col-sm-3 mb-3">
                <select class="custom-select" name="category">
                    <option selected>Categoria</option>
                    <option value="marco-normativo">Marco Normativo</option>
                    <option value="marco-gestion">Marco de Gestion</option>
                    <option value="marco-presupuestario">Marco Presupuestario</option>
                    <option value="3">Estadisticas</option>
                    <option value="3">Documentos Junta Directiva</option>
                </select>
            </div>
            <div class="col-12 col-sm-9 mb-3">
                <div class="form-group mb-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar informacion" aria-label="Recipient's username" value="{{ request('search') }}">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-3 mb-3"></div>

            <div class="col-12 col-sm-7 mb-3">
                <div class="form-group">
                    <div class="input-daterange input-group" data-provide="datepicker">
                        <input type="text" class="form-control" placeholder="Seleccione la fecha de inicio" name="start"  />
                        {{-- <div class="input-group-addon">hasta</div> --}}
                        <input type="text" class="form-control" placeholder="Seleccione la fecha final" name="end" />
                    </div>
                </div>


                {{-- <input type="text" id="date_range" name="date_range" class="form-control"> --}}
            </div>
            <div class="col-12 col-sm-2 mb-3">
                <button type="submit" title="Filtrar la informacion" class="btn btn-danger btn-block"><i class="fa fa-search"></i> Buscar</button>
            </div>

        </div>
    </form>
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


@section('footerjs')
<script type="text/javascript">
    $('.input-daterange').datepicker({
        format: "dd/mm/yyyy",
        // clearBtn: true,
        language: "es",
        autoclose: false,
        todayHighlight: true,
        toggleActive: true,
        orientation: 'bottom'
    });
</script>
@endsection
