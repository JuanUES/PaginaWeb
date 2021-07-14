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


<div class="modal fade" id="modalViewPDF" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> <i class="fa fa-file-pdf"></i> Visualizacion de PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <object id="PDFdoc" width="100%" height="500px" type="application/pdf" data=""></object>
        <p id="prueba"></p>
      </div>
    </div>
  </div>
</div>



@endsection

@section('plugins-js')
<script type="text/javascript">
     $(function () {
        let tabla = $('table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transparencia.index', $categoria) }}",
            columns: [
                {data: 'created_at'},
                {data: 'titulo'},
                {data: 'descripcion'},
                {data: 'publicar'},
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

        //para actualizar el dom y que reconozca el  class de los botones
        tabla.on( 'draw', function () {
            const btns = document.querySelectorAll('.btnViewPDF');
            btns.forEach(el => el.addEventListener('click', event => {
                let pdf = event.target.getAttribute("data-pdf");
                $('#PDFdoc').attr('data',pdf);
            }));

            const frmPublicar = document.querySelectorAll('.frmPublicar');
            frmPublicar.forEach(el => el.addEventListener('change', event => {
                el.submit();
            }));
        });


    });
</script>
@endsection

