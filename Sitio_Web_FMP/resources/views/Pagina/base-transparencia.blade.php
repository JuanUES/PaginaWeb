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
        @yield('appcss')
        <link rel="stylesheet" href="{{ asset('css/base.css') }}" />
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
                                <i class=" mdi mdi-home mdi-24px"></i>Inicio </a>
                        </li>
                        <li class="has-submenu p-1">
                            <a href="#" class="rounded btn text-left">
                                 <i class="mdi mdi-view-list mdi-24px"></i>Marcos<div class="arrow-down"></div></a>
                            <ul class="submenu">                                
                                <li><a href="#">Normativo</a></li>
                                <li><a href="#">De Gestión</a></li>
                                <li><a href="#">Presupuestario</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu p-1">
                            <a href="#" class="rounded btn text-left">
                                 <i class="mdi mdi-chart-line mdi-24px"></i>Estadísticas
                             </a>
                        </li> 
                        <li class="has-submenu p-1">
                            <a href="#" class="rounded btn text-left">
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
                    <!-- End navigation menu -->
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>  
                    </ul>
                    
                    <div class="clearfix"></div>
                    
                </div>
                <!-- end #navigation -->
            </div>
            
            <!-- end navbar-custom -->

        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        @yield('container')      
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->      

        <!-- Footer Start -->
        <footer class="footer py-1 color-boton text-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ date('Y') }} &copy; Facultad Multidisciplinaria Paracentral - <a href="https://www.ues.edu.sv/" class="text-white-50">Universidad de El Salvador</a>. Todos los derechos reservados
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        @yield('footerjs')       
        
    </body>
</html> 