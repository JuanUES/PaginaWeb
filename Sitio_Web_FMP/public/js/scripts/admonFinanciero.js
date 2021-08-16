function calendarConfig(urlJson){
    $('#calendar').fullCalendar({        
        events:urlJson,
        height: 600,
        timeFormat: 'hh:mm t',
        dayClick: function (date, allDay, jsEvent, view) {
            $('#eliminar').prop("disabled", true); 
            const fechaComoCadena = date.format('yyyy-MM-DD h:mm');
            const dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado',];
            const numeroDia = new Date(fechaComoCadena).getDay();
            const nombreDia = dias[numeroDia];
            var select = moment(date).format('yyyy-MM-DD');
            var hoy = moment(new Date()).format('yyyy-MM-DD');
            console.log(nombreDia);
            if (nombreDia == 'domingo' || nombreDia == 'sabado') {
                //si es sabado o domingo dia que no abre 
                $('#informacion').html('Información: Este dia esta cerrado.');
                $('#modalInfo').modal();
            } else {

                if (select >= hoy) {                            
                    $('#fecha').val(date.format("yyyy-MM-DD"));
                    $('#hora').val(new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: false }));
                    $('#myModalRegistro').modal();
                } else {
                    $('#informacion').html('Información: No se puede agendar un evento en el pasado.');
                    $('#modalInfo').modal();
                }
            }//fin else domingo
            // limpiar();
        }, 
        eventClick: function (calEvent, jsEvent, view) {
            $('#eliminar').prop("disabled", false); 
            let date = new Date(calEvent.start._i);
            let fecha = moment(date).format('yyyy-MM-DD');
            let hora = moment(date).format('HH:mm:ss'); 

            $('#_id').val(calEvent.id);
            $('#titulo').val(calEvent.title);
            $('#fecha').val(fecha);
            $('#hora').val(hora);
            $('#myModalRegistro').modal();
            //document.getElementById("update-form").reset();
        },
    });
};

$('.modal').on('hidden.bs.modal',function(){
    $(".alert").hide();$("form").trigger("reset");
});

function disableform(formId) {
    formId=formId.replace('#', '');
    var f = document.forms[formId].getElementsByTagName('input');
    for (var i=0;i<f.length;i++)
        f[i].disabled=true
    var f = document.forms[formId].getElementsByTagName('textarea');
    for (var i=0;i<f.length;i++)
        f[i].disabled=true
    var f = document.forms[formId].getElementsByClassName('btn');
    for (var i=0;i<f.length;i++)
        f[i].disabled=false
};

function enableform(formId) {
    formId=formId.replace('#', '');
    var f = document.forms[formId].getElementsByTagName('input');
    for (var i=0;i<f.length;i++)
        f[i].disabled=false
    var f = document.forms[formId].getElementsByTagName('textarea');
    for (var i=0;i<f.length;i++)
        f[i].disabled=false
    var f = document.forms[formId].getElementsByClassName('btn');
    for (var i=0;i<f.length;i++)
        f[i].disabled=false
};

$("#guardar").click(function() {
    let formulario = '#registro';
    let notificacion = '#notificacion';
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
                $("form").trigger("reset");
                $('#calendar').fullCalendar('refetchEvents');
            }
        }
       // $('.modal').scrollTop($('.modal').height());
       $('.modal').scrollTop(0);
    });
});