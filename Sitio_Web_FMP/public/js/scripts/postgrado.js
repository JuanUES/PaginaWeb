function editarMaestria(id,nombre,titulo,modalidad,duracion,numero_asignatura,unidades_valorativas,precio,contenido){
    $("#id").val(id);$("#nombre").val(nombre);$("#titulo").val(titulo);$("#modalidad").val(modalidad);$("#duracion").val(duracion);$("#asignaturas").val(numero_asignatura);$("#unidades").val(unidades_valorativas);$("#precio").val(precio);$("#contenido").summernote("code", contenido);
};