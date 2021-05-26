@extends('Pagina/baseOnlyHtml')

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
            <div class="card-box col-xl-12">
                <div class="row">
                    <div class="col-xl-12 ">
                        <h1>Titulo </h1>
                        <p>Subtitulo</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col order-first">
                        <img src="/imagen/noticias/{{ $noticia->imagen }}" alt="Imagen Noticia" height="200" width="200">
                    </div>
                    <div class="col order-last">                        
                        <p>Contenido</p>
                    </div>
                </div>
            </div>   
        </div>
    </div> <!-- end container -->
</div> 
@endsection