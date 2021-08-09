@extends('Pagina/baseOnlyHtml')
@section('header')
@auth
<!-- Este css se carga nada mas cuando esta logeado un usuario-->
<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />
@endauth
@endsection
@section('footer')
@auth    
<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>
@endauth
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
                    <h3>Proyección Social</h3>
                    <div class="row">
                        <div class="col-xl-8 p-3">
                            <h4 class="mb-1 font-weight-bold">¿Que es Servicio social?</h4>
                            <p class="text-muted font-15 text-justify">
                                Es el conjunto de actividades planificadas que persiguen objetivos académicos, de investigación y de servicio; con el fin de poner a los miembros de la comunidad universitaria en contacto con la realidad, para obtener una toma de conciencia ante la problemática social salvadoreña e incidir en la transformación y superación de la sociedad.
                            </p>
                            <h4 class="mb-1 font-weight-bold">Jefe de la Unidad</h4>
                            @if (count($jefaturas)==0)
                            @guest
                            <div class="row">
                                <p class="border p-2 text-center btn-block">No hay datos registrados.</p>
                            </div>
                            @endguest
                            @endif
                            @guest
                            <p class="text-muted font-15 text-justify">
                                {!!count($jefaturas)?$jefaturas[0]->sector_dep_unid:null;!!}   
                            </p>
                            @endguest
                            @auth
                            <div class="row">
                                <div class="col-xl-12">
                                    <form action="{{ route('JefeProyeccionSocial') }}" method="POST">
                                        @csrf
                                        <div class="row my-2">                                            
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" required 
                                                placeholder="Jefe de la Unidad (Obligatorio)"
                                                name="jefatura" value="{!!count($jefaturas)?$jefaturas[0]->sector_dep_unid:null;!!}"
                                                />
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-block btn-info"><i class=" mdi mdi-content-save-move"></i> Guardar</button>
                                            </div>                                            
                                        </div> 
                                    </form>                                    
                                </div>
                            </div>  
                            @endauth
                            <div class="row py-2">
                                <div class="col order-first">
                                <h4 class="mb-1 font-weight-bold">Coordinadores de Carreras</h4>
                                </div>
                                @auth         
                                <div class="col-lg-4 order-last">              
                                    <a type="button" href="#" class="btn btn-info btn-block"
                                    data-toggle="modal" data-target="#myModalCoordinadores"><i class="dripicons-document"></i> Nuevo Coordinador</a>
                                    <!-- Coordinadores modal content -->
                                    <div id="myModalCoordinadores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-notebook-multiple mdi-24px"></i>Registro Nuevo</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">                                        
                                                    <div class="tab-content">
                                                    <form method="POST" 
                                                    action="{{ route('nuevoCoordinador') }}" 
                                                    class="parsley-examples"
                                                    enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <label>Nota: <code>* Campos Obligatorio</code></label>
                                                                </div>
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label>Coordinador <code>*</code></label>
                                                                    <input type="text" class="form-control" required
                                                                            placeholder="Coordinador (Obligatorio)"
                                                                            name="coordinador" />
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>      
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label>Departamento <code>*</code></label>
                                                                    <div>
                                                                        <textarea required class="form-control" name="departamento" placeholder="Departamento (Obligatorio)"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>         
                                                        <div class="form-group mb-0">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1"> <li class="fa fa-save"></li>
                                                                    Guardar
                                                                </button>
                                                                <button type="reset" class="btn btn-light waves-effect"><i class="fa fa-ban" aria-hidden="true"></i>
                                                                    Cancelar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>       
                                                    </div>
                                                </div>                                    
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->                                     
                                </div>
                                @endauth
                            </div>

                            <div class="row">
                                
                                @if (count($coordinadores)!=0)
                                <div class="col-xl-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered  ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <p>Nombre</p>
                                                    </th>
                                                    <th class="text-lefth">
                                                        <p>Departamento</p>
                                                    </th>   
                                                    @auth
                                                    <th>
                                                        <p>Acciones</p>
                                                    </th> 
                                                    @endauth                           
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($coordinadores as $item)
                                                <tr>
                                                    <th class="text-nowrap" scope="row">{!!$item->nombre!!}</th>
                                                    <td>{!!$item->sector_dep_unid!!}</td>
                                                    @auth                                   
                                                    <td>
                                                        <div class="row">  
                                                            <div class="col text-center">                                               
                                                            <div class="btn-group" role="group">
                                                                <button onclick="modificarD({{$item->id}})" data-toggle="modal" data-target="#myModalCoordinadoresEditar" class="btn btn-light waves-effect width-md m-1">
                                                                    <i class="mdi mdi-file-document-edit mdi-16p"></i> Editar
                                                                </button>
                                                                <div id="myModalCoordinadoresEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-notebook-multiple mdi-24px"></i>Editar</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">                                        
                                                                                <div class="tab-content">
                                                                                <form method="POST" 
                                                                                action="{{ route('nuevoCoordinador') }}" 
                                                                                class="parsley-examples"
                                                                                enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-xl-12">
                                                                                            <label>Nota: <code>* Campos Obligatorio</code></label>
                                                                                            </div>
                                                                                        <div class="col-xl-12">
                                                                                            <div class="form-group">
                                                                                                <label>Coordinador <code>*</code></label>
                                                                                                <input type="text" class="form-control" required
                                                                                                        placeholder="Coordinador (Obligatorio)"
                                                                                                        name="coordinador" id="cordinador" />
                                                                                            </div> 
                                                                                        </div>
                                                                                        <input type="hidden" name="id" id="id">
                                                                                    </div>      
                                                                                    <div class="row">
                                                                                        <div class="col-xl-12">
                                                                                            <div class="form-group">
                                                                                                <label>Departamento <code>*</code></label>
                                                                                                <div>
                                                                                                    <textarea id="depto" required class="form-control" name="departamento" placeholder="Departamento (Obligatorio)"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>         
                                                                                    <div class="form-group mb-0">
                                                                                        <div>
                                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1"> <li class="fa fa-save"></li>
                                                                                                Guardar
                                                                                            </button>
                                                                                            <button type="reset" class="btn btn-light waves-effect"><i class="fa fa-ban" aria-hidden="true"></i>
                                                                                                Cancelar
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>       
                                                                                </div>
                                                                            </div>                                    
                                                                        </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog -->
                                                                </div><!-- /.modal -->
                                                         
                                                                <form name="{!!  str_replace ( '=', '', base64_encode(md5($item->id))) !!}"
                                                                     action="{{ asset('/Coordinadores/borrar') }}/{!! base64_encode($item->id) !!}" 
                                                                    method="POST">     
                                                                    @csrf                                              
                                                                    <a type="buttom"  class="btn btn-light waves-effect width-md m-1" onclick="eliminar('{!! str_replace ( '=', '', base64_encode(md5($item->id))) !!}');"><i class="mdi mdi-delete"></i> Eliminar</a>   
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>                         
                                                    </th>
                                                    @endauth 
                                                </tr>  
                                                @endforeach                                                              
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div>
                                @else
                                <p class="border p-2 text-center btn-block">No hay datos registrados.</p>
                                @endif  
                            </div>
                            <h4 class="mb-1 font-weight-bold">Lineamientos</h4>
                            <ul>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        No será permitido Inscribir el Servicio Social en Empresas de Familiares.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        La duración del Servicio Social está establecida en el artículo 34 del reglamento, el cual establece para Licenciatura e Ingeniería 500 horas y para los Profesorado y técnico 300 horas, para las Maestrías 200 horas.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        El Servicio Social no debe de confundirse como práctica de la carrera que estudia, sino como la actividad retributiva, obligatoria prioritariamente de carácter gratuito, que realiza todo estudiante de la UES en beneficio de la sociedad.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Es de aclarar que de acuerdo al manual de procedimientos del Servicio Social el ámbito de ejecución puede ser: A nivel interno el Servicio Social para todas las carreras se podrá realizar en las siguientes actividades: En actividades de investigación, culturales, actividades Administrativas entre otras.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Si el Alumno presenta proyectos externos y se comprueba la no realización de estos, se procederá a anularse el Servicio Social.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Es obligación del tutor supervisar y constatar la veracidad del Servicio Social, al detectarse proyectos Viciados por parte de los Estudiantes que quieran beneficiarse por procesos fraudulentos como inscribir Servicio Social en empresas las cuales presten su nombre a los estudiantes para firmar la documentación pertinente y no desarrollar el Servicio Social en físico; al Estudiante se les aplicará el Reglamento Disciplinario de la Universidad y se le anulará el Servicio Social.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Ningún Alumno puede iniciar su Servicio Social sin tenerlo inscrito en la Unidad de Proyección Social.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        El Servicio Social no es de carácter retroactivo se debe de inscribir antes de que se inicie el proyecto.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        A partir de la fecha en que se inscribe se dispone de 15 días corridos para presentar el proyecto aprobado por el tutor a la Unidad de Proyección Social.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                        Documentar todos los proyectos con fotografías y demás documentos que sean producto de la naturaleza de los proyectos.
                                    </p>
                                </li>
                                
                            </ul>
                            
                            <div class="row">                                
                                <div class="col order-first">
                                    <h4></h4>
                                </div>                               
                                @auth
                                <div class="col-lg-3 order-last">
                                    <button class="btn btn-block btn-info tex-left" 
                                        data-toggle="modal" data-target=".bs-example-modal-center">
                                        <div class="mdi mdi-upload mdi-16px text-center"> Subir PDF</div>
                                    </button>
                                </div>  
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myCenterModalLabel">Zona para subir PDF</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form action="{{ route('subirPdf', ['localizacion'=>'ProyeccionSocial']) }}" method="post"
                                                    class="dropzone" id="my-awesome-dropzone">
                                                    @csrf                                 
                                                    <div class="dz-message needsclick">
                                                        <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                        <h3>Suelta los archivos aquí o haz clic para subir.</h3>
                                                    </div>
                                                    <div class="dropzone-previews"></div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endauth
                            </div> 
                            @if (count($pdfs)>0)
                            <div class="table-responsive my-2" id="listaPDF">
                                <table class="table mb-0 border @guest table-striped @endguest">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h4>Formularios y Guías</h4>
                                            </th>
                                            <th class="col-sm-4">                                              
                                            </th>                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pdfs as $item)
                                        <tr>
                                            <th class="text-nowrap align-middle" scope="row">
                                                <p class="font-18">{!!$item->file!!}</p>
                                            </th>                                             
                                                                             
                                            <th class="align-middle ">
                                                
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-danger waves-effect width-lg mx-1"  href="{{ route('index') }}{!!'/files/pdfs/'.$item->file !!}" target="_blank"> 
                                                        <i class="mdi mdi-file-pdf mdi-24px mr-1"></i>Descargar
                                                    </a>
                                                    @auth
                                                    <button type="buttom"  class="btn btn-light waves-effect width-md mx-1" data-toggle="modal" data-target="#modalEliminar"
                                                        onclick="$('#eliminar').val({{$item->id}})"><i class="mdi mdi-delete mdi-24px"></i>  Eliminar
                                                    </button>  
                                                    @endauth 
                                                </div>
                                                                                         
                                            </th>
                                             
                                        </tr>  
                                        @endforeach                                                              
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->    

                            @auth
                            <div id="modalEliminar" class="modal fade bs-example-modal-center" tabindex="-1" 
                                role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="myCenterModalLabel"><i class="mdi mdi-delete mdi-24px"></i> Eliminar</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('EliminarProyeccionPDF') }}" method="POST">
                                                @csrf
                                                <div class="row py-3">
                                                    <div class="col-lg-2 fa fa-exclamation-triangle text-warning fa-4x"></div>
                                                    <div class="col-lg-10 text-black">
                                                        <h4 class="font-17 text-justify font-weight-bold">Advertencia: Se elimina este registro de manera permanente, ¿Desea continuar?</h4>
                                                    </div>
                                                    <input type="hidden" name="_id" id="eliminar">
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <button type="submit" 
                                                            class="btn p-1 btn-light waves-effect waves-light btn-block font-24">
                                                            <i class="mdi mdi-check mdi-16px"></i>
                                                            Si
                                                        </button>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <button type="reset" class="btn btn-light p-1 waves-light waves-effect btn-block font-24" data-dismiss="modal" >
                                                            <i class="mdi mdi-block-helper mdi-16px" aria-hidden="true"></i>
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal --> 
                            @endauth
                            @endif
                            
                            <h4>Contactanos</h4>
                            <p class="text-muted font-15 text-justify">
                                Correo: proyeccionsocial.fmp@ues.edu.sv    
                            </p>
                            
                        </div>
                        <div class="col-xl-4 p-2">
                            <div class="col-xl-12">
                            <h4>Siguenos en Facebook</h4>
                            </div>
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FProyecci%25C3%25B3n-Social-Facultad-Multidisciplinaria-Paracentral-107669451092211&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                                   
                        </div>
                    </div>                       
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> 


    

<script>
    // pone los campos de la persona que se editara en el modal
    function modificarD(id){
      $("#id").val(id);
      
      
    }
</script>

@endsection

