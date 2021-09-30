const ancho = 370;
const alto = 285;
// Obtener referencia al input y a la imagen
const $fileE = document.querySelector("#fileE"),
$fotoE = document.querySelector("#fotoE");

$('#fotoE').width(ancho); 
$('#fotoE').height(alto);
// Escuchar cuando cambie
$fileE.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $fileE.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $fotoE.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $('#fotoE').width(ancho); // Unidades que se asumen en pixeles
    $('#fotoE').height(alto);
    $fotoE.src = objectURL;
});

$('#modalRegistro').on('hidden.bs.modal',function(){
    $(".alert").hide();
    $fotoE.src = "";
    $("form").trigger("reset");
    $(".selectpicker").val(null).trigger("change");
});

function editarCat(id){
    $.get('Empleado/categoriaGetObjeto/'+id,function(json){
        json=JSON.parse(json);
        $('#_idCat').val(json.id);
        $('#categoria').val(json.categoria);
    });
}
function eliminarCat(id){
    $('#idCat').val(id);
    $('#notificacionEliminar').show();
}
function AltaBaja(id){
    $("#activarId").val(id);
    $("#modalAlta").modal();
}
function cargarCategoria(){
    $.get('Empleado/Categoria',function(json){
        json=JSON.parse(json);
        var categoria = $('#categoriaTb').DataTable();
        categoria.clear();
        var id=1;
        for (var i in json) {
            var html = '';
            html += '<div class="btn-group text-center" role="group">';
            html += '<button onclick="editarCat('+json[i].id+');"';
            html += '    title="Editar" class="btn btn-outline-primary mr-1 btn-sm rounded">';
            html += '   <i class="fa fa-edit font-15" aria-hidden="true"></i>';
            html += '</button>';
            html += '<button title="Eliminar" class="btn btn-outline-danger btn-sm rounded" ';
            html += '    onclick="eliminarCat('+json[i].id+');">';
            html += '    <i class=" mdi mdi-trash-can-outline font-18" aria-hidden="true"></i>';
            html += '</button>';
            html += '</div>';
            categoria.row.add([id,json[i].categoria,html]).draw(false);
            id++;
        }
    });
}
function httpCategoria(formulario,notificacion){
    $.ajax({
        type: $(formulario).attr('method'),
        url: $(formulario).attr('action'),
        dataType: "html",
        data: new FormData(document.getElementById(formulario.replace('#',''))),
        processData: false,
        contentType: false,
        error : function(jqXHR, textStatus){
            if (jqXHR.status === 0) {

                errorServer(notificacion,'No conectar: ​​Verifique la red.');

            } else if (jqXHR.status == 404) {

                errorServer(notificacion,'No se encontró la página solicitada [404]');

            } else if (jqXHR.status == 500) {

                errorServer(notificacion,'Error interno del servidor [500].');

            } else if (textStatus === 'parsererror') {

                errorServer(notificacion,'Error al analizar JSON solicitado.');

            } else if (textStatus === 'timeout') {

                errorServer(notificacion,'Error de tiempo de espera.');

            } else if (textStatus === 'abort') {

                errorServer(notificacion,'Solicitud de Ajax cancelada.');

            } else {

                errorServer(notificacion,'Error no detectado: ' + jqXHR.responseText);
            }
            $('.modal').scrollTop($('.modal').height());
        },beforeSend:function(jqXHR, textStatus){
            $(notificacion).removeClass().addClass('alert alert-info bg-info text-white border-0').html(''
                    +'<div class="row">'
                    +'    <div class="col-lg-1 px-2">'
                    +'        <div class="spinner-border text-white m-2" role="status"></div>'
                    +'    </div>'
                    +'    <div class="col-lg-11 align-self-center" >'
                    +'      <h3 class="col-xl text-white">Cargando...</h3>'
                    +'    </div>'
                    +'</div>'
                ).show();
                $('.modal').scrollTop(0);
                disableform(formulario);
        },
    }).then(function(data) {

        data = JSON.parse(data);
        if(data.error!=null){

            $(notificacion).removeClass().addClass('alert alert-danger bg-danger text-white border-0');
            $errores = '';
            for (let index = 0; index < data.error.length; index++) {
                $error = '<li>'+data.error[index]+'</li>';
                $errores +=$error;
            }

            $(notificacion).html('<h4 Class = "text-white">Completar Campos:</h4>'
                +'<div class="row">'
                +'<div class="col-lg-9 order-firts">'
                +'<ul>'+$errores+'</ul>'
                +'</div>'
                +'<div class="col-lg-3 order-last text-center">'
                +'<li class="fa fa-exclamation-triangle fa-5x"></li>'
                +'</div>'
                +'</div>'
            ).show();
            enableform(formulario);

        }else{
            if(data.mensaje!=null && data.error==null){
                $(notificacion).removeClass().addClass('alert alert-success bg-success text-white ').html(''
                    +'<div class="row">'
                        +'<div class="col-xl-11 order-last">'
                            +' <h3 class="col-xl text-white">'+data.mensaje+'</h3>'
                        +'</div>'
                        +'<div class="col-xl-1 order-firts">'
                            +'<i class="fa fa-check  fa-3x"></i>'
                        +'</div>'
                    +'</div>'
                ).show();
                $(formulario)[0].reset();
                enableform(formulario);
                cargarCategoria();
            }
        }
        $('.modal').scrollTop(0);
    });
}
function editar(id,boton){
    $.ajax({
        type: "GET",
        url: 'Empleado/'+id,
        beforeSend: function() {
            $(boton).prop('disabled', true).html(''
                +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
            );
        },
        success: function(json) {
            json=JSON.parse(json);
                $("#idE").val(id);
                $('#nombreE').val(json.nombre);
                $('#apellidoE').val(json.apellido);
                $('#duiE').val(json.dui);
                $('#nitE').val(json.nit);
                $('#telE').val(json.tel);
                $('#categoriaE').val(json.categoria).trigger("change");
                $('#tipo_contratoE').val(json.contrato).trigger("change");
                $('#tipo_jornadaE').val(json.jornada).trigger("change");
                $('#deptoE').val(json.depto).trigger("change");
                $('#tipo_empleadoE').val(json.tipo).trigger("change");
                $('#jefe_empleadoE').val(json.jefe).trigger("change");

                $('#fotoE').width(ancho); 
                $('#fotoE').height(alto);
                $fotoE.src = json.urlfoto===null?'':json.urlfoto;

                $("#modalRegistro").modal();
        },
        complete: function() {
            $(boton).prop('disabled', false).html(''
                +'<i class="fa fa-edit font-16" aria-hidden="true"></i>'
            );
        }
    });
}    



$('.select2').select2({
    width: "100%",
    allowHtml: true,
    dropdownParent: $('#modalRegistro')
}).select2();
