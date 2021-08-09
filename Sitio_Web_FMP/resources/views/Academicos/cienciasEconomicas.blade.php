@extends('Pagina/baseOnlyHtml')
@section('header')
@auth    
    <!-- Este css se carga nada mas cuando esta logeado un usuario-->
    <link href="{{ asset('css/dropzone.min.css') }} " rel="stylesheet" type="text/css" />
@endauth    
@endsection

@section('footer')
    @auth
    <script src=" {{ asset('js/dropzone.min.js') }} "></script>   
    <script src=" {{ asset('js/scripts/dropzonePdf.js') }} "></script>
    <script src=" {{ asset('js/scripts/pdf.js') }} "></script>
    @endauth
@endsection
@section('container')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box color-boton py-2 rounded">
            <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
        </div>         
        <div class="my-3"></div>
        <!-- end page title -->
        
        <div class="card-box"> 
            <div class="row">
                <div class="col-xl-8 px-3">
                    <div class="tab-content pt-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-social2" role="tabpanel" aria-labelledby="v-pills-social-tab2">
                            <h2 class="header-title py-2">Licenciatura en Contaduría Pública</h2>                            
                            <p class="mb-1 font-weight-bold ">Código:</p>
                            <p class="text-muted font-15 text-justify">L70802</p>
                            <p class="mb-1 font-weight-bold">Descripción:</p>
                            <p class="text-muted font-15 text-justify">
                                Los estudios de Contaduría Pública persiguen formar profesionales con amplio dominio de la técnica, sistemas contables y conocimientos legales que se utilizan modernamente, para examinar y dictaminar sobre los resultados reales de las operaciones de las empresas, y además dotarlos de conocimientos suficientes, para analizar y presentar las bases que permitan orientar eficientemente las políticas financieras de la Empresa y así encaminar su ejercicio profesional al mejor desarrollo de nuestro pueblo, procurando tener un conocimiento científico y objetivo de la realidad.
                            </p>  
                            <p class="text-muted font-15 text-justify">PRE-ESPECIALIDADES: La Escuela de Contaduría no tiene especializaciones; pero en el campo profesional se puede especializar en las siguientes áreas:</p>
                            <ul>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                            Auditoría
                                    </p> 
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                            Costos
                                    </p> 
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                            Financiera
                                    </p> 
                                </li>
                                <li>
                                    <p class="text-muted font-15 text-justify">
                                            Legal
                                    </p> 
                                </li>
                            </ul>
                                             
    
                            <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                            <p class="text-muted font-15">
                                5 años.
                            </p>
    
                            <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                            <p class="text-muted font-15">
                                Licenciado(a) en Contaduría Pública.
                            </p>
                            <p class="mb-1 font-weight-bold">Pensum:</p>
                            <a href="{{$pdfs->where('file','licConta.pdf')->first()==null 
                                ? '#':asset('files/pdfs/'.$pdfs[0]->localizacion.'/licConta.pdf')}}"
                                 type="submit" class="btn btn-outline-danger" id="licConta" target="_blank">
                                 <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div>
                            </a>
                            @auth
                            <a href="#" class="btn  btn-outline-info my-2"
                            data-toggle="modal" data-target=".bs-example-modal-center" onclick="pdf('licConta')">
                                <i class="mdi mdi-cloud-upload mdi-24px ml-2 align-center"></i> Subir Archivo
                            </a>
                            @endauth 
    
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab2">
                            <h2 class="header-title py-2">Licenciatura en Administración de Empresas</h2>   
                            <p class="mb-0 font-weight-bold ">Código</p> 
                                    <p class="text-muted font-15 text-justify">
                                        L70803
                                    </p>                   
            
                                    <p class="mb-1 font-weight-bold py-2">Descripción:</p>
                                    <p class="text-muted font-15 text-justify">
                                        El estudio de la Administración se enmarca en el contexto de la economía globalizada y su misión es formar recurso humano capacitado en la teoría económica, la investigación científica y el manejo de la tecnología apropiada, necesaria para el desarrollo económico-social sustentable.
                                    </p> 
                                    
        
                                    <p class="mb-1 font-weight-bold">Tiempo de duración:</p>
                                    <p class="text-muted font-15">
                                        5 años.
                                    </p>
            
                                    <p class="mb-1 font-weight-bold">Grado y título que otorga:</p>
                                    <p class="text-muted font-15">
                                        Licenciado(a) en Administración de Empresas.
                                    </p>
                                    <p class="mb-1 font-weight-bold">Pensum:</p>
                                    <a href="{{$pdfs->where('file','licAdmon.pdf')->first()==null 
                                        ? '#':asset('files/pdfs/'.$pdfs[0]->localizacion.'/licAdmon.pdf')}}"
                                         type="submit" class="btn btn-outline-danger" id="licAdmon" target="_blank">
                                            <div class="mdi mdi-file-pdf mdi-24px align-top">Descargar</div>
                                    </a>
                                    @auth
                                    <a href="#" class="btn  btn-outline-info my-2" 
                                    data-toggle="modal" data-target=".bs-example-modal-center" onclick="pdf('licAdmon')">
                                        <i class="mdi mdi-cloud-upload mdi-24px ml-2 align-center"></i> Subir Archivo
                                    </a>
                                    @endauth 
                        </div>
                  
                    </div>
                   
                </div> <!-- end col -->
                <div class="col-xl-4">
                    <h4>Departamento de Ciencias Económicas</h4>
                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show mb-2 btn-outline-danger  border" id="v-pills-social-tab2" data-toggle="pill" href="#v-pills-social2" role="tab" aria-controls="v-pills-social2"
                            aria-selected="true">
                            Licenciatura en Contaduría pública</a>
                        <a class="nav-link mb-2 btn-outline-danger border" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2"
                            aria-selected="false">
                            Licenciatura en Administración de Empresas</a>
                        
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row--> 
        </div> <!-- end card-box -->
        @auth
        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;" id="dropZonePdf">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel">Zona para subir imágenes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ route('PDF', ['localizacion'=>'ccEco']) }}" method="post"
                            class="dropzone" id="my-awesome-dropzone">
                            @csrf                                 
                            <input type="hidden" name='pdf' id="pdf">
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
    </div> <!-- end container-->
</div>
<!-- end row -->
@endsection