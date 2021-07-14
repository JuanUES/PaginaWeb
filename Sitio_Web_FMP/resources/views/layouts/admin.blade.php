<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Administración FMP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/images/ues_logo3.svg') }}">
        <!-- vectormap -->
        <link href="{{ asset('template-admin/dist/assets/libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />
        <!-- DataTables -->
        <link href="{{ asset('template-admin/dist/assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template-admin/dist/assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>

        <!-- Summernote css -->
        <link href="{{ asset('template-admin/dist/assets/libs/summernote/summernote-bs4.css') }}" rel="stylesheet" />

        <!-- App css -->
        <link href="{{ asset('template-admin/dist/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template-admin/dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template-admin/dist/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


        @yield('plugins')

        {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}

    </head>
    <body>
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="badge badge-info noti-icon-badge">21</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Ver todas</small>
                                        </a>
                                    </span>Notificaciones
                                </h5>
                            </div>

                            <div class="slimscroll noti-scroll">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i> </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                    <p class="notify-details">Carlos Crouch liked
                                        <b>Admin</b>
                                        <small class="text-muted">13 days ago</small>
                                    </p>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                Ver todas
                                <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('/images/ues_logo3.svg') }}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                Agnes K <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="m-0">
                                    Welcome !
                                </h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="dripicons-user"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="dripicons-gear"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="dripicons-help"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="dripicons-lock"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="dripicons-power"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>


                </ul>

                <ul class="list-unstyled menu-left mb-0">
                    <li class="float-left">
                        <a href="{{ asset('admin') }}" class="logo">
                            <span class="logo-lg">
                                <img src="{{ asset('/images/ues_logo3.svg') }}" alt="" height="22">
                                <strong class="text-white">Universidad de El Salvador</strong>
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('/images/ues_logo3.svg') }}" alt="" height="24">
                            </span>
                        </a>
                    </li>
                    <li class="float-left">
                        <a class="button-menu-mobile navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Administración</li>
                            <li>
                                <a href="{{ url('admin/') }}">
                                    <i class="dripicons-meter"></i>
                                    <span> Tablero </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="dripicons-view-list-large"></i>
                                    <span> Marcos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('admin/transparencia/marco-normativo') }}">Normativo</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/transparencia/marco-gestion') }}">De Gestión</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/transparencia/marco-presupuestario') }}">Presupuestario</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('admin/transparencia/estadisticas') }}">
                                    <i class="dripicons-graph-bar "></i> <span> Estadísticas </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/transparencia/documentos-JD') }}">
                                    <i class="dripicons-document"></i> <span> Doc. de Junta Directiva </span>
                                </a>
                            </li>
                            <li class="menu-title">Seguridad</li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="dripicons-toggles "></i>
                                    <span> Gestión de Seguridad </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href=".">Usuarios</a>
                                    </li>
                                    <li>
                                        <a href=".">Roles</a>
                                    </li>
                                    <li>
                                        <a href=".">Bitacora</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        @yield('content')

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {{ date('Y') }} &copy; Universidad de El Salvador
                                {{-- 2018 - 2019 &copy; Greeva theme by <a href="">Coderthemes</a> --}}
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>



        <!-- Vendor js -->
        <script src="{{ asset('template-admin/dist/assets/js/vendor.min.js') }}"></script>

        <!-- KNOB JS -->
        <script src="{{ asset('template-admin/dist/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- Chart JS -->
        <script src="{{ asset('template-admin/dist/assets/libs/chart-js/Chart.bundle.min.js') }}"></script>

        <!-- Jvector map -->
        <script src="{{ asset('template-admin/dist/assets/libs/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/jqvmap/jquery.vmap.usa.js') }}"></script>



        <!-- Datatable js -->
        <script src="{{ asset('template-admin/dist/assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('template-admin/dist/assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>



        <!--Summernote js-->
        <script src="{{ asset('template-admin/dist/assets/libs/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>

        <!-- Init js -->
        {{-- <script src="{{ asset('template-admin/dist/assets/js/pages/form-summernote.init.js') }}"></script> --}}
        <!-- App js -->
        <script src="{{ asset('template-admin/dist/assets/js/app.min.js') }}"></script>


        @yield('plugins-js')
    </body>
</html>
