     
$( function () {
        $('.select2').select2();            

        $(".summernote-config").summernote({
            lang: 'es-ES',
            height: 100,
            toolbar: [
                ['view', ['fullscreen']],           
            ]
        });
        $('#justificacion').summernote('disable');
        $('#observaciones').summernote('disable');
        $("#tipo_representante").prop("disabled", true);
        $("#tipo_permiso").prop("disabled", true);
         //para la constancia de olvido de marcaje
         $('#justificacionConst').summernote('disable');
        $("#marcaje").prop("disabled", true);
    }

);

let mensuales, anuales, hrs_m, hrs_a, min_m, min_a, min_t_a, min_t_m;
mensuales = anuales = hrs_m = hrs_a = min_m = min_a = min_t_a = min_t_m = 0;


function obtenerHora() {
    if($('#tipo_permiso').val() ==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
            var permiso = $('#idPermiso').val().trim()==''?'nuevo':$('#idPermiso').val();
            $.ajax({
                type: "GET",
                url: '/admin/mislicencias/horas-mensual/'+$('#fecha_de_uso').val()+'/'+permiso,
                beforeSend: function() {
                    $('#hora_mensual').val('Cargando...');
                    $('#hora_anual').val('Cargando...');
                },
                success: function(json) {
                    var json = JSON.parse(json);
                    mensuales = json.mensuales;
                    hrs_m = json.horas_acumuladas;
                    min_m = json.minutos_acumulados;
                },
            });
            
            $.ajax({
                type: "GET",
                url: '/admin/mislicencias/horas-anual/'+$('#fecha_de_uso').val()+'/'+permiso,
                success: function(json) {
                    var json  =  JSON.parse(json);
                    anuales = json.anuales;
                    hrs_a = json.horas_acumuladas;
                    min_a = json.minutos_acumulados;
                },
                complete: function(json) {  
                    min_t_m = (parseInt(mensuales)*60)-(parseInt(min_m) + parseInt(hrs_m)*60);
                    min_t_a = (parseInt(anuales)*60)-(parseInt(min_a) + parseInt(hrs_a)*60);

                    var horas = parseInt(Math.trunc(min_t_a/ 60));
                    var minutos = parseInt((min_t_a % 60));
                    
                    $('#hora_anual').val(horas+' hrs, '+minutos+' min');

                    var horas = parseInt(Math.trunc(min_t_m/ 60));
                    var minutos = parseInt((min_t_m % 60));

                    $('#hora_mensual').val(horas+' hrs, '+minutos+' min');               

                    if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                        $('#hora_inicio').click();
                        $('#hora_final').click();
                    }
                }
            });
    }else{
        $('#hora_anual').val('Ilimitado');
        $('#hora_mensual').val('Ilimitado');
    }
}

function calcularHora() {
    var hora_inicio = $('#hora_inicio').val();
    var hora_final = $('#hora_final').val();
    
    // ExpresiÃ³n regular para comprobar formato
    var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
    
    // Si algÃºn valor no tiene formato correcto sale
    if (!(hora_inicio.match(formatohora)
            && hora_final.match(formatohora))){
        return;
    }
    // Calcula los minutos de cada hora
    var minutos_inicio = hora_inicio.split(':')
        .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
    var minutos_final = hora_final.split(':')
        .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
    // Si la hora final es anterior a la hora inicial sale
    if (minutos_final < minutos_inicio) return;
    
    // Diferencia de minutos
    var diferencia = minutos_final - minutos_inicio;

    // CÃ¡lculo de horas y minutos de la diferencia
    var horas = parseInt(Math.trunc(diferencia / 60));
    var minutos = parseInt((diferencia % 60));        

    $('#hora_actuales').val(horas+' hrs, '+minutos+' min');

    var horas = parseInt(Math.trunc((min_t_a-diferencia)/ 60));
    var minutos = parseInt(((min_t_a-diferencia) % 60));
    
    $('#hora_anual').val(horas+' hrs, '+minutos+' min');

    var horas = parseInt(Math.trunc((min_t_m-diferencia)/ 60));
    var minutos = parseInt(((min_t_m-diferencia) % 60));

    $('#hora_mensual').val(horas+' hrs, '+minutos+' min');
}

$('#tipo_permiso').on('select2:select',obtenerHora);
$('#fecha_de_uso').change(obtenerHora).click(obtenerHora);
$('#hora_inicio').change(calcularHora).click(calcularHora);
$('#hora_final').change(calcularHora).click(calcularHora);

 //FUNCION PARA ACEPTAR CONSTANCIA
 function aceptarConst(boton){
    $('#aceptarr_id').val($(boton).val());
    $('#modalAceptarConst').modal();
}
//FIN DE FUNCION PARA ACEPTAR CONSTANCIA
    
function aceptar(boton){
    $('#aceptar_id').val($(boton).val());
    $('#modalAceptar').modal();
}
function observaciones(boton){
    if($(boton).val()!=null){
            $.ajax({
                type: "GET",
                url: '/admin/mislicencias/procesos/'+$(boton).val(),
                beforeSend: function() {
                    $(boton).prop('disabled', true).html(''
                        +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                    );
                    $(boton).prop('disabled', true).html(''
                        +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                    );
                },
                success: function(json) {   
                    var json = JSON.parse(json);   
                    var tabla = $('#obs-table').DataTable();
                    tabla.clear().draw(false);
                    for (var i in json) {     
                        var html= '<tr>'
                        +'<td class="col-sm-3">'+json[i].fecha+'</td>'
                        +'<td class="col-sm-3"><span class="badge badge-primary font-13">'+json[i].proceso+'</span></td>'
                        +'<td class="col-xs-6">'+(json[i].observaciones==null?'Ninguna':json[i].observaciones)+'</td>'
                        +'</tr>';    
                        tabla.row.add($.parseHTML(html)[0]).draw(false);
                    }   
                    $("#modalObservaciones").modal();
                },
                complete: function(json) {
                    $(boton).prop('disabled', false).html(''
                        +'<i class="fa fa-eye font-16 py-1" aria-hidden="true"></i>'
                    );
                }
            });                
    }
};

$('.modal').on('hidden.bs.modal',function(){
    $("form").trigger("reset");
});

//FUNCION PARA VER LOS DATOS DE CONSTANCIA DE OLVIDO
function verDatosConst(boton) {
    if ($(boton).val() != null) {
        $.ajax({
            type: "GET",
            url: '/admin/licencias/jefaturaRRHH/' + $(boton).val(),
            beforeSend: function() {
                $(boton).prop('disabled', true).html('' +
                    '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                );
            },
            success: function(json) {

                var json = JSON.parse(json);
                console.log(json);
                $('#idPermisoC').val(json.permiso);
                $('#nombreC').val(json.nombre);
                $('#apellidoC').val(json.apellido);
                $('#justificacionConst').summernote("code", json.justificacion);
             
                $('#marcaje').val(json.olvido).trigger("change");
                $('#fecha').val(json.fecha_uso).change();
                $('#hora').val(json.hora_inicio);
                $('#observacionesConst').summernote("code", json.observaciones);
                
                $('#modalConstancia').modal();
            },
            complete: function(json) {
                $(boton).prop('disabled', false).html('' +
                    '<i class="fa fa-file-alt font-16 py-1" aria-hidden="true"></i>'
                );
            }
        });
    }
}
//FIN DE VER DATOS DE CONSTANCIA DE OLVIDO

function verDatos(boton) {
    if($(boton).val()!=null){
        $.ajax({
            type: "GET",
            url: '/admin/licencias/jefaturaRRHH/'+$(boton).val(),
            beforeSend: function() {
                $(boton).prop('disabled', true).html(''
                    +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                );
            },
            success: function(json) {  
              //  alert($(boton).val());

                var json = JSON.parse(json);  

                $('#idPermiso').val(json.permiso);  
                $('#nombre').val(json.nombre);                 
                $('#apellido').val(json.apellido);                 
                $('#justificacion').summernote("code",json.justificacion);
                $('#observaciones').summernote("code",json.observaciones);
                $('#tipo_representante').val(json.tipo_representante).trigger("change");
                $('#tipo_permiso').val(json.tipo_permiso).trigger("change");
                $('#fecha_de_presentacion').val(json.fecha_presentacion);
                $('#fecha_de_uso').val(json.fecha_uso).change();                                   
                $('#hora_inicio').val(json.hora_inicio);
                $('#hora_final').val(json.hora_final);
                $('#modalRegistro').modal();
            },
            complete: function(json) {
                $(boton).prop('disabled', false).html(''
                    +'<i class="fa fa-file-alt font-16 py-1" aria-hidden="true"></i>'
                );
            }
        });                
    }
}