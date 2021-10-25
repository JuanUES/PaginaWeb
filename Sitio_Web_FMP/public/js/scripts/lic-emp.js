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


function obtenerHora() {
    if($('#tipo_permiso').val()==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
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
                    $('#hora_actuales').val(hrs_usados+' hrs, '+min_usados+' min');
                    $('#hora_disponible').val(hrs_disponible+' hrs, '+(min_usados > 0 ? (60 - parseInt(min_usados)):0)+' min');
                    
                    if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                        $('#hora_inicio').click();
                        $('#hora_final').click();
                    }
                }
            });
        
    }else{
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
    diferencia = parseInt(diferencia)+parseInt(min_usados);

    // Cálculo de horas y minutos de la diferencia
    var horas = parseInt(Math.trunc(diferencia / 60))+parseInt(hrs_usados);
    var minutos = parseInt((diferencia % 60));

    //Horas disponibles en minutos
    var minutos_disp = (parseInt(hrs_disponible) * 60) + (min_usados > 0 ? (60 - parseInt(min_usados)):0);
    var minutos_disp_dife = minutos_disp - (minutos_final - minutos_inicio);

    $('#hora_actuales').val(horas+' hrs, '+minutos+' min');
    $('#hora_disponible').val((Math.trunc(parseInt(minutos_disp_dife)/ 60))+' hrs, '+parseInt((minutos_disp_dife % 60)) +' min');      
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
                    +'<td class="col-sm-2">'+json[i].fecha+'</td>'
                    +'<td class="col-xs-6"><span class="badge badge-primary">'+json[i].proceso+'</span></td>'
                    +'<td class="col-xs-6">'+(json[i].observaciones==null?'Ninguna':json[i].observaciones)+'</td>'
                    +'</tr>';    
                    console.log($.parseHTML(html));
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