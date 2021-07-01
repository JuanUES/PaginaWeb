@extends('Pagina/base-transparencia')

@section('container')

<div class="card-box margin-start">
    @php
        $titulo = "Marcos Normativos ";
    @endphp

    <h1 class="text-center text-danger font-weight-bold">Marcos Normativos</h1>
    <hr>
</div>
<div class="row">
    @php
        setlocale(LC_TIME,"es_SV");
    @endphp

    @isset($documentos)
        @foreach($documentos as $key => $item)
            <div class="col-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-danger float-left">{{ strftime("%A, %d de %B de %Y", strtotime($item->created_at)) }}</div>
                    <div class="ribbon-content">
                        <h3><a href="{{ url('transparencia').'/'.$categoria.'/'.$item->id }}">{{ $item->titulo }}</a></h3>
                        <p>{!! $item->descripcion !!}</p>
                        <div class="float-right">
                            <a href="{{ url('transparencia').'/'.$categoria.'/'.$item->id }}"> <i class="fa fa-eye"></i> Ver mas</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</div>

<div style="display: block; margin-left: auto; margin-right: auto; width: 10%;">
    {{ $documentos->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection
