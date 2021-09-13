$('#A_carga').on('change', function() {
    let option = document.getElementById("A_carga").value;
    if(option=='ad'){
        document.getElementById("cantidad").disabled=true;
        document.getElementById("dias").disabled=false;
    }else if(option=='ps' || option=='tg'){
        document.getElementById("dias").disabled=true;
        document.getElementById("cantidad").disabled=false;
    }else{
        document.getElementById("cantidad").disabled=false;
        document.getElementById("dias").disabled=false;
    }
    $.ajax({
        url: 'ver/'+option,
        type: "GET",
        success: function(data){
            document.getElementById("carga").disabled=false;
           data=JSON.parse(data);

            let $select = $('#carga');
            $('#carga').empty();
            for (let index = 0; index < data.length; index++) {
                //console.log( data[index]);
                $select.append('<option value=' + data[index].id + '>' + data[index].nombre_carga+
                '</option>');
                
            }
           

        }, 
        error: function(){
            document.getElementById("carga").disabled=true;
            let $select = $('#carga');
            $('#carga').empty();
                $select.append('<option value="" selected>No hay datos</option>');
                
         }

        }); 
  });




$('.select2-multiple').select2();