<form method="POST" action="{{ url('/employees' . '/' . $id) }}" accept-charset="UTF-8" style="display:inline">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}

    @if(strcmp($publicar, 'publicado')==0)
        <span class="badge badge-primary">Publicado</span>
    @else
        <span class="badge badge-warning">Inhabilitado</span>
    @endif

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="publicar" name="publicar">
        <label class="custom-control-label" for="publicar">Publicar</label>
    </div>
</form>
