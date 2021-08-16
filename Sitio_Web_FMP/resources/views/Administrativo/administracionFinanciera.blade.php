@extends('Pagina/baseOnlyHtml')

@section('header')

    <!-- Plugin css -->
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('footer')

    <!-- Calendar init -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>  
    <script src="{{ asset('js/locale/es.js') }}"></script>  
    @auth      
    <script src="{{ asset('js/scripts/admonFinanciero.js') }}"></script>
    <script>
        calendarConfig('{{route('HorarioCole')}}');         
    </script>
    @endauth
    @guest
    <script>$('#calendar').fullCalendar({events:'{{route('HorarioCole')}}',height: 600,timeFormat: 'hh:mm t',});</script>        
    @endguest
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
                    <h3 class="text-center">Administración Financiera</h3>
                    <div class="row">
                        <div class="col-xl-12"> 

                            <h4 class="text-center">Personal</h4>

                            <p class="mb-1 font-weight-bold font-15 text-center">Administradora Financiera</p>
                            <p class="text-muted font-10 text-justify text-center ">
                                Licda. María Isaura Esperanza Guardado
                            </p>  
                            
                            <p class="mb-1 font-weight-bold font-15 text-center">Gestor de Compra</p>
                            <p class="text-muted font-10 text-justify text-center">
                                Msc. Delmy Elizabeth Jovel de Jovel
                            </p>  

                            <p class="mb-1 font-weight-bold font-15 text-center">Colectora</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Licda. Ingrid Yamileth Cañas
                            </p>  

                            <p class="mb-1 font-weight-bold font-15 text-center">Colaboradora</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Licda. Evelyn Noemi Abarca Sandoval
                            </p>

                            <p class="mb-1 font-weight-bold font-15 text-center">Horario de Atención</p>
                            <p class="text-muted font-10  text-justify text-center">
                                Lunes a viernes de 8:00 a.m. A 12:00 p.m. y 1:00 p.m. a 4:00 p.m.
                            </p>   

                            <p class="mb-1 font-weight-bold font-15 text-center">Teléfono</p>
                            <p class="text-muted font-10  text-justify text-center">
                                2393-4752
                            </p>                                
                            
                            
                        </div><!-- end col -->      
                        <!--<div class="col-xl-12 border-top my-2" >
                            <h4 class="text-center">Horarios de colecturia</h4>
                            <p>Fecha: 07/06/2021 - 11/06/2021</p>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th>Lunes</th>
                                        <th>Martes</th>
                                        <th>Miercoles</th>
                                        <th>Jueves</th>
                                        <th>Viernes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>8:00 am<br> 4:00 pm</td>
                                        <td>8:00 am<br> 4:00 pm</td>
                                        <td>8:00 am<br> 4:00 pm</td>
                                        <td>8:00 am<br> 4:00 pm</td>
                                        <td>Cerrado</td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </div>
                                
                        </div><!-- end col -->  
                    </div> 
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h3>Horarios de Colecturia</h3>
                    <div id="calendar" ></div>
                </div>
            </div>'
            @auth               
            <div id="myModalRegistro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myCenterModalLabel">
                                <i class="mdi mdi-calendar-multiselect mdi-24px"></i> Horario Colecturia</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">        
                            <div class="row">
                                <div class="col-xl-12">
                                <label>Nota: <code>* Campos Obligatorio</code></label>
                                </div>
                            </div>                                
                            <div class="tab-content">
                            <div class="alert alert-primary text-white" role="alert" style="display:none" id="notificacion"></div>                                        
                            <form method="POST" 
                            action="{{ route('HorarioColeR') }}" 
                            class="parsley-examples"
                            enctype="multipart/form-data" id="registro">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="_id" name="_id">                                    
                                </div>      
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label>Titulo <code>*</code></label>
                                            <div>
                                                <select class="form-control" id="titulo" name="titulo">
                                                    <option value="Abierto">Abierto</option>
                                                    <option value="Cerrado">Cerrado</option>
                                                </select>                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <div>
                                                <input type="date" class="form-control" id="fecha1" placeholder="" disabled>   
                                                <input type="hidden"  id="fecha" name="fecha">                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>Hora <code>*</code></label>
                                            <div>
                                                <input type="time" class="form-control" id="hora" name="hora" placeholder="">                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="form-group mb-0 row">
                                    <div class="col order-first">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mr-1" 
                                            id="guardar"><i class="fa fa-save font-14"></i> Guardar
                                        </button>
                                        <button type="reset" class="btn btn-light waves-effect waves-light" data-dismiss="modal">
                                            <i class="fa fa-ban font-14" aria-hidden="true"></i> Cancelar
                                        </button>
                                    </div>
                                    <div class="col order-last d-flex justify-content-end">
                                        <button type="button" class="btn btn-light waves-effect waves-light mr-1"
                                            id="eliminar">
                                            <i class="mdi mdi-delete font-14"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </form>       
                            </div>
                        </div>                                    
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="modalInfo" class="modal fade bs-example-modal-center" tabindex="-1" 
                role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myCenterModalLabel">Información</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-lg-2 dripicons-information text-info fa-5x"></div>
                                <div class="col-lg-10 text-black d-flex align-items-center">
                                    <h4 class="font-17 text-justify font-weight-bold align-center" id="informacion">
                                        Informacion: 
                                    </h4>
                                </div>
                                <input type="hidden" name="_id" id="_idEliminar">
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                   
                                </div>
                                <div class="col-xl-6">
                                    <button type="reset" class="btn btn-light p-1 waves-light waves-effect btn-block font-24" data-dismiss="modal" >
                                        <i class="mdi mdi-door mdi-16px" aria-hidden="true"></i>
                                        Salir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal --> 
            @endauth
        </div>
    </div> <!-- end container -->
</div> 
@endsection