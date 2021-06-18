@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header lead"> <i class="fa fa-plus-square"></i> Crear Nuevo</div>
    <hr class="mt-0 pt-0">
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

        <form method="POST" id="frmTransparencia" action="{{ url('/admin/transparencia/store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf

            @include ('Transparencia.form', ['formMode' => 'create'])
        </form>
    </div>
</div>
@endsection
