<!-- Esto va en el header o css-->
@auth
<!-- Summernote css -->
<link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" />
@endauth
<!-- Esto va en el js-->

@auth
<script src="{{ asset('js/scripts/http.min.js') }}"></script>   
<!--Summernote js-->
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/summernote.config.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/lang/summernote-es-ES.js') }}"></script>
@endauth

<!-- Esto va en el content-->
<?php
    $variableNoTocar = 'localizacion';
    $localizacion ='';
    $contenido = App\Models\Pagina\ContenidoHtml::where($variableNoTocar,$localizacion)->first();

?>

@auth
    <div class="col-xl-12">
        <form action="{{ route('contenido', ['localizacion'=>$localizacion]) }}" method="POST"  
            class="parsley-examples"  id="contenido{{$localizacion}}">
            @csrf
            <div class="alert alert-primary text-white py-1" 
                    role="alert" style="display:none" id="notificacion{{$localizacion}}">                                               
            </div>
            <div class="row">
                <div class="col-xl-12">   
                    <div class="form-group">                       
                        <textarea value="" class="form-control summernote-config" name="contenido"  rows="10">
                            @if ($contenido!=null)
                                {{$contenido->contenido}}
                            @endif
                        </textarea>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-block" 
                            onclick="submitForm('#contenido{{$localizacion}}','#notificacion{{$localizacion}}')">
                            <i class="fa fa-save fa-5 ml-3"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
    
@endauth 

@guest  
<div class="col-xl-12 py-2">
@if ($contenido!=null)
    {!!$contenido->contenido!!}
@endif
</div>      
@endguest