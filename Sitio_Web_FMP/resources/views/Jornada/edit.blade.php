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
            <h4 class="page-title"><i class="fa fa-edit"></i> Modificar Registro #{{ $jornada->id }}</h4>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <div class="alert-message">
                    <strong> <i class="fa fa-info-circle"></i> Informacion!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ url('/admin/Jornada/' . $jornada->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include ('Jornada.form', ['formMode' => 'edit'])

        </form>

    </div>
</div>
@endsection