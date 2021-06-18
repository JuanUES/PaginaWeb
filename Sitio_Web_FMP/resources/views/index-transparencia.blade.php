@extends('Pagina/base-transparencia')

@section('appcss')
<!-- App favicon -->
<link rel="shortcut icon" href="images/favicon.ico">
@auth
<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />
@endauth

<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-alt-bg color-top"></div>
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div>
        <div class="my-4"></div>
        <!-- end page title -->


        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h1 class="header-title mb-3 ">Sitios de interes</h1>

                    <div class="row">
                        <div class="col order-first">
                            <p class="header-title">Facultades</p>
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="http://www.fmoues.edu.sv/">Facultad Multidisciplinaria de Oriente</a></div>
                            <div class="p-1"><a href="http://www.fia.ues.edu.sv/">Facultad de Ingeniería y Arquitectura</a></div>
                            <div class="p-1"><a href="https://www.agronomia.ues.edu.sv/">Facultad de Agronomía</a></div>
                            <div class="p-1"><a href="http://www.odontologia.ues.edu.sv/">Facultad de Odontología</a></div>
                            <div class="p-1"><a href="http://www.medicina.ues.edu.sv/">Facultad de Medicina</a></div>
                            <div class="p-1"><a href="https://humanidades.ues.edu.sv/">Facultad de Ciencias y Humanidades</a></div>
                            <div class="p-1"><a href="http://jurisprudencia.ues.edu.sv/sitio/">Facultad de Jurisprudencia y Ciencias Sociales</a></div>
                            <div class="p-1"><a href="https://www.quimicayfarmacia.ues.edu.sv/">Facultad de Química y Farmacia</a></div>
                            <div class="p-1"><a href="https://www.cimat.ues.edu.sv/">Facultad de Ciencias Naturales y Matemática</a></div>
                            <div class="p-1"><a href="http://www.occ.ues.edu.sv/">Facultad Multidisciplinaria de Occidente</a></div>
                            <div class="p-1"><a href="http://www.fce.ues.edu.sv/">Facultad de Ciencias Económicas</a></div>
                        </div>
                        <div class="col">
                            <p class="header-title">Secretarias</p>
                            <div class="p-1"><a href="http://secretariageneral.ues.edu.sv/">Secretaría General</a></div>
                            <div class="p-1"><a href="http://proyeccionsocial.ues.edu.sv/">Secretaría de Proyección Social</a></div>
                            <div class="p-1"><a href="http://www.eluniversitario.ues.edu.sv/">Secretaría de Comunicaciones</a></div>
                            <div class="p-1"><a href="https://es-es.facebook.com/ArteyCulturaUES/">Secretaría de Arte y Cultura</a></div>
                            <div class="p-1"><a href="http://www.bienestar.ues.edu.sv/">Secretaría de Bienestar Universitario</a></div>
                            <div class="p-1"><a href="http://www.ues.edu.sv/secretaria-de-relaciones-nacionales-e-internacionales/">Secretaría de Relaciones</a></div>
                            <div class="p-1"><a href="https://secplan.ues.edu.sv/">Secretaría de Planificación</a></div>
                            <div class="p-1"><a href="https://sic.ues.edu.sv/">Secretaría de Investigaciones Científicas</a></div>
                            <div class="p-1"><a href="http://saa.ues.edu.sv/portal/">Secretaría de Asuntos Académicos</a></div>
                        </div>
                        <div class="col order-last">
                            <p class="header-title">Institución</p>
                            <div class="p-1"><a href="#">Consejo Superior Universitario</a></div>
                            <div class="p-1"><a href="#">Asamblea General Universitaria</a></div>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container -->
</div>
<!-- end wrapper -->
@endsection

@section('footerjs')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v10.0" nonce="sQ6sREaG"></script>
<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.min.js') }}"></script>
@auth
<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>
@endauth


<script>
    Dropzone.options.myAwesomeDropzone = {
        maxFiles: 15,
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
        init: function() {
            this.on("maxfilesexceeded", function(file){
                ("No more files please!");
            });

            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    location.reload();
                }
            });

        }
    };
</script>
@endsection
