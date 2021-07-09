@extends('Pagina/base-transparencia')

@section('container')
<div class="card-box" style="margin-top: 3cm;">
    @php
        //$titulo = "Marcos Normativos ";
        $titulo = explode("-", $documento->categoria);
       
    @endphp
    <h1 class="text-center text-danger font-weight-bold mt-0 pt-0">{{ ucfirst("$titulo[0]"). " " .ucfirst("$titulo[1]")  }}</h1>
    <hr class="mt-0 mb-0 pt-0 pb-0">
    <h3 class="text-center text-danger font-weight-bold">{{ $documento->titulo }}</h3>

</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-4">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-danger float-left">Relacionados</div>
            <div class="ribbon-content">
                <div class="col order-first">
                    @isset($documentos)
                        @foreach($documentos as $key => $item)
                            <div><a href="{{ url('transparencia').'/'.$categoria.'/'.$item->id }}" data-id="{{ Hash::make($item->id) }}" class="documentos btn btn-link"><i class="fa fa-file-pdf"></i> {{ $item->titulo }}</a>
                            
                            <a href="{{ route('downloadFile', $item->documento) }}"><i class="fa fa-download" aria-hidden="true" style="color: brown"></i></a>
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="float-right">
                    <a href="{{ url('transparencia').'/'.$categoria }}" class="font-weight-light"><i class="fa fa-eye"></i> Ver todos ...</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-8">
        <div class="card-box">
            <p> {!! $documento->descripcion !!} </p>
            <hr>
            <embed src="{{ asset('storage').'/'.$documento->documento }}" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>
</div>
@endsection
