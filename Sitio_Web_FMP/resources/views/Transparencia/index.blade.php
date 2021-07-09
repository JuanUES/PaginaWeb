@extends('layouts.admin')

@section('content')

{{-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
{{-- <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Greeva</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Form Elements</li> --}}
                </ol>
            </div>
            <h4 class="page-title">Administracion</h4>
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
            <a href="{{ url('/admin/create').'/'.$categoria }}" class="btn btn-success" title="Add New Client">
                <i class="fa fa-plus" aria-hidden="true"></i> Agregar
            </a>
        </div>
    </div>

    <br/>
    <br/>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Publico</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        {{-- <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->titulo }}</td>
                <td>{!! $item->descripcion !!}</td>
                <td>
                    <form method="POST" action="{{ url('/employees' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        @if($item->publicar)
                            <span class="badge badge-primary">Publicado</span>
                        @else
                            <span class="badge badge-warning">Inhabilitado</span>
                        @endif

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="publicar" name="publicar">
                            <label class="custom-control-label" for="publicar">Publicar</label>
                        </div>
                    </form>
                </td>
                <td class="text-center">
                    <button type="button" data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-info btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></button>
                    <a href="{{ url('/admin/transparencia/edit/' . $item->id) }}" title="Modificar contenido"><button class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>
                    <form method="POST" action="{{ url('/employees' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody> --}}
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

