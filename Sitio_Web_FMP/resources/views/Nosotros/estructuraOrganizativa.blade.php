@extends('Pagina/baseOnlyHtml')

@section('header')
@auth
<link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />
@endauth
@endsection

@section('footer')
@auth
<!-- Plugins js -->
<script src=" {{ asset('js/dropzone.min.js') }} "></script>
<script>
Dropzone.options.myAwesomeDropzone = {
    paramName: "file",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar",
    uploadMultiple: false,
    parallelUploads: 1,
    maxFiles: 1,
    acceptedFiles: "image/*"
    ,init: function () {
        this.on("complete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                
            };

            this.on("maxfilesexceeded", function(file){
                done("Limite de archivos 1!");
            });
            
        });
    }
}
</script>
@endauth
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

        <div class="row" id="organigrama">
            <div class="col-xl-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col order-first">
                            <h4 class="my-2">Organigrama</h4>
                        </div>
                        @auth                            
                        <div class="col-lg-2 order-last">
                            @auth
                                <button type="button" class="btn btn-info btn-block my-1 float-right"  
                                    data-toggle="modal" data-target=".bs-example-modal-center"> 
                                    <div class="dripicons-photo">&nbsp;Subir Imagen</div>
                                </button>
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" 
                                    aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myCenterModalLabel">Zona para subir</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form  method="post" action="{{ asset('/nosotros/organigrama/image') }}/{!! base64_encode('organigrama')!!}"
                                                    class="dropzone" id="my-awesome-dropzone">
                                                    @csrf                                 
                                                    <div class="dz-message needsclick">
                                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                        <h3>Suelta el archivo aquí o haz clic para subir.</h3>
                                                    </div>
                                                    <div class="dropzone-previews"></div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            @endauth
                                                        
                        </div>
                        @endauth
                    </div>
                    @if (count($organigrama)>0)
                        <img  width="100%" height="550px" src="{{ asset('/files/image') }}/{!!$organigrama[0]->file!!}" alt="{!!$organigrama[0]->file!!}">
                    @else
                        <p>No hay imagen del organigrama.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row" id="junta">
            <div class="col-xl-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col order-first">
                            <h4 class="my-2">Miembros de la junta directiva de la facultad
                                multidisciplinaria paracentral</h4>
                        </div>
                        @auth                            
                        <div class="col-lg-3 order-last">
                            <a href="#" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModalJunta"><i class="dripicons-document"></i> Nuevo Miembro de Junta</a>
                            <div id="myModalJunta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myCenterModalLabel">Registro</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">                                        
                                            <div class="tab-content">
                                            <form method="POST" 
                                            action="{{ route('EstructuraOrganizativa.Junta') }}" 
                                            class="parsley-examples"
                                            enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label>Nombre</label>
                                                            <input type="text" class="form-control" required
                                                                    placeholder="Nombre (Obligatorio)"
                                                                    name="nombre"/>
                                                        </div> 
                                                    </div>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label>Sector que representa</label>
                                                            
                                                            <input type="text" class="form-control" required
                                                                    placeholder="Sector que representa (Obligatorio)"
                                                                    name="sector" />
                                                            
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group mb-0">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                            Crear Miembro de Junta
                                                        </button>
                                                        <button type="reset" class="btn btn-light waves-effect">
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
                        @guest
                            <p>{!!count($periodoJunta)==1 ? $periodoJunta[0] -> sector_dep_unid :'Periodo:'!!}</p>
                        @endguest
                        @auth
                            <div class="row">
                                <div class="col-xl-12">
                                    <form action="{{ route('Periodo.junta') }}" method="POST">
                                        @csrf
                                        <div class="row my-2">                                            
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" required 
                                                placeholder="Periodo (Obligatorio)"
                                                name="periodo" 
                                                value="{!!count($periodoJunta)==1 ? $periodoJunta[0] -> sector_dep_unid:null!!}"/>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-block btn-info">Guardar   <i class=" mdi mdi-content-save-move"></i></button>
                                            </div>                                            
                                        </div> 
                                    </form>                                    
                                </div>
                            </div>   
                        @endauth  
                        @if (count($junta)!=0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="tex-left">  
                                                Nombre                                          
                                            </th>
                                            <th class="text-left">
                                                Sector que Representa
                                            </th>    
                                            @auth
                                                <th class="text-left">
                                                    Acciones
                                                </th>  
                                            @endauth            
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($junta as $item)
                                        <tr>
                                            <td class="align-middle">{!!$item->nombre;!!}</td>
                                            <th class="text-nowrap align-middle" scope="row">{!!$item->sector_dep_unid;!!}</th>
                                            @auth                                   
                                            <th class="align-middle">
                                                <div class="row">
                                                    <div class="col-xl-6 order-first">                                                    
                                                        <a href="#" class="btn btn-success btn-block"><i class="dripicons-document-edit"></i>  Modificar</a>                                               
                                                    </div>
                                                    <div class="col-xl-6 order-last">                                                    
                                                        <form action="{{ asset('/EstructuraOrganizativa/JefaturaJunta') }}/{!!base64_encode($item->id)!!}/{!!base64_encode($item->tipo)!!}" 
                                                            method="POST">     
                                                            @csrf                                              
                                                            <button type="submit" class="btn btn-danger btn-block"><i class="dripicons-trash"></i>  Eliminar</button>   
                                                        </form>   
                                                    </div>
                                                </div>                                         
                                            </th>
                                            @endauth
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        @else
                            <p class="border p-2 text-center">No hay datos registrados.</p>
                        @endif             
                        
                </div>
            </div>
        </div>
        
        <div class="row" id="jefatura">
            <div class="col-xl-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col order-first">
                            <h4 class="my-2">Jefaturas Académicas y Administrativas de la facultad multidisciplinaria paracentral</h4>
                        </div>
                        @auth                            
                        <div class="col-lg-2 order-last">
                            <a class="btn btn-block btn-info" href="#" data-toggle="modal" data-target="#myModalJefatura"><i class="dripicons-document"></i> Nueva Jefatura</a>
                            <div id="myModalJefatura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myCenterModalLabel">Registro</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">                                        
                                            <div class="tab-content">
                                            <form method="POST" 
                                            action="{{ route('EstructuraOrganizativa.Jefatura') }}" 
                                            class="parsley-examples"
                                            enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label>Nombre</label>
                                                            <input type="text" class="form-control" required
                                                                    placeholder="Nombre (Obligatorio)"
                                                                    name="nombre"/>
                                                        </div> 
                                                    </div>
                                                    
                                                </div>      
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label>Departamento/Unidad</label>
                                                            <div>
                                                                <input type="text" class="form-control" required
                                                                    placeholder="Sector que representa (Obligatorio)"
                                                                    name="jefatura" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>         
                                                <div class="form-group mb-0">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                            Crear Jefatura
                                                        </button>
                                                        <button type="reset" class="btn btn-light waves-effect">
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
                    @guest
                            <p>{!!count($periodoJefatura)==1 ? $periodoJefatura[0] -> sector_dep_unid :'Periodo:'!!}</p>
                    @endguest
                    @auth
                        <div class="row">
                            <div class="col-xl-12">
                                <form action="{{ route('Periodo.jefatura') }}" method="POST">
                                    @csrf
                                    <div class="row my-2">                                            
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" required
                                            placeholder="Periodo (Obligatorio)"
                                            name="periodo" value="{!!count($periodoJefatura)==1 ? $periodoJefatura[0] -> sector_dep_unid:null!!}"/>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-block btn-info">Guardar   <i class=" mdi mdi-content-save-move"></i></button>
                                        </div>                                            
                                    </div> 
                                </form>                                    
                            </div>
                        </div>   
                    @endauth 
                    @if (count($jefaturas)!=0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="tex-left">  
                                        Nombre                                          
                                    </th>
                                    <th class="text-left">
                                        Departamento / Unidad
                                    </th>   
                                    @auth
                                    <th>
                                        Acciones
                                    </th> 
                                    @endauth                                                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jefaturas as $item)                                       
                                <tr>
                                    <td class="align-middle">
                                        {!!$item->nombre;!!}
                                    </td>
                                    <th class="align-middle" scope="row">{!!$item->sector_dep_unid;!!}</th> 
                                    @auth                                   
                                    <th class="align-middle ">
                                        <div class="row">
                                            <div class="col-xl-12"> 
                                                <form action="{{ asset('/EstructuraOrganizativa/JefaturaJunta') }}/{!!base64_encode($item->id)!!}/{!!base64_encode($item->tipo)!!}" 
                                                    method="POST">     
                                                    @csrf                                              
                                                    <button type="submit" class="btn btn-danger btn-block"><i class="dripicons-trash"></i>  Eliminar</button>   
                                                </form>
                                            </div>
                                        </div>                                         
                                    </th>
                                    @endauth  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                    @else
                    <p class="border p-2 text-center">No hay datos registrados.</p>                        
                    @endif
                    
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> 
@endsection