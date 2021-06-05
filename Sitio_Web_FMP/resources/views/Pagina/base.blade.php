<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Facultad Multidisciplinaria Paracentral</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="UTI" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @yield('appcss')
        <style>
            .color-top{
                background:#DC3545;
            }
            .bottom-aligned {
                display: flex;
                align-items: flex-end;
            }
            .color-boton{
                background: #bb3b44;
            }
            .min-width-full-container{
                min-width: 100vh;
            }

            @media screen and (max-width: 992px) {
                .ocultar-div{
                     display:none;
                }
            }

            /*@media screen and (min-width: 992px) {
                .ocultar-div{
                     display:none;
                }
            }*/

            .full-height{
                height:100%;
            }

            .full-width{
                width: 100%;
            }
            .center-h {
                justify-content: center;
            }
            .center-v {
                align-items: center;
            }
        </style>
    </head>

    <body class="unsticky-header">

        <!-- Navigation Bar-->
        <header id="topnav" style="background: #DC3545;">
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
                                 <i class="mdi mdi-account-multiple mdi-24px"></i>Nosotros <div class="arrow-down"></div></a>
                            <ul class="submenu">                               
                                <li>
                                    <a href="{{ asset('MisionVision') }}">Misión y Visión</a>
                                </li>                                           
                                <li>
                                    <a href="{{ route('directorio') }}">Directorio</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="{{ asset('EstructuraOrganizativa') }}">Estructura Organizativa&nbsp;</a>                                    
                                </li>                               
                    
                            </ul>
                        </li>

                        <li class="has-submenu p-1">
                            <a href="#">
                            <i class="mdi mdi-book-open-page-variant mdi-24px"></i>Academicos <div class="arrow-down"></div></a>
                            <ul class="submenu">    
                                <li class="has-submenu">
                                    <a href="#">Administracion Académica</a>                                    
                                </li>                            
                                <li class="has-submenu">
                                    <a href="#">Departamentos <div class="arrow-down"></div></a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ asset('CienciasEducacion') }}">Ciencias de la Educación</a>
                                        </li>
                                        <li>
                                            <a href="{{ asset('CienciasAgronomicas') }}">Ciencias Agronómicas</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{ asset('CienciasEconomicas') }}">Ciencias Económicas</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{ asset('Informatica') }}">Informática</a>
                                        </li>     

                                        <li>
                                            <a href="#">Postgrado</a>
                                        </li>                                       
                                    </ul>
                                </li>                                
                                <li class="has-submenu">
                                    <a href="{{ route('investigacion')}}">Investigación</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#">Proyección Social</a>
                                </li>   
                                <li class="has-submenu">
                                    <a href="#">Procesos de Graduacion</a>
                                </li> 
                                <li class="has-submenu">
                                    <a href="http://biblio.fmp.ues.edu.sv/">Biblioteca</a>
                                </li>                                 
                            </ul>
                        </li>

                        <li class="has-submenu p-1">
                            <a href="#" class="rounded btn text-left">
                                 <i class="mdi mdi-clipboard-text mdi-24px"></i>Administrativo<div class="arrow-down"></div></a>
                            <ul class="submenu">                                
                                <li>
                                    <a href="#">Colecturia</a>
                                </li>
                                
                                <li>
                                    <a href="#">Unidad de Tegnologia<br>de la Informacion</a>
                                </li>

                                <li>
                                    <a href="#">Desarrollo Físico</a>
                                </li>

                                <li>
                                    <a href="#">Universidad en Linea</a>
                                </li>                                    
                            </ul>
                        </li>     

                        <li class="has-submenu p-1">
                            <a href="{{ url('transparencia') }}"  class="rounded btn text-left">
                                <i class="mdi mdi-file-account mdi-24px"></i>
                                Transparencia
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
        <footer class="footer py-1 color-top text-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ date('Y') }} &copy; Facultad Multidisciplinaria Paracentral - <a href="https://www.ues.edu.sv/" class="text-white-50">Universidad de El Salvador</a>.   Todos los derechos reservados.
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        @yield('footerjs')       
        
    </body>
</html> 