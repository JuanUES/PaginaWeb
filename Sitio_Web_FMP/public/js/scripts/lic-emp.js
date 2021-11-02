$(
    function () {
        $('.select2').select2();            

        $(".summernote-config").summernote({
            lang: 'es-ES',
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['view', ['fullscreen']],           
            ]
        });
    }

);

var hrs_usados=0;
var min_usados=0;
var hrs_disponible=0;
var hrs_anual_a = 0;
var hrs_usados_a = 0;
var min_usados_a= 0;
var hrs_disponible_a = 0;


function obtenerHora() {
    if($('#tipo_permiso').val() ==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
            $.ajax({
                type: "GET",
                url: 'mislicencias/horas/'+$('#fecha_de_uso').val(),
                beforeSend: function() {
                    $('#hora_disponible').val('Cargando...');
                    $('#hora_actuales').val('Cargando...');
                },
                success: function(json) {
                    var json = JSON.parse(json);
                    hrs_usados = json.horas_acumuladas;
                    min_usados = (json.minutos_acumulados < 10 ? '0' : '')+json.minutos_acumulados;
                    hrs_disponible = (json.minutos_acumulados > 0 ? parseInt(json.mensuales)-1:json.mensuales);
                },
                complete: function(json) {
                    $('#hora_actuales').val(0+' hrs, '+0+' min');
                    
                    $('#hora_disponible').val(hrs_disponible+' hrs, '
                        +(min_usados > 0 ? (60 - parseInt(min_usados)):0)+' min');         

                    if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                        $('#hora_inicio').click();
                        $('#hora_final').click();
                    }
                }
            });
            
            $.ajax({
                type: "GET",
                url: 'mislicencias/horas-anuales/'+$('#fecha_de_uso').val(),
                beforeSend: function() {
                    $('#hora_anual').val('Cargando...');
                },
                success: function(json) {
                    var json = JSON.parse(json);
                    hrs_anual_a = (json.minutos_acumulados_a > 0 ? parseInt(json.anuales)-1:json.anuales);
                    hrs_usados_a = json.horas_acumuladas_a;
                    min_usados_a = (json.minutos_acumulados_a < 10 ? '0' : '')+json.minutos_acumulados_a;
                    hrs_disponible_a = (json.minutos_acumulados_a > 0 ? parseInt(json.anuales)-1:json.anuales);
                },
                complete: function(json) {

                    $('#hora_anual').val(hrs_anual_a+' hrs, '
                    +(min_usados_a > 0 ? (60 - parseInt(min_usados_a)):0)+' min');                    

                    if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                        $('#hora_inicio').click();
                        $('#hora_final').click();
                    }
                }
            });
    }else{
        $('#hora_anual').val('Ilimitado');
        $('#hora_actuales').val('Ilimitado');
        $('#hora_disponible').val('Ilimitado');
    }
}

function calcularHora() {
    
    var hora_inicio = $('#hora_inicio').val();
    var hora_final = $('#hora_final').val();
    
    // Expresión regular para comprobar formato
    var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
    
    // Si algún valor no tiene formato correcto sale
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

    // Cálculo de horas y minutos de la diferencia
    var horas = parseInt(Math.trunc(diferencia / 60));
    var minutos = parseInt((diferencia % 60));
    console.log( horas+' '+minutos);
    //Horas disponibles en minutos
    //var minutos_disp = (parseInt(hrs_disponible) * 60) + (min_usados > 0 ? (60 - parseInt(min_usados)):0);
    //var minutos_disp_anual = (parseInt(hrs_anual) * 60) + (min_usados > 0 ? (60 - parseInt(min_usados)):0);
    //var minutos_disp_dife = minutos_disp - (minutos_final - minutos_inicio);
    //var minutos_disp_dife_anual = minutos_disp_anual - (minutos_final - minutos_inicio);

    $('#hora_actuales').val(horas+' hrs, '+minutos+' min');
    //$('#hora_disponible').val((Math.trunc(parseInt(minutos_disp_dife)/ 60))+' hrs, '+parseInt((minutos_disp_dife % 60)) +' min'); 
   // $('#hora_anual').val((Math.trunc(parseInt(minutos_disp_dife_anual)/ 60))+' hrs, '+parseInt((minutos_disp_dife_anual % 60)) +' min');     
}

    $('#tipo_permiso').on('select2:select',obtenerHora);
    $('#fecha_de_uso').change(obtenerHora).click(obtenerHora);
    $('#hora_inicio').change(calcularHora).click(calcularHora);
    $('#hora_final').change(calcularHora).click(calcularHora);

//
// observaciones,editar,enviar,cancelar enviar_id enviar_permiso
function cancelar(btn) {
    $('#cancelar_id').val($(btn).val());
    $('#modalCancelar').modal();
}
function enviar(boton){
    $('#enviar_id').val($(boton).val());
    $('#modalEnviar').modal();
}
function editar(boton) {
   if($(boton).val()!=null){
        $.ajax({
            type: "GET",
            url: 'mislicencias/permiso/'+$(boton).val(),
            beforeSend: function() {
                $(boton).prop('disabled', true).html(''
                    +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                );
            },
            success: function(json) {   
                var json = JSON.parse(json);  
                console.log(json);
                $('#idPermiso').val(json.permiso);                   
                $('#justificacion').summernote("code",json.justificacion);
                $('#observaciones').summernote("code",json.observaciones);
                $('#tipo_representante').val(json.tipo_representante).trigger("change");
                $('#tipo_permiso').val(json.tipo_permiso).trigger("change");
                $('#fecha_de_presentacion').val(json.fecha_presentacion);
                $('#fecha_de_uso').val(json.fecha_uso).change();                                   
                $('#hora_inicio').val(json.hora_inicio).change();
                $('#hora_final').val(json.hora_final).change();
                $("#modalRegistro").modal();
            },
            complete: function(json) {
                $(boton).prop('disabled', false).html(''
                    +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                );
            }
        });                
   }
}

function observaciones(boton){
if($(boton).val()!=null){
        $.ajax({
            type: "GET",
            url: 'mislicencias/procesos/'+$(boton).val(),
            beforeSend: function() {
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
                    +'<td class="col-xs-2">'+json[i].fecha+'</td>'
                    +'<td class="col-xs-6"><span class="badge badge-primary">'+json[i].proceso+'</span></td>'
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
    $(".alert").hide();
    $("form").trigger("reset");
    $(".select2").val(null).trigger("change");
    $(".select2").select2();
});