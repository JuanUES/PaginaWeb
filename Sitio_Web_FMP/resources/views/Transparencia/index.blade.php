@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header lead"><i class="fa fa-list"></i> Administracion</div>
    <hr class="mt-0 pt-0">
    <div class="card-body">
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
            <div class="col-12 col-sm-8">
                <div class="row d-flex flex-row-reverse">
                    <div class="col-4">
                        <form method="GET" action="{{ url('/admin').'/'.$categoria }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Publico</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->titulo }}</td>
                        <td>{!! $item->descripcion !!}</td>
                        <td>{{ $item->publicar }}</td>
                        <td class="text-center">
                            <a href="{{ url('/employees/' . $item->id) }}" title="Detalle"><button class="btn btn-info btn-sm"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/employees/' . $item->id . '/edit') }}" title="Modificar contenido"><button class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>

                            <form method="POST" action="{{ url('/employees' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $items->links() !!}
            </div>
        </div>

    </div>
</div>
@endsection
