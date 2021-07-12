<div class="text-center">
    <button type="button" data-key="{{ ($id) }}" data-toggle="modal" data-target="#modalView" class="btn btn-info btn-sm openModal" title="Visualizar PDF"><i class="fa fa-file-pdf fa-fw" aria-hidden="true"></i></button>
    <a href="{{ url('/admin/transparencia/edit/' . $id) }}" title="Modificar contenido"><button class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i></button></a>
    {{-- <form method="POST" action="{{ url('/employees' . '/' . $id) }}" accept-charset="UTF-8" style="display:inline">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>
    </form> --}}
</div>
