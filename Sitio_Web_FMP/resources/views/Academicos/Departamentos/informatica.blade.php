@extends('Pagina/baseOnlyHtml')

@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-alt-bg color-top"></div>
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div>         
        <div class="my-3"></div>
        <!-- end page title -->
        <div class="card-box"> 
            <div class="row">
                <div class="col-xl-8">
                    <h4 class="header-title">Ingeniería de Sistemas Informáticos</h4>                            
                            <p class="mb-1 font-weight-bold ">CODIGO:</p>
                            <p class="text-muted font-13 text-justify">I70515</p>
                            <p class="mb-1 font-weight-bold">DESCRIPCIÓN:</p>
                            <p class="text-muted font-13 text-justify">
                                La Carrera de INGENIERIA DE SISTEMAS INFORMATICOS, tiene como objetivo preparar
Profesionales con conocimientos científicos y una habilidad creadora tal, que le permita identificar
problemas y formular soluciones integrales a sistema informáticos en empresas públicas y
privadas.
                            </p> 
                        
                                            
                            <p class="mb-1 font-weight-bold">TIEMPO DE DURACIÓN:</p>
                            <p class="text-muted font-13">
                                5 años.
                            </p>
    
                            <p class="mb-1 font-weight-bold">GRADO Y TÍTULO QUE OTORGA:</p>
                            <p class="text-muted font-13">
                                INGENIERO (A) DE SISTEMAS INFORMÁTICOS
                            </p>
                            <p class="mb-1 font-weight-bold">PENSUM:</p>
                            
                            <a href="#" type="submit" class="btn btn-outline-danger"> <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div></a>
                        
                </div>
                
            </div> <!-- end row--> 
        </div> <!-- end card-box -->

    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection