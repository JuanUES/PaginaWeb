@extends('Pagina/baseOnlyHtml')
@extends('MensajesToast/notificacionesErrores')

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
        
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col order-first">
                            <h1 class="header-title py-2">Directorio</h1>                   
                        </div>
                        @auth                           
                        <div class="col-lg-2 order-last container-fluid">
                            <a type="button" href="#" class="btn btn-block btn-info"
                             data-toggle="modal" data-target="#myModalDirectorio"><i class="dripicons-document"></i> Nuevo Contacto</a>
                            <!-- directorio modal content -->
                        <div id="myModalDirectorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Registro Nuevo</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">                                        
                                        <div class="tab-content">
                                        <form method="POST" 
                                        action="{{ route('Nosotros.directorio') }}" 
                                        class="parsley-examples"
                                        enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <input type="text" class="form-control" required
                                                                placeholder="Nombre (Obligatorio)"
                                                                name="nombre" id="titulo"/>
                                                    </div> 
                                                </div>
                                                
                                            </div>      
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label>Contactos</label>
                                                        <div>
                                                            <textarea required class="form-control" name="contacto" placeholder="Contactos (Obligatorio)"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>         
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Nuevo
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
                    @if (count($directorio)!=0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <p>Nombre</p>
                                    </th>
                                    <th class="text-lefth">
                                        <p>Contacto</p>
                                    </th>   
                                    @auth
                                    <th>
                                        <p>Acciones</p>
                                    </th> 
                                    @endauth                           
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($directorio as $item)
                                <tr>
<<<<<<< HEAD
                                    <th class="text-nowrap" scope="row">Administración Académica</th>
                                    <td>Tel. 2393-1993 <br>Correo: academica.paracentral@ues.edu.sv</td>
=======
                                    <th class="text-nowrap" scope="row">{!!$item->nombre!!}</th>
                                    <td>{!!$item->contacto!!}</td>
>>>>>>> 6c4f23b9003421029db58138d4fffd05149db3aa
                                    @auth                                   
                                    <th class="align-middle ">
                                        <div class="row">
                                            <div class="col-xl-12"> 
                                                <form id="{!! base64_encode($item->id) !!}" action="{{ asset('/Directorio/borrar') }}/{!! base64_encode($item->id) !!}" 
                                                    method="POST">     
                                                    @csrf                                              
                                                    <a type="buttom"  class="btn btn-danger text-white btn-block" onclick="eliminar({!! base64_encode($item->id) !!});"><i class="dripicons-trash"></i>  Eliminar</a>   
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
                             
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->       
        
    </div> <!-- end container -->
    
</div> 
@endsection
@section('nuevotoast')
<script type="text/javascript">

    function eliminar(formulario){
      /*  $.toast({ 
            heading: "¡¡ Aviso !!",
            text: "<p class='my-1'>Se eliminara el registro de la base de datos de forma permanente.</p>¿Desea continuar con esta acción?<a type='buttom' class='btn btn-outline-light waves-effect btn-block my-1' onclick='si("+formulario+");'>Si, eliminar</a>",
            icon: "warning",
            position: "top-right",
            showHideTransition : 'slide',
            bgColor : '#FBCC5C',   
            hideAfter : false
        });*/
    }
    
    function si(formulario){
        $form = "#"+formulario;
        alert($form);
        //$("#editarForm").submit();
    }
</script>  
@endsection
