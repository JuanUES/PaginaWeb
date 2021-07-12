@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">{{ $titulo }}</li>
                </ol>
            </div>
            <h4 class="page-title"> <i class="fa fa-list"></i> Administracion de {{ $titulo }}</h4>
        </div>
    </div>
</div>


<div class="card-box">
    @if(Session::has('flash_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="alert-message">
                <strong> <i class="fa fa-info-circle"></i> Informacion!</strong> {{ (Session::get('flash_message')) }}
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-12 col-sm-4">
            <a href="{{ route('admin.transparencia.create', $categoria) }}" class="btn btn-success" title="Add New Client">
                <i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo registro
            </a>
        </div>
    </div>

    <br/>
    <br/>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Publico</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
    </table>
</div>




@endsection

@section('plugins-js')
<script type="text/javascript">

    $(".openModal").click(function (e) {
        e.preventDefault();
        $('#modalView').modal('show');

    });

     $(function () {
        $('table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transparencia.index', $categoria) }}",
            columns: [
                {data: 'created_at', name: 'fecha'},
                {data: 'titulo', name: 'titulo'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'publicar', name: 'publicar'},
                {
                    data: 'action',
                    width: '150',
                    orderable: true,
                    searchable: true
                },
            ],
            language:{
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });
</script>
@endsection

@section('modals')
<!-- Modal -->
<div class="modal fade" id="modalView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="fa fa-info-circle"></i> Archivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="card-box" id="content">
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

