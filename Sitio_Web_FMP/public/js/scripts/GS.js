
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
                    $('#salarioE').val(json.salario);
                    $('#nitE').val(json.nit);
                    $('#telE').val(json.tel);
                    $('#categoriaE').val(json.categoria).trigger("change");
                    $('#tipo_contratoE').val(json.contrato).trigger("change");
                    $('#tipo_jornadaE').val(json.jornada).trigger("change");
                    $('#deptoE').val(json.depto).trigger("change");
                    $('#tipo_empleadoE').val(json.tipo).trigger("change");
                    $('#jefe_empleadoE_option'+id).prop('disabled', !$('#jefe_empleadoE_option'+id).prop('disabled'));
                    $('#jefe_empleadoE').val(json.jefe).trigger("change");

                    $('#fotoE').width(ancho); 
                    $('#fotoE').height(alto);
                    $('#fotoE').attr('src',json.urlfoto===null?'/sin_imagen':json.urlfoto);;

                    $("#modalRegistro").modal();
            },
            complete: function() {
                $(boton).prop('disabled', false).html(''
                    +'<i class="fa fa-edit font-16" aria-hidden="true"></i>'
                );
            }
        });
    }    
