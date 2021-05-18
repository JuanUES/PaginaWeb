@extends('Pagina/base')
@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">
<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('footerjs')
<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }}"></script>
@endsection