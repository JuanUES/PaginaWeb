@extends('Licencias.base')

@section('head')
<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Greeva</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Starter</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        
    </div> <!-- container-fluid -->

</div> <!-- content -->
@endsection

@section('footer')

<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }} "></script>
    
@endsection