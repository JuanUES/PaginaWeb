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
    <script>

    </script>
    <script>
    

            $('#calendar')
                .fullCalendar({lang: 'es'})
                .fullCalendar('option', 'height', 450)
                .fullCalendar({
                    events: [
                        {
                        title: 'Event1',
                        start: '2021-08-04'
                        },
                        {
                        title: 'Event2',
                        start: '2021-08-05'
                        }
                        // etc...
                    ],
                    color: 'yellow',   // an option!
                    textColor: 'black' // an option!
                } 
            );
    </script>

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
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> 
@endsection