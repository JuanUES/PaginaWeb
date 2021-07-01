<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Transparencia FMP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="UTI" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" href="{{ asset('css/base.css') }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('template-admin/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />


        @yield('appcss')


    </head>

    <body class="unsticky-header">

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="navb  color-top">
                <ul class="list-unstyled bottomnav-menu float-right color-top">

                    <li class="dropdown notification-list color-top">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link ">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
            </div>
            <!-- end Topbar -->

            <div class="container-fluid">
                <div class="row align-items-center color-top ocultar-div ">
                    <div class="col-2">
                        <div class="col-2 my-1">
                            <a href="{{ asset('/') }}">
                                <img src="{{ asset('/images/ues_logo3.svg') }}" alt="logo" height="">
                            </a>
                        </div>
                    </div>
                    <div class="col-10 text-white text-left">
                        <h3 class="text-white">Universidad de El Salvador</h3>
                        <h1 class="text-white">Facultad Multidisciplinaria Paracentral</h1>
                        <h3 class="text-white">Unidad de Acceso a la Información Pública</h2>
                    </div>
                </div>

                <div id="navigation" >
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu py-1 color-fondo " >
                        <li class="has-submenu p-1 center-text">
                            <a href="{{ asset('/') }}" class=" rounded text-left" >
                                <i class="mdi mdi-arrow-left-box  mdi-24px"></i>Regresar a la Pagina Web </a>
                        </li>
                        <li class="has-submenu p-1">
                            <a href="#" class="rounded btn text-left">
                                 <i class="mdi mdi-view-list mdi-24px"></i>Marcos<div class="arrow-down"></div></a>
                            <ul class="submenu">
                                <li><a href="{{ url('transparencia/marco-normativo') }}">Normativo</a></li>
                                <li><a href="{{ url('transparencia/marco-gestion') }}">De Gestión</a></li>
                                <li><a href="{{ url('transparencia/marco-presupuestario') }}">Presupuestario</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu p-1">
                            <a href="{{ url('transparencia/estadisticas') }}" class="rounded btn text-left">
                                 <i class="mdi mdi-chart-line mdi-24px"></i>Estadísticas
                             </a>
                        </li>
                        <li class="has-submenu p-1">
                            <a href="{{ url('transparencia/documentos-JD') }}" class="rounded btn text-left">
                                 <i class="mdi mdi-file-pdf mdi-24px"></i>Documentos Junta Directiva
                             </a>
                        </li>

                        <li class="has-submenu float-right p-1">

                            @auth
                                <a href="#"  class="rounded btn text-left">
                                    <i class="mdi mdi-account mdi-24px"></i>
                                    {{ Auth::user()->name }}
                                    <div class="arrow-down"></div>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">{{ __('Cerrar sesión') }}</a>
                                        </form>
                                    </li>
                                </ul>

                            @else
                                <a href="{{ route('login') }}"  class="rounded btn text-left">
                                    <i class="mdi mdi-account mdi-24px"></i>
                                    Iniciar Sesión
                                </a>
                            @endauth

                        </li>

                    </ul>
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

        </header>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="page-title-box color-boton py-2 rounded titulo-responsive">
                    <a class="page-title text-white h2" href="{{ route('index') }}">
                        <p class="mt-0 pt-0 mb-0 pb-0 text-center">Universidad de El Salvador</p>
                        <p class="mt-0 pt-0 mb-0 pb-0 text-center">Facultad Multidisciplinaria Paracentral</p>
                        <p class="mt-0 pt-0 mb-0 pb-0 text-center">Unidad de Acceso a la Información Pública</p>
                    </a>
                </div>
                <div class="my-4"></div>

                @yield('container')

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
                        </div>
                        <!-- end card-box -->
                    </div>
                </div>

            </div>



        </div>

        <!-- Footer Start -->
        <footer class="footer py-1 text-white" id="footerbase">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ date('Y') }} &copy; Facultad Multidisciplinaria Paracentral - <a href="https://www.ues.edu.sv/" class="text-white-50">Universidad de El Salvador</a>.   Todos los derechos reservados.
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        <!-- Vendor js -->
        <script src="{{ asset('js/vendor.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('js/app.min.js') }}"></script>



        <script src="{{ asset('template-admin/dist/assets/libs/moment/moment.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

        @yield('footerjs')

    </body>
</html>
