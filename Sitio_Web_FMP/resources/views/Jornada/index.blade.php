@extends('layouts.admin')

@section('content')
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
                <th>Jornada</th>
                <th>Periodo</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->titulo }}</td>
                <td>{!! $item->descripcion !!}</td>
                <td>
                    <form method="POST" action="{{ url('/Jornada' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        @if($item->publicar)
                            <span class="badge badge-primary">Activo</span>
                        @else
                            <span class="badge badge-warning">Inactivo</span>
                        @endif

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="publicar" name="publicar">
                            <label class="custom-control-label" for="publicar">Publicar</label>
                        </div>
                    </form>
                </td>
                {{--<td class="text-center">
                    <button type="button" data-key="{{ ($item->id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-info btn-sm openModal"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></button>
                    <a href="{{ url('/admin/transparencia/edit/' . $item->id) }}" title="Modificar contenido"><button class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>
                    <form method="POST" action="{{ url('/employees' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>
                    </form>
                </td>--}}
            </tr>
        @endforeach
        </tbody> 
    </table>
</div>




@endsection