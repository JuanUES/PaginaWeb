@extends('layouts.admin')

@section('plugins')
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />    
@endsection
@section('plugins-js')
   <!--Librerias js para datatable
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/index/index.datatable.js') }}"></script>-->

    <script>
        $(document).ready(function(){
            $("#btnAgregarEmp").on('click',function(){
                let _url = `{{ route('Empleado.empleado') }}`;
                
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                    _token: "{{csrf_token()}}",
                    apellido: $('#apellido').val(),
                    nombre: $('#nombre').val(),
                    dui: $('#dui').val(),
                    nit: $('#nit').val(),
                    telefono: $('#telefono').val(),
                    tipo_jefe: $('#tipo_empleado').val(),
                    jefe:$('#jefe').val()
                    },
                    success: function(response) {
                        $("#row_"+id).remove();
                    }
                });// fin ajax
            });
        });
    </script> 
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=" exampleModalLongTitle">Agregar empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="empleadoForm" action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Digite el nombre">
                          </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellido</label>
                            <input type="text" class="form-control" id="apellido"  placeholder="Digite el apellido">
                           
                          </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">D.U.I.</label>
                            <input type="text" class="form-control" id="dui" placeholder="Digite el número de D.U.I.">
                          </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">N.I.T.</label>
                            <input type="text" class="form-control" id="nit" placeholder="Digite el número de N.I.T.">
                          </div>
                    </div>
                </div>
                

                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Teléfono</label>
                    <input type="tel" class="form-control" id="tel" placeholder="Digite el número de teléfono">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Tipo empleado</label>
                <select class="custom-select" name="emepleadosSelect" id="empleadosSelect">
                    <option value="1">Decano</option>
                    <option value="2">Vice-decano</option>
                    <option value="3">Administrativo</option>
                    <option value="4">Académico</option>
                </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Jefe</label>
                    @if (count($empleadoJefe))
                        <select class="custom-select" name="" id="">
                            @foreach ($empleadoJefe as $item)
                            <option value="{!!$item->id!!}">{!!$item->nombre.' '.$item->apellido!!}</option>
                            @endforeach
                        </select>
                    @else
                        <select class="custom-select" name="" disabled>
                            <option value="">Sin datos</option>
                        </select>
                    @endif                 
                  </div>
                
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnAgregarEmp">Guardar empleado</button>
        </div>
      </div>
    </div>
  </div>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>
            </div>
            <h4 class="page-title">Empleados</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Empleados
                    </h3>      
                </div>
                <div class="col-3">   
                    <button class="btn btn-info" style="float: right">Subir excel</button>  
                </div>
                <div class="col-3">
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Agregar empleado
  </button>
                </div>
            </div>

 
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table table-borderless  btn-table table-sm table-responsive-md" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Apellido</th>
                                <th data-priority="1">Nombre</th>
                                <th data-priority="3">D.U.I.</th>
                                <th data-priority="1">N.I.T.</th>
                                <th data-priority="3">Teléfono</th>
                                <th data-priority="3">Estado</th>
                                <th data-priority="6">Foto</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>GOOG <span class="co-name">Google Inc.</span></th>
                                <td>597.74</td>
                                <td>12:12PM</td>
                                <td>14.81 (2.54%)</td>
                                <td>582.93</td>
                                <td>597.95</td>
                                <td>597.73 x 100</td>
                           
                            </tr>
                            <tr>
                                <th>AAPL <span class="co-name">Apple Inc.</span></th>
                                <td>378.94</td>
                                <td>12:22PM</td>
                                <td>5.74 (1.54%)</td>
                                <td>373.20</td>
                                <td>381.02</td>
                                <td>378.92 x 300</td>
                             
                            </tr>
                            <tr>
                                <th>AMZN <span class="co-name">Amazon.com Inc.</span></th>
                                <td>191.55</td>
                                <td>12:23PM</td>
                                <td>3.16 (1.68%)</td>
                                <td>188.39</td>
                                <td>194.99</td>
                                <td>191.52 x 300</td>
                             
                            </tr>
                            <tr>
                                <th>ORCL <span class="co-name">Oracle Corporation</span></th>
                                <td>31.15</td>
                                <td>12:44PM</td>
                                <td>1.41 (4.72%)</td>
                                <td>29.74</td>
                                <td>30.67</td>
                                <td>31.14 x 6500</td>
                              
                            </tr>
                            <tr>
                                <th>MSFT <span class="co-name">Microsoft Corporation</span></th>
                                <td>25.50</td>
                                <td>12:27PM</td>
                                <td>0.66 (2.67%)</td>
                                <td>24.84</td>
                                <td>25.37</td>
                                <td>25.50 x 71100</td>
                              
                            </tr>
                            <tr>
                                <th>CSCO <span class="co-name">Cisco Systems, Inc.</span></th>
                                <td>18.65</td>
                                <td>12:45PM</td>
                                <td>0.97 (5.49%)</td>
                                <td>17.68</td>
                                <td>18.23</td>
                                <td>18.65 x 10300</td>
                             
                            </tr>
                            <tr>
                                <th>YHOO <span class="co-name">Yahoo! Inc.</span></th>
                                <td>15.81</td>
                                <td>12:25PM</td>
                                <td>0.11 (0.67%)</td>
                                <td>15.70</td>
                                <td>15.94</td>
                                <td>15.79 x 6100</td>
                             
                            </tr>
                            
                            
                            
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- table-rep-plugin-->
            </div>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->   
@endsection