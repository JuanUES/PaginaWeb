@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/tcontrato') }}">Tipo de Contratos</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </div>
            <h4 class="page-title"> <i class="fa fa-list"></i> Administración de Tipos de Contrato</h4>
        </div>
    </div>
</div>

<div class="card-box">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <div class="alert-message">
                    <strong> <i class="fa fa-info-circle"></i> Información!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <form method="POST" id="frmTContrato" action="{{ route('admin.tcontrato.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @include ('Tipo_Contrato.form', ['formMode' => 'create'])
        </form>
    </div>
</div>
@endsection
