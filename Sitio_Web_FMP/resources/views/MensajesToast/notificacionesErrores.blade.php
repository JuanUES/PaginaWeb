
@section('csstoast')
    <!-- Jquery Toast css -->
    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('jstoast')
    <!-- toastr init js-->
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('js/toastr.init.js') }}"></script>
    @if (session('mensaje') && session('titulo') && session('tipo') )    
    <script>
        $.toast({ 
            heading: {!! session('titulo') !!},
            text: {!! session('mensaje') !!},
            hideAfter: 3000,
            bgColor : '#33CA70',   
            icon: {!! session('tipo') !!},
            loaderBg: "#FFFFFF",
            position: "bottom-center",
            showHideTransition : 'slide',
            allowToastClose : false,
            stack: 20
        });
    </script>
    @endif

    @if ($errors->any())
    
        @foreach ($errors -> all() as $error)
        <script>
            $.toast({ 
                heading: "Error!",
                text: {!! $error !!}."",
                hideAfter: 3000,  
                icon: "error",
                loaderBg: "#FFFFFF",
                position: "bottom-center",
                showHideTransition : 'slide',
                allowToastClose : false,
                stack: 20
            });
        </script>    
        @endforeach     
    @endif
@endsection