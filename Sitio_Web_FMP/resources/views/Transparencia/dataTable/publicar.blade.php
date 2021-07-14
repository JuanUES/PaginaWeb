<form method="POST" action="{{ route('admin.transparencia.publicar', $id) }}" class="frmPublicar" accept-charset="UTF-8" >
    @csrf
    <div class="custom-control custom-checkbox" >
        @if(strcmp($publicar, 'publicado')==0)
            <div class="badge badge-primary">Publicado</div>
        @else
            <div class="badge badge-warning">Inhabilitado</div>
        @endif
        <input type="checkbox" class="custom-control-input" id="{{ $id }}" name="publicar" {{ (strcmp($publicar, 'publicado')==0) ? 'checked' : '' }} >
        <label class="custom-control-label" for="{{ $id }}">Publicar</label>
    </div>
</form>
