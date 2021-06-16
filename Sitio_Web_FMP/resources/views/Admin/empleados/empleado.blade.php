@extends('layouts.admin')

@section('content')

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
                    <button class="btn btn-primary" style="float: right">Agregar</button>
                </div>
            </div>

 
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
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
