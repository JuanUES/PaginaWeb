@extends('Pagina/baseOnlyHtml')
@section('header')
<!-- Summernote css -->
<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
    
    
@endsection

@section('footer')

<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/summernote.config.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
    
        
    @endsection

@section('container')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div> 
        <div class="my-4"></div>
        <!-- end page title -->           

        <div class="row">
            <div class="col-xl-12">   
                <div class="card-box">
                    <h3 class="text-center">
                        Unidad de Tecnología de la Información
                        </h3>
                    <div class="row">
                        <!--
                        <div class="col-xl-12"> 
                            <br>
                            <h4 class="text-center">Coordinador de la Unidad de Tecnología de la Información</h4>
                            <p class="mb-1 font-weight-bold font-15 text-center">Ing. Herbert Orlando Monge Barrios</p>
                            <br>
                            <h4 class="text-center">Personal de la unidad</h4>
                            <p class="mb-1 font-weight-bold font-15 text-center">Coordinación de LMS</p>
                            <p class="text-muted font-10 text-justify text-center ">
                                Ing. Jose Guillermo Pacas Montes<br>
                                Ing. Juan Francisco Hernández Duran
                            </p>  
                            
                            <p class="mb-1 font-weight-bold font-15 text-center">Coordinación de redes</p>
                            <p class="text-muted font-10 text-justify text-center">
                                Lic. Julio Alberto Martinez Guzman
                            </p>  

                            <p class="mb-1 font-weight-bold font-15 text-center">Coordinación de soporte técnico</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Ing. Jesus Armando Lainez Rodriguez
                            </p>   

                            <p class="mb-1 font-weight-bold font-15 text-center">Coordinación de desarrollo</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Inga. Liseth Guadalupe Merino De Córdova
                            </p>                                
                            
                            <p class="mb-1 font-weight-bold font-15 text-center">Horario de atención</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Lunes a viernes de 8:00 a.m. a 12:00 p.m. y 1:00 p.m. a 4:00 p.m.
                            </p> 

                            <p class="mb-1 font-weight-bold font-15 text-center">Correo</p>
                            <p class="text-muted font-10  text-justify text-center">
                                soporte.uti@ues.edu.sv
                            </p> 
                            
                        </div> end col 
                    -->
                    <div class="col-xl-12">     
                        <div class="form-group">                                               
                            <label for="contenido">Contenido <code>*</code></label>
                            <textarea value="" class="form-control summernote-config" name="contenido" id="contenido"></textarea>
                        </div>
                    </div>       
                    </div> 
                </div> 
            </div>
        </div>
    </div> <!-- end container -->
</div> 
@endsection