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
            heading: "{!! session('titulo') !!}",
            text: "{!! session('mensaje') !!}",
            hideAfter: 3000,
            bgColor : '#33CA70',   
            icon: "{!! session('tipo') !!}",
            loaderBg: "#FFFFFF",
            position: "top-right",
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
                heading: "¡¡ Error !!",
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
    

    <script>
        $.toast({ 
            heading: "¡¡ Aviso !!",
            text: "Se eliminara el registro de la base de datos <br> ¿Desea continuar con esta acción? <br><div class='row my-1'><div class='col order-first mx-1'><button type='submit' class='btn btn-outline-light waves-effect btn-block px-2'>Si</button></div><div class='col order-last mx-1'><button type='submit' class='btn btn-block btn-outline-light waves-effect px-2'>No</button></div></div>",
            icon: "warning",
            position: "top-center",
            showHideTransition : 'slide',
            hideAfter : false,
            allowToastClose : false
        });
    </script>   
@endsection