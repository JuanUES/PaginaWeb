<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>FMP - Universidad de El Salvador</title><!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                
            <div class="container-fluid py-1">
                <div class="row align-items-center color-top ocultar-div">
                    <div class="col-2">
                        <div class="col-2">
                            <a>
                                <img src="images/ues_logo3.svg" alt="logo" height="">
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
                            <a href="index1.html" class="color-boton rounded text-left" >
                                &nbsp;&nbsp;&nbsp;&nbsp;<i class=" mdi mdi-home mdi-24px"></i>Inicio </a>
                        </li>

                        <li class="has-submenu p-1">
                            <a href="#" class="color-boton rounded btn text-left">
                                 <i class="mdi mdi-account-multiple mdi-24px"></i>Nosotros <div class="arrow-down"></div></a>
                            <ul class="submenu">
                                <li>
                                    <ul>
                                        <li>
                                            <a href="#">Misión y Visión</a>
                                        </li>                                           
                                        <li>
                                            <a href="#">Directorio</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="EstructuraOrganizativa.html">Estructura Organizativa&nbsp;</a>                                    
                                </li>                               
                    
                            </ul>
                        </li>

                        <li class="has-submenu p-1 color-top">
                            <a href="#" class="color-boton rounded btn text-left btn-sm">
                                <i class=" mdi mdi-library mdi-24px"></i>
                                Academicos 
                                <div class="arrow-down"></div>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">Ciencias de la educacion</a>
                                </li>
                                <li>
                                    <a href="#">Ciencias Agronomicas</a>
                                </li>
                                <li>
                                    <a href="#">Ciencias Economicas</a>
                                </li>
                                <li>
                                    <a href="#">Informática</a>
                                </li>  
                                <li>
                                    <a href="#">Postgrado</a>
                                </li>                                    
                            </ul>
                        </li>

                        <li class="has-submenu p-1">
                            <a href="#" class="color-boton rounded btn text-left">
                                 <i class="mdi mdi-file-account mdi-24px"></i>Administrativo<div class="arrow-down"></div></a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li>
                                            <a href="#">Administración académica</a>
                                        </li>
                                        <li>
                                            <a href="#">Colecturia</a>
                                        </li>
                                        <li>
                                            <a href="#">Comunicaciones</a>
                                        </li>
                                        <li>
                                            <a href="#">Unidad de tegnologia</br>de la informacion</a>
                                        </li>
                                        <li>
                                            <a href="#">Unidad de planificación</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="#">Proyección Social</a>
                                        </li>
                                        <li>
                                            <a href="#">Universidad en linea</a>
                                        </li>
                                        
                                        <li>
                                            <a href="#">CELEUES</a>
                                        </li> 
                                    </ul>
                                </li>
                            </ul>
                        </li>   

                        <li class="has-submenu p-1">
                            <a href="#"  class="color-boton rounded btn text-left">
                                <i class="mdi mdi-file-account mdi-24px"></i>
                                Transparencia
                            </a>
                        </li>

                        <i class="has-submenu p-1 text-left float-right">
                            <a href="#"  class=" btn">
                                <i class="mdi mdi-facebook-box mdi-36px"></i>
                            </a>
                        </i>
                        
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
                        2021 &copy; Facultad Multidisciplinaria Paracentral - <a href="" class="text-white-50">Universidad de El Salvador</a> 
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        @yield('footerjs')       
        
    </body>
</html> 