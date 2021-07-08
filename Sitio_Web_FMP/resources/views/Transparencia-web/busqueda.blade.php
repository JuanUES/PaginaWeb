@extends('Pagina/base-transparencia')

@section('container')
<div class="card-box margin-start">
    {{-- <h1 class="text-center text-danger font-weight-bold">TITULO</h1>
    <hr> --}}
    <form method="GET" action="{{ url('/transparencia/resultado/a/b') }}" accept-charset="UTF-8" role="search">
        <div class="form-group row mb-0">
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
                <div class="form-group row mb-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar informacion" aria-label="Recipient's username" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-danger waves-effect waves-light" type="submit"> <i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-daterange input-group" data-provide="datepicker">
                <input type="text" class="form-control" name="start"  value="{{ request('start') }}"/>
                <input type="text" class="form-control" name="end" value="{{ request('end') }}"/>
            </div>
        </div>
    </form>
</div>
<div class="row">
    @php
        setlocale(LC_TIME,"es_SV");
    @endphp

        @foreach($items as $item)
            <div class="col-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-danger float-left">{{ strftime("%A, %d de %B de %Y", strtotime($item->created_at)) }}</div>
                    <div class="ribbon-content">
                        <h3><a href="url('transparencia').'/'.request('category').'/'.$item->id }}">{{ $item->titulo }}</a></h3>
                        <p>{!! $item->descripcion !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
</div>
<!--
<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Fecha de publicacion</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('transparencia').'/'.request('category').'/'.$item->id }}" data-id="{{ Hash::make($item->id) }}" ><i class="fa fa-file-pdf"></i> {{ $item->titulo }}</td>
                            <td>{!! $item->descripcion !!}</td>
                            <td>{!! $item->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
</div>-->

@endsection