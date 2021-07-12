@extends('Pagina/base-transparencia')

@section('container')

<div class="card-box margin-start">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-danger font-weight-bold">{{ $titulo }}</h1>
            <hr>
            <h5 class="text-center font-weight-lighter">A continuacion se muestra el listado completo de todos los documentos encontrados para esta categoria.</h5>
            @if(Session::has('mensaje'))
                <div class="alert alert-{{ Session::get('tipo') }} alert-dismissible fade show mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong><i class="fa fa-exclamation-circle"></i> Informacion: </strong> {{ Session::get('mensaje'); }}
                </div>
            @endif
        </div>
        <div class="col-12">
            <span class="float-right">
                {{-- <strong class="font-weight-lighter">Visualizacion</strong> --}}
                <button class="btn btn-outline-danger btn-sm" onclick="fnChangeView('list');" title="Seleccione el tipo de visualizacion como Lista"><i class="fa fa-th-list"></i></button>
                <button class="btn btn-outline-danger btn-sm" onclick="fnChangeView('table');" title="Seleccione el tipo de visualizacion como Tabla"><i class="fa fa-table"></i></button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-danger float-left">Categorias</div>
                    <div class="ribbon-content mb-3">
                        <div class="col order-first">
                            @isset($categorias)
                                @foreach($categorias as $key => $value)
                                    <div>
                                        <a href="{{ url('transparencia').'/'.$value }}" class="btn btn-link"><i class="fa fa-arrow-alt-circle-right"></i> {{ $key }}</a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-8" id="viewList">
        @include('Transparencia-web._components.documents')
    </div>
    <div class="col-12 col-sm-6 col-md-8" style="display: none;" id="viewTable">
        <div class="card-box">
            <table class="table table-sm table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection

@section('footerjs')
<script type="text/javascript">
    $(function () {
        $('table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transparencia.datatable', $categoria) }}",
            columns: [
                {data: 'titulo', name: 'titulo'},
                {data: 'descripcion', name: 'descripcion'},
                {
                    data: 'action',
                    width: '100',
                    orderable: true,
                    searchable: true
                },
            ],
            language:{
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });

    function fnChangeView(type){
        $('#viewList').show('slow');
        $('#viewTable').hide('slow');
        if(type==='table'){
            $('#viewList').hide('slow');
            $('#viewTable').show('slow');
        }
    }

</script>
@endsection
