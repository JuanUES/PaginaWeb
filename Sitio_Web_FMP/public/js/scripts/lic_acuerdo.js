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
   //if($('#tipo_permiso').val()==='LC/GS' && $('#fecha_de_uso').val().trim() != ""){
       
              //alert($('#empleado').val());
            $.ajax({
                type: "GET",
                url: '/admin/LicenciasAcuerdo/horas/'+$('#fecha_de_inicio').val()+'/'+$('#fecha_final').val()+'/'+$('#empleado').val(),
                beforeSend: function() {
                   
                    $('#hora_utilizar').val('Cargando...');
                },
                success: function(json) {
                   /* var json = JSON.parse(json);
                    hrs_usados = json.horas_acumuladas;
                    min_usados = (json.minutos_acumulados < 10 ? '0' : '')+json.minutos_acumulados;
                    hrs_disponible = (json.minutos_acumulados > 0 ? parseInt(json.mensuales)-1:json.mensuales);*/
                },
                complete: function(json) {
                    //document.getElementById('hora_utilizar').disabled=true;
                    $('#hora_disponible').val(hrs_disponible+' hrs, '
                        +(min_usados > 0 ? (60 - parseInt(min_usados)):0)+' min');         

                    /*if($('#hora_inicio').val().trim() != "" && $('#hora_final').val().trim() != ""){
                        $('#hora_inicio').click();
                        $('#hora_final').click();
                    }*/
                }
            });
        
   /* }else{
        $('#hora_anual').val('Ilimitado');
        $('#hora_actuales').val('Anual');
        $('#hora_disponible').val('Ilimitado');
    }*/
}


    $('#hora_utilizar').change(obtenerHora).click(obtenerHora);

//

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


$('.modal').on('hidden.bs.modal',function(){
    $(".alert").hide();
    $("form").trigger("reset");
    $(".select2").val(null).trigger("change");
    $(".select2").select2();
});