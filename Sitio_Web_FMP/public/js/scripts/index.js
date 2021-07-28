function editarNL(json){
    $('#titulo').val(json.titulo);$('#subtitulo').val(json.subtitulo);$('#contenido').summernote("code", json.contenido);$('#_id_local').val(json.id);
}