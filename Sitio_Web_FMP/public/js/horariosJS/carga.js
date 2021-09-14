function editar(json){

    $("#_id").val(json.id);
    $("#nombre_carga").val(json.nombre_carga); 
    $("#categoria").val(json.categoria);
    };


(function(window){
        window.htmlentities = {
            /**
             * Convierte una cadena a sus caracteres html por completo.
             *
             * @param {String} str String with unescaped HTML characters
             **/
            encode : function(str) {
                var buf = [];
                
                for (var i=str.length-1;i>=0;i--) {
                    buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
                }
                
                return buf.join('');
            },
            /**
             * Convierte un conjunto de caracteres html en su carácter original.
             *
             * @param {String} str htmlSet entities
             **/
            decode : function(str) {
                return str.replace(/&#(\d+);/g, function(match, dec) {
                    return String.fromCharCode(dec);
                });
            }
        };
    })(window);
//llenare el select con js
    $(document).ready(function() {

        $.ajax({
            url: 'Empleado',
            type: "GET",
            success: function(data){
                document.getElementById("jefe").disabled=false;
               data=JSON.parse(data);
    
                let $select = $('#jefe');
                $('#jefe').empty();
                for (let index = 0; index < data.length; index++) {
                    //console.log( data[index]);
                    $select.append('<option value=' + data[index].id + '>' + data[index].nombre+' '+data[index].apellido+
                    '</option>');
                    
                }
               
    
            }, 
            error: function(){
                document.getElementById("jefe").disabled=true;
                let $select = $('#jefe');
                $('#jefe').empty();
                    $select.append('<option value="" selected>No hay datos</option>');
                    
             }
    
            }); 

    });